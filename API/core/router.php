<?php

    require 'bootstrap.php';

    $method = $_SERVER['REQUEST_METHOD'];

    $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

    $numberOfCompleted = $query->checkCompletedCount();

    switch ($method) {

        case 'GET':

            switch($uri){

                case 'getTaskList':

                    $query->selectAll($config['table']);

                    break;

                case 'getRecord':

                    $test = $query->getRecord($_REQUEST['id']);

                    echo json_encode($test);

                    break;

                default:

                echo "404.Not Found";

                break;
            }


        case 'POST':

             switch($uri){

                 case'updateTask':

                    $query->updateTask($config['table'], $_POST, $_POST['id']);

                    break;

                 case 'addTask':

                    if ($numberOfCompleted <= 2) {

                        $newTask = new Task($_POST);

                        $query->insert($config['table'], $newTask->task);

                        break;

                     } else {

                        echo "There are already three incomplete tasks, please delete or complete at least one record before you can add another task";

                        break;

                }


                 case 'delete':

                    $query->deleteRecord($_POST["id"]);

                     break;

                 case 'markTaskAsCompleted':

                    $check = $query->getRecord($_POST['id']);

                    if ($check["completed_status"] == 0) {

                        $query->updateToCompleted($_POST['id']);

                        break;

                    } else {

                        echo $check['name'] . " has already been marked as completed";

                        break;
                    }

                 case'unmarkTaskAsCompleted':

                     $query->updateToIncomplete($_POST['id']);

                     break;


            }
    }


