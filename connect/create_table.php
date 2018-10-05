<?php

	require_once __DIR__ . '/create_database.php';

	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sql = "USE " . $dbname;
		$conn->exec($sql);

		$sql = "CREATE "
			. " TABLE IF NOT EXISTS "
			. $dbUser
			. " (id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			email VARCHAR(255) NOT NULL, 
			username VARCHAR(255) NOT NULL, 
			name VARCHAR(255) NOT NULL, 
			surname VARCHAR(255) NOT NULL, 
			password VARCHAR(255) NOT NULL,
			rating INT(11) NULL DEFAULT 0,
			active INT(1) NULL DEFAULT 0,
			created_at TIMESTAMP NULL DEFAULT NULL,
			updated_at TIMESTAMP NULL DEFAULT NULL)";

		$conn->exec($sql);


		$sql = "CREATE "
			. " TABLE IF NOT EXISTS "
			. $dbAbout
			. " (id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			user_id INT(11) NOT NULL, 
			gender VARCHAR(255) NULL DEFAULT NULL,
			about_me VARCHAR(255) NULL DEFAULT NULL,
			age INT(11) NOT NULL DEFAULT 18,
			sexual_pref VARCHAR(255) NULL DEFAULT NULL,
			created_at TIMESTAMP NULL DEFAULT NULL,
			updated_at TIMESTAMP NULL DEFAULT NULL)";

		$conn->exec($sql);


		$sql = "CREATE "
			. " TABLE IF NOT EXISTS "
			. $dbChat
			. " (id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			chat_id INT(11) NOT NULL, 
			user_id INT(11) NOT NULL, 
			message VARCHAR(255) NULL DEFAULT NULL,
			created_at TIMESTAMP NULL DEFAULT NULL,
			updated_at TIMESTAMP NULL DEFAULT NULL)";

		$conn->exec($sql);


		$sql = "CREATE "
			. " TABLE IF NOT EXISTS "
			. $dbCheckEmail
			. " (id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			email VARCHAR(255) NOT NULL, 
			uniq_id VARCHAR(255) NOT NULL,
			created_at TIMESTAMP NULL DEFAULT NULL,
			updated_at TIMESTAMP NULL DEFAULT NULL)";

		$conn->exec($sql);


		$sql = "CREATE "
			. " TABLE IF NOT EXISTS "
			. $dbInterestList
			. " (id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			interest VARCHAR(255) NOT NULL, 
			created_at TIMESTAMP NULL DEFAULT NULL,
			updated_at TIMESTAMP NULL DEFAULT NULL)";

		$conn->exec($sql);


		$sql = "CREATE "
			. " TABLE IF NOT EXISTS "
			. $dbLike
			. " (id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			user_id INT(11) NOT NULL, 
			liked_id INT(11) NOT NULL, 
			created_at TIMESTAMP NULL DEFAULT NULL,
			updated_at TIMESTAMP NULL DEFAULT NULL)";

		$conn->exec($sql);


		$sql = "CREATE "
			. " TABLE IF NOT EXISTS "
			. $dbMatcha
			. " (id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			first_id INT(11) NOT NULL, 
			second_id INT(11) NOT NULL, 
			chat_id INT(11) NOT NULL, 
			created_at TIMESTAMP NULL DEFAULT NULL,
			updated_at TIMESTAMP NULL DEFAULT NULL)";

		$conn->exec($sql);


		$sql = "CREATE "
			. " TABLE IF NOT EXISTS "
			. $dbPhoto
			. " (id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			user_id INT(11) NOT NULL,
			photo_src VARCHAR(255) NOT NULL,
			created_at TIMESTAMP NULL DEFAULT NULL,
			updated_at TIMESTAMP NULL DEFAULT NULL)";

		$conn->exec($sql);


		$sql = "CREATE "
			. " TABLE IF NOT EXISTS "
			. $dbUserInterest
			. " (id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			user_id INT(11) NOT NULL, 
			interest_id INT(11) NOT NULL,
			created_at TIMESTAMP NULL DEFAULT NULL,
			updated_at TIMESTAMP NULL DEFAULT NULL)";

		$conn->exec($sql);
	}
	catch(PDOException $e) {
		echo $sql . "<br>" . $e->getMessage();
	}

	$conn = null;
?>