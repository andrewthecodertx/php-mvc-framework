<?php

require_once(__DIR__.'/../bootstrap/init.php');

$app = new \Framework\App;

$routes = require(ROOT.'routes.php');
$routes($app);

$app->run();