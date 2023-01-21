<?php

session_start();

use Framework\App;
use Framework\Request;

require_once(__DIR__.'/../bootstrap/init.php');


if(!isset($_SESSION['USERNAME'])) {
  $_SESSION['USERNAME'] = \Faker\Factory::create()->firstName;
}

$app = new App;

/* LOAD ALL THE ROUTES */
$routes = require(ROOT.'routes.php');

/* CREATE THE REQUEST OBJECT */
$request = new Request;

$app->run($request);
