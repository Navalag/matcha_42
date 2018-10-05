<?php

namespace Matcha\Controllers\Auth;

use Matcha\Models\User;
use Matcha\Models\About;
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
		$aboutTable = $this->checker->allAboutUser();

		$interestsResult = $this->checker->allValueOfInterests();
		$this->container->view->getEnvironment()->addGlobal('interests', $interestsResult);

		$allInterests = InterestList::showAllInterests();
		$this->container->view->getEnvironment()->addGlobal('allInterests', $allInterests);

		$edit['about_me'] = $aboutTable->about_me;
		$edit['gender'] = $aboutTable->gender;
		$edit['age'] = $aboutTable->age;
		$edit['username'] = $userInfo->username;
		$edit['name'] = $userInfo->name;
		$edit['surname'] = $userInfo->surname;
		if ($allPhoto) {
			$edit['photo'] = $allPhoto;
		}
		// $edit['interests'] = $this->checker->allValueOfInterests();

		$this->container->view->getEnvironment()->addGlobal('edit', $edit);
		return $this->view->render($response, 'user/edit/edit-user.twig');
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
			// 'email' => v::noWhitespace()->notEmpty()->email()->emailAvailable(),
			'username' => v::notEmpty()->usernameAvailable(),
			'name' => v::notEmpty()->alpha(),
			'surname' => v::notEmpty()->alpha(),
			'about_me' => v::notEmpty(),
			'gender' => v::notEmpty()
		]);

		// r($request);
		// die();
		if ($validation->failed()) {
			return $this->view->render($response, 'user/edit/edit-user.twig');
		}

		$edit['username'] = $request->getParam('username');
		$edit['name'] = $request->getParam('name');
		$edit['surname'] = $request->getParam('surname');
		$edit['about_me'] = $request->getParam('about_me');
		$edit['gender'] = $request->getParam('gender');
		$edit['age'] = $request->getParam('age');
		$this->container->view->getEnvironment()->addGlobal('edit', $edit);

		$id = $_SESSION['user'];

//        $edit['email'] = $request->getParam('email');
		// $this->checker->user()->setEmail($id, $edit['email']);

//        $edit['username'] = $request->getParam('username');
		$this->checker->user()->setUsername($id, $edit['username']);

//        $edit['name'] = $request->getParam('name');
		$this->checker->user()->setName($id, $edit['name']);

//        $edit['surname'] = $request->getParam('surname');
		$this->checker->user()->setSurname($id, $edit['surname']);

		About::where('user_id', $id)->update([
			// 'user_id' => $id,
			'gender' => $edit['gender'],
			'about_me' => $edit['about_me'],
			'age' => $edit['age']
			// 'sexual_pref' => $request->getParam('sexual_pref')
			// 'biography' => $request->getParam('biography'),
//            'listOfInterests' => $request->getParam('listOfInterests'),
		]);

		// $this->flash->addMessage('info', 'Your user was updated');
		return $response->withRedirect($this->router->pathFor('home'));
	}
}
