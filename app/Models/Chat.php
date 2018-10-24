<?php

namespace Matcha\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
	protected $table = 'chat';

	protected $fillable = [
		'id',
		'chat_id',
		'user_id',
		'message',
		'created_at',
		'updated_at',
	];

	public static function sendMessage($first, $second, $chat_id)
	{

	}

	public static function addMessage($message, $chat_id)
	{
		Chat::create([
			'chat_id' => $chat_id,
			'user_id' => $_SESSION['user'],
			'message' => $message,
		]);
	}
}
