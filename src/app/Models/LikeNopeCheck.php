<?php

namespace Matcha\Models;

use Illuminate\Database\Eloquent\Model;

class LikeNopeCheck extends Model
{
	protected $table = 'like_nope_check';

	protected $fillable = [
		'user_id',
		'action_user_id',
		'like_nope',
		'check_profile',
		'updated_at',
	];

	public static function getAll() {
		return LikeNopeCheck::where('user_id', $_SESSION['user'])->get();
	}

	public static function getAllLikesAndCheck() {
		return LikeNopeCheck::
					where(function ($query) {
						$query->where('action_user_id', $_SESSION['user']);
					})->where(function ($query) {
						$query->where('like_nope', 1)
							  ->orWhere('check_profile', 1);
					})->get();
	}

	public static function getAllLikeNope() {
		return LikeNopeCheck::where('user_id', $_SESSION['user'])
							->where('check_profile', '!=', 1)
							->get();
	}

	public static function checkIfLike($user_id) {
		return LikeNopeCheck::where([
					'user_id' => $_SESSION['user'],
					'action_user_id' => $user_id,
					'like_nope' => 1
				])->first();
	}

	public static function createNewRecord($user_id, $action) {
		LikeNopeCheck::create([
			'user_id' => $_SESSION['user'],
			'action_user_id' => $user_id,
			'like_nope' => $action,
		]);
	}

	public static function checkIfMatch($user_id) {
		$firstUser = LikeNopeCheck::where([
				'user_id' => $_SESSION['user'],
				'action_user_id' => $user_id,
				'like_nope' => 1,
			])->first();

		$secondUser = LikeNopeCheck::where([
			'user_id' => $user_id,
			'action_user_id' => $_SESSION['user'],
			'like_nope' => 1,
		])->first();

		if ($firstUser && $secondUser) {
			return true;
		}
		return false;
	}

	public static function setCheckRecord($user_id) {
		LikeNopeCheck::create([
			'user_id' => $_SESSION['user'],
			'action_user_id' => $user_id,
			'check_profile' => 1,
		]);
	}

	public static function checkIfFirstTimeOpenProfile($user_id) {
		return LikeNopeCheck::where([
			'user_id' => $_SESSION['user'],
			'action_user_id' => $user_id,
			'check_profile' => 1,
		])->first();
	}

	public static function checkIfUserLikeOrVisitMe($user_id) {
		return LikeNopeCheck::
				where(function ($query) use ($user_id) {
						$query->where('action_user_id', $_SESSION['user'])
							  ->where('user_id', $user_id);
					})->where(function ($query) {
						$query->where('like_nope', 1)
							  ->orWhere('check_profile', 1);
					})->first();
	}
}
