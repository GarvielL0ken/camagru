<?php
	function output_input($type, $value= null, $class= null, $id= null)
	{
		$str_input = '<input type= ' . $type;
		if ($value)
			$str_input = $str_input . ' value= ' . $value;
		if ($class)
			$str_input = $str_input . ' class= ' . $class;
		if ($id)
			$str_input = $str_input . ' id= ' . $id;
		$str_input = $str_input . '>';
		return($str_input);
	}

	function output_a($href, $inner_html)
	{
		$str_a = '<a href= ' . $href;
		$str_a = $str_a . '>';
		$str_a = $str_a . $inner_html;
		$str_a = $str_a . '</a>';
		return($str_a);
	}

	function send_email($to, $subject, $message)
	{
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		mail($to, $subject, $message, $headers);
	}

	function send_verification_email($first_name, $email, $hash)
	{
		global $DOMAIN_NAME;

		$verification_link = "<a href='" . $DOMAIN_NAME . "/camagru/site/verify_email.php?hash=$hash'>Link</a>";
		$message = "<html>
						<body>
							<pre>Hello $first_name.</pre>
							<pre>Verify your Camagru Account by clicking on the following link: $verification_link</pre>
							<pre>If this was not you then ignore this email</pre>
						</body>
					<html>";
		send_email($email, "Verify your Camagru Account", $message);
	}
?>