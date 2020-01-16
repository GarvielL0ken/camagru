<?php
    session_start();
    $_SESSION['username'] = null;
    $_SESSION['id_user'] = null;
    header("Location: ./login.php");
?>