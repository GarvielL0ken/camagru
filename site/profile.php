<?php
    $page = 'profile';
    require_once '../config/globals.php';
    require_once 'header.php';
?>
<html>
    <body>
        <div class= "card" id= "frm_user_data">
            <img src= "../resources/Salamander_0.png">
            <?php
                print('<h2>' . $_SESSION['logged_on_user'] . '</h2>');
            ?>
        </div>
    </body>
</html>