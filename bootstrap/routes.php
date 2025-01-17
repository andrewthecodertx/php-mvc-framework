<?php

use Framework\App;
use Framework\Router;
use App\Controllers;

Router::get('/', [Controllers\HomeController::class, 'index']);
Router::get('/about', [Controllers\HomeController::class, 'about']);
Router::get('/contact', [Controllers\HomeController::class, 'contact']);

Router::get('/testlink', function () {
  var_dump(App::get()->request()->body());
});

Router::get('/infolink', function () {
  phpinfo();
});

Router::get('/blog', [Controllers\BlogController::class, 'index']);
Router::get('/blog/{slug}', [Controllers\BlogController::class, 'show']);

Router::get('/user/{id}', [Controllers\UserController::class, 'show']);
Router::get('/user', [Controllers\UserController::class, 'index']);
