<?php
    require_once '../config/globals.php';
    require_once '../config/database.php';
    require_once '../config/setup.php';
    require_once '../config/lib.php';

    $hash = $_GET['hash'];
    $id_user = valid_hash($hash, 'new_user_hash');
    if (!$id_user)
        exit();
    $new_email = is_in_db('users', 'id_user', $id_user, 'new_email')[0]['new_email'];
    if ($new_email)
    {
        update_value('users', 'new_email', null, $id_user);
        update_value('users', 'email_address', $new_email, $id_user);
    }
    else
        update_value('users', 'verified', 1, $id_user);
    delete_hash($hash, 'new_user_hash');
    header("Location: ./login.php");
?>