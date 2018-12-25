<?php

namespace Matcha\Controllers\Profile;

use Matcha\Models\User;
use Matcha\Controllers\Controller;
use Matcha\Controllers\Check\CheckController;
use Respect\Validation\Validator as v;

class PasswordController extends Controller
{
	public function getChangePassword($request, $response)
	{
		$userInfo = $this->checker->user();
		$this->container->view->getEnvironment()->addGlobal('email', $userInfo->email);

		return $this->view->render($response, 'user/edit/account-settings.twig');
	}

	/*
	** Below we have multy step validation and error handling to update
	** user information.
	** Please read comments to understand every step.
	*/
	public function postChangePassword($request, $response)
	{
		/*
		** First validate email.
		** - If it is valid and avialable in system.
		** - If yes and user really create new one, update email in DB 
		** and add a flash message
		*/
		$validation = $this->validator->validate($request, [
			'email' => v::noWhitespace()->notEmpty()->email()->emailAvailable(),
		]);
		if ($validation->failed()) {
			return $response->withRedirect($this->router->pathFor('auth.password.change'));
		}

		$email = $request->getParam('email');
		if ($email !== User::find($_SESSION['user'])->email) {
			$this->checker->user()->setEmail($_SESSION['user'], $email);
			$this->flash->addMessage('info', 'Your email was updated');
		}

		/*
		** Next check password.
		** - Check if fields are not empty.
		** - If old password is correct.
		** - If new password secure enough
		** - Compare password_new and password_repeat
		** 
		** After all validation update password and add success message
		*/
		$validation = $this->validator->validate($request, [
			'password_old' => v::noWhitespace()->notEmpty(),
			'password_new' => v::noWhitespace()->notEmpty(),
			'password_repeat' => v::noWhitespace()->notEmpty(),
		]);
		if ($validation->failed()) {
			return $response->withRedirect($this->router->pathFor('auth.password.change'));
		}

		$validation = $this->validator->validate($request, [
			'password_old' => v::matchesPassword($this->checker->user()->password),
		]);
		if ($validation->failed()) {
			$this->flash->addMessage('error', 'Old password is incorrect, click "I forgot my password" to reset');
			return $response->withRedirect($this->router->pathFor('auth.password.change'));
		}

		$password1 = $request->getParam('password_new');
		$password2 = $request->getParam('password_repeat');
		if (!preg_match("/^.*(?=.{8,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $password1)) {
			$this->flash->addMessage('error', 'Password must be at least 8 characters and must contain at least one lower case letter, one upper case letter and one digit');
			return $response->withRedirect($this->router->pathFor('auth.password.change'));
		}
		if ($this->checker->comparePasswords($password1, $password2, $response)) {
			$this->flash->addMessage('error', 'New passwords does not match');
			return $response->withRedirect($this->router->pathFor('auth.password.change'));
		}

		$this->checker->user()->setPassword($request->getParam('password_new'));

		$this->flash->addMessage('info', 'Your account was updated');
		return $response->withRedirect($this->router->pathFor('auth.password.change'));
	}

	public function postResetPassword($request, $response) {
		$validation = $this->validator->validate($request, [
			'email' => v::noWhitespace()->notEmpty()->email(),
		]);
		if ($validation->failed()) {
			return $response->withRedirect($this->router->pathFor('auth.password.change'));
		}

		$user = User::where('email', $request->getParam('email'))->first();
		if (!$user) {
			$this->flash->addMessage('error', 'Can\'t find that email, sorry');
			return $response->withRedirect($this->router->pathFor('auth.password.change'));
		}

		$new_password = $this->checker->random_str(10);
		$user->setPassword($new_password);
		$this->sendEmail->sendNewPasswordEmail($user->email, $user->username, $new_password);
		$this->flash->addMessage('info', 'Check your email for a link to reset your password. If it doesn’t appear within a few minutes, check your spam folder.');
		return $response->withRedirect($this->router->pathFor('auth.password.change'));
	}
}
