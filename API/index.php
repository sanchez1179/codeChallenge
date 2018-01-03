<?php

require 'core/auth.php';

require_auth();

header('Access-Control-Allow-Origin: *');

require 'core/Task.php';

require 'core/router.php';


?>

