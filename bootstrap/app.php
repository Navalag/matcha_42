<?php
/*
 * call Validator class as v
 */
use \Respect\Validation\Validator as v;
// session_start();
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../connect/create_table.php'; // DB
// require_once __DIR__ . '/../php-ref-master/ref.php'; // для тестов

/* все настройки в отдельном файле потом ложаться в Slim __construct */
$settings = require_once __DIR__ . '/../conf/settings.php';
$app = new \Slim\App(['settings' => $settings]);
$container = $app->getContainer();

/* 
 * создать движок для работы с базой данных Laravel
 * Сначала создайте новый экземпляр менеджера «Capsule». 
 * Капсула стремится максимально упростить настройку библиотеки для использования вне рамок Laravel.
 * use Illuminate\Database\Capsule\Manager as Capsule; || $capsule = new Capsule;
 * дает возможность сортировки, выборки и т.д.
**/

$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
//Make this Capsule instance available globally.
$capsule->setAsGlobal();
// Setup the Eloquent ORM.
$capsule->bootEloquent();

/* read Laravel Documentation
 * создать движок для работы с БД а затем добавить его в container
 * длы работы с ним через db
 * use говорит о том что мне будет доступно все что храниться в переменной capsule
 * а добавление к db что я смогу получить это именно при работе с базой
 * так как с этой точки доступны все логины пароли и имена БД
 * */

$container['db'] = function ($container) use ($capsule) {
	return $capsule;
};
//$container['auth'] = function ($container) {
//    return new Matcha\Auth\Auth($container);
//};

/* сообщения что должны всплывать для подсказок пользователю 
 * взяты со сторонней библиотеки
 */

$container['flash'] = function ($container) {
	return new \Slim\Flash\Messages;
};

/* устлвив Twig через композер он добавился по пути Slim\Views\twig
 * мы создали объект по его главнуму классу
 * в конструктор передать путь где лежат файлы представления
 * и настройки по кэшу
 */

$container['view'] = function ($container) {
	$view = new \Slim\Views\Twig(__DIR__ . '/../resources/views', [
		'cache' => false,
	]);
	/* addExtension вызвать метод Slim который к изначально созданому объекту
	 * 
	 * добавит еще один объект который можно будет использовать внутри главного объекта
	 * добавить расширение в объект Twig через addExtension дополнительный объект TwigExtension
	 * в котором указаны возможности router и request->getUri() что лежат в контейнере
	 */
	$view->addExtension(new \Slim\Views\TwigExtension(
		$container->router,
		$container->request->getUri()
	));
	/* addGlobal это чисто Twig-кий функционал и он определяет по каким ключевым словам будет доступен 
	 * тот или иной метод
	 * 
	 * добавить в view часть того что есть в контейнере по auth
	 * auth class available inside of templates
	 * мы добавили класс auth в класс view
	 * помимо его общего доступа по всему приложению
	 * а и на стороне представления
	 * */
	$view->getEnvironment()->addGlobal('auth', [
		'check' => $container->checker->check(),
		'user' => $container->checker->user(),
	]);
	/* добавить в объект view набор возможностей flash чтобы использовать его на шаблонах twig */
	$view->getEnvironment()->addGlobal('flash', $container->flash);
	return $view;
};
$container['validator'] = function ($container) {
	return new \Matcha\Validation\Validator;
};
/* добавить класс в контроллер чтобы юзать его по всей проге */
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
	return new \Matcha\Controllers\Auth\PasswordController($container);
};
/*
** Profile Controllers
*/
$container['EditController'] = function ($container) {
	return new \Matcha\Controllers\Profile\EditController($container);
};
$container['AboutController'] = function ($container) {
	return new \Matcha\Controllers\Profile\AboutController($container);
};
$container['InterestsController'] = function ($container) {
	return new \Matcha\Controllers\Profile\InterestsController($container);
};
$container['UserInterest'] = function ($container) {
	return new \Matcha\Controllers\Profile\UserInterest($container);
};
$container['PhotoController'] = function ($container) {
	return new \Matcha\Controllers\Profile\PhotoController($container);
};
$container['DiscoverySettingsController'] = function ($container) {
	return new \Matcha\Controllers\Search\DiscoverySettingsController($container);
};
/*
** 
*/
$container['upload_directory'] = $_SERVER['DOCUMENT_ROOT'] . 'img';
$container['SearchController'] = function ($container) {
	return new \Matcha\Controllers\Search\SearchController($container);
};
$container['LikedController'] = function ($container) {
	return new \Matcha\Controllers\Search\LikedController($container);
};
$container['MatchaController'] = function ($container) {
	return new \Matcha\Controllers\Search\MatchaController($container);
};


$container['csrf'] = function ($container) {
	return new \Slim\Csrf\Guard;
};
$container['logger'] = function($container) {
		$logger = new \Monolog\Logger('my_logger');
		$file_handler = new \Monolog\Handler\StreamHandler('../logs/app.log');
		$logger->pushHandler($file_handler);
		return $logger;
};
/*
 * такое добавление классов через $app->add
 * позволяет им быть всегда в режиме прослушки запроса
 * поэтому все функции вызваны через магический метод __invoke
 * чтобы все запросы прошли через них без явного вызова функции
 * */
$app->add(new \Matcha\Middleware\ValidationErrorsMiddleware($container));
$app->add(new \Matcha\Middleware\OldInputMiddleware($container));
$app->add(new \Matcha\Middleware\CsrfViewMiddleware($container));
/* ???
 * csrf folder $container['csrf'] = function ($container) {}
 * активация самого Guard
 * */
$app->add($container->csrf);
/* Доделать 404 страничку
 * изменить стандартный вывод об ошибке 404
 * */
$container['notFoundHandler'] = function ($container) {
	return function ($request, $response) use ($container) {
		return $container->response
			->withStatus(404)
			->withHeader('Content-Type', 'text/html')
			->write('404 Error: Page not found');
		};
};
/*
 * allows this validation library to use out rules
 * give the name space to where out rules are kept
 * loading in all out rules
 * подключить библиотеку в наш класс Validator
 * сверху через use указан путь к библиотеке что надо использовать
 *
 * добавляет все методы что есть в библиотеке
 * их можно использовать как статические методы
 * */
v::with('Matcha\\Validation\\Rules\\');
require_once __DIR__ . '/../app/routes.php';
