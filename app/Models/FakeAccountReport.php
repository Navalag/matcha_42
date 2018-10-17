<?php

namespace Matcha\Models;


use Illuminate\Database\Eloquent\Model;

class FakeAccountReport extends Model
{
	protected $table = 'fake_account_report';

	protected $fillable = [
		'user_id',
		'fake_user_id',
	];

	public static function getAll() {
		return FakeAccountReport::where('user_id', $_SESSION['user'])->get();
	}
}
