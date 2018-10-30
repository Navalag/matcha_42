<?php

require_once __DIR__ .'/dbkey.php';

try { 
	$conn = new PDO("mysql:host=$servername", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
	$conn->exec($sql);
}
catch (PDOException $e) {
	echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
