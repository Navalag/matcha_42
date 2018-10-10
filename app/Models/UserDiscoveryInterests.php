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
}
