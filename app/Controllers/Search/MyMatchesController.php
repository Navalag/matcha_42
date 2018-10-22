<?php

namespace Matcha\Controllers\Search;

use Matcha\Controllers\Controller;
use Matcha\Models\User;
use Matcha\Models\Photo;
use Matcha\Models\UserInterest;
use Matcha\Models\MatchedPeople;

use Respect\Validation\Validator as v;

class MyMatchesController extends Controller
{
	public function getMyMatches($request, $response)
	{
		// $user = User::getAllUserInfo();
		$matchedPeople = MatchedPeople::getMyMatches();

		$viewArray = [];
		foreach ($matchedPeople as $row) {
			$userInfo = User::getUserInfoById(
							($row->first_id == $_SESSION['user']) 
							? $row->second_id : $row->first_id
						);
			$userPhoto = Photo::getPhotoSrcByUserId(
							($row->first_id == $_SESSION['user']) 
							? $row->second_id : $row->first_id
						);
			$userInterests = UserInterest::getInterestsValueByUserId(
							($row->first_id == $_SESSION['user']) 
							? $row->second_id : $row->first_id
						);
			$viewArray[] = array('chat_id' => $row->chat_id,
								 'basic_info' => $userInfo, 
								 'photo' => $userPhoto,
								 'interests' => $userInterests);
		}
		$this->container->view->getEnvironment()->addGlobal('array', $viewArray);

		return $this->view->render($response, 'search/my-matches.twig');
	}

	public function getOtherUserProfile($request, $response) {
		$route = $request->getAttribute('route');
		$user_id = $route->getArgument('user_id');

		$userInfo = User::getUserInfoById($user_id);
		$userPhoto = Photo::getPhotoSrcByUserId($user_id);
		$userInterests = UserInterest::getInterestsValueByUserId($user_id);
		$viewArray[] = array(
							'basic_info' => $userInfo, 
							'photo' => $userPhoto,
							'interests' => $userInterests
							);
		$this->container->view->getEnvironment()->addGlobal('user', $viewArray);
		return $this->view->render($response, 'search/other-user.twig');
	}

	public function getUnmatch($request, $response) {
		$route = $request->getAttribute('route');
		$user_id = $route->getArgument('user_id');

		$myMatches = MatchedPeople::getMyMatches();
		foreach ($myMatches as $row) {
			if ($row->first_id == $user_id || $row->second_id == $user_id) {
				MatchedPeople::setUnmatch($user_id);
			}
		}
		
		return $response->withRedirect($this->router->pathFor('my-matches'));
	}
}
