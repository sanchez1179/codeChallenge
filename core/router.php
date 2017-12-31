<?php

    require 'bootstrap.php';

    $method = $_SERVER['REQUEST_METHOD'];

    $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

    $numberOfCompleted = $query->checkCompletedCount();

    switch ($method){

        case 'GET':

            if($uri == 'getTaskList'){

                $test = $query->selectAll($config['table']);

                return $test;

            } elseif($uri ==''){

                $test = $query->getRecord($_REQUEST['id']);

                var_dump($test);

                break;

            }

        case 'POST':

            if($uri == 'updateTask'){

                $query->updateTask($config['table'], $_POST, $_POST['id']);

                break;

            } elseif($uri == 'addTask'){

                if($numberOfCompleted <= 4){

                    $newTask = new Task($_POST);

                    $query->insert($config['table'], $newTask->task);

                    break;

                } else {

                    echo "There are already three incomplete tasks, please delete or complete at least one record before you can add another task";

                    break;

                }


            }elseif($uri = 'markTaskAsCompleted') {

                $query->updateToCompleted($_POST['id']);

                break;

            } else {

                "404. Not Found";

                break;
            }

        default:

            "404. Not Found";

    }

