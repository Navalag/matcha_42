<?php

namespace Matcha\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Matcha\Models\User;

class EmailAvailable extends AbstractRule
{

	public function validate($input)
	{   
		// if (User::find($_SESSION['user'])->email != $input)
		if (isset($_SESSION['user'])) {
			$user = User::find($_SESSION['user']);
			$user->email = strtolower($user->email);
			$email = strtolower($input);
			if ($user->email == $email) {
				return 1;
			}
		}

		return User::where('email', $input)->count() === 0;
		// return true;
	}
}
