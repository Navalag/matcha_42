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

		if (!Notifications::checkIfExist($socketArray['active_user_id'],$socketArray['dest_user_id'])) 
		{
			if (Notifications::addNewNotification($socketArray['active_user_id'],$socketArray['dest_user_id'],"message"))
			{
				$userAvatar = Photo::getAvatarImgByUserId($socketArray['active_user_id']);
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
		return $response->write(json_encode([
			'csrf'=>$request->getAttribute('ajax_csrf'),
			'new_msg'=>'no new msg'
		]));
	}

	public function addOtherNotification($request, $response) {
		$validation = $this->validator->validate($request, [
			'socket_array' => v::notEmpty(),
		]);
		if ($validation->failed()) {
			return $response->write(json_encode([
				'csrf'=>$request->getAttribute('ajax_csrf'),
				'new_msg'=>'failed validation'
			]));
		}
		$socketArray = $request->getParam('socket_array');

		if (Notifications::addNewNotification($socketArray['active_user_id'],$socketArray['dest_user_id'],$socketArray['message_type']))
		{
			$count = Notifications::countSameNotifications($socketArray['dest_user_id'],$socketArray['message_type']);

			$respond_json['type'] = $socketArray['message_type'];
			$respond_json['count'] = $count;
			$respond_json['csrf'] = $request->getAttribute('ajax_csrf');
			return $response->write(json_encode($respond_json));
		}
		return $response->write(json_encode([
			'csrf'=>$request->getAttribute('ajax_csrf'),
			'new_msg'=>'no new msg'
		]));
	}

	public function loadMessageNotifications($request, $response)
	{
		$messageNotif = Notifications::getAllMessageNotifForUser();
		$json = [];
		$notifCount = 0;
		/*
		** prepare message notifications
		*/
		foreach ($messageNotif as $row) {
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
		/*
		** prepare other notifications
		*/
		$countLike = Notifications::getCountLikeNotifForUser();
		$countCheckProf = Notifications::getCountCheckProfileNotifForUser();
		$countMatch = Notifications::getCountMatchNotifForUser();
		$countUnmatch = Notifications::getCountUnmatchNotifForUser();
		$json['count_like'] = $countLike;
		$json['count_check_prof'] = $countCheckProf;
		$json['count_match'] = $countMatch;
		$json['count_unmatch'] = $countUnmatch;

		$json['other_notif_count'] = $countLike + $countCheckProf + $countMatch + $countUnmatch;
		$json['msg_notif_count'] = $notifCount;

		$json['csrf'] = $request->getAttribute('ajax_csrf');

		return $response->write(json_encode($json));
	}

	public function openMessageNotification($request, $response)
	{
		$validation = $this->validator->validate($request, [
			'action_user_id' => v::notEmpty(),
		]);
		if ($validation->failed()) {
			return 'failed request';
		}
		$actionUserId = $request->getParam('action_user_id');

		if (Notifications::checkIfExist($actionUserId,$_SESSION['user'])) 
		{
			Notifications::deleteMessageNotification($actionUserId,$_SESSION['user']);
			return 'deleted';
		}
		return 'no such msg';
	}

	public function openLikeCheckProfNotification($request, $response)
	{
		Notifications::deleteUserLikeCheckProfNotification();
		return $response->withRedirect($this->router->pathFor('activity-log'));
	}

	public function openMatchUnmatchNotification($request, $response)
	{
		Notifications::deleteUserMatchUnmatchNotification();
		return $response->withRedirect($this->router->pathFor('my-matches'));

	}
}
