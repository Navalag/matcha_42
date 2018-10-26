<?php

namespace Matcha\Controllers\Notifications;

use Matcha\Controllers\Controller;
use Matcha\Models\Notifications;
use Matcha\Models\Photo;
// use Matcha\Models\User;
// use Matcha\Models\LikeNopeCheck;
// use Matcha\Models\LastActivityStatus;

use Respect\Validation\Validator as v;

class NotificationsController extends Controller
{
	public function addMessageNotification($request, $response)
	{
		$validation = $this->validator->validate($request, [
			'socket_array' => v::notEmpty(),
		]);
		if ($validation->failed()) {
			return 'failed request';
		}
		$socketArray = $request->getParam('socket_array');
		// print_r($socketArray); die();
		if (Notifications::addNewMessage($socketArray['active_user_id'],$socketArray['dest_user_id']))
		{
			$userAvatar = Photo::getAvatarImgByUserId($socketArray['active_user_id']);
			/*
			** request csrf values for return
			*/
			$ajax_csrf = $request->getAttribute('ajax_csrf');
			$respond_json = [
				$ajax_csrf, 
				'avatar' => $userAvatar->photo_src,
				'username' => $socketArray['active_user_name'],
				'chat_id' => $socketArray['chat_id']
			];
			return $response->write(json_encode($respond_json));
		}
		return 'error add notification';
	}
}
