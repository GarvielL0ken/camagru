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
	$user_data = array('first_name' => $first_name, 'last_name' => $last_name, 'username' => $username, 'email' => $email);
	$location = '../site/registration.php';
	if (!ctype_alpha($first_name))
		redirect_to_page($location, 'Names must only be alphabetical characters', null, $user_data, array('first_name'));
	if (!ctype_alpha($last_name))
		redirect_to_page($location, 'Names must only be alphabetical characters', null, $user_data, array('last_name'));
	if(!preg_match('/' . $RGX_USERNAME . '/', $username))
		redirect_to_page($location, 'Invalid Username', null, $user_data, array('username'));
	if (!valid_email($email))
		redirect_to_page($location, 'Email address is already in use', null, $user_data, array('email'));
	if ($passwd != $confirm_passwd)
		redirect_to_page($location, 'Passwords do not match', null, $user_data);
	if (!validate_password($passwd))
		redirect_to_page($location, 'Passwords must:<br>Be longer than 8 characters<br>Contain 1 Uppercase Letter<br>Contain 1 Lowercase Letter<br>Contain 1 Number', null, $user_data);
	$conn = connect_to_db();
	$passwd = hash( 'whirlpool', $passwd);
	$stmt = $conn->prepare("SELECT username FROM users WHERE username = :username");
	$stmt->execute(array("username" => $username));
	$results = $stmt->fetchAll();
	if ($results)
		redirect_to_page($location, 'Username already in use', null, $user_data, array('username'));
	$sql = 'INSERT INTO users (first_name, last_name, username, email_address, passwd)
		VALUES (:first_name, :last_name, :username, :email_address, :passwd)';
	$stmt = $conn->prepare($sql);
	$stmt->execute(array("first_name" => $first_name, "last_name" => $last_name, "username" => $username, "email_address" => $email, "passwd" => $passwd));
	$id_user = get_user_id($username);
	$hash = generate_hash($id_user, 'new_user_hash');
	send_verification_email($first_name, $email, $hash);
	header("Location: ../site/email.php");
?>