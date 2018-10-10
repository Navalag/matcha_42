<?php 

namespace Matcha\Controllers\Search;

use Matcha\Controllers\Controller;
use Slim\Http\Request;
use Slim\Http\Response;
use Matcha\Controllers\Check\CheckController;
use Matcha\Models\User;
use Matcha\Models\InterestList;
use Matcha\Models\DiscoverySettings;
use Matcha\Models\UserDiscoveryInterests;

class DiscoverySettingsController extends Controller
{
	public function getEditDiscoverySettings($request, $response) 
	{
		$userInfo = DiscoverySettings::getAllSettings();
		$interestsResult = $this->checker->allValueOfInterestsToSearch();
		$allInterests = InterestList::showAllInterests();

		$settings['max_distanse'] = $userInfo->max_distanse;
		$settings['min_age'] = $userInfo->min_age;
		$settings['max_age'] = $userInfo->max_age;
		$settings['min_rating'] = $userInfo->min_rating;
		$settings['max_rating'] = $userInfo->max_rating;
		$settings['looking_for'] = $userInfo->looking_for;
		$settings['lat'] = $userInfo->lat;
		$settings['lng'] = $userInfo->lng;

		// $ip = $_SERVER['REMOTE_ADDR'];
		// $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
		// if($query && $query['status'] == 'success') {
		//   echo 'Hello visitor from '.$query['country'].', '.$query['city'].'!';
		// } else {
		//   echo 'Unable to get location';
		// }

		// if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		//    echo $ip = $_SERVER['HTTP_CLIENT_IP'];
		// } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		//   echo  $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		// } else {
		//    echo $ip = $_SERVER['REMOTE_ADDR'];
		// }
		// die();

		$this->container->view->getEnvironment()->addGlobal('interests', $interestsResult);
		$this->container->view->getEnvironment()->addGlobal('allInterests', $allInterests);
		$this->container->view->getEnvironment()->addGlobal('settings', $settings);

		return $this->view->render($response, 'user/edit/discovery-settings.twig');
	}

	public function postEditDiscoverySettings($request, $response) 
	{
		$settings['max_distanse'] = $request->getParam('max_distanse');
		$settings['min-rating'] = $request->getParam('min-rating');
		$settings['max-rating'] = $request->getParam('max-rating');
		$settings['min-age'] = $request->getParam('min-age');
		$settings['max-age'] = $request->getParam('max-age');
		$settings['interests'] = $request->getParam('interests');
		$settings['looking_for'] = $request->getParam('looking_for');

		var_dump($request->getParsedBody()); die();
	}

	// public function postDeleteDiscoveryInterests($request, $response)
	// {
	// 	$interest = $request->getParam('interest');

	// 	$interestRow = InterestList::where('interest', $interest)->first();
	// 	if ($interestRow)
	// 	{
	// 		UserInterest::where('user_id', $_SESSION['user'])
	// 					->where('interest_id', $interestRow->id)
	// 					->delete();
	// 	}
	// 	/*
	// 	** send csrf values for ajax request
	// 	*/
	// 	$ajax_csrf = $request->getAttribute('ajax_csrf');
	// 	return $response->write(json_encode($ajax_csrf));
	// }

	// public function postAddDiscoveryInterests($request, $response)
	// {
	// 	$interest = $request->getParam('interest');

	// 	$interestRow = InterestList::where('interest', $interest)->first();
	// 	if ($interestRow)
	// 	{
	// 		UserInterest::create([
	// 			'user_id' => $_SESSION['user'],
	// 			'interest_id' => $interestRow->id,
	// 		]);
	// 	}
	// 	/*
	// 	** send csrf values for ajax request
	// 	*/
	// 	$ajax_csrf = $request->getAttribute('ajax_csrf');
	// 	return $response->write(json_encode($ajax_csrf));
	// }
}
