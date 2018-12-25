<?php

namespace Matcha\Middleware;

use Matcha\Models\LastActivityStatus;

class CheckOnlineStatusMiddleware extends Middleware
{
	public function __invoke($request, $response, $next)
	{
		if (isset($_SESSION['user'])) {
			$activity = LastActivityStatus::updateActivity();
		}

		$response = $next($request, $response);
		return $response;
	}
}
