<?php

session_start();

require_once(__DIR__ . '/../bootstrap/init.php');

$app = new \Framework\App;
$request = new \Framework\Http\Request;

$app->run($request);
