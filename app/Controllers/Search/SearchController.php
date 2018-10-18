<?php

namespace  Matcha\Controllers\Search;

use Matcha\Controllers\Controller;
use Slim\Http\Request;
use Slim\Http\Response;
use Matcha\Models\User;
use Matcha\Models\DiscoverySettings;
use Matcha\Models\UserDiscoveryInterests;
use Matcha\Models\UserInterest;
use Matcha\Models\BlockUsersList;
use Matcha\Models\LikeNope;
use Matcha\Models\Photo;
use Matcha\Controllers\Check\CheckController;
use Respect\Validation\Validator as v;
use Illuminate\Database\Capsule\Manager as DB;

class SearchController extends Controller
{
	public function checkInterests($usersToFilter)
	{
		$interestsActiveUser = UserDiscoveryInterests::getAll();
		/*
		** check if no interests to search - does not use this filter
		*/
		if (!$interestsActiveUser[0]) {
			return $usersToFilter;
		}
		$result = [];
		foreach ($usersToFilter as $row) {
			$interestsUserToCheck = UserInterest::where('user_id', $row->id)->get();
			foreach ($interestsActiveUser as $interest) {
				foreach ($interestsUserToCheck as $checkInterest) {
					if ($interest->interest_id === $checkInterest->interest_id) {
						$result[] = $row;
						break 2;
					}
				}
			}
		}
		// print_r($result); die();
		return $result;
	}

	public function checkBlockList($usersToFilter)
	{
		$userList = BlockUsersList::getAll();
		$result = [];
		$i = 0;

		foreach ($usersToFilter as $row) {
			foreach ($userList as $blockMark) {
				if ($blockMark->blocked_user_id === $row->id) {
					$i = 1;
					break ;
				}
			}
			if ($i == 0) {
				$result[] = $row;
			}
			$i = 0;
		}
		// print_r($result); die();
		return $result;
	}

	public function checkAlreadyLikeNope($usersToFilter)
	{
		$likeTable = LikeNope::getAll();
		$result = [];
		$i = 0;

		foreach ($usersToFilter as $row) {
			foreach ($likeTable as $likeNope) {
				if ($likeNope->action_user_id === $row->id) {
					$i = 1;
					break ;
				}
			}
			if ($i == 0) {
				$result[] = $row;
			}
			$i = 0;
		}
		// print_r($result); die();
		return $result;
	}

	public function getAllProfile($request, $response)
	{
		$user = User::getAllUserInfo();
		$discovSet = DiscoverySettings::getAllSettings();

		$selectedUsers = DB::select("SELECT * , ( 6371 
			* acos( cos( radians( $user->lat ) ) 
				* cos( radians( lat ) ) 
				* cos( radians( lng ) - radians( $user->lng ) )
				+ sin( radians( $user->lat ) ) 
				* sin( radians( lat ) ) 
			) ) AS distance FROM user HAVING distance < ?;", [$discovSet->max_distanse]);
		// var_dump($selectedUsers);

		$finalArray = [];
		foreach ($selectedUsers as $row) {
			if ($row->id === $user->id) {
				continue;
			}
			if ($row->active == 1 
				&& ($row->age >= $discovSet->min_age && $row->age <= $discovSet->max_age) 
				&& ($row->fame_rating >= $discovSet->min_rating && $row->fame_rating <= $discovSet->max_rating)) 
			{
				if (($discovSet->looking_for === 'man' 
					|| $discovSet->looking_for === 'both') && $row->gender === 'man') {
					$finalArray[] = $row;
				} elseif (($discovSet->looking_for === 'woman' 
						|| $discovSet->looking_for === 'both') 
						&& $row->gender === 'woman') {
					$finalArray[] = $row;
				} elseif ($discovSet->looking_for === 'both' 
						&& $row->gender === 'other') {
					$finalArray[] = $row;
				}
			}
		}

		if (!empty($finalArray)) {
			$finalArray = $this->checkBlockList($finalArray);
		}
		if (!empty($finalArray)) {
			$finalArray = $this->checkAlreadyLikeNope($finalArray);
		}
		if (!empty($finalArray)) {
			$finalArray = $this->checkInterests($finalArray);
		}

		$viewArray = [];
		foreach ($finalArray as $row) {
			$userPhoro = Photo::getPhotoSrcByUserId($row->id);
			$userInterests = UserInterest::getInterestsValueByUserId($row->id);
			$viewArray[] = array('active' => $user->active,
								 'basic_info' => $row, 
								 'photo' => $userPhoro,
								 'interests' => $userInterests);
		}
		$this->container->view->getEnvironment()->addGlobal('array', $viewArray);
		// print_r($viewArray); die();

		return $this->view->render($response, 'search/find-a-match.twig');
	}
}
