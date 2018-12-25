<?php

namespace Matcha\Middleware;

class CsrfViewMiddleware extends Middleware
{
	public function __invoke($request, $response, $next)
	{
		$nameKey = $this->container->csrf->getTokenNameKey();
		$valueKey = $this->container->csrf->getTokenValueKey();
		$name = $this->container->csrf->getTokenName();
		$value = $this->container->csrf->getTokenValue();

		 $this->container->view->getEnvironment()->addGlobal('csrf', [
			 'field' => '
				<input type="hidden" name="'. $nameKey . '" 
					value="'. $name .'">
				<input type="hidden" name="'. $valueKey .'" 
					value="'. $value .'">
			 ',
		 ]);

		$tokenArray = [
		$nameKey => $name,
		$valueKey => $value
		];

		$request = $request->withAttribute('ajax_csrf', $tokenArray);

		$response = $next($request, $response);
		return $response;
	}
}
