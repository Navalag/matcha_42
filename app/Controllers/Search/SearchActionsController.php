<?php

namespace Matcha\Controllers\Search;

use Matcha\Controllers\Controller;

use Matcha\Models\User;
use Matcha\Models\CheckProfileLog;
use Matcha\Models\LikeNopeCheck;
use Matcha\Models\FakeAccountReport;
use Matcha\Models\BlockUsersList;
use Matcha\Models\MatchedPeople;
// use Matcha\Models\Notifications;

use Respect\Validation\Validator as v;

class SearchActionsController extends Controller
{
	public function getBlockUser($request, $response)
	{
		$validation = $this->validator->validate($request, [
			'action_user_id' => v::notEmpty(),
		]);
		if ($validation->failed()) {
			return $response->write(json_encode([
				'csrf'=>$request->getAttribute('ajax_csrf'),
				'msg'=>'error validation'
			]));
		}

		$action_user_id = $request->getParam('action_user_id');
		BlockUsersList::setBlockUser($action_user_id);
		
		return $response->write(json_encode([
			'csrf'=>$request->getAttribute('ajax_csrf'),
			'msg'=>'user is blocked'
		]));
	}

	public function getRepotFakeAccount($request, $response)
	{
		$validation = $this->validator->validate($request, [
			'action_user_id' => v::notEmpty(),
		]);
		if ($validation->failed()) {
			return $response->write(json_encode([
				'csrf'=>$request->getAttribute('ajax_csrf'),
				'msg'=>'error validation'
			]));
		}

		$action_user_id = $request->getParam('action_user_id');
		FakeAccountReport::setFakeReport($action_user_id);

		return $response->write(json_encode([
			'csrf'=>$request->getAttribute('ajax_csrf'),
			'msg'=>'Report Fake Account Success'
		]));
	}

	public function getCheckProfile($request, $response)
	{
		$validation = $this->validator->validate($request, [
			'action_user_id' => v::notEmpty(),
		]);
		if ($validation->failed()) {
			return $response->write(json_encode([
				'csrf'=>$request->getAttribute('ajax_csrf'),
				'msg'=>'error validation'
			]));
		}

		$action_user_id = $request->getParam('action_user_id');
		if (!LikeNopeCheck::checkIfFirstTimeOpenProfile($action_user_id)) 
		{
			LikeNopeCheck::setCheckRecord($action_user_id);
			$old_rating = User::getUserInfoById($action_user_id);
			if (($old_rating->fame_rating + 2) <= 100) {
				User::updateRating($action_user_id, $old_rating->fame_rating + 2);
			}
			return $response->write(json_encode([
				'csrf'=>$request->getAttribute('ajax_csrf'),
				'msg'=>'success new record'
			]));
		}
		/*
		** send csrf values for ajax request
		*/
		return $response->write(json_encode([
			'csrf'=>$request->getAttribute('ajax_csrf'),
			'msg'=>'no new record'
		]));
	}

	public function getLike($request, $response)
	{
		$validation = $this->validator->validate($request, [
			'action_user_id' => v::notEmpty(),
		]);
		if ($validation->failed()) {
			return $response->write(json_encode([
				'csrf'=>$request->getAttribute('ajax_csrf'),
				'msg'=>'error validation'
			]));
		}

		$rating = 0;
		$liked_user_id = $request->getParam('action_user_id');

		if (!LikeNopeCheck::checkIfLike($liked_user_id))
		{
			LikeNopeCheck::createNewRecord($liked_user_id, 1);
			if (LikeNopeCheck::checkIfMatch($liked_user_id)) {
				MatchedPeople::setAMatch($liked_user_id);
				$old_rating = User::getUserInfoById($_SESSION['user']);
				if (($old_rating->fame_rating + 10) <= 90) {
					User::updateRating($_SESSION['user'], $old_rating->fame_rating + 10);
				}
				return $response->write(json_encode([
					'csrf'=>$request->getAttribute('ajax_csrf'),
					'msg'=>'new match'
				]));
			}
			/*
			** update rating
			*/
			$old_rating = User::getUserInfoById($liked_user_id);

			if (($old_rating->fame_rating + $rating) <= 95) {
				$rating = $old_rating->fame_rating + $rating + 5;
				User::updateRating($liked_user_id, $rating);
			}
			/*
			** send csrf values for ajax request
			*/
			return $response->write(json_encode([
				'csrf'=>$request->getAttribute('ajax_csrf'),
				'msg'=>'success'
			]));
		}
		return $response->write(json_encode([
			'csrf'=>$request->getAttribute('ajax_csrf'),
			'msg'=>'some error occurred'
		]));
	}

	public function getNope($request, $response)
	{
		$validation = $this->validator->validate($request, [
			'action_user_id' => v::notEmpty(),
		]);
		if ($validation->failed()) {
			return $response->write(json_encode([
				'csrf'=>$request->getAttribute('ajax_csrf'),
				'msg'=>'error validation'
			]));
		}

		$nope_user_id = $request->getParam('action_user_id');

		if (LikeNopeCheck::createNewRecord($nope_user_id, 0)) {
			return $response->write(json_encode([
				'csrf'=>$request->getAttribute('ajax_csrf'),
				'msg'=>'success'
			]));
		}
		return $response->write(json_encode([
			'csrf'=>$request->getAttribute('ajax_csrf'),
			'msg'=>'some error occurred'
		]));
	}
}
