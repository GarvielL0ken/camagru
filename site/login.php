<?php
	$page = 'login';
	require_once '../config/globals.php';
	require_once '../config/lib.php';
	require_once 'header.php';
?>
<html>
	<body>
		<form class= "card medium" id= "frm_user_data" action= "../config/login.php" method= "post">
			<?php
				$html = '<pre id= "username">Username: <input required type= "text" name= "username"';
				if (isset($_SESSION['user_data']))
				{
					if ($_SESSION['user_data']['username'])
						$html .= 'value= "' . $_SESSION['user_data']['username'] . '"';
					$_SESSION['user_data'] = null;
				}
				$html .= '></pre>';
				print($html);
			?>
			<pre id= "password">Password: <input required type= "password" name= "passwd"></pre>
			<pre id= "btn_submit"><input type= "submit" value= "Submit" name= "submit"></pre>
			<?php
				print_error_msg();
			?>
			<pre><a href= "registration.php">Don't have an account?</a></pre>
			<pre><a href= "reset_password.php?m=0">Forgot your password?</a></pre>
		</form>
	</body>
</html>