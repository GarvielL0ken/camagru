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
		<form class= "card" id= "div_main" action= "./browse.php" method= "get">
			<?php
				print_pager($_SESSION['gallery_page']);
			?>
		</form>
		<div class= "card" id= "div_main">
			<?php
				$images = get_images($_SESSION['gallery_page']);
				$_SESSION['num_images_on_page'] = count($images);
				foreach ($images as $image)
				{
					$html = '<div class= "div_image centered">
								<img class= "image" src= "../user_images/' . $image['image_name'] . '">
								<p>' . $image['image_text'] . '</p>
							</div>';
					print($html);
				}
			?>
		</div>
		<?php
			global $IMAGES_PER_PAGE;
			if ($_SESSION['num_images_on_page'] > 3)
			{
				print('<form class= "card" id= "div_main" action= "./browse.php" method= "get">');
				print_pager($_SESSION['gallery_page']);
				print('</form>');
			}
		?>
	</body>
</html>