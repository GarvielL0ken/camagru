<?php
	$page = 'reset_password';
	require_once('header.php');
?>
<html>
    <body>
        <form class= "card" id= "frm_user_data" action= "../config/reset_password.php" method= "post">
            <pre>Email Address: <input required type= "text" placeholder= "dick@face.com" name= "email"></pre>
            <pre id= "btn_submit">         <input type= "submit" value= "Reset Password" name= "submit"></pre>
        <form>
    </body>
</html>