<?php

namespace Matcha\Models;

use Illuminate\Database\Eloquent\Model;
class Photo extends Model
{
	protected $table = 'photo';
	protected $fillable = [
		'user_id',
		'photo_src',
	];
	
	public static function setUserPhoto($src)
	{
		Photo::create([
			'user_id' => $_SESSION['user'],
			'photo_src' => $src,
		]);
	}

	public static function delUserPhoto($src)
	{
		Photo::where('photo_src', $src)->delete();
	}

	public static function checkIfUserHasPhoto()
	{
		return Photo::where('user_id', $_SESSION['user'])->first();
	}

	public static function getUserPhoto()
	{
		$allPhoto = Photo::get();
		$photoResult = array();
		if ($allPhoto) {
			if (!empty($allPhoto['0']) && isset($allPhoto['0']))
			{
				foreach($allPhoto as $key => $row) {
					if ($row->user_id == $_SESSION['user']) {
						$photoRow = Photo::where('photo_src', $row->photo_src)->first();
						$photoResult[] = $photoRow->photo_src;
					}
				}
				return $photoResult;
			}
		}
	}

	public static function getPhotoSrcByUserId($user_id)
	{
		$rawUserPhoto = Photo::where('user_id', $user_id)->get();
		$result = [];
		foreach ($rawUserPhoto as $row) {
			$result[] = $row->photo_src;
		}
		// print_r($result); die();
		return $result;
	}

	public static function getAvatarImg()
	{
		return Photo::where('user_id', $_SESSION['user'])->first();
	}

	public static function getAvatarImgByUserId($user_id)
	{
		return Photo::where('user_id', $user_id)->first();
	}
}
