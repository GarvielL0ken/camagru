<?php
	require_once './database.php';
	require_once './setup.php';
	require_once "./globals.php";
    require_once "lib.php";

    function email_password_reset($email)
    {
        $results = is_in_db('users', 'email_address', $email, 'id_user');
        if (!$results)
            redirect_to_page('../site/reset_password.php?m=2&email=' . $email);
        $id_user = $results[0]['id_user'];
        $hash = generate_hash($id_user, 'reset_passwd_hash');
        send_reset_password_email($email, $hash);
        header('Location: ../site/reset_password.php?m=2&email=' . $email);
    }

    function reset_password($new_passwd, $confirm_passwd, $hash)
    {
        if ($new_passwd != $confirm_passwd)
        {
            print('ERROR: passwords do not match');
            exit();
        }
        if (!validate_password($new_passwd))
        {
            print('Invalid password');
            exit();
        }
        $id_user = valid_hash($hash, 'reset_passwd_hash');
        if (!$id_user)
            return(print('not a valid hash'));
        $passwd = hash( 'whirlpool', $new_passwd);
        update_value('users', 'passwd', $passwd, $id_user);
        delete_hash($hash, 'reset_passwd_hash');
        print("Success");
        header('Location: ../site/login.php');
    }

	if ($_POST['submit'] === "Request password reset")
	{
		if ($_POST['email'])
			$email = $_POST['email'];
		else
			$email = $_GET['email'];
		email_password_reset($email);
	}
	if ($_POST['submit'] === "Reset password")
		reset_password($_POST['new_passwd'], $_POST['confirm_passwd'], $_GET['hash']);
?>