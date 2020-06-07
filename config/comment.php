<?php
	session_start();

	require_once './lib.php';

	if ($_POST['submit'] == "Comment")
	{
		$data = array('id_user' => $_SESSION['id_user'], 'id_image' => $_GET['id_image'], 'text' => $_POST['comment_text']);
		insert_new_record('comments', $data);
	}
?>