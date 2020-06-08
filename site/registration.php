<?php
	$page = 'registration';
	require_once '../config/globals.php';
	require_once '../config/lib.php';
	require_once 'header.php';
?>
<html>
	<body>
		<form class= "card wide" id= "frm_user_data" action= "../config/register_user.php" method= "post">
			<?php
				$first_name = null;
				$last_name = null;
				$username = null;
				$email = null;
				if (isset($_SESSION['user_data']))
				{
					$user_data = $_SESSION['user_data'];
					if (isset($user_data['first_name']))
						$first_name = $user_data['first_name'];
					if (isset($user_data['last_name']))
						$last_name = $user_data['last_name'];
					if (isset($user_data['username']))
						$username = $user_data['username'];
					if (isset($user_data['email']))
						$email = $user_data['email'];
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
				$html.= '<pre>   Email Address: <input required type= "email" placeholder= "less@profanity.com" name= "email"';
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