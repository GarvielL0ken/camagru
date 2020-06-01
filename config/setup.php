<?php
	require_once('database.php');

	function connect_to_db()
	{
		global $dbhost, $dbname, $dbusername, $dbpassword, $server_root;;
		try {
			$conn = new PDO("mysql:host=$dbhost", $dbusername, $dbpassword);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$conn->exec("CREATE DATABASE IF NOT EXISTS $dbname");
			$conn->query("use $dbname");
			$sql = "CREATE TABLE IF NOT EXISTS `users` (
				`id_user`		INT(6)			AUTO_INCREMENT	PRIMARY KEY,
				`first_name`	VARCHAR(30) 	NOT NULL,
				`last_name` 	VARCHAR(30) 	NOT NULL,
				`username` 		VARCHAR(20) 	NOT NULL,
				`new_email`		VARCHAR(70)		DEFAULT NULL,
				`email_address`	VARCHAR(70) 	NOT NULL,
				`passwd`		VARCHAR(128)	NOT NULL,
				`verified`		BOOLEAN 		NOT NULL		DEFAULT FALSE,
				`notifications`	BOOLEAN			NOT NULL		DEFAULT FALSE
				);";
			$conn->exec($sql);
			$sql = "CREATE TABLE IF NOT EXISTS `verification_hashes` (
				`id`				INT(6)		AUTO_INCREMENT	PRIMARY KEY,
				`id_user`			VARCHAR(20)	DEFAULT NULL,
				`new_user_hash`		VARCHAR(20) DEFAULT NULL,
				`reset_passwd_hash`	VARCHAR(20) DEFAULT NULL
			);";
			$conn->exec($sql);
			$sql = "CREATE TABLE IF NOT EXISTS `images` (
				`id`			INT(6)			AUTO_INCREMENT	PRIMARY KEY,
				`id_user`		VARCHAR(20)		DEFAULT NULL,
				`image_name`	VARCHAR(100)	DEFAULT NULL,
				`image_text`	TEXT			DEFAULT NULL
			);";
			$conn->exec($sql);
			$sql = "CREATE TABLE IF NOT EXISTS `overlays` (
				`image_id`              INT         PRIMARY KEY AUTO_INCREMENT
			);";
			$conn->exec($sql);
			return($conn);
		} catch (PDOException $pe) {
			die("Could not connect to the database $dbname :" . $pe->getMessage());
		}
		if (!is_dir('../userdata/')) 
			mkdir('../userdata/', 0777, true);
	};
?>