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

use Respect\Validation\Validator as v;

class SearchActionsController extends Controller
{
	public function getBlockUser($request, $response)
	{
		$validation = $this->validator->validate($request, [
			'action_user_id' => v::notEmpty(),
		]);
		if ($validation->failed()) {
			return 'fail request';
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
			return 'fail request';
		}

		$action_user_id = $request->getParam('action_user_id');
		// print_r($action_user_id); die();
		FakeAccountReport::setFakeReport($action_user_id);
		return 'Report Fake Account Success';
	}


	public function isMatcha($first, $second)
	{
		$allLikes = Likes::all();

		foreach ($allLikes as $row) {
			if ($row->user_id == $second && $row->liked_id == $first) {
				Matcha::setMatcha($first, $second);
				return ;
			}
		}
	}

	public function isUnmatcha($first, $second)
	{
		$allLikes = Likes::all();

		foreach ($allLikes as $row) {
			if ($row->user_id == $second && $row->liked_id == $first) {
				Matcha::unsetMatcha($first, $second);
				return ;
			}
		}
	}


	public function getLike($request, $response)
	{
		$validation = $this->validator->validate($request, [
			// 'like' => v::notEmpty(),
			'liked_id' => v::notEmpty(),
		]);

		if ($validation->failed()) {
			$this->flash->addMessage('info', 'Fail');
			return 'validation failed';
			// return $response->withRedirect($this->router->pathFor('search.all'));
		}

		$user_id = $_SESSION['user'];
		$liked_id = $request->getParam('liked_id');

		if (!Likes::where(['user_id' => $user_id, 'liked_id' => $liked_id,])->first()) {
			Likes::create([
				'user_id' => $user_id,
				'liked_id' => $liked_id,
			]);
			$this->isMatcha($user_id, $liked_id);
			// подбор для рейтинга
			$user_id = $request->getParam('liked_id');

			$likedUser = User::where('id', $user_id)->first();

			$newRating = $likedUser->rating + 1;

			// нужна новая графа в базе для рейтинка
			User::where('id', $user_id)->update([
				'rating' => $newRating,
			]);
		}
		return 'success request';
		// return $response->withRedirect($this->router->pathFor('search.all'));
	}

	public function getNope($request, $response)
	{
		$validation = $this->validator->validate($request, [
			// 'unlike' => v::notEmpty(),
			'liked_id' => v::notEmpty(),
		]);

		if ($validation->failed()) {
			$this->flash->addMessage('info', 'Fail');
			return 'unlike fail validation';
			// return $response->withRedirect($this->router->pathFor('search.all'));
		}

		$user_id = $_SESSION['user'];
		$liked_id = $request->getParam('liked_id');

		$this->isUnmatcha($user_id, $liked_id);
		if (Likes::where(['user_id' => $user_id, 'liked_id' => $liked_id,])->first()) {
			Likes::where([
				'user_id' => $user_id,
				'liked_id' => $liked_id,
			])->delete();

			$user_id = $request->getParam('liked_id');

			$likedUser = User::where('id', $user_id)->first();

			$newRating = $likedUser->rating - 1;

			// нужна новая графа в базе для рейтинка
			if ($newRating >= 0)
			{
				User::where('id', $user_id)->update([
					'rating' => $newRating,
				]);
			}
		}
		return 'unlike success';
		// return $response->withRedirect($this->router->pathFor('search.all'));
	}
}
