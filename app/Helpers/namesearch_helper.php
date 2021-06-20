<?php
if (! function_exists('name_on_system'))
{
	function name_on_system($id = 0, $lists = [], $table = '')
	{
		// echo $id;
		// echo "<br>";
		//print_r($lists);
		//print_r($table);
		$str = "";
		if(!empty($lists))
		{
			foreach($lists as $list)
			{
				if($list['id'] == $id)
				{
					switch($table)
					{
						case 'roles':
							$str = $list['role_name'];						
							break;
						case 'users':					
							$str = $list['firstname'].' '.$list['lastname'];						
							break;
						case 'modules':					
							$str = $list['module_name'];						
							break;
						case 'permissions':					
							$str = $list['function_name'];						
							break;
						default:
							break;
					}
					break;
				}
			}
		}
		// die($str);

		return $str;
	}
}

if (! function_exists('getIcon'))
{
	function getIcon($id = 0, $lists = [], $isPermalink = true)
	{
		if(!empty($lists))
		{
			foreach($lists as $list)
			{
				if($list['id'] == $id)
				{
					if($isPermalink)
					{
						return ' '.$list['link_icon'];
					}
					else
					{
						return ' '.$list['module_icon'];
					}
					break;
				}
			}
		}
		// die($str);

		return $str;
	}
}

if (! function_exists('role_name'))
{
	function role_name($id = 0, $lists = [])
	{
		$str = "";
		if(!empty($lists))
		{
			foreach($lists as $list)
			{
				if($list['id'] == $id)
				{
					$str = $list['role_name'];
					break;
				}
			}
		}
		// die($str);

		return $str;
	}
}
