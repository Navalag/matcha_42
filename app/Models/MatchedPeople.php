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

	public static function getMyMatches()
	{
		return MatchedPeople::
				where('first_id', $_SESSION['user'])
			  ->orWhere('second_id', $_SESSION['user'])
			  ->get();
		// print_r($myMatches); die();
	}

	public static function setUnmatch($chat_id)
	{
		MatchedPeople::where('chat_id', $chat_id)->delete();
	}

	public static function getUsersByChatId($chat_id)
	{
		return MatchedPeople::where('chat_id', $chat_id)->first();
	}

	public static function getUserChatId($first_user, $second_user)
	{
		return MatchedPeople::
				where([
					'first_id' => $first_user,
					'second_id' => $second_user
				])
			  ->orWhere([
			  		'first_id' => $second_user,
			  		'second_id' => $first_user
			  	])
			  ->first();
	}
}
