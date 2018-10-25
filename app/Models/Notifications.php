<?php

namespace Matcha\Models;


use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
	protected $table = 'notifications';

	protected $fillable = [
		'user_id',
		'dest_user_id',
		'notif_type',
		'seen',
		'created_at',
		'updated_at',
	];

	public static function addNew($user_id, $type)
	{

	}
}
