<?php
	require("./globals.php");
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

	function validate_password($passwd)
	{
		if (!preg_match('/[A-Z]/', $passwd) || !preg_match('/[a-z]/', $passwd) || !preg_match('/[0-9]/', $passwd))
			return (false);
		if (strlen($passwd) < 2) //change to 8
			return(false);
		return (true);
	}

	if(!isset($_POST))
		return;
	if (!is_set('first_name') || !is_set('last_name') || !is_set('username') || !is_set('email') || !is_set('passwd') || !is_set('confirm_passwd'))
		return;
	$first_name = get_key('first_name');
	$last_name = get_key('last_name');
	$username = get_key('username');
	$email = get_key('email');
	$passwd = get_key('passwd');
	$confirm_passwd = get_key('confirm_passwd');
	if (!ctype_alpha($first_name) || !ctype_alpha($last_name))
		return(print('ERROR: first or last'));
	if(!preg_match('/' . $RGX_USERNAME . '/', $username))
		return(print('ERROR: username'));
	//VALIDATION FOR EMAIL
	if ($passwd != $confirm_passwd)
		return(print('ERROR: passwords do not match'));
	if (!validate_password($passwd))
		return(print('ERROR: invalid password'));
?>