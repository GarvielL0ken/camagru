<?php
    require_once 'database.php';
    require_once 'setup.php';

    function get_images($page, $id_user= null)
    {
        $conn = connect_to_db();
        $sql = 'SELECT image_name, image_text FROM images';
        $data = array();
        if ($id_user)
        {
            $sql .= ' WHERE id_user = :id_user';
            $data = array('id_user' => $id_user);
        }
        $index = $page * 12;
        $sql .= ' LIMIT ' . $index . ', ' . ($index + 12);
        $stmt = $conn->prepare($sql);
        $stmt->execute($data);
        $results = $stmt->fetchAll();
        return ($results);
    }

    function print_pager($page)
    {
        print( '<pre class= "pre_pagination">page: ' . ($page + 1) . '</pre>
                <div class= "div_panel">
                    <div class= "div_pager"><input type= "submit" name= "pager" value= "Prev"></div>
                    <div class= "div_pager"><input type= "submit" name= "pager" value= "Next"></div>
                </div>');
    }

    function update_page($get)
    {
        if (!isset($_SESSION['gallery_page']))
            $_SESSION['gallery_page'] = 0;
        if (isset($get['pager']))
        {
            if ($get['pager'] == 'Prev')
                $_SESSION['gallery_page'] -= 1;
            else if ($get['pager'] == 'Next')
                $_SESSION['gallery_page'] += 1;
        }
    }
?>