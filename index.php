<?php

require 'core/bootstrap.php';

require 'core/Task.php';


$test = $query->selectAll($config['table']);

//$method = $_SERVER['REQUEST_METHOD'];

//$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

$it = new Task($_POST);

//var_dump($it);



//var_dump($test);






?>

