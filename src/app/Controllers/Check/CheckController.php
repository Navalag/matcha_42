<?php

namespace Matcha\Controllers\Check;

use Matcha\Models\User;
use Matcha\Models\Photo;
use Matcha\Models\UserInterest;
use Matcha\Models\InterestList;
use Matcha\Models\UserDiscoveryInterests;
use Matcha\Models\LastActivityStatus;

class CheckController
{
	private $container;

	public function __construct($container)
	{
		$this->container = $container;
	}
	public function user()
	{
		if (isset($_SESSION['user'])) {
			return User::find($_SESSION['user']);
		}
	}

	public function avatarImg()
	{
		$avatarSrc = Photo::getAvatarImg();

		if ($avatarSrc) {
			return $avatarSrc->photo_src;
		}
		return '/img/default-avatar-2.png';
	}

	public function allUserInterests()
	{
		if (isset($_SESSION['user'])) {
			return UserInterest::all();
		}
	}

	public function allDiscoveryInterests()
	{
		if (isset($_SESSION['user'])) {
			return UserDiscoveryInterests::all();
		}
	}

	public function allValueOfInterests()
	{
		$interestsResult = [];
		$userInterest = $this->allUserInterests();
		foreach($userInterest as $row) {
			if ($row->user_id == $_SESSION['user']) {
				$interestRow = InterestList::where('id', $row->interest_id)->first();
				$interestsResult[] = $interestRow->interest;
			}
		}
		return $interestsResult;
	}

	public function allValueOfInterestsToSearch()
	{
		$interestsResult = [];
		$userInterest = $this->allDiscoveryInterests();
		foreach($userInterest as $row) {
			if ($row->user_id == $_SESSION['user']) {
				$interestRow = InterestList::where('id', $row->interest_id)->first();
				$interestsResult[] = $interestRow->interest;
			}
		}
		return $interestsResult;
	}

	public function check()
	{
		return isset($_SESSION['user']);
	}

	public function attempt($email, $password)
	{
		$user = User::where('email', $email)->first();

		if (!$user) {
			return false;
		}

		if (password_verify($password, $user->password)) {
			$_SESSION['user'] = $user->id;
			return true;
		}
		else {
			$_SESSION['errors']['password']['0'] = "wrong password";
		}
		return false;
	}

	public function comparePasswords($password1, $password2, $response)
	{
		if (strcmp($password1, $password2) != 0) {
			return 1;
		}
	}

	/*
	** Generate a random string, using a cryptographically secure 
	** pseudorandom number generator (random_int)
	*/
	function random_str($length) {
		$keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$str = '';
		$keyspaceLength = strlen($keyspace) - 1; //put the length -1 in cache
		for ($i = 0; $i < $length; ++$i) {
			$str .= $keyspace[random_int(0, $keyspaceLength)];
		}
		return $str;
	}
}
