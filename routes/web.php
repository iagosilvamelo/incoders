<?php

$router->group(['prefix' => 'api'], function($router) {

    foreach(glob(__DIR__."/api/*.php") as $file) {
        require $file;
    }

});

$router->get('/', function () use ($router) {
    return $router->app->version();
});
