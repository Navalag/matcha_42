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
	public function index($request, $response)
	{
		$allPhoto = Photo::getUserPhoto();
		$userInfo = User::getAllUserInfo();
		$interestsResult = $this->checker->allValueOfInterests();

		$about['about_me'] = $userInfo->about_me;
		$about['age'] = $userInfo->age;
		$about['rating'] = $userInfo->fame_rating;
		$about['user_interests'] = $interestsResult;
		if ($allPhoto) {
			$about['user_photo'] = $allPhoto;
		}
		$this->container->view->getEnvironment()->addGlobal('about', $about);

		return $this->view->render($response, 'home.twig');
	}
}
