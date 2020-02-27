<?php

$router->group(['prefix' => 'mailbox'], function($router) {

    $router->get('/', 'MailboxController@get_messages');

});
