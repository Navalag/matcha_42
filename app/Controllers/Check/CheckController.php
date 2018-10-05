<?php

namespace Matcha\Controllers\Check;

use Matcha\Models\User;
use Matcha\Models\About;
use Matcha\Models\UserInterest;
use Matcha\Models\InterestList;

class CheckController
{
    /* find вернет user->id
     * */

    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }
    public function user()
    {
        if (isset($_SESSION['user'])) {
            return User::find($_SESSION['user']);
        }
    }

    public function allUserInterests()
    {
        if (isset($_SESSION['user']))
            return UserInterest::all();
    }

    public function allAboutUser()
    {
        if (isset($_SESSION['user'])) {
            return About::find($_SESSION['user']);
            // return About::where('user_id', $_SESSION['user'])->first();
        }
    }

    public function allValueOfInterests()
    {
        $interestsResult = [];
        $userInterest = $this->allUserInterests();
        foreach($userInterest as $row) {
            if ($row->user_id == $_SESSION['user']) {
                $interestRow = InterestList::where('id', $row->interest_id)->first();
                $interestsResult[] = $interestRow->interest;
            }
        }
        if ($interestsResult)
            return $interestsResult;
    }

    public function check()
    {
        return isset($_SESSION['user']);
    }

    /*
     * получаем для входа email и password
     * отправляем email в model User и запрагиваем поиск по email
     * просим вернуть первую найденую строку она же и единственная с таким email
     * елси ответ путой false
     * после взять переданный пароль и проверить на совпадение
     * если и пароль есть то  все ok true
     * иначе выйдет с if и return false
     */

    public function attempt($email, $password)
    {
        /*
         * так как у нас добавлена библиотека Illuminate\Database\Eloquent\Model
         * мы используем ее методы через статическое обращение к функции
         */
        $user = User::where('email', $email)->first();

        if (!$user) {
            // $this->flash->addMessage('error', 'Email not found');
            return false;
        }

        if (password_verify($password, $user->password)) {
            $_SESSION['user'] = $user->id;
            return true;
        }
        else {
            $_SESSION['errors']['password']['0'] = "wrong password";
        }

        return false;
    }

//    public function logout()
//    {
//        unset($_SESSION['user']);
//    }

    public function comparePasswords($password1, $password2, $response)
    {
        if (strcmp($password1, $password2) != 0)
        {
            // $_SESSION['errors']['password_new']['0'] = "Different password";
            return 1;
        }
    }

    /*
    ** Generate a random string, using a cryptographically secure 
    ** pseudorandom number generator (random_int)
    */
    function random_str($length) {
        $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $str = '';
        $keyspaceLength = strlen($keyspace) - 1; //put the length -1 in cache
        for ($i = 0; $i < $length; ++$i) {
            $str .= $keyspace[random_int(0, $keyspaceLength)];
        }
        return $str;
    }

    public function logout()
    {
        unset($_SESSION['user']);
    }
}
