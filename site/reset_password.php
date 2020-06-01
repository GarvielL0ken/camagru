<?php
    $page = 'reset_password';
    require_once '../config/globals.php';
	require_once 'header.php';
?>
<html>
    <body>
    <?php
        $hash= "";
        $mode = $_GET['m'];
        if ($_GET['hash'])
            $hash = $_GET['hash'];
        if ($mode == '0')
        {
            $action = "../config/reset_password.php";
            $frm = '<pre>Email Address: <input required type= "text" placeholder= "johndoe@gmail.com" name= "email"></pre>';
            $value = "Request password reset";
        }
        else if ($mode == '1')
        {
            $action = '../config/reset_password.php?hash=' . $hash;
            $frm = '<pre>    New Password: <input required type= "password" name= "new_passwd"></pre>
                    <pre>Confirm Password: <input required type= "password" name= "confirm_passwd"></pre>';
            $value = "Reset password";
        }
        else if ($mode == '2')
        {
            $action = '../config/reset_password.php?email=' . $_GET['email'];
            $frm = '<pre>An email with a link to reset your password was sent to your email address</pre>';
            $value = "Request password reset";
        }
        $btn = '<pre id= "btn_submit">         <input type= "submit" value= "' . $value . '" name= "submit"></pre>';
        print('
            <form class= "card" id= "frm_user_data" action= "'. $action .'" method= "post">
                ' . $frm . $btn . '
            <form>');
    ?>
    </body>
</html>