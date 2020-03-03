<?php

$router->group(['prefix' => 'danfe'], function($router) {

    $router->get('verify-mail', 'DanfeController@index');
    $router->get('send',        'MainController@send_danfes_to_api');

});
