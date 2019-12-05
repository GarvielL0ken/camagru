<?php
	$page = 'registration';
	require_once '../config/globals.php';
	require_once '../config/lib.php';
	require_once 'header.php';
?>
<html>
	<body>
		<form class= "card" id= "frm_user_data" action= "../config/register_user.php" method= "post">
			<?php
				if ($_SESSION['user_data'])
				{
					$first_name = $_SESSION['user_data']['first_name'];
					$last_name = $_SESSION['user_data']['last_name'];
					$username = $_SESSION['user_data']['username'];
					$email = $_SESSION['user_data']['email'];
				}
				$html = '<pre>      First Name: <input required type= "text" placeholder= "John" name= "first_name"';
				if ($first_name)
					$html.= ' value= "' . $first_name . '"';
				$html.= '></pre>';
				$html.= '<pre>       Last Name: <input required type= "text" placeholder= "Doe" name= "last_name"';
				if ($last_name)
					$html.= ' value= "' . $last_name . '"';
				$html.= '></pre>';
				$html.= '<pre>        Username: <input required type= "text" placeholder= "J.Doe" name= "username"';
				if ($username)
					$html.= ' value= "' . $username . '"';
				$html.= '></pre>';
				$html.= '<pre>   Email Address: <input required type= "text" placeholder= "dick@face.com" name= "email"';
				if ($email)
					$html.= ' value= "' . $email . '"';
				$html.= '></pre>';
				print($html);
			?>
			<pre>        Password: <input required type= "password" name= "passwd"></pre>
			<pre>Confirm Password: <input required type= "password" name= "confirm_passwd"></pre>
			<pre id= "btn_submit"      ><input type= "submit" value= "Submit" name= "submit"></pre>
			<?php
				print_error_msg();
			?>
			<pre><a href= "login.php" >Have an account?</a></pre>
		</form>
	</body>
</html>