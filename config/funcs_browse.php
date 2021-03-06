<?php
	require_once 'database.php';
	require_once 'setup.php';
	require_once 'lib.php';

	function get_images($page, $id_user= null)
	{
		global $IMAGES_PER_PAGE;
		$conn = connect_to_db();
		$sql = 'SELECT * FROM images INNER JOIN `users` ON images.id_user = users.id_user';
		$data = array();
		if ($id_user)
		{
			$sql .= ' WHERE images.id_user = :id_user';
			$data = array('id_user' => $id_user);
		}
		
		$sql .= ' ORDER BY images.upload_date DESC';
		if ($page)
		{
			$index = $page * $IMAGES_PER_PAGE;
			$sql .= ' LIMIT ' . $IMAGES_PER_PAGE . ' OFFSET ' . $index;
		}
		$stmt = $conn->prepare($sql);
		$stmt->execute($data);
		$results = $stmt->fetchAll();
		return ($results);
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
		$id_user = null;
		if (isset($_SESSION['id_user']))
			$id_user = $_SESSION['id_user'];
		if ($page == 'browse')
			$images = get_images($_SESSION['gallery_page']);
		else
			$images = get_images($_SESSION['gallery_page'], $id_user);
		$num_images = count($images);
		if ($num_images == 0)
			$_SESSION['gallery_page'] -= 1; 
		if ($_SESSION['previous_page'] != $page)
			$_SESSION['gallery_page'] = 0;
	}

	function delete_image($id)
	{
		$results = is_in_db('images', 'id_image', $id, 'id_user, image_name');
		if (!$results)
			return (NULL);
		if ($_SESSION['id_user'] == $results[0]['id_user'])
		{
			remove_records('images', 'id_image', $id);
			remove_records('likes', 'id_image', $id);
			remove_records('comments', 'id_image', $id);
			$path = '../user_images/' . $results[0]['image_name'];
			unlink($path);
		}
	}

	function search_for_images($username, $image_name)
	{
		$conn = connect_to_db();
		$sql = 'SELECT * FROM `images` ';
		$data = array();
		if ($username)
		{
			$sql .= 'INNER JOIN `users` ON users.id_user = images.id_user ';
			$sql .= 'WHERE users.username LIKE :username';
			$username = "%$username%";
			$data['username'] = $username;
			if ($image_name)
				$sql .= ' OR ';
		}
		if ($image_name)
		{
			if (!$username)
				$sql .= 'WHERE ';
			$sql .= 'images.image_name LIKE :image_name';
			$image_name = "%$image_name%";
			$data['image_name'] = $image_name;
		}
		$sql .= ' ORDER BY upload_date DESC';
		$stmt = $conn->prepare($sql);
		$stmt->execute($data);
		$results = $stmt->fetchAll();
		return ($results);
	}
?>