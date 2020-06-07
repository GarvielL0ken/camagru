<?php
	session_start();
	require_once './lib.php';

	$id_user = $_SESSION['id_user'];
	$username = $_SESSION['username'];
	if (!isset($_SESSION['email']))
		$_SESSION['email'] = is_in_db('users', 'id_user', $id_user, 'email_address')[0]['email_address'];
	$email = $_SESSION['email'];
	$id_image = array_keys($_POST)[0];
	$action = $_POST[$id_image];
	$data = array('id_user' => $id_user, 'id_image' => $id_image);
	//print_r($_SESSION);
	
	if ($action == "Like")
	{
		insert_new_record('likes', $data);
		$results = get_user_from_id_image($id_image);
		if ($results[0]['notifications'])
		{
			$notfied_username = $results[0]['username'];
			$message = $username . 'Like your photo: ' . $results[0]['image_name'];
			$email = $results[0]['email_address'];
			$page = 'browse.php?page=' . $_SESSION['gallery_page'];
			send_notification_email($notfied_username, $message, $email, $page);
		}
		
	}
	elseif ($action == "Unlike")
		remove_like($id_user, $id_image);
	redirect_to_page('../site/browse.php?page=' . $_SESSION['gallery_page']);
?>