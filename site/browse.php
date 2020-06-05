<?php
    $page = 'browse';
    require_once '../config/globals.php';
    require_once '../config/lib.php';
    require_once '../config/funcs_browse.php';

    update_page($_GET, $page);
    require_once './header.php';
?>
<html>
	<body>
		<div class= "card" id= "pager">
		</div>
		<div class= "card" id= "div_main">
			<?php
				$images = get_images($_SESSION['gallery_page']);
				$_SESSION['num_images_on_page'] = count($images);
				foreach ($images as $image)
				{
					$html = '<div class= "div_image centered">
								<img class= "image" src= "../user_images/' . $image['image_name'] . '"><br>
								<label>Like: <input type= "checkbox" form= "frm_like" name= "' . $image['id'] . '"></label><br>
								<a href= "./comments.php?id=' . $image['id'] . '"><input type= "button" value= "Comments" class= "transparent"><a>
							</div>';
					print($html);
				}
			?>
		</div>
		<div class= "card" id= "pager">
		</div>
		<form method="POST" action="../config/like.php" enctype="multipart/form-data" id='frm_like'>
		</form>
	</body>
</html>