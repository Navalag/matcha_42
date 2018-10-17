<?php

namespace Matcha\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
	protected $table = 'user';

	protected $fillable = [
		'username',
		'first_name',
		'last_name',
		'email',
		'password',
		'email_confirmed',
		'fake_account',
		'active',
		'about_me',
		'gender',
		'age',
		'fame_rating',
		'lat',
		'lng',
		'facebook_link',
		'instagram_link',
		'twittwer_link',
		'google_plus_link',
	];

	public static function getAllUserInfo()
	{
		return User::where('id', $_SESSION['user'])->first();
	}

	public static function getUserInfoById($user_id)
	{
		return User::where('id', $user_id)->first();
	}

	public static function updateRating($user_id, $rating)
	{
		User::where('id', $user_id)->update([
			'fame_rating' => $rating
		]);
	}

	public static function setGpsLocation($lat, $lng) {
		User::where('id', $_SESSION['user'])->update([
			'lat' => $lat,
			'lng' => $lng,
		]);
	}

	public function setPassword($password)
	{
		$this->update([
			'password' => password_hash($password, PASSWORD_DEFAULT)
		]);
	}

	public function setEmail($id, $email)
	{
		User::where('id', $id)->update([
			'email' => $email
		]);
	}

	public static function setActiveAccount($email)
	{
		User::where('email', $email)->update([
			'email_confirmed' => "1",
		]);
	}

	public static function setActiveStatus()
	{
		User::where('id', $_SESSION['user'])->update([
			'active' => "1",
		]);
	}

	public static function setNotActiveStatus()
	{
		User::where('id', $_SESSION['user'])->update([
			'active' => "0",
		]);
	}

	public static function setUsername($id, $username)
	{
		User::where('id', $id)->update([
			'username' => $username,
		]);
	}

	public static function setName($id, $name)
	{
		User::where('id', $id)->update([
			'first_name' => $name,
		]);
	}

	public static function setSurname($id, $surname)
	{
		User::where('id', $id)->update([
			'last_name' => $surname,
		]);
	}
}
