<?php
    $page = "upload";
    require_once './header.php';
?>
<html>
    <body>
        <form class= "card centerd" id= "frm_user_data" action= "../config/upload.php" method= "post" enctype="multipart/form-data">
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
            <div>
                <input type= "submit" name="upload" value= "Upload">
  	        </div>
        </form>
    <body>
</html>