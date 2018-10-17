<?php

namespace Matcha\Models;

use Illuminate\Database\Eloquent\Model;
use Matcha\Models\InterestList;

class UserInterest extends Model
{
	protected $table = 'user_interest';

	protected $fillable = [
		'user_id',
		'interest_id',
	];

	public static function getInterestsValueByUserId($user_id)
	{
		$rawUserInterests = UserInterest::where('user_id', $user_id)->get();
		$rawAllInterests = InterestList::all();
		$result = [];
		foreach ($rawUserInterests as $row) {
			foreach ($rawAllInterests as $interestList) {
				if ($row->interest_id == $interestList->id) {
					$result[] = $interestList->interest;
				}
			}
		}
		// print_r($result); die();
		return $result;
	}
}
