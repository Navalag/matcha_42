<?php

namespace Matcha\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Matcha\Models\User;

class EmailAvailable extends AbstractRule
{

    public function validate($input)
    {
        /*
         * найти в базе данных совпадение по email с $input и посчитать их количество
         * если оно > 0 то вернет false
         * есди = 0 то вернет true
         * */
        
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


        