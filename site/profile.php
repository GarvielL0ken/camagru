<?php
    $page = 'profile';
    require_once '../config/globals.php';
    require_once '../config/lib.php';
    require_once 'header.php';
?>
<html>
    <body>
        <div id= "div_body_main">
            <div class= "card centered" id= "div_profile">
                <img src= "../resources/Salamander_0.png">
                <?php
                    print('<h2>' . $_SESSION['username'] . '</h2>');
                ?>
            </div>
            <form class= "card centered" id= "frm_edit_profile" action= "./profile.php" method= "post">
                <input type= "submit" class= "transparent btn_edit_profile" value= "Change Username" name= "change_username"><br>
                <input type= "submit" class= "transparent btn_edit_profile" value= "Change Email Address" name= "change_email"><br>
                <input type= "submit" class= "transparent btn_edit_profile" value= "Change Password" name= "change_passwd"><br>
                <input type= "submit" class= "transparent btn_edit_profile" value= "Change Profile Picture" name= "change_picture"><br>
                <input type= "submit" class= "transparent btn_edit_profile" value= "Change Notification Option" name= "change_notification">
            </form>
            <?php
                $html = '<form class= "card centered" id= "frm_edit_profile" action= "../config/user_funcs.php" method= "post">';
                $forms = array('change_username', 'change_email', 'change_passwd', 'change_picture', 'change_notification');
                $form = null;
                foreach ($forms as $tmp_form)
                {
                    if (isset($_POST[$tmp_form]))
                        $form = $tmp_form;
                }
                if (!$form)
                {
                    $form = $_SESSION['profile_page_form'];
                    $_SESSION['profile_page_form'] = null;
                }
                if ($form === 'change_username')
                {
                    $html = $html . 
                                '<pre class= "field">New Username: <input required type= "text" name= "username"></pre>
                                <pre class= "field"><input type= "submit" value= "Change Username" name= "submit"></pre>';
                }
                if ($form === 'change_email')
                {
                    $html = $html . 
                                '<pre class= "field">   New Email: <input required type= "text" name= "email"></pre>
                                <pre class= "field"><input type= "submit" value= "Change Email" name= "submit"></pre>';
                }
                if ($form === 'change_passwd')
                {
                    $html = $html . 
                                '<pre class= "field">    Old Password: <input required type= "password" name= "old_password"></pre>
                                <pre class= "field">    New Password: <input required type= "password" name= "new_password"></pre>
                                <pre class= "field">Confirm Password: <input required type= "password" name= "confirm_password"></pre>
                                <pre class= "field"><input type= "submit" value= "Change Password" name= "submit"></pre>';
                }
                if ($form === 'change_picture')
                {
                    $html = $html . 
                                '<pre class= "field"> Search by name: <input type= "text" name= "image_name"></pre>
                                <pre class= "field"><input type= "submit" value= "Search"></pre>
                                <pre class= "field"><input type= "submit" value= "Select an existing picture"></pre>
                                <pre class= "field"><input type= "submit" value= "Upload a new picture"></pre>
                                <pre class= "field"><input type= "submit" value= "Change Picture" name= "submit"></pre>';
                }
                if ($form === 'change_notification')
                {
                    $html = $html .
                                '<pre class= "field">I would like to recieve notifications via email: <input type= "checkbox" name= "notifications"></pre>
                                <pre class= "field"><input type= "submit" value= "Submit" name= "submit"></pre>';
                }
                if ($_SESSION['error_msg'])
                {
                    $html .= '<pre>' . $_SESSION['error_msg'] . "</pre>";
                    $_SESSION['error_msg'] = null;
                }
                $html = $html . '</form>';
                if ($form)
                    print($html);
            ?>
        </div>
    </body>
</html>