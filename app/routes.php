<?php

use Matcha\Middleware\AuthMiddleware;
use Matcha\Middleware\GuestMiddleware;

/*
 * так как мы добавили контроллер HomeController в container (app.php)
 * мы можем ипользовать его методы чере одинарное двоиточие
 */

$app->group('', function () {
    /*
     * setName связан, с twig файлами path_for и return $response->withRedirect($this->router->path('home'));
     * */
    $this->get('/auth/signup', 'AuthController:getSignUp')->setName('auth.signup');
    $this->post('/auth/signup', 'AuthController:postSignUp');

    $this->get('/auth/signin', 'AuthController:getSignIn')->setName('auth.signin');
    $this->post('/auth/signin', 'AuthController:postSignIn');

    $this->get('/hello', 'HomeController:hello')->setName('hello');
    $this->post('/activate', 'ActivateController:activate');
})->add(new GuestMiddleware($container));


$app->group('', function () {
    $this->get('/', 'HomeController:index')->setName('home');
    
    $this->get('/auth/signout', 'AuthController:getSignOut')->setName('auth.signout');

    $this->get('/auth/password/change', 'PasswordController:getChangePassword')->setName('auth.password.change');
    $this->post('/auth/password/change', 'PasswordController:postChangePassword');

    $this->get('/auth/edit/profile', 'EditController:getChangeProfile')->setName('auth.edit.profile');
    $this->post('/auth/edit/profile', 'EditController:postChangeProfile');
})->add(new AuthMiddleware($container));

