<?php

namespace Matcha\Controllers\Notifications;

use Matcha\Controllers\Controller;
use Matcha\Models\Notifications;
use Matcha\Models\Photo;
use Matcha\Models\User;
use Matcha\Models\MatchedPeople;

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
		if (!Notifications::checkIfUnique($socketArray['active_user_id'],$socketArray['dest_user_id'])) 
		{
			if (Notifications::addNewMessage($socketArray['active_user_id'],$socketArray['dest_user_id']))
			{
				$userAvatar = Photo::getAvatarImgByUserId($socketArray['active_user_id']);
				/*
				** request csrf values for return
				*/
				$respond_json['user'] = [
					'avatar' => $userAvatar->photo_src,
					'user_id' => $socketArray['active_user_id'],
					'username' => $socketArray['active_user_name'],
					'chat_id' => $socketArray['chat_id']
				];
				$respond_json['csrf'] = $request->getAttribute('ajax_csrf');
				return $response->write(json_encode($respond_json));
			}
		}
		return $response->write(json_encode(['csrf'=>$request->getAttribute('ajax_csrf'),
											'new_msg'=>'no new msg']));
	}

	public function loadMessageNotifications($request, $response)
	{
		$notif = Notifications::getAllMessageNotifForUser();
		$json = [];
		$notifCount = 0;
		foreach ($notif as $row) {
			$userAvatar = Photo::getAvatarImgByUserId($row->action_user_id);
			$userName = User::getUserInfoById($row->action_user_id);
			$userChat = MatchedPeople::getUserChatId($row->action_user_id, $row->dest_user_id);

			$json[$userName->username] = array(
				'avatar' => $userAvatar->photo_src,
				'user_id' => $userName->id,
				'username' => $userName->username,
				'chat_id' => $userChat->chat_id
			);
			$notifCount++;
		}
		$json['notif_count'] = $notifCount;
		$json['csrf'] = $request->getAttribute('ajax_csrf');

		return $response->write(json_encode($json));
	}
	
	public function openMessage($request, $response)
	{
		$notif = Notifications::getAllMessageNotifForUser();
		$json = [];
		$notifCount = 0;
		foreach ($notif as $row) {
			$userAvatar = Photo::getAvatarImgByUserId($row->action_user_id);
			$userName = User::getUserInfoById($row->action_user_id);
			$userChat = MatchedPeople::getUserChatId($row->action_user_id, $row->dest_user_id);

			$json[$userName->username] = array(
				'avatar' => $userAvatar->photo_src,
				'username' => $userName->username,
				'chat_id' => $userChat->chat_id
			);
			$notifCount++;
		}
		$json['notif_count'] = $notifCount;
		$json['csrf'] = $request->getAttribute('ajax_csrf');

		return $response->write(json_encode($json));
	}
}
