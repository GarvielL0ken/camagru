<?php
	session_start();

	require_once './lib.php';

	$id_image = $_GET['id_image'];
	$image_name = $_GET['image_name'];
	$page = 'comments.php?id_image=' . $id_image . '&image_name='. $image_name;

	if ($_POST['submit'] == "Comment")
	{
		$data = array('id_user' => $_SESSION['id_user'], 'id_image' => $id_image, 'text' => $_POST['comment_text']);
		insert_new_record('comments', $data);

		$results = get_user_from_id_image($id_image);
		if ($results[0]['notifications'])
		{
			$notfied_username = $results[0]['username'];
			$message = $username . 'Commented on your photo: ' . $image_name;
			$email = $results[0]['email_address'];
			send_notification_email($notfied_username, $message, $email, $page);
		}
	}
	$page = '../site/' . $page;
	redirect_to_page($page);
?>