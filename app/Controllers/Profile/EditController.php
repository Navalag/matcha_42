<?php

namespace Matcha\Controllers\Profile;

use Matcha\Models\User;
use Matcha\Models\InterestList;
use Matcha\Models\UserInterest;
use Matcha\Models\Photo;
use Matcha\Controllers\Controller;
use Matcha\Controllers\Check\CheckController;
use Respect\Validation\Validator as v;

class EditController extends Controller
{
	public function getChangeProfile($request, $response)
	{
		$allPhoto = Photo::getUserPhoto();
		$userInfo = $this->checker->user();
		$interestsResult = $this->checker->allValueOfInterests();
		$allInterests = InterestList::showAllInterests();

		$this->container->view->getEnvironment()->addGlobal('interests', $interestsResult);
		$this->container->view->getEnvironment()->addGlobal('allInterests', $allInterests);

		$edit['about_me'] = $userInfo->about_me;
		$edit['gender'] = $userInfo->gender;
		$edit['age'] = $userInfo->age;
		$edit['username'] = $userInfo->username;
		$edit['name'] = $userInfo->first_name;
		$edit['surname'] = $userInfo->last_name;
		if ($allPhoto) {
			$edit['photo'] = $allPhoto;
		}

		$this->container->view->getEnvironment()->addGlobal('edit', $edit);
		return $this->view->render($response, 'user/edit/edit-user.twig');
	}

	public function postChangeProfile($request, $response)
	{
		$validation = $this->validator->validate($request, [
			'username' => v::notEmpty()->usernameAvailable(),
			'name' => v::notEmpty()->alpha(),
			'surname' => v::notEmpty()->alpha(),
		]);

		if ($validation->failed()) {
			return $response->withRedirect($this->router->pathFor('auth.edit.user'));
		}

		$edit['username'] = $request->getParam('username');
		$edit['name'] = $request->getParam('name');
		$edit['surname'] = $request->getParam('surname');
		$edit['about_me'] = $request->getParam('about_me');
		$edit['gender'] = $request->getParam('gender');
		$edit['age'] = $request->getParam('age');
		$this->container->view->getEnvironment()->addGlobal('edit', $edit);

		$id = $_SESSION['user'];
		// $this->checker->user()->setUsername($id, $edit['username']);
		// $this->checker->user()->setName($id, $edit['name']);
		// $this->checker->user()->setSurname($id, $edit['surname']);

		User::where('id', $id)->update([
			'username' => $edit['username'],
			'first_name' => $edit['name'],
			'last_name' => $edit['surname'],
			'gender' => $edit['gender'],
			'about_me' => $edit['about_me'],
			'age' => $edit['age'],
		]);
		return $response->withRedirect($this->router->pathFor('home'));
	}
}
