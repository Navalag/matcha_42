<?php

namespace Matcha\Controllers\Search;

use Matcha\Controllers\Controller;
use Slim\Http\Request;
use Slim\Http\Response;

use Matcha\Models\User;
use Matcha\Models\CheckProfileLog;
use Matcha\Models\LikeNope;
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
		return 'User is blocked';
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
		return 'Report Fake Account Success';
	}

	public function getLike($request, $response)
	{
		// print_r($request->getParam('action_user_id')); die();
		$validation = $this->validator->validate($request, [
			'action_user_id' => v::notEmpty(),
		]);
		if ($validation->failed()) {
			return 'failed request';
		}

		$liked_user_id = $request->getParam('action_user_id');

		if (!LikeNope::checkRecord($liked_user_id))
		{
			LikeNope::createNewRecord($liked_user_id, 1);
			if (LikeNope::checkIfMatch($liked_user_id)) {
				MatchedPeople::setAMatch($liked_user_id);
				echo "new match";
			}
			/*
			** update rating
			*/

			return 'success';
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

		if (!LikeNope::checkRecord($nope_user_id))
		{
			LikeNope::createNewRecord($nope_user_id, 0);
			
			/*
			** update rating
			*/

			return 'success';
		}
		return ';-( some error occurred ;-(';
	}
}
