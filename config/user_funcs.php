<?php
    require_once './globals.php';
    require_once './database.php';
    require_once './setup.php';
    require_once './lib.php';

    function change_username($current_username, $new_username)
    {
        global $RGX_USERNAME;

        $id_user = $_SESSION['id_user'];
        if(!preg_match('/' . $RGX_USERNAME . '/', $new_username))
            redirect_to_page('Invalid username', 'change_username');
        if (is_in_db('users', 'username', $new_username, 'username'))
            redirect_to_page('Username already in use', 'change_username');
        update_value('users', 'username', $new_username, $id_user);
        $_SESSION['username'] = $new_username;
        redirect_to_page('../site/profile.php', 'Success', 'change_username');
    }

    function change_password($username, $old_passwd, $new_passwd, $confirm_passwd)
    {
        $target = '../site/profile.php';
        $id_user = $_SESSION['id_user'];
        if (!password_user_match($username, $old_passwd))
            redirect_to_page($target, 'Username and password do not match', 'change_passwd');
        if ($new_passwd != $confirm_passwd)
            redirect_to_page($target, 'Passwords do not match', 'change_passwd');
        if (!validate_password($new_passwd))
		    redirect_to_page($target, 'Passwords must:<br>Be longer than 8 characters<br>Contain 1 Uppercase Letter<br>Contain 1 Lowercase Letter<br>Contain 1 Number', 'change_passwd');
        update_value('users', 'passwd', hash('whirlpool', $new_passwd), $id_user);
        redirect_to_page($target, 'Success', 'change_passwd');
    }

    function change_email($id_user, $new_email)
    {
        $conn = connect_to_db();
        $stmt = $conn->prepare('UPDATE users SET new_email = :new_email WHERE id_user = :id_user');
        $stmt->execute(array('new_email' => $new_email, 'id_user' => $id_user));
        $first_name = is_in_db('users', 'id_user', $id_user, 'first_name')[0][0];
        print_r($first_name);
        $hash = generate_hash($id_user, 'new_user_hash');
        send_verification_email($first_name, $new_email, $hash);
        redirect_to_page('../site/profile.php', 'Success', 'change_email');
    }

    function change_notifications($id_user, $notifications)
    {
        if ($notifications)
            $notifications = 1;
        else
            $notifications = 0;
        update_value('users', 'notifications', $notifications, $id_user);
        redirect_to_page('../site/profile.php', 'Success', 'change_notification');
    }

    function delete_account($username, $del_password)
    {
        if (!password_user_match($username, $del_password))
        {
            redirect_to_page('../site/profile.php', 'Password is incorrect', 'delete_account');
            die();
        }
        $id_user = get_user_id($username);
        remove_records('images', 'id_user', $id_user);
        remove_records('users', 'id_user', $id_user);
        $_SESSION['username'] = null;
        $_SESSION['id_user'] = null;
        redirect_to_page('../site/login.php', 'Account removed successfully');
	}
	
    $action = $_POST['submit'];
    if ($action === 'Change Username')
        change_username($_SESSION['username'], $_POST['username']);
    if ($action === 'Change Email')
        change_email($_SESSION['id_user'], $_POST['email']);
    if ($action === 'Change Password')
        change_password($_SESSION['username'], $_POST['old_password'], $_POST['new_password'], $_POST['confirm_password']);
    if ($action === 'Search')
        print("Search");
    if ($action === 'Select an existing picture')
        print("Browse");
    if ($action === 'Upload a new picture')
        print("Upload");
    if ($action === 'Change Picture')
        print("change_picture");
    if ($action === 'Submit')
        change_notifications($_SESSION['id_user'], $_POST['notifications']);
    if ($action === 'Delete Account')
        delete_account($_SESSION['username'], $_POST['del_password']);
    header("Location: ../site/profile.php");
?>