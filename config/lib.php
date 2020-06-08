<?php
	require_once 'setup.php';
	if (!isset($_SESSION))
		session_start();

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
		$str_a = '<a href= "' . $href;
		$str_a = $str_a . '">';
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
							<pre>Hello.</pre>
							<pre>You can reset your password by clicking the following link: $reset_password_link</pre>
						</body>
					</html>";
		send_email($email, "Reset your password for Camagru", $message);
	}

	function send_notification_email($username, $message, $email, $page)
	{
		global $DOMAIN_NAME;

		$link = '<a href= "' . $DOMAIN_NAME . '/camagru/site/' . $page . '">Here</a>';
		$message = "<html>
						<body>
							<pre>Hello $username.</pre>
							<pre>$message</pre>
							<pre>Click $link to view</pre>
							<pre>If you would like to disable notifications you can do so in the profile tab</pre>
						</body>
					</html>";
		send_email($email, "Camagru Notification", $message);
	}

	function validate_password($passwd)
	{
		if (!preg_match('/[A-Z]/', $passwd) || !preg_match('/[a-z]/', $passwd) || !preg_match('/[0-9]/', $passwd))
			return(false);
		if (strlen($passwd) < 8) //change to 8
			return(false);
		return(true);
	}

	function valid_hash($hash, $type)
	{
		$conn = connect_to_db();
		$stmt = $conn->prepare('SELECT id_user, ' . $type . ' FROM verification_hashes WHERE ' . $type . ' = :verification_hash');
		$stmt->execute(array("verification_hash" => $hash));
		$results = $stmt->fetchAll();
		if (!$results)
			return(0);
		$dbhash = $results[0][$type];
		if ($hash != $dbhash)
			return(0);
		return($results[0]['id_user']);
	}

	function update_value($table, $column, $value, $id_user)
	{
		$conn = connect_to_db();
		$stmt = $conn->prepare('UPDATE ' . $table . ' SET ' . $column . '= "' . $value . '" WHERE id_user = :id_user');
		$stmt->execute(array("id_user" => $id_user));
	}

	function delete_hash($hash, $column)
	{
		$conn = connect_to_db();
		$stmt = $conn->prepare('DELETE FROM verification_hashes WHERE ' . $column . '= :verification_hash');
		$stmt->execute(array("verification_hash" => $hash));
	}

	function remove_records($table, $column, $value)
	{
		$conn = connect_to_db();
		$stmt = $conn->prepare('DELETE FROM ' . $table . ' WHERE ' . $column . '= :value');
		$stmt->execute(array("value" => $value));
	}

	function remove_like($id_user, $id_image)
	{
		$conn = connect_to_db();
		$sql = 'DELETE FROM likes WHERE id_user = :id_user AND id_image = :id_image';
		$stmt = $conn->prepare($sql);
		$stmt->execute(array("id_user" => $id_user, "id_image" => $id_image));
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
		if ($null_keys)
		{
			foreach ($null_keys as $null_key)
				$user_data[$null_key] = null;
		}
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
		if (isset($_SESSION['error_msg']))
		{
			print('<pre>' . $_SESSION['error_msg'] . '</pre>');
			$_SESSION['error_msg'] = null;
		}
	}

	function upload_image($id_user, $image_name, $image_text)
	{
		$conn = connect_to_db();
		$upload_date = date("Y-m-d H:i:s");
		$stmt = $conn->prepare('INSERT INTO images (id_user, image_name, image_text, upload_date)
								VALUES (:id_user, :image_name, :image_text, :upload_date)');
		$stmt->execute(array('id_user' => $id_user,
								'image_name' => $image_name,
								'image_text' => $image_text,
								'upload_date' => $upload_date
							));
	}

	function get_user_id($username)
	{
		$conn = connect_to_db();
		$stmt = $conn->prepare('SELECT id_user FROM users WHERE username = :username');
		$stmt->execute(array('username' => $username));
		$results = $stmt->fetchAll();
		return ($results[0]['id_user']);
	}

	function generate_hash($id_user, $type)
	{
		$hash = bin2hex(openssl_random_pseudo_bytes(64));
		$conn = connect_to_db();
		$stmt = $conn->prepare('INSERT INTO verification_hashes (id_user, ' . $type . ') VALUES (:id_user, :verification_hash)');
		$stmt->execute(array('id_user' => $id_user, 'verification_hash' => $hash));
		return ($hash);
	}

	function get_overlays()
	{
		$conn = connect_to_db();
		$stmt = $conn->prepare('SELECT `id_overlay` FROM `overlays` ORDER BY `id_overlay` ASC');
		if (!$stmt->execute(array()))
		{
			$stmt = null;
			print("Error getting overlays");
			exit;
		}
		if (!$return = $stmt->fetchAll(PDO::FETCH_COLUMN))
		{
			$stmt = null;
			return (null);
		}
		return ($return);
	}

	function valid_email($email)
	{
		$conn = connect_to_db();
		if (is_in_db('users', 'email_address', $email, '*'))
			return (false);
		return (true);
	}

	function insert_new_record($table, $data)
	{
		$conn = connect_to_db();
		$keys = array_keys($data);
		$fields = '';
		$values = '';
		foreach ($keys as $field)
		{
			$fields .= $field . ', ';
			$values .= ':' . $field . ', '; 
		}
		$fields = rtrim($fields, ', ');
		$values = rtrim($values, ', ');
		$sql = 'INSERT INTO ' . $table . ' (' . $fields . ') VALUES (' . $values . ')';
		$stmt = $conn->prepare($sql);
		$stmt->execute($data);
	}

	function get_user_from_id_image($id_image)
	{
		$conn = connect_to_db();
		$sql = "SELECT * FROM `users`
				INNER JOIN `images` ON users.id_user = images.id_user
				WHERE images.id_image = :id_image";
		$stmt = $conn->prepare($sql);
		$stmt->execute(array('id_image' => $id_image));
		$results = $stmt->fetchAll();
		if (!$results)
			return (null);
		return ($results);
	}

	function get_likes($id_user)
	{
		$results = is_in_db('likes', 'id_user', $id_user, 'id_image');
		return ($results);
	}

	function get_comments($id_image)
	{
		$conn = connect_to_db();
		$sql = 'SELECT users.username, comments.text FROM `users`
				INNER JOIN `comments` ON users.id_user = comments.id_user
				WHERE comments.id_image = :id_image';
		$stmt = $conn->prepare($sql);
		$stmt->execute(array('id_image' => $id_image));
		$results = $stmt->fetchAll();
		if (!$results)
			return (null);
		return ($results);
	}

	function add_overlays(string $image_path, string $newpath, array $overlays)
	{
		$overlay_posX = 10;
		$overlay_posY = 10;

		$size = getimagesize($image_path);
		$width = $size[0];
		$height = $size[1];

		$image = imagecreatefrompng($image_path);
		imagesavealpha($image, true);
		imagealphablending($image, true);

		if (isset($overlays) && is_array($overlays))
		{
			foreach ($overlays as $id)
			{
				$overlay_path = '../resources/' . $id . '.png';

				$size = getimagesize($overlay_path);
				$overlay_width = $size[0];
				$overlay_height = $size[1];
				$overlay_ratio = $overlay_width / $overlay_height;
				$overlay_newwidth = $width * 0.2;
				$overlay_newheight = $overlay_newwidth / $overlay_ratio;
				
				$overlay = imagecreatefrompng($overlay_path);
				imagesavealpha($overlay, true);
				imagealphablending($overlay, true);

				$overlay_resized = imagecreatetruecolor($overlay_newwidth, $overlay_newheight);
				imagesavealpha($overlay_resized, true);
				imagealphablending($overlay_resized, false);

				imagecopyresampled($overlay_resized, $overlay, 0, 0, 0, 0, $overlay_newwidth, $overlay_newheight, $overlay_width, $overlay_height);
				imagecopy($image, $overlay_resized, $overlay_posX, $overlay_posY, 0, 0, $overlay_newwidth, $overlay_newheight);
				$overlay_posX += $overlay_newwidth + 10;

				imagedestroy($overlay);
				imagedestroy($overlay_resized);
			}
		}

		imagepng($image, $newpath);
		imagedestroy($image);
		unlink($image_path);
	}
?>