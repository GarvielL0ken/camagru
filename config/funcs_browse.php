<?php
    require_once 'database.php';
    require_once 'setup.php';
    require_once 'lib.php';

    function get_images($page, $id_user= null)
    {
        global $IMAGES_PER_PAGE;
        $conn = connect_to_db();
        $sql = 'SELECT id, image_name, image_text FROM images';
        $data = array();
        if ($id_user)
        {
            $sql .= ' WHERE id_user = :id_user';
            $data = array('id_user' => $id_user);
        }
        $index = $page * $IMAGES_PER_PAGE;
        $sql .= ' LIMIT ' . $IMAGES_PER_PAGE . ' OFFSET ' . $index;
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

    function update_page($get, $page)
    {
        global $IMAGES_PER_PAGE;
        if (!isset($_SESSION['gallery_page']))
            $_SESSION['gallery_page'] = 0;
        if (isset($get['pager']))
        {
            if ($get['pager'] == 'Prev' && $_SESSION['gallery_page'] > 0)
                $_SESSION['gallery_page'] -= 1;
            else if ($get['pager'] == 'Next' && $_SESSION['num_images_on_page'] == $IMAGES_PER_PAGE)
                $_SESSION['gallery_page'] += 1;
        }
        if ($page == 'browse')
            $images = get_images($_SESSION['gallery_page']);
        else
            $images = get_images($_SESSION['gallery_page'], $_SESSION['id_user']);
        $num_images = count($images);
        if ($num_images == 0)
            $_SESSION['gallery_page'] -= 1; 
        if ($_SESSION['previous_page'] != $page)
            $_SESSION['gallery_page'] = 0;
    }

    function delete_image($id)
    {
        $results = is_in_db('images', 'id', $id, 'id_user');
        if ($_SESSION['id_user'] == $results[0]['id_user'])
            remove_records('images', 'id', $id);
    }
?>