<?php
    session_start();
    $_SESSION['logged_on_user'] = null;
    header("Location: ./login.php");
?>