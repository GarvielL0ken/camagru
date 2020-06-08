<?php
	$page = 'main';
	session_start();
	require_once '../config/globals.php';
	require_once '../config/lib.php';
	require_once 'header.php';

	if (isset($_GET['delete']))
		delete_image($_GET['delete']);
?>
<html>
	<head>
		<link rel= "stylesheet" type= "text/css" href= "css/main.css">
		<script src= "js/main.js"></script>
	</head>
	<body>
		<div id= "body_main">
			<div id= "main">
				<div class= "play-area-sub">
					<div id="wc-overlays"></div>
					<video id= "stream" width= "640" height= "400" controls playsinline autoplay></video>
				</div>
			</div>
			<div id= "side">
				<form method="POST" action="../config/test.php" enctype="multipart/form-data" id='formupload'>
					<input type= "text" name= "image" id = "frm-image" hidden>
					<?php print_error_msg();?>
					<input type= "submit" id= "btn-upload" name= 'upload' value= 'upload'>
				</form>
				<div class= "play-area-sub">
					<canvas id= "capture" width= "320" height= "240" style= "display:none"></canvas>
					<div id= "snapshot"></div>
				</div>
				<?php
					$images = get_images(NULL, $_SESSION['id_user']);
					if (!$images)
						print("<pre class= 'centered'>Any images you upload will appear here<pre>");
					$_SESSION['num_images_on_page'] = count($images);
					foreach ($images as $image)
					{
						$html = '<div class= "div_image centered">
									<img class= "image" src= "../user_images/' . $image['image_name'] . '">
									<p>' . $image['image_text'] . '</p>' .
									output_a('main.php?delete=' . $image['id_image'], output_input('button', 'Delete', 'transparent')) .
								'</div>';
						print($html);
					}
				?>
			</div>
		</div>
		<div id= "footer">
			<button id= "btn-start" type= "button" class= "button">Start</button>
			<button id= "btn-stop" type= "button" class= "button">Stop</button>
			<button id= "btn-capture" type= "button" class= "button">Capture</button>
		</div>
		<div class= "card" id= "overlays">
			<?php
				$overlays = get_overlays();
				if ($overlays)
				{
					foreach ($overlays as $id)
					{
						print("<label><input type='checkbox' form='formupload' name='overlay[]' value='" . $id . "' onchange='overlays();'>");
						$src = "../resources/" . $id . ".png";
						print('<img class= "overlay" src= "' . $src . '">');
						print("</label> ");
					}
				}
			?>
		</div>
	</body>
</html>
<head>

</body>