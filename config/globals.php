<?php
	$RGX_NAME = "^[A-Za-z]$";
	$RGX_USERNAME = "^[A-Za-z][A-Za-z0-9.\-_]{3,20}$";

	if (isset($_SERVER["SERVER_NAME"]) && isset($_SERVER["SERVER_PORT"]))
    	$DOMAIN_NAME = $_SERVER["REQUEST_SCHEME"] . '://' . $_SERVER["SERVER_NAME"] . ':' . $_SERVER["SERVER_PORT"];
	else
    	$DOMAIN_NAME = $_SERVER['PWD'];
?>