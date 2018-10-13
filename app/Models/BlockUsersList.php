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
}
