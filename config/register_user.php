<?php
	require_once './database.php';
	require_once './setup.php';
	require_once "./globals.php";
	require_once './lib.php';
	
	global $RGX_NAME;
	global $RGX_USERNAME;
	function is_set($key)
	{
		return(isset($_POST[$key]));
	}

	function get_key($key)
	{
		return($_POST[$key]);
	}

	if(!isset($_POST))
		exit();
	if (!is_set('first_name') || !is_set('last_name') || !is_set('username') || !is_set('email') || !is_set('passwd') || !is_set('confirm_passwd'))
		exit();
	$first_name = get_key('first_name');
	$last_name = get_key('last_name');
	$username = get_key('username');
	$email = get_key('email');
	$passwd = get_key('passwd');
	$confirm_passwd = get_key('confirm_passwd');
	if (!ctype_alpha($first_name) || !ctype_alpha($last_name))
		exit();
	if(!preg_match('/' . $RGX_USERNAME . '/', $username))
		exit();
	//VALIDATION FOR EMAIL
	if ($passwd != $confirm_passwd)
	{
		print('ERROR: passwords do not match');
		exit();
	}
	if (!validate_password($passwd))
		exit();
	print("NO ERRORS ");
	$conn = connect_to_db();
	$passwd = hash( 'whirlpool', $passwd);
	$stmt = $conn->prepare("SELECT username FROM users WHERE username = :username");
	$stmt->execute(array("username" => $username));
	$results = $stmt->fetchAll();
	foreach($results as $result)
	{
		if ($username === $result['username'])
		{
			print("Username already in use ");
			exit();
		}
	}
	$sql = 'INSERT INTO users (first_name, last_name, username, email_address, passwd)
		VALUES (:first_name, :last_name, :username, :email_address, :passwd)';
	$stmt = $conn->prepare($sql);
	$stmt->execute(array("first_name" => $first_name, "last_name" => $last_name, "username" => $username, "email_address" => $email, "passwd" => $passwd));
	$hash = bin2hex(openssl_random_pseudo_bytes(8));
	send_verification_email($first_name, $email, $hash);
	$sql = 'INSERT INTO verification_hashes (username, verification_hash)
		VALUES (:username, :verification_hash)';
	$stmt = $conn->prepare($sql);
	$stmt->execute(array("username" => $username, "verification_hash" => $hash));
	//header("Location: ../site/login.php");
?>