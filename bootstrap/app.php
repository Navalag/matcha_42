<?php
/*
 * call Validator class as v
 */
use \Respect\Validation\Validator as v;
use Illuminate\Database\Capsule\Manager as DB;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../connect/create_table.php';

$settings = require_once __DIR__ . '/../conf/settings.php';
$app = new \Slim\App(['settings' => $settings]);
$container = $app->getContainer();

$capsule = new DB;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function ($container) use ($capsule) {
	return $capsule;
};

$container['flash'] = function ($container) {
	return new \Slim\Flash\Messages;
};

$container['view'] = function ($container) {
	$view = new \Slim\Views\Twig(__DIR__ . '/../resources/views', [
		'cache' => false,
	]);

	$view->addExtension(new \Slim\Views\TwigExtension(
		$container->router,
		$container->request->getUri()
	));

	$view->getEnvironment()->addGlobal('auth', [
		'user' => $container->checker->user(),
		'avatar' => $container->checker->avatarImg(),
	]);

	$view->getEnvironment()->addGlobal('flash', $container->flash);
	return $view;
};
$container['validator'] = function ($container) {
	return new \Matcha\Validation\Validator;
};
$container['HomeController'] = function ($container) {
	return new \Matcha\Controllers\HomeController($container);
};
$container['sendEmail'] = function ($container) {
	return new \Matcha\Controllers\Auth\SendEmailController($container);
};
$container['checker'] = function ($container) {
	return new \Matcha\Controllers\Check\CheckController($container);
};
$container['ActivateController'] = function ($container) {
	return new \Matcha\Controllers\Auth\ActivateController($container);
};
$container['AuthController'] = function ($container) {
	return new \Matcha\Controllers\Auth\AuthController($container);
};
$container['PasswordController'] = function ($container) {
	return new \Matcha\Controllers\Profile\PasswordController($container);
};
/*
** Profile controllers
*/
$container['EditController'] = function ($container) {
	return new \Matcha\Controllers\Profile\EditController($container);
};
$container['InterestsController'] = function ($container) {
	return new \Matcha\Controllers\Profile\InterestsController($container);
};
$container['upload_directory'] = $_SERVER['DOCUMENT_ROOT'] . 'img';
$container['PhotoController'] = function ($container) {
	return new \Matcha\Controllers\Profile\PhotoController($container);
};
/*
** Chat controllers
*/
$container['ChatController'] = function ($container) {
    return new \Matcha\Controllers\Chat\ChatController($container);
};
/*
** Find a Match controllers
*/
$container['DiscoverySettingsController'] = function ($container) {
	return new \Matcha\Controllers\Search\DiscoverySettingsController($container);
};
$container['SearchController'] = function ($container) {
	return new \Matcha\Controllers\Search\SearchController($container);
};
$container['SearchActionsController'] = function ($container) {
	return new \Matcha\Controllers\Search\SearchActionsController($container);
};
/*
** My Matches controllers
*/
$container['MyMatchesController'] = function ($container) {
	return new \Matcha\Controllers\Search\MyMatchesController($container);
};
/*
** Activity Log controllers
*/
$container['MyLogController'] = function ($container) {
	return new \Matcha\Controllers\Log\MyLogController($container);
};

$container['NotificationsController'] = function ($container) {
    return new \Matcha\Controllers\Notifications\NotificationsController($container);
};

/*
** CSRF middleware
*/
$container['csrf'] = function ($container) {
	return new \Slim\Csrf\Guard;
};
$container['logger'] = function($container) {
		$logger = new \Monolog\Logger('my_logger');
		$file_handler = new \Monolog\Handler\StreamHandler('../logs/app.log');
		$logger->pushHandler($file_handler);
		return $logger;
};

$app->add(new \Matcha\Middleware\ValidationErrorsMiddleware($container));
$app->add(new \Matcha\Middleware\CsrfViewMiddleware($container));
$app->add(new \Matcha\Middleware\CheckOnlineStatusMiddleware($container));

$app->add($container->csrf);

$container['notFoundHandler'] = function ($container) {
	return function ($request, $response) use ($container) {
		return $container->response
			->withStatus(404)
			->withHeader('Content-Type', 'text/html')
			->write('404 Error: Page not found');
		};
};
v::with('Matcha\\Validation\\Rules\\');
require_once __DIR__ . '/../app/routes.php';
