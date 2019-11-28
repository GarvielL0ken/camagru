<?php
	require 'verify.php';
	require './database.php';
	require './setup.php';

	$conn = connect_to_db();
	$passwd = hash( 'whirlpool', $passwd);
	$stmt = $conn->prepare("SELECT username FROM users WHERE username = '$username'");
	$stmt->execute();
	$results = $stmt->fetchAll();
	foreach($results as $result)
	{
		if ($username === $result['username']);
			return(print("Username already in use"));
	}
	$sql = "INSERT INTO users (first_name, last_name, username, email_address, passwd)
		VALUES ('$first_name', '$last_name', '$username', '$email', '$passwd')";
	$conn->exec($sql);
	header("Location: ../login.php");
?>