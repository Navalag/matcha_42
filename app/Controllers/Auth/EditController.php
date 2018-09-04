<?php

namespace Matcha\Controllers\Auth;

use Matcha\Models\User;
/*
 * use покажет какой родительский контроллер нужно использовать
 * */
use Matcha\Controllers\Controller;
use Matcha\Controllers\Check\CheckController;
use Respect\Validation\Validator as v;

class EditController extends Controller
{
    public function getChangeProfile($request, $response)
    {
        $userInfo = $this->checker->user();

        $edit['email'] = $userInfo->email;
        $edit['username'] = $userInfo->username;
        $edit['name'] = $userInfo->name;
        $edit['surname'] = $userInfo->surname;

        $this->container->view->getEnvironment()->addGlobal('edit', $edit);

        return $this->view->render($response, 'auth/edit/editProfile.twig');
    }

    public function postChangeProfile($request, $response)
    {

        $validation = $this->validator->validate($request, [
            /*
             * password задесь возвращается как свойство
             * которое храниться в объекте User
             * все остальное как метод
             * $this->auth->user()->password
             * 
             * вызовиться метод user() что вернет все что имется в БД
             * из всего этого выбереться только свойство password
             * 
             * с чем он сравнивает? c объектом v:: ?
             * */
            'email' => v::noWhitespace()->notEmpty()->email()->emailAvailable(),
            'username' => v::notEmpty()->usernameAvailable(),
            'name' => v::notEmpty()->alpha(),
            'surname' => v::notEmpty()->alpha(),
        ]);


        $edit['email'] = $request->getParam('email');
        $edit['username'] = $request->getParam('username');
        $edit['name'] = $request->getParam('name');
        $edit['surname'] = $request->getParam('surname');

        $this->container->view->getEnvironment()->addGlobal('edit', $edit);

        if ($validation->failed()) {
            return $this->view->render($response, 'auth/edit/editProfile.twig');
        }

        $id = $_SESSION['user'];

//        $edit['email'] = $request->getParam('email');
        $this->checker->user()->setEmail($id, $edit['email']);

//        $edit['username'] = $request->getParam('username');
        $this->checker->user()->setUsername($id, $edit['username']);

//        $edit['name'] = $request->getParam('name');
        $this->checker->user()->setName($id, $edit['name']);

//        $edit['surname'] = $request->getParam('surname');
        $this->checker->user()->setSurname($id, $edit['surname']);

        $this->flash->addMessage('info', 'Your profile was changed');
        return $response->withRedirect($this->router->pathFor('home'));
    }
}