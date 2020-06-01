<?php
	session_start();
	
	$RGX_NAME = "^[A-Za-z]$";
	$RGX_USERNAME = "^[A-Za-z][A-Za-z0-9.\-_]{8,20}$";
	$DOMAIN_NAME = $_SERVER["REQUEST_SCHEME"] . '://' . $_SERVER["SERVER_NAME"] . ':' . $_SERVER["SERVER_PORT"];
	$IMAGES_PER_PAGE = 6;
	$MAX_UPLOAD_SIZE = 35000000;

	if (isset($_SERVER['DOCUMENT_ROOT']) && $_SERVER['DOCUMENT_ROOT'] !== '')
		$server_root = $_SERVER['DOCUMENT_ROOT'] . rtrim($ROOT_PATH, '/');
	else
		$server_root = $_SERVER['PWD'];
?>