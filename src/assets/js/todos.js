$(document).ready(function(){

    $.ajax(
        {
            url: 'http://localhost:8001/getTaskList',
            type: 'GET',
            success: function (data) {
                var title = JSON.parse(data);
                var number = title.length;
                //var status = title.completed_status;
                for (var i = 0; i < number; i++) {
                    if(title[i]['completed_status'] == 0) {
                        $("#theList").append("<li id=" + title[i]['id'] + " > <span class='delete'><i class='fa fa-trash' aria-hidden='true'></i></span>" + title[i]['name'] + "</li>");
                    } else {
                        $("#theList").append("<li id=" + title[i]['id'] + " class='completed' > <span class='delete'><i class='fa fa-trash' aria-hidden='true'></i></span>" + title[i]['name'] + "</li>");
                    }
                }
            }
        })
})

$("ul").on("click", "li", function(){
    var value =$(this).prop('id');
    $.ajax({
        url: 'http://localhost:8001/getRecord?id='+ value,
        type:'GET',
        success:function(data){
            var title = JSON.parse(data);
            var status = title.completed_status;
            console.log(status);
             if (status == 0){
                 $.post('http://localhost:8001/markTaskAsCompleted', {id: value});
             } else {
                 $.post('http://localhost:8001/unmarkTaskAsCompleted', {id: value});
             }
        }
    })
    $(this).toggleClass("completed");


});

$("ul").on("click", "span", function(event){
    var value = $(this).closest("li").prop('id');

    $.post('http://localhost:8001/delete', {id:value});

    $(this).parent().fadeOut(500,function(){
        $(this).remove();

        console.log(value);
    });
    event.stopPropagation();

});

$("input[type='text']").keypress(function(e){
   if(e.which === 13){
       var input = $(this).val();
       $(this).val("");
       //$("ul").append("<li><span><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></span> " + input + "</li>");
       $.post('http://localhost:8001/addTask', {name: input});

   }
});

$(".fa-plus").click(function(){
    $("input[type='text']").fadeToggle();
})