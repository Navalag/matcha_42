<?php

namespace Matcha\Controllers\Search;

use Matcha\Controllers\Controller;

use Respect\Validation\Validator as v;

class MyMatchesController extends Controller
{
	public function getMyMatches($request, $response)
	{
		return $this->view->render($response, 'search/my-matches.twig');
	}

	
}
