<?php
	require("../config/globals.php");
	global $RGX_USERNAME;
	function is_set($key)
	{
		return (isset($_POST[$key]));
	}

	if(!isset($_POST))
		return;
	if (!is_set('first_name') || !is_set('last_name') || !is_set('username') || !is_set('email') || !is_set('passwd') || !is_set('confirm_passwd'))
		return;
	print($RGX_USERNAME);
?>