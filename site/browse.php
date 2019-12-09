<?php
    $page = 'browse';
    require_once '../config/globals.php';
    require_once '../config/lib.php';
    require_once '../config/funcs_browse.php';
    require_once './header.php';

    update_page($_GET);
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
    </body>
</html>