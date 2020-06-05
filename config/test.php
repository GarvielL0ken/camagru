<?php
	require_once "./lib.php";
	session_start();

	if (!is_dir('../userdata/')) 
		mkdir('../userdata/', 0777, true);
	if (!$_POST['image'])
		redirect_to_page('../site/main.php', 'No Image Selected');
	$hash = bin2hex(openssl_random_pseudo_bytes(32));
	$file = '../user_images/' . $hash . '.png';
	$fp = fopen($file, "w");
	$image = $_POST['image'];
	$image = str_replace('data:image/png;base64,', '', $image);
	$image = str_replace(' ', '+', $image);
	$image = base64_decode($image);
	fwrite($fp, $image);
	fclose($fp);
	
	if (!$_SESSION['id_user'])
		$_SESSION['id_user'] = 1;
	upload_image($_SESSION['id_user'], $hash . '.png', null);
	redirect_to_page('../site/main.php', 'Image Uploaded Successfully');
?>