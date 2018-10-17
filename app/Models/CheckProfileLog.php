<?php

namespace Matcha\Models;

use Illuminate\Database\Eloquent\Model;

class CheckProfileLog extends Model
{
	protected $table = 'check_profile_log';

	protected $fillable = [
		'user_id',
		'check_profile_user_id',
	];

	public static function setRecord($user_id) {
		CheckProfileLog::create([
				'user_id' => $_SESSION['user'],
				'check_profile_user_id' => $user_id,
			]);
	}

	public static function checkIfFirstTimeOpenProfile($user_id) {
		return CheckProfileLog::where([
					'user_id' => $_SESSION['user'],
					'check_profile_user_id' => $user_id
				])->first();
	}
}
