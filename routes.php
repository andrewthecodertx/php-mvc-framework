<?php

use Framework\App;
use App\Controllers;
use Framework\Router;

Router::get('/', [Controllers\HomeController::class, 'index']);
Router::get('/about', [Controllers\HomeController::class, 'about']);
Router::get('/contact', [Controllers\HomeController::class, 'contact']);

Router::get('/testlink', function () {
	var_dump(App::get()->request()->body());
});

Router::get('/infolink', function () {
	phpinfo();
});

Router::get('/blog', [Controllers\BlogController::class, 'getblog']);
Router::get('/blog/{slug}', function() {
	
});
