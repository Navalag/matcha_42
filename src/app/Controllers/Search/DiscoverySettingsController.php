<?php 

namespace Matcha\Controllers\Search;

use Matcha\Controllers\Controller;
use Matcha\Models\User;
use Matcha\Models\InterestList;
use Matcha\Models\DiscoverySettings;
use Matcha\Models\UserDiscoveryInterests;

use Respect\Validation\Validator as v;

class DiscoverySettingsController extends Controller
{
	public function getEditDiscoverySettings($request, $response) 
	{
		$userInfo = DiscoverySettings::getAllSettings();
		$interestsResult = $this->checker->allValueOfInterestsToSearch();
		$allInterests = InterestList::showAllInterests();
		$userAll = User::getAllUserInfo();

		$settings['max_distanse'] = $userInfo->max_distanse;
		$settings['min_age'] = $userInfo->min_age;
		$settings['max_age'] = $userInfo->max_age;
		$settings['min_rating'] = $userInfo->min_rating;
		$settings['max_rating'] = $userInfo->max_rating;
		$settings['looking_for'] = $userInfo->looking_for;
		$settings['lat'] = $userAll->lat;
		$settings['lng'] = $userAll->lng;

		$this->container->view->getEnvironment()->addGlobal('interests', $interestsResult);
		$this->container->view->getEnvironment()->addGlobal('allInterests', $allInterests);
		$this->container->view->getEnvironment()->addGlobal('settings', $settings);

		return $this->view->render($response, 'user/edit/discovery-settings.twig');
	}

	public function postEditDiscoverySettings($request, $response) 
	{
		$validation = $this->validator->validate($request, [
			'max-distanse' => v::notEmpty()->numeric(),
			'min-rating' => v::numeric(),
			'max-rating' => v::notEmpty()->numeric(),
			'min-age' => v::notEmpty()->numeric(),
			'max-age' => v::notEmpty()->numeric(),
			'looking_for' => v::notEmpty()->alpha(),
			'lat' => v::notEmpty()->numeric(),
			'lng' => v::notEmpty()->numeric(),
		]);

		if ($validation->failed()) {
			return $response->withRedirect($this->router->pathFor('user.search.discovery_settings'));
		}

		$settings['max_distanse'] = $request->getParam('max-distanse');
		$settings['min_rating'] = $request->getParam('min-rating');
		$settings['max_rating'] = $request->getParam('max-rating');
		$settings['min_age'] = $request->getParam('min-age');
		$settings['max_age'] = $request->getParam('max-age');
		$settings['looking_for'] = $request->getParam('looking_for');
		$settings['lat'] = $request->getParam('lat');
		$settings['lng'] = $request->getParam('lng');
		$this->container->view->getEnvironment()->addGlobal('settings', $settings);

		DiscoverySettings::setAll($settings);
		User::setGpsLocation($settings['lat'], $settings['lng']);
		return $response->withRedirect($this->router->pathFor('user.search.discovery_settings'));
	}

	public function postDeleteDiscoveryInterests($request, $response)
	{
		$interest = $request->getParam('interest');

		$interestRow = InterestList::where('interest', $interest)->first();
		if ($interestRow) {
			UserDiscoveryInterests::deleteInterest($interestRow->id);
		}
		/*
		** send csrf values for ajax request
		*/
		$ajax_csrf = $request->getAttribute('ajax_csrf');
		return $response->write(json_encode($ajax_csrf));
	}

	public function postAddDiscoveryInterests($request, $response)
	{
		$interest = $request->getParam('interest');

		$interestRow = InterestList::where('interest', $interest)->first();
		if ($interestRow) {
			UserDiscoveryInterests::setInterest($interestRow->id);
		}
		/*
		** send csrf values for ajax request
		*/
		$ajax_csrf = $request->getAttribute('ajax_csrf');
		return $response->write(json_encode($ajax_csrf));
	}
}
