<?php
	require_once('database.php');

	function connect_to_db()
	{
		global $dbhost, $dbname, $dbusername, $dbpassword;
		try {
			$conn = new PDO("mysql:host=$dbhost", $dbusername, $dbpassword);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$conn->exec("CREATE DATABASE IF NOT EXISTS $dbname");
			$conn->query("use $dbname");
			$data = $conn->query("SELECT * FROM `users`")->fetchAll();
			return ($conn);
		} catch (PDOException $pe) {
			//print_r($pe);
			print("\ncode = ". $pe->getCode() . "\n");
			if ($pe->getCode() == "42S02")
				create_table_users();
			die("Could not connect to the database $dbname :" . $pe->getMessage());
			
		}
	};

	function create_table_users()
	{
		print("CREATE TABLE USERS\n");
	}
?>