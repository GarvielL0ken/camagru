<?php
	require './database.php';
	require './setup.php';

	$username = $_POST['username'];
	$passwd = $_POST['passwd'];

	if (!$username || !$passwd)
		return (print(1));
	$conn = connect_to_db();
	$passwd = hash( 'whirlpool', $passwd);
	$stmt = $conn->prepare("SELECT passwd, confirmed FROM users WHERE username = '$username'");
	$stmt->execute();
	$results = $stmt->fetchAll();
	if (!$results)
		return(print('Password and username do not match'));
	if ($results[0]['passwd'] != $passwd)
		return(print('Password and username do not match'));
	if (!$results[0]['confirmed'])
		return(print('Validate email address first'));
	header("Location: ../main.php");
?>