<?php
/**
 * Created by PhpStorm.
 * User: ozharko
 * Date: 8/17/18
 * Time: 2:37 PM
 */

namespace Matcha\Controllers;

use Matcha\Models\CheckEmail;
use Matcha\Models\User;
use Respect\Validation\Validator as v;

class HomeController extends Controller
{
    protected $uniqid;
    protected $email;
    protected $user;
    protected $validation;
    /*
     * так как мы добавили container, что включает в себя методы twig,
     * в конструкстор класса Controller мы можем использовать его методы
     * для отрисовки страниц
     * */
    public function index($request, $response)
    {
        $this->flash->addMessage('info', 'Test flash message');
//        $tmp = $this->db->table('users')->find(1);
//        var_dump($tmp->email);
//        die();

//        $user = User::where('email', 'alex@codecourse.com')->first();
//        var_dump($user->email);
//        die();

        return $this->view->render($response, 'home.twig');
    }

    public function hello($request, $response)
    {
        $this->flash->addMessage('info', 'Check you email and confinm your account');
        return $this->view->render($response, 'auth/hello/hello.twig');
    }
}