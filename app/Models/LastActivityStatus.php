<?php

namespace Matcha\Models;

use Illuminate\Database\Eloquent\Model;

class LastActivityStatus extends Model
{
	protected $table = 'last_activity_status';

	protected $fillable = [
		'user_id',
		'last_activity',
	];

	public static function updateActivity()
	{
		// print_r($_SESSION); die();
		$user = LastActivityStatus::where('user_id', $_SESSION['user'])->first();

		if ($user) {
			return LastActivityStatus::where('user_id', $_SESSION['user'])->update([
				'last_activity' => date("Y-m-d H:i:s", STRTOTIME(date('h:i:sa')))
			]);
		} else {
			return LastActivityStatus::create([
				'user_id' => $_SESSION['user'],
				'last_activity' => date("Y-m-d H:i:s", STRTOTIME(date('h:i:sa')))
			]);
		}	
	}

	public static function checkIfUserOnline($user_id)
	{
		// print_r($_SESSION); die();
		$user = LastActivityStatus::where('user_id', $user_id)->first();

		if ($user) {
			$currentTime = date("Y-m-d H:i:s", STRTOTIME(date('h:i:sa')));
			$lastActiv = $user->last_activity;
			$diff = strtotime($currentTime) - strtotime($lastActiv);
			if (($diff / 60) <= 10) {
				return 1;
			} else {
				$diff = $diff / 60;
				if ($diff < 50) {
					// print_r($diff); die();
					return 'less than hour ago';
				} else if ($diff > 50 && $diff <= 70) {
					// print_r($diff); die();
					return 'about hour ago';
				} else {
					$diff = $diff / 60;
					if ($diff < 24) {
						// print_r($diff); die();
						return 'today';
					} else {
						// print_r($diff); die();
						return 'more than 1 day ago';
					}
				}
			}
			// print_r($dif); die();
		}
		return false;
	}
}
