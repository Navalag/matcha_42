<?php

namespace Matcha\Models;

use Illuminate\Database\Eloquent\Model;
use Matcha\Models\Notifications;

class LikeNope extends Model
{
	protected $table = 'like_nope';

	protected $fillable = [
		'user_id',
		'action_user_id',
		'like_nope',
	];

	public static function getAll() {
		return LikeNope::where('user_id', $_SESSION['user'])->get();
	}

	public static function checkRecord($user_id) {
		return LikeNope::where([
					'user_id' => $_SESSION['user'],
					'action_user_id' => $user_id
					])->first();
	}

	public static function createNewRecord($user_id, $action) {
		LikeNope::create([
				'user_id' => $_SESSION['user'],
				'action_user_id' => $user_id,
				'like_nope' => $action,
			]);


        // Notifications::addNew($user_id, "like");



	}

	public static function checkIfMatch($user_id) {
		$firstUser = LikeNope::where([
				'user_id' => $_SESSION['user'],
				'action_user_id' => $user_id,
				'like_nope' => 1,
			])->first();

		$secondUser = LikeNope::where([
				'user_id' => $user_id,
				'action_user_id' => $_SESSION['user'],
				'like_nope' => 1,
			])->first();

		if ($firstUser && $secondUser) {
			return true;
		}
		return false;
	}
}
