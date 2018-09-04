<?php
/**
 * Created by PhpStorm.
 * User: ozharko
 * Date: 9/3/18
 * Time: 4:16 PM
 */

namespace Matcha\Controllers\Auth;


use Matcha\Controllers\Controller;
use Respect\Validation\Validator as v;
use Matcha\Models\CheckEmail;
use Matcha\Models\User;

class ActivateController extends Controller
{
    protected $uniqid;
    protected $email;
    protected $user;
    protected $validation;

    public function activate($request, $response)
    {
        echo "HomeController confirm";

        $validation = $this->validator->validate($request, [
            'email' => v::noWhitespace()->notEmpty()->email(),
            'uniqid' => v::noWhitespace()->notEmpty(),
        ]);

        if ($validation->failed()) {
            return $response->withRedirect($this->router->pathFor('auth.signup'));
        }

        $email = $request->getParam('email');
        $uniqid = $request->getParam('uniqid');
        $user = CheckEmail::where('uniqid', $uniqid)->first();

        User::setActiveAccount($user->email);
        $email = $request->getParam('email');
        $user = User::where('email', $email)->first();

        if ($user->active == 1) {
            $_SESSION['user'] = $user->id;
            $this->flash->addMessage('info', 'Welcome my friend');
            return $response->withRedirect($this->router->pathFor('home'));
        }
    }
}