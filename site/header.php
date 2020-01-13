<?php
	$_SESSION['previous_page'] = $page;
	if ($page == 'browse' || $page == 'upload')
		echo('<link rel= "stylesheet" type= "text/css" href= "css/browse.css">');
	if ($page == 'main')
		echo('<script src= "js/' . $page . '.js"></script>');
	require_once '../config/globals.php';
	require_once '../config/lib.php';
	require_once '../config/funcs_browse.php';

?>
<head>
	<title>Camagru</title>
	<link rel= "stylesheet" type= "text/css" href= "css/common.css">
	<script src= "js/mylib.js"></script>
</head>
<body>
	<div class="card" id= 'div_header'>
		<div id= "div_header_title">
			<h2>Camagru</h2>
		</div>
		<?php
			$v = array('login' => 0, 'reset_password' => 0, 'email' => 0, 'registration' => 0, 'main' => 0, 'profile' => 0, 'upload' => 0, 'browse' => 0);
			$v[$page] = 1;
			if (!$v['registration'] && !$v['login'] && !$v['browse'] && !$_SESSION['id_user'] && !v['reset_password'])
				redirect_to_page('./login.php');
			if ($v['login'] || $v['reset_password'] || $v['email'])
				print(output_a('registration.php', output_input('button', 'Register', 'header_btn transparent')));
			if ($v['registration'] || $v['reset_password'] || $v['email'])
				print(output_a('login.php', output_input('button', 'Login', 'header_btn transparent')));
			if ($v['profile'] || $v['upload'] || $v['browse'])
				print(output_a('main.php', output_input('button', 'Main', 'header_btn transparent')));
			if ($v['main'] || $v['profile'] || $v['browse'])
				print(output_a('upload.php', output_input('button', 'Upload', 'header_btn transparent')));
			if ($v['main'] || $v['profile'] || $v['upload'])
				print(output_a('browse.php', output_input('button', 'Browse', 'header_btn transparent')));
			if ($v['main'] || $v['upload'] || $v['browse'])
				print(output_a('profile.php', output_input('button', 'Profile', 'header_btn transparent')));
			if (!$v['registration'] && !$v['login'] && !$v['reset_password'])
				print(output_a('logout.php', (output_input('button', 'Logout', 'header_btn transparent'))));
		?>
	</div>
</body>