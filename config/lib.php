<?php
	function output_input($type, $value= null, $class= null, $id= null)
	{
		$str_input = '<input type= ' . $type;
		if ($value)
			$str_input = $str_input . ' value= "' . $value . '"';
		if ($class)
			$str_input = $str_input . ' class= "' . $class . '"';
		if ($id)
			$str_input = $str_input . ' id= "' . $id . '"';
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
					</html>";
		send_email($email, "Verify your Camagru Account", $message);
	}

	function send_reset_password_email($email, $hash)
	{
		global $DOMAIN_NAME;

		$reset_password_link = "<a href='" . $DOMAIN_NAME . "/camagru/site/reset_password.php?m=1&hash=$hash'>Link</a>";
		$message = "<html>
						<body>
							<pre>Hello $first_name.</pre>
							<pre>You can reset your password by clicking the following link: $reset_password_link</pre>
						</body>
					</html>";
		send_email($email, "Reset your password for Camagru", $message);
	}

	function validate_password($passwd)
	{
		if (!preg_match('/[A-Z]/', $passwd) || !preg_match('/[a-z]/', $passwd) || !preg_match('/[0-9]/', $passwd))
			return(false);
		if (strlen($passwd) < 2) //change to 8
			return(false);
		return(true);
	}

	function valid_hash($hash, $type)
	{
		$conn = connect_to_db();
		$stmt = $conn->prepare('SELECT username, ' . $type . ' FROM verification_hashes WHERE ' . $type . ' = :verification_hash');
		$stmt->execute(array("verification_hash" => $hash));
		$results = $stmt->fetchAll();
		if (!$results)
			return(0);
		$dbhash = $results[0][$type];
		if ($hash != $dbhash)
			return(0);
		return($results[0]['username']);
	}

	function update_value($table, $column, $value, $username)
	{
		
		$conn = connect_to_db();
		$stmt = $conn->prepare('UPDATE ' . $table . ' SET ' . $column . '= "' . $value . '" WHERE username = :username');
		$stmt->execute(array("username" => $username));
	}

	function delete_hash($hash, $column)
	{
		$conn = connect_to_db();
		$stmt = $conn->prepare('DELETE FROM verification_hashes WHERE ' . $column . '= :verification_hash');
		$stmt->execute(array("verification_hash" => $hash));
	}

	function is_in_db($table, $column, $value, $returns)
	{
		$conn = connect_to_db();
		$stmt = $conn->prepare('SELECT ' . $returns . ' FROM ' . $table . ' WHERE ' . $column . '= :value');
		$stmt->execute(array("value" => $value));
		$results = $stmt->fetchAll();
		if (!$results)
			return (null);
		return ($results);
	}
	
	function set_keys($user_data, $null_keys)
	{
		$arr_keys = array('first_name', 'last_name', 'username', 'email');
		foreach ($arr_keys as $key)
		{
			if (!isset($user_data[$key]))
				$user_data[$key] = null;
		}
		foreach ($null_keys as $null_key)
			$user_data[$null_key] = null;
		return ($user_data);
	}

	function redirect_to_page($page, $error_msg= null, $form= null, $user_data= null, $null_keys=null)
    {
		$_SESSION['profile_page_form'] = $form;
		$_SESSION['error_msg'] = $error_msg;
		if ($user_data)
			$user_data = set_keys($user_data, $null_keys);
		$_SESSION['user_data'] = $user_data;
        header('Location: ' . $page);
        die();
	}
	
	function password_user_match($username, $passwd)
	{
		$conn = connect_to_db();
		$passwd = hash( 'whirlpool', $passwd);
		$stmt = $conn->prepare("SELECT passwd FROM users WHERE username = '$username'");
		$stmt->execute();
		$results = $stmt->fetchAll();
		if (!$results)
			return (0);
		if ($results[0]['passwd'] != $passwd)
			return (0);
		return (1);
	}

	function print_error_msg()
	{
		if ($_SESSION['error_msg'])
		{
			print('<pre>' . $_SESSION['error_msg'] . '</pre>');
			$_SESSION['error_msg'] = null;
		}
	}

	function upload_image($username, $image_name, $image_text)
	{
		$conn = connect_to_db();
		$stmt = $conn->prepare('INSERT INTO images (username, image_name, image_text)
								VALUES :username, :image_name, :image_text');
		$stmt->execute(array('username' => $username, 'image_name' => $image_name, 'image_text' => $image_text));
	}
?>