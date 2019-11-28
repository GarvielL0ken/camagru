<?php
	require 'verify.php';
	require '../config/database.php';
	require '../config/setup.php';

	$conn = connect_to_db();
	$passwd = hash( 'whirlpool', $passwd);
	$sql = "INSERT INTO users (first_name, last_name, username, email_address, passwd)
		VALUES ('$first_name', '$last_name', '$username', '$email', '$passwd')";
	$conn->exec($sql);
?>