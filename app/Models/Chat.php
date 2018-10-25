<?php

namespace Matcha\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
	protected $table = 'chat';

	protected $fillable = [
		'id',
		'chat_id',
		'author_user_id',
		'dest_user_id',
		'message',
		'created_at',
		'updated_at',
	];

	public static function getAllMessagesByChatId($chat_id)
	{
		return Chat::where('chat_id', $chat_id)->get();
	}

	public static function addMessage($message, $chatId, $activeUser, $destUser)
	{
		Chat::create([
			'chat_id' => $chatId,
			'author_user_id' => $activeUser,
			'dest_user_id' => $destUser,
			'message' => $message,
		]);
	}
}
