<?php

session_start();

require_once(__DIR__ . '/../bootstrap/init.php');

$app = new \Framework\App;
$request = new \Framework\Request;

$app->run($request);
