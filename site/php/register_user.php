<?php
	require 'verify.php';
	require '../config/database.php';
	require '../config/setup.php';

	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$username = $_POST['username'];
	$email_address = $_POST['email_address'];
	$passwd = $_POST['passwd'];
	//$conn = connect_to_db();
	//print(0);
?>