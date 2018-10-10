<?php 

namespace Matcha\Models;

use Illuminate\Database\Eloquent\Model;

class DiscoverySettings extends Model
{
	protected $table = 'discovery_settings';

	protected $fillable = [
		'user_id',
		'max_distanse',
		'min_age',
		'max_age',
		'min_rating',
		'max_rating',
		'looking_for',
		'lat',
		'lng',
	];

	public static function getAllSettings() {
		return DiscoverySettings::where('user_id', $_SESSION['user'])->first();
	}

	public static function createAndSetDefault() {
		DiscoverySettings::create([
			'user_id' => $_SESSION['user'],
			'max_distanse' => 20,
			'min_age' => 18,
			'max_age' => 99,
			'min_rating' => 0,
			'max_rating' => 100,
			'looking_for' => 'both',
			'lat' => 0,
			'lng' => 0,
		]);
	}

	public static function setGpsLocation($lat, $lng) {
		
	}
}
