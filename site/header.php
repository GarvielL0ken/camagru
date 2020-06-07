<?php
	if (!isset($page))
		$page = null;
	$_SESSION['previous_page'] = $page;
	if ($page == 'browse' || $page == 'upload' || $page == 'comments')
		echo('<link rel= "stylesheet" type= "text/css" href= "css/browse.css">');
	require_once '../config/globals.php';
	require_once '../config/lib.php';
	require_once '../config/funcs_browse.php';
?>
<head>
	<title>Camagru</title>
	<link rel= "stylesheet" type= "text/css" href= "css/common.css">
</head>
<body>
	<div class="card" id= 'div_header'>
		<div id= "div_header_title">
			<h2>Camagru</h2>
		</div>
		<?php
			$id_user = null;
			if (isset($_SESSION['id_user']))
				$id_user = 1;
			$v = array('login' => 0, 'reset_password' => 0, 'email' => 0, 'registration' => 0, 'main' => 0, 'profile' => 0, 'upload' => 0, 'browse' => 0, 'verify_email' => 0, 'comments' => 0);
			$v[$page] = 1;
			if (!$v['registration'] && !$v['login'] && !$v['browse'] && !$id_user && !$v['reset_password'] && !$v['email'] && !$v['verify_email'])
				redirect_to_page('./login.php');
			if ($v['login'] || $v['reset_password'] || $v['email'])
				print(output_a('registration.php', output_input('button', 'Register', 'header_btn transparent')));
			if ($v['registration'] || $v['reset_password'] || $v['email'])
				print(output_a('login.php', output_input('button', 'Login', 'header_btn transparent')));
			if ($v['profile'] || $v['upload'] || $v['browse'] || $v['comments'])
				print(output_a('main.php', output_input('button', 'Main', 'header_btn transparent')));
			if ($v['main'] || $v['profile'] || $v['browse'] || $v['comments'])
				print(output_a('upload.php', output_input('button', 'Upload', 'header_btn transparent')));
			if ($v['main'] || $v['profile'] || $v['upload'] || $v['comments'])
				print(output_a('browse.php', output_input('button', 'Browse', 'header_btn transparent')));
			if ($v['main'] || $v['upload'] || $v['browse'] || $v['comments'])
				print(output_a('profile.php', output_input('button', 'Profile', 'header_btn transparent')));
			if (!$v['registration'] && !$v['login'] && !$v['reset_password'])
				print(output_a('logout.php', (output_input('button', 'Logout', 'header_btn transparent'))));
		?>
	</div>
</body>