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

	public static function addNewNotification($actionUserId, $destUserId, $notifType)
	{
		return Notifications::create([
			'action_user_id' => $actionUserId,
			'dest_user_id' => $destUserId,
			'notif_type' => $notifType,
			'seen' => '0'
		]);
	}

	public static function countSameNotifications($destUserId, $notifType)
	{
		return Notifications::where([
			'dest_user_id' => $destUserId,
			'notif_type' => $notifType,
			'seen' => '0'
		])->count();
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

	public static function getCountLikeNotifForUser()
	{
		return Notifications::where('dest_user_id', $_SESSION['user'])
							->where('notif_type', 'like')
							->where('seen', '0')
							->count();
	}

	public static function getCountCheckProfileNotifForUser()
	{
		return Notifications::where('dest_user_id', $_SESSION['user'])
							->where('notif_type', 'check_prof')
							->where('seen', '0')
							->count();
	}
	public static function getCountMatchNotifForUser()
	{
		return Notifications::where('dest_user_id', $_SESSION['user'])
							->where('notif_type', 'match')
							->where('seen', '0')
							->count();
	}
	public static function getCountUnmatchNotifForUser()
	{
		return Notifications::where('dest_user_id', $_SESSION['user'])
							->where('notif_type', 'unmatch')
							->where('seen', '0')
							->count();
	}

	public static function deleteMessageNotification($actionUserId, $destUserId)
	{
		return Notifications::where('action_user_id', $actionUserId)
							->where('dest_user_id', $destUserId)
							->where('notif_type', 'message')
							->where('seen', '0')
							->delete();
	}

	public static function deleteUserLikeCheckProfNotification()
	{
		return Notifications::where(function ($query) {
						$query->where('dest_user_id', $_SESSION['user']);
					})->where(function ($query) {
						$query->where('notif_type', 'like')
							  ->orWhere('notif_type', 'check_prof');
					})->delete();
	}

	public static function deleteUserMatchUnmatchNotification()
	{
		return Notifications::where(function ($query) {
						$query->where('dest_user_id', $_SESSION['user']);
					})->where(function ($query) {
						$query->where('notif_type', 'match')
							  ->orWhere('notif_type', 'unmatch');
					})->delete();
	}
}
// 'message', 'check_prof', 'like', 'match', 'unmatch'