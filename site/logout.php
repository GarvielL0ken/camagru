<?php
    session_start();
    $_SESSION['username'] = null;
    $_SESSION['id_user'] = null;
    $_SESSION['gallery_page'] = null;
    header("Location: ./login.php");
?>