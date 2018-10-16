<?php

namespace Matcha\Models;


use Illuminate\Database\Eloquent\Model;

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
}
