<?php

use Framework\App;
use App\Controllers;

return function (App $app)
{
    $app->get('/', [Controllers\HomeController::class, 'index']);
    $app->get('/about', [Controllers\HomeController::class, 'about']);
    $app->get('/contact', function() {
        var_dump(App::load()->request()->body());
    });

    $app->get('/blog', [Controllers\BlogController::class, 'index']);
    $app->get('/blog/{id}', [Controllers\BlogController::class, 'index']);
};