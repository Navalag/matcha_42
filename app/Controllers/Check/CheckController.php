<?php

namespace Matcha\Controllers\Check;

use Matcha\Models\User;

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
        if (isset($_SESSION['user']))
            return User::find($_SESSION['user']);
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
            $this->flash->addMessage('error', 'Email not found');
            return false;
        }

        if (password_verify($password, $user->password)) {
            $_SESSION['user'] = $user->id;
            return true;
        }
        else
            $_SESSION['errors']['password']['0'] = "wrong password";

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

    public function logout()
    {
        unset($_SESSION['user']);
    }
}