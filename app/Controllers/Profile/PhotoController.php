<?php

namespace Matcha\Controllers\Profile;

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\UploadedFile;
use Matcha\Models\Photo;
use Matcha\Models\User;
use Matcha\Controllers\Controller;

class PhotoController extends Controller
{
	public function postUploadPhoto(Request $request, Response $response)
	{
		$userdir = $_SESSION['user'];
		$directory = $this->upload_directory . "/" . $userdir;
		if (!file_exists($directory)) {
			mkdir($directory);
		}
		$uploadedFiles = $request->getUploadedFiles();
		// handle single input with single file upload
		if ($uploadedFiles)
		{
			$uploadedFile = $uploadedFiles['photo'];
			if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
				$filename = $this->moveUploadedFile($directory, $uploadedFile, $userdir);
				User::setActiveStatus();
			}
		}
		/*
		** send csrf values for ajax request
		*/
		$ajax_csrf = $request->getAttribute('ajax_csrf');
		$respond_json = [$ajax_csrf, 
			'file_name' => $filename];
		$response->write(json_encode($respond_json));
	}

	public function postDeletePhoto($request, $response)
	{
		$photoWithTokenLikeKey = $request->getParsedBody();
		$photoWithTokenLikeIndex = array_keys($photoWithTokenLikeKey);
		$src = $photoWithTokenLikeIndex['0'];
		$src = preg_replace('/_/', '.', $src);
		/*
		** TRY TO FIGURE OUT HOW TO FIX THE LINE BELOW 
		*/
		// $src = str_replace('http://127.0.0.1:8800', '', $src);
		$src = str_replace('http://localhost:8800', '', $src);
		Photo::delUserPhoto($src);
		if (Photo::checkIfUserHasPhoto() == null) {
			User::setNotActiveStatus();
		}
		$src = $_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR.$src;
		unlink($src);
		/*
		** send csrf values for ajax request
		*/
		$ajax_csrf = $request->getAttribute('ajax_csrf');
		$response->write(json_encode($ajax_csrf));
	}

	public function moveUploadedFile($directory, UploadedFile $uploadedFile, $userdir)
	{
		$extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
		$basename = bin2hex(random_bytes(8)); // see http://php.net/manual/en/function.random-bytes.php
		$filename = sprintf('%s.%0.8s', $basename, $extension);
		$photo_src = '/img/' . $userdir . DIRECTORY_SEPARATOR . $filename;
		Photo::setUserPhoto($photo_src);
		$src = $directory . DIRECTORY_SEPARATOR . $filename;
		$uploadedFile->moveTo($src);
		return $photo_src;
	}
}

