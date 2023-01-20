<?php

require_once(__DIR__.'/../bootstrap/init.php');

session_start();

$app = new \Framework\App;

var_dump($_SERVER);
var_dump($_GET);
var_dump(http_response_code());

$routes = require(ROOT.'routes.php');

$app->run();