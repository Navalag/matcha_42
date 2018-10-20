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
		$user = User::getAllUserInfo();
		$matchedPeople = MatchedPeople::getMyMatches();

		$viewArray = [];
		foreach ($matchedPeople as $row) {
			$userInfo = User::getUserInfoById(
							($row->first_id == $_SESSION['user']) 
							? $row->second_id : $row->first_id
						);
			$userPhoro = Photo::getPhotoSrcByUserId(
							($row->first_id == $_SESSION['user']) 
							? $row->second_id : $row->first_id
						);
			$userInterests = UserInterest::getInterestsValueByUserId(
							($row->first_id == $_SESSION['user']) 
							? $row->second_id : $row->first_id
						);
			$viewArray[] = array('chat_id' => $row->chat_id,
								 'basic_info' => $userInfo, 
								 'photo' => $userPhoro,
								 'interests' => $userInterests);
		}
		$this->container->view->getEnvironment()->addGlobal('array', $viewArray);

		return $this->view->render($response, 'search/my-matches.twig');
	}

	
}
