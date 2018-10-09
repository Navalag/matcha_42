<?php 

namespace Matcha\Controllers\Search;

use Matcha\Controllers\Controller;
use Slim\Http\Request;
use Slim\Http\Response;

class DiscoverySettingsController extends Controller
{
	public function getEditDiscoverySettings($request, $response) {

		return $this->view->render($response, 'user/edit/discovery-settings.twig');
	}

	public function postEditDiscoverySettings($request, $response) {
		
	}
}
