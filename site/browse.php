<?php
    $page = 'browse';
    require_once '../config/globals.php';
    require_once '../config/lib.php';
    require_once '../config/funcs_browse.php';

	require_once './header.php';
	if (isset($_GET['page']))
		$_SESSION['gallery_page'] = $_GET['page'];
	else
		$_SESSION['gallery_page'] = 0;
	if (isset($_GET['delete']))
		delete_image($_GET['delete']);
	$username = NULL;
	$value_username = "";
	if (isset($_POST['username']))
	{
		$username = $_POST['username'];
		$value_username = 'value="' . $username . '"';
	}
	$image_name = NULL;
	$value_image_name = "";
	if (isset($_POST['image_name']))
	{
		$image_name = $_POST['image_name'];
		$value_image_name = 'value="' . $image_name . '"';
	}
?>
<html>
	<body>
		<form class= "card" id= "frm_search" action= "./browse.php" method= "POST">
			<pre>  Search by Username: <input type= "text" name= "username" <?php print($value_username)?>></pre>
			<pre>Search by Image Name: <input type= "text" name= "image_name" <?php print($value_image_name)?>></pre>
			<pre>                      <input type= "submit" value= "Search" name= "search"></pre>
		</form>
		<div class= "card" id= "div_main">
			<?php
				if ($username || $image_name)
					$images = search_for_images($username, $image_name);
				else
					$images = get_images(null);
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
						if ($_SESSION['id_user'] == $image['id_user'])
							$html .= '<br>' . output_a('browse.php?delete=' . $image['id_image'], output_input('button', 'Delete', 'transparent'));
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