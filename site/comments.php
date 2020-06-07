<?php
	$page = 'comments';
	session_start();
	require_once './header.php';
?>
<html>
	<body>
		<div class= "card" id= "div_main">
			<div class= "div_image centered" i>
				<img class= "image" src= "../user_images/<?php print($_GET['image_name']);?>"><br>
			</div>
		</div>
		<div class= "card" id= "div_main">
			<form action= "../config/comment.php?id_image=<?php print($_GET['id_image'])?>" method= "post" enctype="multipart/form-data">
				<div>
					<textarea 
						id="text" 
						cols="40" 
						rows="4" 
						name="comment_text" 
						placeholder="Type any comments here. There is a maximum of 120 characters"
						maxlength="120"></textarea>
				</div>
				<br>
				<input type= "submit" name="submit" value= "Comment">
			</form>
		</div>
		<div class= "card" id= "div_main">
		</div>
	<body>
</html>