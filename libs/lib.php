<?php
	function output_input($type, $value= null, $class= null, $id= null)
	{
		$str_input = '<input type= ' . $type;
		if ($value)
			$str_input = $str_input . ' value= ' . $value;
		if ($class)
			$str_input = $str_input . ' class= ' . $class;
		if ($id)
			$str_input = $str_input . ' id= ' . $id;
		$str_input = $str_input . '>';
		return($str_input);
	}

	function output_a($href, $inner_html)
	{
		$str_a = '<a href= ' . $href;
		$str_a = $str_a . '>';
		$str_a = $str_a . $inner_html;
		$str_a = $str_a . '</a>';
		return($str_a);
	}
?>