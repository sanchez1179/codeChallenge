<?php


function require_auth(){

    $AUTH_USER = 'admin';

    $AUTH_PASS = 'admin';

    header('Cache-Control: no-cache, must-revalidate, max-age=0');

    $has_supplied_crentials = !(empty($_SERVER['PHP_AUTH_USER']) && empty($_SERVER['PHP_AUTH_PW']));

    $is_not_authenticated = (

        !$has_supplied_crentials ||

        $_SERVER['PHP_AUTH_USER'] != $AUTH_USER ||

        $_SERVER['PHP_AUTH_PW'] != $AUTH_PASS

    );

    if($is_not_authenticated){

        header('HTTP/1.1 401 Authorization required');

        header('WWW-Authenticate: Basic realm = "Access denied"');

        echo "you can't get in";

        exit;
    }

}