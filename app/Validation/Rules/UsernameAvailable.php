<?php

namespace Matcha\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Matcha\Models\User;

class UsernameAvailable extends AbstractRule
{

    public function validate($input)
    {
        /*
         * найти в базе данных совпадение по email с $input и посчитать их количество
         * если оно > 0 то вернет false
         * есди = 0 то вернет true
         * */
        // if (User::find($_SESSION['user'])->username != $input)
        if (isset($_SESSION['user'])) {
            $user = User::find($_SESSION['user']);
            $user->username = strtolower($user->username);
            $newUsername = strtolower($input);
            if ($user->username == $newUsername) {
                return 1;
            }
        }
        	return User::where('username', $input)->count() === 0;
        // return true;
    }
}