<?php

	require_once __DIR__ . '/create_database.php';

	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "USE " . $dbname;
        $conn->exec($sql);

		$sql = "CREATE "
            . " TABLE IF NOT EXISTS "
            . $dbtable
            . " (id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
            email VARCHAR(255) NOT NULL, 
            username VARCHAR(255) NOT NULL, 
            name VARCHAR(255) NOT NULL, 
            surname VARCHAR(255) NOT NULL, 
            password VARCHAR(255) NOT NULL,
            active INT(1) NULL DEFAULT 0,
            created_at TIMESTAMP NULL DEFAULT NULL,
            updated_at TIMESTAMP NULL DEFAULT NULL)";

        $conn->exec($sql);

        $sql = "CREATE "
            . " TABLE IF NOT EXISTS "
            . $dbCheckEmail
            . " (id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
            email VARCHAR(255) NOT NULL, 
            uniqid VARCHAR(255) NOT NULL,
            created_at TIMESTAMP NULL DEFAULT NULL,
            updated_at TIMESTAMP NULL DEFAULT NULL)";

        $conn->exec($sql);
	}
	catch(PDOException $e) {
		echo $sql . "<br>" . $e->getMessage();
	}

	$conn = null;
?>