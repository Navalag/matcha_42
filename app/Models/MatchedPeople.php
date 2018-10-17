<?php

namespace Matcha\Models;

use Illuminate\Database\Eloquent\Model;
//namespace Matcha\Models\Chat;

class MatchedPeople extends Model
{
	protected $table = 'matched_people';

	protected $fillable = [
		'first_id',
		'second_id',
		'chat_id',
	];

	public static function setAMatch($user_id)
	{
		$chat_id = time();

		MatchedPeople::create([
			'first_id' => $_SESSION['user'],
			'second_id' => $user_id,
			'chat_id' => $chat_id,
		]);
	}

	public static function unsetMatcha($first_id, $second_id)
	{
		$allMatcha = Matcha::all();

		foreach ($allMatcha as $row)
		{
			if ($row->first_id == $first_id && $row->second_id == $second_id ||
				$row->first_id == $second_id && $row->second_id == $first_id) {
				Matcha::where('id', $row->id)->delete();
				return ;
			}
		}
	}
}
