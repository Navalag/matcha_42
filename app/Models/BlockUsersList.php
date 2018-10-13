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

	// public static function setInterest($interest_id) {
	// 	UserDiscoveryInterests::create([
	// 			'user_id' => $_SESSION['user'],
	// 			'interest_id' => $interest_id,
	// 		]);
	// }

	// public static function deleteInterest($interest_id) {
	// 	UserDiscoveryInterests::where('user_id', $_SESSION['user'])
	// 					->where('interest_id', $interest_id)
	// 					->delete();
	// }

	public static function getAll() {
		return BlockUsersList::where('user_id', $_SESSION['user'])->get();
	}
}
