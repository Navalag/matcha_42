<?php

	require_once __DIR__ . '/create_database.php';

	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sql = "USE " . $dbname;
		$conn->exec($sql);

		/* 
		** CREATE user TABLE
		*/
		$sql = "CREATE "
			. " TABLE IF NOT EXISTS "
			. $dbUser
			. " (
			id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,  
			username VARCHAR(255) NOT NULL, 
			first_name VARCHAR(255) NOT NULL, 
			last_name VARCHAR(255) NOT NULL, 
			email VARCHAR(255) NOT NULL,
			password VARCHAR(255) NOT NULL,
			email_confirmed INT(1) NULL DEFAULT 0 COMMENT 'after registration user must confirm account via email', 
			fake_account INT(1) NULL DEFAULT 0 COMMENT 'if 5 users comlains that account is fake, active status become false', 
			active INT(1) NULL DEFAULT 0 COMMENT 'set true when user has at least one photo and account is confirmed and not fake account', 
			online INT(1) NOT NULL DEFAULT 0, 
			about_me VARCHAR(255) NULL DEFAULT NULL,
			gender VARCHAR(255) NULL DEFAULT NULL,
			age INT(11) NOT NULL DEFAULT 18,
			fame_rating INT(11) NULL DEFAULT 0,
			lat FLOAT( 10, 6 ) NOT NULL DEFAULT 0, 
  			lng FLOAT( 10, 6 ) NOT NULL DEFAULT 0, 
			facebook_link VARCHAR(80) NULL DEFAULT NULL,
			instagram_link VARCHAR(80) NULL DEFAULT NULL,
			twittwer_link VARCHAR(80) NULL DEFAULT NULL,
			google_plus_link VARCHAR(80) NULL DEFAULT NULL,
			created_at TIMESTAMP NULL DEFAULT NULL,
			updated_at TIMESTAMP NULL DEFAULT NULL
		)";

		$conn->exec($sql);

		/* 
		** CREATE about TABLE
		*/
		// $sql = "CREATE "
		// 	. " TABLE IF NOT EXISTS "
		// 	. $dbAbout
		// 	. " (id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		// 	user_id INT(11) NOT NULL, 
			
			
		// 	created_at TIMESTAMP NULL DEFAULT NULL,
		// 	updated_at TIMESTAMP NULL DEFAULT NULL)";

		// $conn->exec($sql);

		/* 
		** CREATE chat TABLE
		*/
		$sql = "CREATE "
			. " TABLE IF NOT EXISTS "
			. $dbChat
			. " (id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			chat_id INT(11) NOT NULL, 
			author_user_id INT(11) NOT NULL, 
			dest_user_id INT(11) NOT NULL, 
			message VARCHAR(255) NULL DEFAULT NULL,
			created_at TIMESTAMP NULL DEFAULT NULL,
			updated_at TIMESTAMP NULL DEFAULT NULL)";

		$conn->exec($sql);

		/* 
		** CREATE check_email TABLE
		*/
		$sql = "CREATE "
			. " TABLE IF NOT EXISTS "
			. $dbCheckEmail
			. " (id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			email VARCHAR(255) NOT NULL, 
			uniq_id VARCHAR(255) NOT NULL,
			created_at TIMESTAMP NULL DEFAULT NULL,
			updated_at TIMESTAMP NULL DEFAULT NULL)";

		$conn->exec($sql);

		/* 
		** CREATE interest_list TABLE
		*/
		$sql = "CREATE "
			. " TABLE IF NOT EXISTS "
			. $dbInterestList
			. " (id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			interest VARCHAR(255) NOT NULL, 
			created_at TIMESTAMP NULL DEFAULT NULL,
			updated_at TIMESTAMP NULL DEFAULT NULL)";

		$conn->exec($sql);
		/* 
		** INSERT demo content into "interest_list"
		**
		** in order to initialize demo interests list
		** uncomment lines below when first time execute application
		*/
		// $sql = " INSERT INTO ". $dbInterestList
		// 	. "(interest) VALUES('yoga');";

		// $sql .= " INSERT INTO ". $dbInterestList
		// 	. "(interest) VALUES('vegan');";

		// $sql .= " INSERT INTO ". $dbInterestList
		// 	. "(interest) VALUES('geek');";

		// $sql .= " INSERT INTO ". $dbInterestList
		// 	. "(interest) VALUES('piercing');";

		// $sql .= " INSERT INTO ". $dbInterestList
		// 	. "(interest) VALUES('photo');";

		// $sql .= " INSERT INTO ". $dbInterestList
		// 	. "(interest) VALUES('architecture');";

		// $sql .= " INSERT INTO ". $dbInterestList
		// 	. "(interest) VALUES('rock');";

		// $sql .= " INSERT INTO ". $dbInterestList
		// 	. "(interest) VALUES('pop');";
		
		// $conn->exec($sql);

		/* 
		** CREATE like_nope_check TABLE
		*/
		$sql = "CREATE "
			. " TABLE IF NOT EXISTS "
			. $dbLikeNopeCheck
			. " (id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			user_id INT(11) NOT NULL, 
			action_user_id INT(11) NOT NULL, 
			like_nope INT(1) NOT NULL DEFAULT 0, 
			check_profile INT(1) NOT NULL DEFAULT 0, 
			created_at TIMESTAMP NULL DEFAULT NULL, 
			updated_at TIMESTAMP NULL DEFAULT NULL)";

		$conn->exec($sql);

		/* 
		** CREATE matched_people TABLE
		*/
		$sql = "CREATE "
			. " TABLE IF NOT EXISTS "
			. $dbMatchedPeople
			. " (id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			first_id INT(11) NOT NULL, 
			second_id INT(11) NOT NULL, 
			chat_id INT(11) NOT NULL, 
			created_at TIMESTAMP NULL DEFAULT NULL,
			updated_at TIMESTAMP NULL DEFAULT NULL)";

		$conn->exec($sql);

		/* 
		** CREATE photo TABLE
		*/
		$sql = "CREATE "
			. " TABLE IF NOT EXISTS "
			. $dbPhoto
			. " (id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			user_id INT(11) NOT NULL,
			photo_src VARCHAR(255) NOT NULL,
			created_at TIMESTAMP NULL DEFAULT NULL,
			updated_at TIMESTAMP NULL DEFAULT NULL)";

		$conn->exec($sql);

		/* 
		** CREATE user_interest TABLE
		*/
		$sql = "CREATE "
			. " TABLE IF NOT EXISTS "
			. $dbUserInterest
			. " (id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			user_id INT(11) NOT NULL, 
			interest_id INT(11) NOT NULL,
			created_at TIMESTAMP NULL DEFAULT NULL,
			updated_at TIMESTAMP NULL DEFAULT NULL)";

		$conn->exec($sql);

		/* 
		** CREATE discovery_settings TABLE
		*/
		$sql = "CREATE "
			. " TABLE IF NOT EXISTS "
			. $dbDiscoverySettings
			. " (
			id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			user_id INT(11) NOT NULL, 
			max_distanse INT(11) NOT NULL DEFAULT 20, 
			min_age INT(11) NULL DEFAULT NULL, 
			max_age INT(11) NULL DEFAULT NULL, 
			min_rating INT(11) NULL DEFAULT NULL, 
			max_rating INT(11) NULL DEFAULT NULL, 
			looking_for VARCHAR(255) NULL DEFAULT NULL, 
			created_at TIMESTAMP NULL DEFAULT NULL,
			updated_at TIMESTAMP NULL DEFAULT NULL
		)";

		$conn->exec($sql);

		/* 
		** CREATE user_discovery_interests TABLE
		*/
		$sql = "CREATE "
			. " TABLE IF NOT EXISTS "
			. $dbUserDiscoveryInterests
			. " (
			id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			user_id INT(11) NOT NULL, 
			interest_id INT(11) NOT NULL, 
			created_at TIMESTAMP NULL DEFAULT NULL,
			updated_at TIMESTAMP NULL DEFAULT NULL
		)";

		$conn->exec($sql);

		/* 
		** CREATE block_users_list TABLE
		*/
		$sql = "CREATE "
			. " TABLE IF NOT EXISTS "
			. $dbBlockUsersList
			. " (
			id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			user_id INT(11) NOT NULL, 
			blocked_user_id INT(11) NOT NULL, 
			created_at TIMESTAMP NULL DEFAULT NULL,
			updated_at TIMESTAMP NULL DEFAULT NULL
		)";

		$conn->exec($sql);

		/* 
		** CREATE fake_account_report TABLE
		*/
		$sql = "CREATE "
			. " TABLE IF NOT EXISTS "
			. $dbFakeAccountReport
			. " (
			id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			user_id INT(11) NOT NULL, 
			fake_user_id INT(11) NOT NULL, 
			created_at TIMESTAMP NULL DEFAULT NULL,
			updated_at TIMESTAMP NULL DEFAULT NULL
		)";

		$conn->exec($sql);

		/* 
		** CREATE check_profile_log TABLE
		*/
		$sql = "CREATE "
			. " TABLE IF NOT EXISTS "
			. $dbCheckProfileLog
			. " (
			id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			user_id INT(11) NOT NULL, 
			check_profile_user_id INT(11) NOT NULL, 
			created_at TIMESTAMP NULL DEFAULT NULL,
			updated_at TIMESTAMP NULL DEFAULT NULL
		)";

		$conn->exec($sql);

		/* 
		** CREATE last_activity_status TABLE
		*/
		$sql = "CREATE "
			. " TABLE IF NOT EXISTS "
			. $dbLastActivityStatus
			. " (
			id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			user_id INT(11) NOT NULL, 
			last_activity datetime NOT NULL, 
			created_at TIMESTAMP NULL DEFAULT NULL,
			updated_at TIMESTAMP NULL DEFAULT NULL
		)";

		$conn->exec($sql);

		/* 
		** CREATE notifications TABLE
		*/
		$sql = "CREATE "
			. " TABLE IF NOT EXISTS "
			. $dbNotifications
			. " (
			id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			user_id INT(11) NOT NULL,
			dest_user_id INT(11) NOT NULL,
			notif_type VARCHAR(10) NOT NULL, 
			seen INT(1) NULL DEFAULT 0,
			created_at TIMESTAMP NULL DEFAULT NULL,
			updated_at TIMESTAMP NULL DEFAULT NULL 
		)";

		$conn->exec($sql);
	}
	catch(PDOException $e) {
		echo $sql . "<br>" . $e->getMessage();
	}

	$conn = null;
?>
