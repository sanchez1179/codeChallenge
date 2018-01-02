$(document).ready(function(){

    $.ajax(
        {
            url: 'http://localhost:8001/getTaskList',
            type: 'GET',
            success: function (data) {

                var title = JSON.parse(data);

                var number = title.length;

                for (var i = 0; i < number; i++) {

                    $("#theList").append("<li> <span class='delete'><i class='fa fa-trash' aria-hidden='true'></i></span>"+ title[i]['name'] + "</li>");

                }
            }
        })
})

$("ul").on("click", "li", function(){
    $(this).toggleClass("completed");
});

$("ul").on("click", "span", function(event){

    $(this).parent().fadeOut(500,function(){
        $(this).remove();
    });
    event.stopPropagation();
});

$("input[type='text']").keypress(function(e){
   if(e.which === 13){
       var input = $(this).val();
       $(this).val("");
       $("ul").append("<li><span><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></span> " + input + "</li>")

   }
});

$(".fa-plus").click(function(){
    $("input[type='text']").fadeToggle();
})