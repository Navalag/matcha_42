<?php

namespace Matcha\Controllers\Search;

use Matcha\Controllers\Controller;
use Slim\Http\Request;
use Slim\Http\Response;

use Matcha\Models\User;
use Matcha\Models\CheckProfileLog;
use Matcha\Models\LikeNopeCheck;
use Matcha\Models\FakeAccountReport;
use Matcha\Models\BlockUsersList;
use Matcha\Models\MatchedPeople;

use Respect\Validation\Validator as v;

class SearchActionsController extends Controller
{
	public function getBlockUser($request, $response)
	{
		$validation = $this->validator->validate($request, [
			'action_user_id' => v::notEmpty(),
		]);
		if ($validation->failed()) {
			return 'failed request';
		}

		$action_user_id = $request->getParam('action_user_id');
		BlockUsersList::setBlockUser($action_user_id);
		// return 'User is blocked';
		/*
		** send csrf values for ajax request
		*/
		$ajax_csrf = $request->getAttribute('ajax_csrf');
		return $response->write(json_encode($ajax_csrf));
	}

	public function getRepotFakeAccount($request, $response)
	{
		$validation = $this->validator->validate($request, [
			'action_user_id' => v::notEmpty(),
		]);
		if ($validation->failed()) {
			return 'failed request';
		}

		$action_user_id = $request->getParam('action_user_id');
		// print_r($action_user_id); die();
		FakeAccountReport::setFakeReport($action_user_id);
		// return 'Report Fake Account Success';
		/*
		** send csrf values for ajax request
		*/
		$ajax_csrf = $request->getAttribute('ajax_csrf');
		return $response->write(json_encode($ajax_csrf));
	}

	public function getCheckProfile($request, $response)
	{
		$validation = $this->validator->validate($request, [
			'action_user_id' => v::notEmpty(),
		]);
		if ($validation->failed()) {
			return 'failed request';
		}

		$action_user_id = $request->getParam('action_user_id');
		if (!LikeNopeCheck::checkIfFirstTimeOpenProfile($action_user_id)) 
		{
			LikeNopeCheck::setCheckRecord($action_user_id);
			$old_rating = User::getUserInfoById($action_user_id);
			if (($old_rating->fame_rating + 2) <= 100) {
				User::updateRating($action_user_id, $old_rating->fame_rating + 2);
			}
			// return 'check profile record success';
		}
		// return 'not first check';
		/*
		** send csrf values for ajax request
		*/
		$ajax_csrf = $request->getAttribute('ajax_csrf');
		return $response->write(json_encode($ajax_csrf));
	}

	public function getLike($request, $response)
	{
		$validation = $this->validator->validate($request, [
			'action_user_id' => v::notEmpty(),
		]);
		if ($validation->failed()) {
			return 'failed request';
		}

		$rating = 0;
		$liked_user_id = $request->getParam('action_user_id');

		if (!LikeNopeCheck::checkIfLike($liked_user_id))
		{
			LikeNopeCheck::createNewRecord($liked_user_id, 1);
			if (LikeNopeCheck::checkIfMatch($liked_user_id)) {
				MatchedPeople::setAMatch($liked_user_id);
				$rating += 5;
				$old_rating = User::getUserInfoById($_SESSION['user']);
				if (($old_rating->fame_rating + $rating) <= 95) {
					User::updateRating($_SESSION['user'], $old_rating->fame_rating + 5);
				}
				// echo "new match";
			}
			/*
			** update rating
			*/
			$old_rating = User::getUserInfoById($liked_user_id);

			if (($old_rating->fame_rating + $rating) <= 95) {
				$rating = $old_rating->fame_rating + $rating + 5;
				User::updateRating($liked_user_id, $rating);
			}
			// return 'success';
			/*
			** send csrf values for ajax request
			*/
			$ajax_csrf = $request->getAttribute('ajax_csrf');
			return $response->write(json_encode($ajax_csrf));
		}
		return ';-( some error occurred ;-(';
	}

	public function getNope($request, $response)
	{
		$validation = $this->validator->validate($request, [
			'action_user_id' => v::notEmpty(),
		]);
		if ($validation->failed()) {
			return 'failed request';
		}

		$nope_user_id = $request->getParam('action_user_id');

		if (!LikeNopeCheck::checkRecord($nope_user_id))
		{
			LikeNopeCheck::createNewRecord($nope_user_id, 0);
			// return 'success';
			/*
			** send csrf values for ajax request
			*/
			$ajax_csrf = $request->getAttribute('ajax_csrf');
			return $response->write(json_encode($ajax_csrf));
		}
		return ';-( some error occurred ;-(';
	}
}
