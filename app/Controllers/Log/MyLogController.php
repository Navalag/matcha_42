<?php

namespace Matcha\Controllers\Log;

use Matcha\Controllers\Controller;

use Respect\Validation\Validator as v;

class MyLogController extends Controller
{
	public function getActivityLog($request, $response)
	{
		return $this->view->render($response, 'log/my-activity-log.twig');
	}

	
}
