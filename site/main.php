<?php
	$page = 'main';
	require_once('header.php');
?>
<html>
	<head>
		<link rel= "stylesheet" type= "text/css" href= "css/common.css">
		<link rel= "stylesheet" type= "text/css" href= "css/main.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src= "js/main.js"></script>
	</head>
	<body>

		<div id= "body_main">
			<div id= "main">
				<video id= "camera_view" autoplay= "true"></video>
				<button id="camera_trigger">Take a picture</button>
				<canvas id="camera_sensor"></canvas>
			</div>
			<div id= "side">
				<img src="//:0" alt="" id="camera_output">
			</div>
		</div>
		<div id= "footer">Footer</div>
	</body>
</html>