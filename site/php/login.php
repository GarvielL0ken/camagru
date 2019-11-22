<?php
	$username = $_POST['username'];
	$passwd = $_POST['passwd'];

	if (!$username || !$passwd)
		return (print(1));
	if ($username == 'admin' && $passwd == 'admin')
	{
		return(print(0 . ';admin'));
	}
?>