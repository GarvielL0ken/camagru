<?php
	session_start();

	if ($_SESSION['logged_on_user'])
		header('Location: main.php');
	else
		header('Location: login.php');
?>