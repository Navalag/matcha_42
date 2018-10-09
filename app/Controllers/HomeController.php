<?php

namespace Matcha\Controllers;

// use Matcha\Models\CheckEmail;
use Matcha\Models\User;
use Matcha\Models\UserInterest;
use Matcha\Models\Photo;
use Matcha\Controllers\Controller;
use Matcha\Controllers\Check\CheckController;
use Respect\Validation\Validator as v;

class HomeController extends Controller
{
	// protected $uniqid;
	// protected $email;
	// protected $user;
	// protected $validation;

	public function index($request, $response)
	{
		$allPhoto = Photo::getUserPhoto();
		$userInfo = $this->checker->user();
		$interestsResult = $this->checker->allValueOfInterests();

		$about['about_me'] = $userInfo->about_me;
		$about['age'] = $userInfo->age;
		$about['user_interests'] = $interestsResult;
		if ($allPhoto) {
			$about['user_photo'] = $allPhoto;
		}
		$this->container->view->getEnvironment()->addGlobal('about', $about);

		return $this->view->render($response, 'home.twig');
	}

	// public function hello($request, $response)
	// {
	// 	$this->flash->addMessage('info', 'Check you email and confinm your account');
	// 	return $this->view->render($response, 'hello/hello.twig');
	// }
}
