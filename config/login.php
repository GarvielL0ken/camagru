<?php
	require_once './database.php';
	require_once './setup.php';
	require_once './globals.php';

	$username = $_POST['username'];
	$passwd = $_POST['passwd'];

	if (!$username || !$passwd)
		return (print(1));
	$conn = connect_to_db();
	$passwd = hash( 'whirlpool', $passwd);
	$stmt = $conn->prepare("SELECT passwd, verified FROM users WHERE username = '$username'");
	$stmt->execute();
	$results = $stmt->fetchAll();
	if (!$results)
		return(print('Password and username do not match'));
	if ($results[0]['passwd'] != $passwd)
		return(print('Password and username do not match'));
	if (!$results[0]['verified'])
		return(print('Validate email address first'));
	$_SESSION['logged_on_user'] = $username;
	print($_SESSION['logged_on_user']);
	header("Location: ../site/main.php");
?>