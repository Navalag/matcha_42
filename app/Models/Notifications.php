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

	public static function addNewMessage($activeUserId, $destUserId)
	{
		return Notifications::create([
			'action_user_id' => $activeUserId,
			'dest_user_id' => $destUserId,
			'notif_type' => 'message',
			'seen' => 0
		]);
	}
}
	// 'message', 'check_prof', 'like', 'match', 'unmatch'