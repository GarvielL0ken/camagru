<?php
    $page = "upload";
    require_once '../config/globals.php';
    require_once '../config/lib.php';
    require_once './header.php';

    update_page($_GET);
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
                <input type= "submit" name="upload" value= "Upload">
  	        </div>
            <?php
                print_error_msg();
            ?>
        </form>
        <form class= "card" id= "div_main" action= "./browse.php" method= "get">
            <?php
                print_pager($_SESSION['gallery_page']);
            ?>
        </form>
        <div class= "card" id= "div_main">
            <?php
                $images = get_images($_POST['gallery_page'], $_SESSION['id_user']);
                foreach ($images as $image)
                {
                    $html = '<div class= "div_image centered">
                                <img class= "image" src= "../resources/' . $image['image_name'] . '">
                                <p>' . $image['image_text'] . '</p>
                            </div>';
                    print($html);
                }
            ?>
        </div>
    <body>
</html>