<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if(!isset($_SESSION))
{
	session_start();
}

require_once __DIR__ . '/../bootstrap/app.php';

$app->run();
