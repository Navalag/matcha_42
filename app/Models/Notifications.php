<?php

namespace Matcha\Models;


use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
	protected $table = 'notifications';

	protected $fillable = [
		'action_user_id',
		'dest_user_id',
		'notif_type',
		'seen',
		'created_at',
		'updated_at',
	];

	public static function addNewMessage($actionUserId, $destUserId)
	{
		return Notifications::create([
			'action_user_id' => $actionUserId,
			'dest_user_id' => $destUserId,
			'notif_type' => 'message',
			'seen' => '0'
		]);
	}

	public static function checkIfExist($actionUserId, $destUserId)
	{
		return Notifications::where([
			'action_user_id' => $actionUserId,
			'dest_user_id' => $destUserId,
			'notif_type' => 'message',
			'seen' => '0'
		])->first();
	}

	public static function getAllMessageNotifForUser()
	{
		return Notifications::where('dest_user_id', $_SESSION['user'])
							->where('notif_type', 'message')
							->where('seen', '0')
							->get();
	}

	public static function deleteMessageNotification($actionUserId, $destUserId)
	{
		return Notifications::where('action_user_id', $actionUserId)
							->where('dest_user_id', $destUserId)
							->where('notif_type', 'message')
							->where('seen', '0')
							->delete();
	}
}
// 'message', 'check_prof', 'like', 'match', 'unmatch'