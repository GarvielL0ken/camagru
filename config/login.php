<?php
	require_once './database.php';
	require_once './setup.php';
	require_once './globals.php';
	require_once './lib.php';

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
		redirect_to_page('../site/login.php', 'Password and username do not match');
	if ($results[0]['passwd'] != $passwd)
		redirect_to_page('../site/login.php', 'Password and username do not match');
	if (!$results[0]['verified'])
		redirect_to_page('../site/login.php', 'Validate email address first');
	$_SESSION['username'] = $username;
	$_SESSION['id_user'] = get_user_id($username);
	header("Location: ../site/main.php");
?>