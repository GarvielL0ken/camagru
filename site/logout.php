<?php
	session_start();
	session_destroy();
    $_SESSION['username'] = null;
    $_SESSION['id_user'] = null;
    header("Location: ./login.php");
?>