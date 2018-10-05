<?php
/**
 * Created by PhpStorm.
 * User: ozharko
 * Date: 9/5/18
 * Time: 1:54 PM
 */

namespace Matcha\Controllers\Profile;

use Matcha\Models\InterestList;
use Matcha\Models\UserInterest;
use Matcha\Controllers\Controller;
use Respect\Validation\Validator as v;

class InterestsController extends Controller
{
	// public function getInterestsProfile($request, $response)
	// {
	//     $interestsResult = $this->checker->allValueOfInterests();
	//     $this->container->view->getEnvironment()->addGlobal('interests', $interestsResult);

	//     $allInterests = InterestList::showAllInterests();
	//     $this->container->view->getEnvironment()->addGlobal('allInterests', $allInterests);

	//     return $this->view->render($response, 'user/edit/interests.twig');
	// }

	// public function postInterestsProfile($request, $response)
	// {
	//     $validation = $this->validator->validate($request, [
	//         'interest' => v::notEmpty()->interestAvailable(),
	//     ]);

	//     if ($validation->failed()) {
	//         return $response->withRedirect($this->router->pathFor('user.edit.interests'));
	//     }

	//     $interest = $request->getParam('interest');

	//     $interest = InterestList::create([
	//         'interest' => $interest,
	//     ]);

	//     UserInterest::create([
	//         'user_id' => $_SESSION['user'],
	//         'interest_id' => $interest->id,
	//     ]);

	//     return $response->withRedirect($this->router->pathFor('user.edit.interests'));
	// }

	public function postDeleteInterestsProfile($request, $response)
	{
		$validation = $this->validator->validate($request, [
			'interest' => v::notEmpty(),
		]);
		if ($validation->failed()) {
			return $response->withRedirect($this->router->pathFor('user.edit.interests'));
		}
		$interest = $request->getParam('interest');

		// $interestWithTokenLikeKey = $request->getParsedBody();
		// $interestWithTokenLikeIndex = array_keys($interestWithTokenLikeKey);
		// $find = $interestWithTokenLikeIndex['0'];

		$allRowCurrentInterests = InterestList::where('interest', $interest)->first();
	   // r($allRowCurrentInterests->id);die();
		UserInterest::where('interest_id', $allRowCurrentInterests->id)->delete();
		/*
		** send csrf values for ajax request
		*/
		$ajax_csrf = $request->getAttribute('ajax_csrf');
		$response->write(json_encode($ajax_csrf));
		// return $response->withRedirect($this->router->pathFor('user.edit.interests'));
	}

	public function postAddInterestsProfile($request, $response)
	{
		$validation = $this->validator->validate($request, [
			'interest' => v::notEmpty(),
		]);

		if ($validation->failed()) {
			return $response->withRedirect($this->router->pathFor('user.edit.interests'));
		}

		$interest = $request->getParam('interest');

		$allRowCurrentInterests = InterestList::where('interest', $interest)->first();

		if (UserInterest::where('interest_id', $allRowCurrentInterests->id)->count() === 0)
		{
			UserInterest::create([
				'user_id' => $_SESSION['user'],
				'interest_id' => $allRowCurrentInterests->id,
			]);
		}
		/*
		** send csrf values for ajax request
		*/
		$ajax_csrf = $request->getAttribute('ajax_csrf');
		$response->write(json_encode($ajax_csrf));
		// return $response->withRedirect($this->router->pathFor('user.edit.interests'));
	}
}
