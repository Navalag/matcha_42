<?php

namespace Matcha\Models;

use Illuminate\Database\Eloquent\Model;
use Matcha\Models\User;
use Matcha\Models\BlockUsersList;

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

	public static function setFakeReport($fake_user_id) {
		/*
		** first create record in 'FakeAccountReport'
		*/
		FakeAccountReport::create([
			'user_id' => $_SESSION['user'],
			'fake_user_id' => $fake_user_id,
		]);

		/*
		** than update 'User' with increased fake account value
		*/
		$fake_user = User::where('id', $fake_user_id)->first();
		$fake_count = $fake_user->fake_account;
		$fake_count++;

		if ($fake_count >= 5) {
			User::where('id', $fake_user_id)->update([
				'fake_account' => $fake_count,
				'active' => 0,
			]);
		} else {
			User::where('id', $fake_user_id)->update([
				'fake_account' => $fake_count,
			]);
		}

		/*
		** finaly update 'BlockUsersList' list
		*/
		BlockUsersList::setBlockUser($fake_user_id);
	}
}
