<?php
    $page = 'browse';
    require_once '../config/globals.php';
    require_once '../config/lib.php';
    require_once '../config/funcs_browse.php';
    require_once './header.php';

    if (!isset($_POST['gallery_page']))
        $_POST['gallery_page'] = 1;
?>
<html>
    <body>
        <form class= "card" id= "div_main" action= "./browse.php">
            <?php
                $html = '<pre class= "pre_pagination">page:</pre>';
                print($html);
            ?>
        </form>
        <div class= "card" id= "div_main">
            <?php
                $images = get_images($_POST['gallery_page'], $_POST['gallery_page'] + 4, null);
                foreach ($images as $image)
                {
                    $html = '<div class= "div_image centered">
                                <img class= "image" src= "../resources/' . $image['image_name'] . '">
                                <p>' . $image['image_text'] . '</p>
                            </div>';
                    print($html);
                }
            ?>
        <div>
    </body>
</html>