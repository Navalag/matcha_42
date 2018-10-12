<?php

namespace  Matcha\Controllers\Search;

use Matcha\Controllers\Controller;
use Slim\Http\Request;
use Slim\Http\Response;
use Matcha\Models\User;
use Matcha\Models\Likes;
use Matcha\Models\DiscoverySettings;
use Matcha\Models\UserDiscoveryInterests;
use Matcha\Models\UserInterest;
use Respect\Validation\Validator as v;
use Matcha\Controllers\Search\MatchaController;
use Illuminate\Database\Capsule\Manager as DB;

class SearchController extends Controller
{
	public function checkInterests($userToCheck)
	{
		// $interestsActiveUser = UserDiscoveryInterests::getAll();
		// $interestsUserToCheck = UserInterest::where('user_id', $userToCheck->id)->first();

		// foreach ($interestsActiveUser as $row) {
		// 	foreach ($interestsUserToCheck as $checkUser) {
		// 		var_dump($interestsActiveUser);
		// 		if ($row->interest_id === $checkUser->interest_id) {
		// 			return $userToCheck;
		// 		}
		// 	}
		// }
		// return null;
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
			if ($row->active == 1 
				&& ($row->age >= $discovSet->min_age && $row->age <= $discovSet->max_age) 
				&& ($row->fame_rating >= $discovSet->min_rating && $row->fame_rating <= $discovSet->max_rating)) 
			{
				if (($discovSet->looking_for === 'man' 
					|| $discovSet->looking_for === 'both') && $row->gender === 'man') {
					$finalArray[] = $this->checkInterests($row);
				} elseif (($discovSet->looking_for === 'woman' 
						|| $discovSet->looking_for === 'both') 
						&& $row->gender === 'woman') {
					$finalArray[] = $this->checkInterests($row);
				} elseif ($discovSet->looking_for === 'both' 
						&& $row->gender === 'other') {
					$finalArray[] = $this->checkInterests($row);
				}
			}
		}
		var_dump($finalArray); die();

		// $about = About::where('user_id', $user->id)->first();

		$prefer = $about->sexual_pref;

		$allPrefer = About::where('sexual_pref', $prefer)->get();

		// поиск и запись всех кто нужен по полу
		foreach ($allPrefer as $row) {
			$arr[] = $row->user_id;
		}

		// всех bi туда же
		$allPreferBi = About::where('sexual_pref', "bi")->get();

		foreach ($allPreferBi as $row) {
			$arr[] = $row->user_id;
		}

		// все юзеры по базе User
		foreach ($arr as $user_id) {
			$row = User::where('id', $user_id)->first();
			$row->password = null;
			$userUser[] = $row;
		}
		// все юзеры в глобальном окружении
		$this->container->view->getEnvironment()->addGlobal('allUserForSearchUser', $userUser);

		// все юзеры по базе About
		foreach ($arr as $user_id) {
			$aboutUser[] = About::where('user_id', $user_id)->first();
		}
		// все о юзерах в глобальном окружении
//        var_dump($aboutUser);die;
//        $arJson = json_decode( $aboutUser, true );
//        var_dump( $arJson );die;
		$this->container->view->getEnvironment()->addGlobal('allUserForSearchAbout', $aboutUser);

		// return $this->view->render($response, 'search/all.twig');
		return $this->view->render($response, 'search/find-a-match.twig');
	}
}
