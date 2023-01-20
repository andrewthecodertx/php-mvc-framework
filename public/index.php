<?php

session_start();

use Framework\App;
use Framework\Request;

require_once(__DIR__.'/../bootstrap/init.php');


if(!isset($_SESSION['USERNAME'])) {
  $_SESSION['USERNAME'] = \Faker\Factory::create()->firstName;
}

$app = new App;

var_dump($_SERVER);

$routes = require(ROOT.'routes.php');
$request = new Request;

$app->run($request);
