<?php

namespace Matcha\Models;

use Illuminate\Database\Eloquent\Model;

class InterestList extends Model
{
	protected $table = 'interest_list';

	protected $fillable = [
		'interest',
	];

	public static function  showAllInterests()
	{
		$listInterests = InterestList::all();
		$allInterests = array();

		foreach($listInterests as $row) {
			$allInterests[] = $row->interest;
		}

		return $allInterests;
	}
}
