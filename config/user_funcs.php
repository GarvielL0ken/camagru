<?php
    require_once './globals.php';
    require_once './database.php';
    require_once './setup.php';
    require_once './lib.php';

    function change_username($current_username, $new_username)
    {
        global $RGX_USERNAME;
        if(!preg_match('/' . $RGX_USERNAME . '/', $new_username))
            redirect_to_page('Invalid username', 'change_username');
        if (is_in_db('users', 'username', $new_username, 'username'))
            redirect_to_page('Username already in use', 'change_username');
        update_value('users', 'username', $new_username, $current_username);
        $_SESSION['logged_on_user'] = $new_username;
        redirect_to_page('../site/profile.php', 'Success', 'change_username');
    }

    function change_password($username, $old_passwd, $new_passwd, $confirm_passwd)
    {
        $target = '../site/profile.php';
        if (!password_user_match($username, $old_passwd))
            redirect_to_page($target, 'Username and password do not match', 'change_passwd');
        if ($new_passwd != $confirm_passwd)
            redirect_to_page($target, 'Passwords do not match', 'change_passwd');
        update_value('users', 'passwd', hash('whirlpool', $new_passwd), $username);
        redirect_to_page($target, 'Success', 'change_passwd');
    }

    $action = $_POST['submit'];
    if ($action === 'Change Username')
        change_username($_SESSION['logged_on_user'], $_POST['username']);
    if ($action === 'Change Email')
        print("change_email");
    if ($action === 'Change Password')
        change_password($_SESSION['logged_on_user'], $_POST['old_password'], $_POST['new_password'], $_POST['confirm_password']);
    if ($action === 'Search')
        print("Search");
    if ($action === 'Select an existing picture')
        print("Browse");
    if ($action === 'Upload a new picture')
        print("Upload");
    if ($action === 'Change Picture')
        print("change_picture");
    //header("Location: ../site/profile.php");
?>