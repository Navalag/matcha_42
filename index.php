<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';

$settings = require_once __DIR__ . '/app/settings.php';
//var_dump($settings);
//die;

$app = new \Slim\App(['settings' => $settings]);

$container = $app->getContainer();

/*
 *  чтобы подключить компоненты по работе с TWIG VIEW
 *  надо добавть сосдание класса в контейнер
 * */

$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig('resources/views', [
        'cache' => false
    ]);

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container->get('request')->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container->get('router'), $basePath));

    return $view;
};

//____________________________________________________
//$container['greeting'] = function () {
//	return 'Hello from the container';
//};
/*
 *	вызвать метод с контейнера через $this 
 *	так как новый метод добавлен в тело класса Slim
 *	вызов происходит без (), только имя;
 */
//$app->get('/', function () {
//	echo $this->greeting;
//});
//____________________________________________________



$app->get('/', function ($request, $response) {
    return $this->view->render($response, 'home.twig');
})->setName('home');

$app->get('/users/yo', function($request, $response) {
    $users = [
        ['username' => 'alex'],
        ['username' => 'alex'],
        ['username' => 'alex'],
    ];
   return $this->view->render($response, 'users.twig', [
       'users' => $users,
   ]);
})->setName('users.index'); // стаким именем можно быть спокойным за сам запрос

/*_____________________________________________________________*/
$app->get('/contact', function ($request, $response) {
    return $this->view->render($response, 'contacts.twig');
//    return "Hello";
});

$app->post('/contact', function ($request, $response) {
     $params = $request->getParam('email'); // getParam собирает данные с POST,

    var_dump($params);
})->setName('contact');
/*_____________________________________________________________*/

$app->get('/users', function ($request,$response) {
    echo $request->getParam('page');
});

$app->run();