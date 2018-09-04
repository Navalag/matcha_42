<?php

use \App\Controllers\TopicController;
use \App\Controllers\UserController;
use \App\Controllers\ExampleController;

//var_dump(\App\Controllers\TopicController::class);
//die;

$app->group('/users', function () {
    $this->get('', UserController::class . ':index');
});

$app->group('/topics', function () {
    $this->get('', TopicController::class . ':index');
    $this->get('/{id}', TopicController::class . ':show')->setName('topics.show');
});


$app->get('/redirect', ExampleController::class . ':redirect');
$app->get('/landing', ExampleController::class . ':landing');