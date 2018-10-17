<?php 

namespace Matcha\Models;

use Illuminate\Database\Eloquent\Model;

class BlockUsersList extends Model
{
	protected $table = 'block_users_list';

	protected $fillable = [
		'user_id',
		'blocked_user_id',
	];

	public static function getAll() {
		return BlockUsersList::where('user_id', $_SESSION['user'])->get();
	}

	public static function setBlockUser($block_user_id) {
		BlockUsersList::create([
			'user_id' => $_SESSION['user'],
			'blocked_user_id' => $block_user_id,
		]);
	}
}
