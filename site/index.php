<?php
	session_start();

	if ($_SESSION['username'])
		header('Location: main.php');
	else
		header('Location: login.php');
?>