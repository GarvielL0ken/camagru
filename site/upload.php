<?php
	$page = "upload";
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
?>
<html>
	<body>
		<form class= "card centered wide" id= "frm_user_data" action= "../config/upload.php" method= "post" enctype="multipart/form-data">
			<div>
				<input type="file" name="image">
			</div>
			<div>
			<textarea 
				id="text" 
				cols="40" 
				rows="4" 
				name="image_text" 
				placeholder="Say something about this image..."></textarea>
			</div>
			<div>
				<input type= "submit" name="upload" value= "Upload">
			</div>
			<?php
				print_error_msg();
			?>
		</form>
		<form class= "card" id= "div_main" action= "./upload.php" method= "get">
			<?php
				//print_pager($_SESSION['gallery_page']);
			?>
		</form>
		<div class= "card" id= "div_main">
			<?php
				$images = get_images(NULL, $_SESSION['id_user']);
				if (!$images && $_SESSION['gallery_page'] == 0)
					print("<pre class= 'centered'>Any images you upload will appear here<pre>");
				$_SESSION['num_images_on_page'] = count($images);
				foreach ($images as $image)
				{
					$html = '<div class= "div_image centered">
								<img class= "image" src= "../user_images/' . $image['image_name'] . '">
								<p>' . $image['image_text'] . '</p>' .
								output_a('upload.php?delete=' . $image['id_image'], output_input('button', 'Delete', 'transparent')) .
							'</div>';
					print($html);
				}
			?>
		</div>
		<?php
			global $IMAGES_PER_PAGE;
			if ($_SESSION['num_images_on_page'] > 3)
			{
				print('<form class= "card" id= "div_main" action= "./browse.php" method= "get">');
				//print_pager($_SESSION['gallery_page']);
				print('</form>');
			}
		?>
	<body>
</html>