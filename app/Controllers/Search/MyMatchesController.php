<?php

namespace Matcha\Controllers\Search;

use Matcha\Controllers\Controller;
use Matcha\Models\User;
use Matcha\Models\Photo;
use Matcha\Models\UserInterest;
use Matcha\Models\MatchedPeople;
use Matcha\Models\LikeNopeCheck;
use Matcha\Models\LastActivityStatus;

use Respect\Validation\Validator as v;

class MyMatchesController extends Controller
{
	public function getMyMatches($request, $response)
	{
		// $user = User::getAllUserInfo();
		$matchedPeople = MatchedPeople::getMyMatches();

		$viewArray = [];
		foreach ($matchedPeople as $row) {
			$onlineStatus = LastActivityStatus::checkIfUserOnline(
							($row->first_id == $_SESSION['user']) 
							? $row->second_id : $row->first_id
						);
			$userInfo = User::getUserInfoById(
							($row->first_id == $_SESSION['user']) 
							? $row->second_id : $row->first_id
						);
			$userPhoto = Photo::getPhotoSrcByUserId(
							($row->first_id == $_SESSION['user']) 
							? $row->second_id : $row->first_id
						);
			// $userInterests = UserInterest::getInterestsValueByUserId(
			// 				($row->first_id == $_SESSION['user']) 
			// 				? $row->second_id : $row->first_id
			// 			);
			$viewArray[] = array('chat_id' => $row->chat_id,
								 'basic_info' => $userInfo, 
								 'photo' => $userPhoto,
								 'online' => $onlineStatus == 1 ? 'online' 
								 			:$onlineStatus
								);
		}
		$this->container->view->getEnvironment()->addGlobal('array', $viewArray);

		return $this->view->render($response, 'search/my-matches.twig');
	}

	public function getOtherUserProfile($request, $response) {
		$route = $request->getAttribute('route');
		$user_id = $route->getArgument('user_id');

		if (LikeNopeCheck::checkIfMatch($user_id) 
			|| LikeNopeCheck::checkIfUserLikeOrVisitMe($user_id)) 
		{
			$onlineStatus = LastActivityStatus::checkIfUserOnline($user_id);
			$userInfo = User::getUserInfoById($user_id);
			$userPhoto = Photo::getPhotoSrcByUserId($user_id);
			$userInterests = UserInterest::getInterestsValueByUserId($user_id);
			$viewArray[] = array(
								'basic_info' => $userInfo, 
								'photo' => $userPhoto,
								'interests' => $userInterests,
								'online' => $onlineStatus == 1 ? 'online' 
								 			:$onlineStatus
								);
			$this->container->view->getEnvironment()->addGlobal('user', $viewArray);

			return $this->view->render($response, 'search/other-user.twig');
		}
		return $response->withRedirect($this->router->pathFor('home'));
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
