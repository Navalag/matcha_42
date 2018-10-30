<?php

namespace Matcha\Controllers\Log;

use Matcha\Controllers\Controller;
use Matcha\Models\Photo;
use Matcha\Models\User;
use Matcha\Models\LikeNopeCheck;
use Matcha\Models\LastActivityStatus;

use Respect\Validation\Validator as v;

class MyLogController extends Controller
{
	public function getActivityLog($request, $response)
	{
		$myLog = LikeNopeCheck::getAllLikesAndCheck();

		$viewArray = [];
		foreach ($myLog as $row) {
			$userInfo = User::getUserInfoById($row->user_id);
			$userPhoto = Photo::getAvatarImgByUserId($row->user_id);
			$userPhoto = $userPhoto->photo_src;
			$parseDate = date_parse($row->updated_at);
			$onlineStatus = LastActivityStatus::checkIfUserOnline($row->user_id);

			$viewArray[] = array('basic_info' => $userInfo,
								 'action_type' => ($row->like_nope == 1) 
								 				? 'liked your profile' 
								 				: 'check your page',
								 'photo' => $userPhoto,
								 'date' => $parseDate['month'].'.'.$parseDate['day'],
								 'online' => $onlineStatus == 1 ? 'online' 
								 			:$onlineStatus
								);
		}
		$this->container->view->getEnvironment()->addGlobal('array', $viewArray);

		return $this->view->render($response, 'log/my-activity-log.twig');
	}
}
