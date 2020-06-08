<?php
    require_once './globals.php';
    require_once './database.php';
    require_once './setup.php';
    require_once './lib.php';

	$image_name = NULL;
	if (isset($_FILES['image']['name']))
		$image_name = $_FILES['image']['name'];
	$image_text = NULL;
	if (isset($_POST['image_text']))
		$image_text = $_POST['image_text'];
	$target = '../user_images/' . basename($image_name);
	$page = '../site/upload.php';
	if ($image_name)
		upload_image($_SESSION['id_user'], $image_name, $image_text);
	if (move_uploaded_file($_FILES['image']['tmp_name'], $target))
		redirect_to_page($page, 'Image uploaded successfully');
	else
		redirect_to_page($page, 'Failed to upload image');
?>