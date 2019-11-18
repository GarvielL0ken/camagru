<?php
	require_once 'dbconfig.php';

	function connect_to_db()
	{
		try {
			$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
			echo "Connected to $dbname at $host successfully.";
		} catch (PDOException $pe) {
			print_r($pe);
			die("Could not connect to the database $dbname :" . $pe->getMessage());
		}
	};
?>