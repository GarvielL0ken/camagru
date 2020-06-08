<?php
	$page = 'comments';
	session_start();
	require_once './header.php';

	if (isset($_GET['id_image']) && isset($_GET['image_name']))
	{
		$image_name = $_GET['image_name'];
		$id_image = $_GET['id_image'];
	}
	else
		redirect_to_page('./browse.php');
?>
<html>
	<body>
		<div class= "card" id= "div_main">
			<div class= "div_image centered" i>
				<img class= "image" src= "../user_images/<?php print($image_name);?>"><br>
			</div>
		</div>
		<div class= "card" id= "div_main">
			<form action= "../config/comment.php?id_image=<?php print($id_image . '&image_name=' . $image_name)?>" method= "post" enctype="multipart/form-data">
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
			<?php
				$comments = get_comments($id_image);
				foreach($comments as $comment)
				{

					$html = '<div class= "card">';
					$html .= '<h3>' . $comment['username'] . '</h3>';
					$html .= '<p>' . $comment['text'] . '</p>';
					$html .= '</div>';
					print($html);
				}
			?>
		</div>
	<body>
</html>