<?php
	$page = 'registration';
	require_once('header.php');
?>
<html>
	<body>
		<form class= "card" id= "frm_user_data" action= "../config/register_user.php" method= "post">
			<pre>      First Name: <input required type= "text" placeholder= "John" name= "first_name"></pre>
			<pre>       Last Name: <input required type= "text" placeholder= "Doe" name= "last_name"></pre>
			<pre>        Username: <input required type= "text" placeholder= "J.Doe" name= "username"></pre>
			<pre>   Email Address: <input required type= "text" placeholder= "dick@face.com" name= "email"></pre>
			<pre>        Password: <input required type= "password" name= "passwd"></pre>
			<pre>Confirm Password: <input required type= "password" name= "confirm_passwd"></pre>
			<pre id= "btn_submit"      ><input type= "submit" value= "Submit" name= "submit"></pre>
			<pre><a href= "login.php" >Have an account?</a></pre>
		</form>
	</body>
</html>