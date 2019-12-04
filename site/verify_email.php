<?php
    require_once '../config/globals.php';
    require_once '../config/database.php';
    require_once '../config/setup.php';
    require_once '../config/lib.php';

    $hash = $_GET['hash'];
    $username = valid_hash($hash, 'new_user_hash');
    if (!$username)
        exit();
    update_value('users', 'verified', 1, $username);
    delete_hash($hash, 'new_user_hash');
    header("Location: ./login.php");
?>