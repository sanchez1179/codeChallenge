<?php

require 'config.php';

require'core/database/Connection.php';

require 'core/database/QueryBuilder.php';


$query = new QueryBuilder(Connection::conn($config));