<?php

// namespace Matcha\Controllers\Profile;

// use Matcha\Models\About;
// use Matcha\Controllers\Controller;
// use Respect\Validation\Validator as v;

// class AboutController extends Controller
// {
// 	// public function getEditProfile($request, $response)
// 	// {
// 	// 	return $this->view->render($response, 'user/edit/info.twig');
// 	// }

// 	public function postEditProfile($request, $response)
// 	{

// 		$validation = $this->validator->validate($request, [
// 			'gender' => v::notEmpty(),
// 			'about_me' => v::notEmpty(),
// 			'sexual_pref' => v::notEmpty()
// 			// 'biography' => v::notEmpty(),
// //            'listOfInterests' => v::notEmpty(),
// //            'photo' => v::notEmpty()
// 		]);

// 		if ($validation->failed()) {
// 			$this->flash->addMessage('info', 'Fail');
// 			return $response->withRedirect($this->router->pathFor('user.edit.info'));
// 		}

// 		About::where('user_id', $_SESSION['user'])->update([
// 			'user_id' => $_SESSION['user'],
// 			'gender' => $request->getParam('gender'),
// 			'about_me' => $request->getParam('about_me'),
// 			'sexual_pref' => $request->getParam('sexual_pref')
// 			// 'biography' => $request->getParam('biography'),
// //            'listOfInterests' => $request->getParam('listOfInterests'),
// 		]);
// 		$this->flash->addMessage('info', 'Success');

// 		return $response->withRedirect($this->router->pathFor('home'));
// 	}
// }