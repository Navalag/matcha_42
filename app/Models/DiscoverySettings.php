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

	
}
