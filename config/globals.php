<?php
	$RGX_NAME = "^[A-Za-z]$";
	$RGX_USERNAME = "^[A-Za-z][A-Za-z0-9.\-_]{3,20}$";
	$DOMAIN_NAME = $_SERVER["REQUEST_SCHEME"] . '://' . $_SERVER["SERVER_NAME"] . ':' . $_SERVER["SERVER_PORT"];
	$IMAGES_PER_PAGE = 6;
	$MAX_UPLOAD_SIZE = 35000000;

	$SQL_OVERLAY_VALUES = "(1)";
	for ($i = 2; $i < 15; $i++) { 
		$SQL_OVERLAY_VALUES .= ", ($i)";
	}
?>