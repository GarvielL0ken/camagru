<?php
	//echo('<link rel= "stylesheet" type= "text/css" href= "css/' . $page . '.css">');
	//echo('<script src= "js/' . $page . '.js"></script>');
	require_once '../config/globals.php';
	require_once '../config/lib.php';
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
			if ($page == 'login' || $page == "reset_password" || $page == 'email')
				print(output_a('registration.php', output_input('button', 'Register', 'header_btn transparent')));
			if ($page == 'registration' || $page == "reset_password" || $page == 'email')
				print(output_a('login.php', output_input('button', 'Login', 'header_btn transparent')));
			if ($page == 'main')
			{
				print(output_input('button', 'Upload', 'header_btn transparent'));
				print(output_input('button', 'Browse', 'header_btn transparent'));
				print(output_a('logout.php', (output_input('button', 'Logout', 'header_btn transparent'))));
				print(output_a('profile.php', output_input('button', 'Profile', 'header_btn transparent')));
			}
			if ($page == 'profile')
			{
				print(output_a('./logout.php', output_input('button', 'Logout', "header_btn transparent")));
				print(output_a('main.php', output_input('button', 'Main', 'header_btn transparent')));
			}
		?>
	</div>
</body>