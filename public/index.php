<?php

use Framework\App;
use Framework\Request;

require_once(__DIR__.'/../bootstrap/init.php');

session_start();

$app = new App;

var_dump($_SERVER);

$routes = require(ROOT.'routes.php');
$request = new Request;

$app->run($request);
