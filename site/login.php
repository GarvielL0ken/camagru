<?php
	$page = 'login';
	require_once('header.php');
?>
<html>
	<body>
		<div class= "card" id= "frm_user_data">
			<pre id= "username">Username: <input placeholder= 'J.Doe'></pre>
			<pre id= "password">Password: <input></pre>
			<pre id= "btn_submit"><button id= "submit">Submit</button></pre>
			<pre><a href= "registration.php">Don't have an account?</a></pre>
		</div>
	</body>
</html>