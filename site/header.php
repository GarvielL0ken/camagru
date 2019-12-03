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
			if ($page == 'login' || $page == "reset_password")
				print(output_a('registration.php', output_input('button', 'Register', 'btn_header_btn')));
			if ($page == 'registration' || $page == "reset_password")
				print(output_a('login.php', output_input('button', 'Login', 'btn_header_btn')));
			if ($page == 'main')
			{
				print(output_input('button', 'Upload', 'btn_header_btn'));
				print(output_input('button', 'Browse', 'btn_header_btn'));
				print(output_input('button', 'Logout', 'btn_header_btn'));
				print(output_a('profile.php', output_input('button', $_SESSION['logged_on_user'], 'btn_header_btn')));
			}
		?>
	</div>
</body>