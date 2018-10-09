<?php

namespace Matcha\Models;

use Illuminate\Database\Eloquent\Model;

class CheckEmail extends Model
{
	protected $table = "check_email";

	protected $fillable = [
		'email',
		'uniq_id',
	];
}
