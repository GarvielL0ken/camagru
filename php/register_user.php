<?php
	require_once '../config/database.php';
	require_once '../config/setup.php';

	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$username = $_POST['username'];
	$email_address = $_POST['email_address'];
	$passwd = $_POST['passwd'];
	$confirm_passwd = $_POST['confirm_passwd'];
	if (!$first_name || !$last_name || !$username || !$email_address || !$passwd || !$confirm_passwd)
		return (print(1));
	if ($passwd != $confirm_passwd)
		return (print(2));
	if (strlen($passwd) < 6)
		return (print(3));
	$conn = connect_to_db();
	print(0);
?>