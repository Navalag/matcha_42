<?php

namespace Matcha\Controllers\Profile;

use Matcha\Models\InterestList;
use Matcha\Models\UserInterest;
use Matcha\Controllers\Controller;
use Respect\Validation\Validator as v;

class InterestsController extends Controller
{
	public function postDeleteInterestsProfile($request, $response)
	{
		$interest = $request->getParam('interest');

		$interestRow = InterestList::where('interest', $interest)->first();
		if ($interestRow)
		{
			UserInterest::where('user_id', $_SESSION['user'])
						->where('interest_id', $interestRow->id)
						->delete();
		}
		/*
		** send csrf values for ajax request
		*/
		$ajax_csrf = $request->getAttribute('ajax_csrf');
		return $response->write(json_encode($ajax_csrf));
	}

	public function postAddInterestsProfile($request, $response)
	{
		$interest = $request->getParam('interest');

		$interestRow = InterestList::where('interest', $interest)->first();
		if ($interestRow)
		{
			UserInterest::create([
				'user_id' => $_SESSION['user'],
				'interest_id' => $interestRow->id,
			]);
		}
		/*
		** send csrf values for ajax request
		*/
		$ajax_csrf = $request->getAttribute('ajax_csrf');
		return $response->write(json_encode($ajax_csrf));
	}
}
