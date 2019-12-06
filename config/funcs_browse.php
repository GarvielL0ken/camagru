<?php
    require_once 'database.php';
    require_once 'setup.php';

    function get_images($id_min, $id_max)
    {
        $conn = connect_to_db();
        $stmt = $conn->prepare('SELECT image_name, image_text FROM images WHERE id BETWEEN :id_min and :id_max');
        $stmt->execute(array('id_min' => $id_min, 'id_max' => $id_max));
        $results = $stmt->fetchAll();
        return ($results);
    }
?>