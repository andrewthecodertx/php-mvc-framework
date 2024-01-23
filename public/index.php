<?php

session_start();
require_once(__DIR__ . '/../bootstrap/init.php');

if (!isset($_SESSION['USERNAME'])) {
  $_SESSION['USERNAME'] = \Faker\Factory::create()->firstName;
}

$app = new \Framework\App;

/* LOAD ALL THE ROUTES */
$routes = require(ROOT . 'routes.php');

/* CREATE THE REQUEST OBJECT */
$request = new \Framework\Request;

$app->run($request);
