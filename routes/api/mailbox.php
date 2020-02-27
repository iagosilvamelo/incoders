<?php

$router->group(['prefix' => 'mailbox'], function($router) {

    $router->get('/',     'MailboxController@index');
    $router->get('/{id}', 'MailboxController@find');

});
