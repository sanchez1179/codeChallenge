<?php

require 'core/database/QueryBuilder.php';

require'core/database/Connection.php';

require 'config.php';


$query = new QueryBuilder(Connection::conn($config));