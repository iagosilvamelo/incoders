<?php

$router->group(['prefix' => 'danfe'], function($router) {

    $router->get('verify-mail', 'DanfeController@index');

});
