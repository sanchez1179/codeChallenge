<?php



    require 'bootstrap.php';




    $method = $_SERVER['REQUEST_METHOD'];

    $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

    $numberOfCompleted = $query->checkCompletedCount();

    switch ($method) {

        case 'GET':

            if ($uri == 'getTaskList') {

                $query->selectAll($config['table']);

                break;

            } elseif ($uri == '') {

                $test = $query->getRecord($_REQUEST['id']);

                echo json_encode($test);

                break;

            } else {

                echo "404.Not Found";

                break;
            }

        case 'POST':

            if ($uri == 'updateTask') {

                $query->updateTask($config['table'], $_POST, $_POST['id']);

                break;

            } elseif ($uri == 'addTask') {

                if ($numberOfCompleted <= 2) {

                    $newTask = new Task($_POST);

                    $query->insert($config['table'], $newTask->task);

                    break;

                } else {

                    echo "There are already three incomplete tasks, please delete or complete at least one record before you can add another task";

                    break;

                }


            } elseif ($uri = 'delete'){

                $query->deleteRecord($_POST["id"]);

                break;

            }elseif ($uri = 'markTaskAsCompleted') {

                $check = $query->getRecord($_POST['id']);

                if ($check["completed_date"] == 0) {

                    $query->updateToCompleted($_POST['id']);

                } else {

                    echo $check['name'] . " has already been marked as completed";
                }

                break;

            }else {

                echo "404. Not Found";

                break;
            }

        default:

            echo "404. Not Found";

            break;

    }


