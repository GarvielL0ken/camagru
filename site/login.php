<?php
	$page = 'login';
	require_once('header.php');
?>
<html>
	<body>
		<form class= "card" id= "frm_user_data" action= "../config/login.php" method= "post">
			<pre id= "username">Username: <input type= "text" name= "username"></pre>
			<pre id= "password">Password: <input type= "password" name= "passwd"></pre>
			<pre id= "btn_submit"><input type= "submit" value= "Submit" name= "submit"></pre>
			<pre><a href= "registration.php">Don't have an account?</a></pre>
			<pre><a href= "reset_password.php">Forgot your password?</a></pre>
		</form>
	</body>
</html>