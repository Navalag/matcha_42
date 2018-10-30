<?php

namespace Matcha\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

class InterestAvailableException extends ValidationException
{
	public static $defaultTemplates = [
		self::MODE_DEFAULT => [
			self::STANDARD => 'Interest is already taken',
		],
	];
}
