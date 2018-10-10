<?php 

namespace Matcha\Controllers\Search;

use Matcha\Controllers\Controller;
use Slim\Http\Request;
use Slim\Http\Response;
use Matcha\Models\User;
use Matcha\Models\DiscoverySettings;

class DiscoverySettingsController extends Controller
{
	public function getEditDiscoverySettings($request, $response) 
	{
		$userInfo = DiscoverySettings::getAllSettings();

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

		$this->container->view->getEnvironment()->addGlobal('settings', $settings);

		return $this->view->render($response, 'user/edit/discovery-settings.twig');
	}

	public function postEditDiscoverySettings($request, $response) 
	{
		
	}
}
