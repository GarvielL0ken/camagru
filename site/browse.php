<?php
    $page = 'browse';
    require_once '../config/globals.php';
    require_once '../config/lib.php';
    require_once '../config/funcs_browse.php';

	//update_page($_GET, $page);
	require_once './header.php';
	if (isset($_GET['page']))
		$_SESSION['gallery_page'] = $_GET['page'];
	else
		$_SESSION['gallery_page'] = 0;
?>
<html>
	<body>
		<div class= "card" id= "pager">
		</div>
		<div class= "card" id= "div_main">
			<?php
				$images = get_images($_SESSION['gallery_page']);
				$likes = NULL;
				if (isset($_SESSION['id_user']))
					$likes = get_likes($_SESSION['id_user']);
				$_SESSION['num_images_on_page'] = count($images);
				foreach ($images as $image)
				{
					$value = "Like";
					if ($likes)
					{
						foreach ($likes as $like)
						{
							if ($like['id_image'] == $image['id_image'])
								$value = "Unlike";
						}
					}
					$html = '<div class= "div_image centered">
								<img class= "image" src= "../user_images/' . $image['image_name'] . '"><br>';
					if (isset($_SESSION['id_user']))
					{
						$html .= '<input type= "submit" form= "frm_like" name= "' . $image['id_image'] . '" value= "' . $value . '"><br>
									<a href= "./comments.php?id_image=' . $image['id_image'] . '&image_name=' . $image['image_name'] . '"><input type= "button" value= "Comments" class= "transparent"><a>';
					}
					$html .= '</div>';
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