<?php 

namespace Matcha\Models;

use Illuminate\Database\Eloquent\Model;

class UserDiscoveryInterests extends Model
{
	protected $table = 'user_discovery_interests';

	protected $fillable = [
		'user_id',
		'interest_id',
	];

	public static function setInterest($interest_id) {
		UserDiscoveryInterests::create([
				'user_id' => $_SESSION['user'],
				'interest_id' => $interest_id,
			]);
	}

	public static function deleteInterest($interest_id) {
		UserDiscoveryInterests::where('user_id', $_SESSION['user'])
						->where('interest_id', $interest_id)
						->delete();
	}

	public static function getAll() {
		return UserDiscoveryInterests::where('user_id', $_SESSION['user'])->first();
	}
}
