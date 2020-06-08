<?php
	$page = 'reset_password';
	require_once '../config/globals.php';
	require_once 'header.php';
?>
<html>
	<body>
	<?php
		$hash= "";
		$mode = null;
		if (isset($_GET['m']))
			$mode = $_GET['m'];
		if (isset($_GET['hash']))
			$hash = $_GET['hash'];
		if ($mode == '0')
		{
			$placeholder = 'placeholder= "less@profanity.com"';
			if (isset($_GET['email']))
				$placeholder = 'value= ' . $_GET['email'];
			$action = "../config/reset_password.php";
			$frm = '<pre>Email Address: <input required type= "text" ' . $placeholder . ' "johndoe@gmail.com" name= "email"></pre>';
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
			$action = './reset_password.php?m=0&email=' . $_GET['email'];
			$frm = '<pre>If the email address is asscociated with an account<br>then an email with a link to reset your password<br>will have been sent to your email address</pre>
					<pre>If no email was recieved click here</pre>';
			$value = "Request password reset";
		}
		$btn = '<pre id= "btn_submit">         <input type= "submit" value= "' . $value . '" name= "submit"></pre>';
		if (isset($mode))
		{
			print('
				<form class= "card wide" id= "frm_user_data" action= "'. $action .'" method= "post">
					' . $frm . $btn . '
				<form>');
		}
	?>
	</body>
</html>