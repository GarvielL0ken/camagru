<?php
	require_once '../config/lib.php';
	

	session_start();
	$_SESSION['username'] = 'garviel';
	global $MAX_UPLOAD_SIZE;
?>
<head>
	<link rel= "stylesheet" type= "text/css" href= "css/main.css">
</head>






<body>
		<h2>Upload Image</h2>
			<form method="POST" action="api/upload.php" enctype="multipart/form-data" id='formupload' onsubmit="return submitUploadForm('formupload');">
				<input type="hidden" name="MAX_FILE_SIZE" value="<?php print($MAX_UPLOAD_SIZE); ?>" />
					Select Image (Only PNG):
				<br /><input style="width: 200px; height: 23px" required type="file" accept="image/png" name="userfile" />
				<br /><button type="submit" class='submitbtn'>Upload</button>
				<div id="upload-status">&nbsp;</div>
				<div id="upload-progress">&nbsp;</div>
			</form>
		<div id= "body_main">
			<div id= "main">
				<div class= "play-area-sub">
					<video id= "stream" width= "640" height= "400" controls></video>
				</div>
			</div>
			<div id= "side">
				<div class= "play-area-sub">
					<div id="wc-overlays"></div>
					<canvas id= "capture" width= "320" height= "240"></canvas>
					<div id= "snapshot"></div>
				</div>
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