<?php
if (! function_exists('hasPrimary'))
{
	function hasPrimary($module_id, array $array_permissions)
	{
		foreach($array_permissions as $permission)
		{
			if( $permission['module_id'] == $module_id && $permission['func_type'] == 1 && in_array($_SESSION['rid'], json_decode($permission['allowed_roles'])))
			{
				return true;
			}
		}
		return false;
	}
}

// if (! function_exists('user_primary_links'))
// {
// 	function user_primary_links(array $array_permissions)
// 	{
// 		$strAdditionalUrl = '';
// 		foreach($_SESSION['appmodules'] as $module)
// 		{
// 			if(hasPrimary($module['id'], $array_permissions))
// 			{
// 				echo '<li class="nav-item">';
// 					echo '<a href="#" class="nav-link">';
// 						echo getIcon($module['id'], $_SESSION['appmodules'], false);
// 						echo '<p>';
// 							echo ucwords(name_on_system($module['id'], $_SESSION['appmodules'], 'modules'));
// 							echo'<i class="right fas fa-angle-left"></i>';
// 						echo '</p>';
// 					echo '</a>';
// 					echo '<ul class="nav nav-treeview">';



				// echo '<li class="nav-item">';
				// echo '<div class="dropdown primary-menu-top">';
				// echo '<button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="'.str_replace(' ', '', ucwords(name_on_system($module['id'], $_SESSION['appmodules'], 'modules'))).'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
				// echo getIcon($module['id'], $_SESSION['appmodules'], false).' '. ucwords(name_on_system($module['id'], $_SESSION['appmodules'], 'modules'));
				// echo '</button>';
				// echo '<div class="dropdown-menu drop-items-primary" aria-labelledby="'.str_replace(' ', '', ucwords(name_on_system($module['id'], $_SESSION['appmodules'], 'modules'))).'">';
// 				foreach($array_permissions as $permission)
// 				{
// 					if($permission['module_id'] == $module['id'] && $permission['func_type'] == 1 && in_array($_SESSION['rid'], json_decode($permission['allowed_roles'])))
// 					{
// 						if($permission['slugs'] == 'user-own-profile')
// 						{
// 							echo '<a class="dropdown-item" title="'.ucwords($permission['function_name']) .'" data-toggle="tooltip" data-placement="bottom" class="nav-link" href="'. base_url() .''.str_replace("_","-",$permission['table_name']).'/own/'.$_SESSION['uid'] .'">'.getIcon($permission['id'], $_SESSION['userPermmissions']).' '.ucwords($permission['function_name']) .' </a>';
// 						}
// 						else
// 						{
// 							echo '<li class="nav-item">';
// 								echo '<a href="'. base_url() .''.str_replace("_","-",$permission['table_name']).'" title="'.ucwords($permission['function_name']) .'" class="nav-link">';
// 									echo getIcon($permission['id'], $_SESSION['userPermmissions']);
// 									echo '<p>'.ucwords($permission['function_name']) .'</p>';
// 								echo '</a>';
// 								echo '</li>';
// 							echo '<a class="dropdown-item" title="'.ucwords($permission['function_name']) .'" data-toggle="tooltip" data-placement="bottom" class="nav-link" href="'. base_url() .''.str_replace("_","-",$permission['table_name']).'">'.getIcon($permission['id'], $_SESSION['userPermmissions']).' '.ucwords($permission['function_name']) .' </a>';
// 						}
// 					}
// 				}
// 				echo '</ul>';
// 				echo '</li>';
// 			}
// 		}
// 	}
// }
if (! function_exists('user_primary_links'))
{
	function user_primary_links(array $array_permissions)
	{
		$strAdditionalUrl = '';

		foreach($_SESSION['appmodules'] as $module)
		{
			if(hasPrimary($module['id'], $array_permissions))
			{
				if($module['module_name'] !== 'Users' && $module['is_dropdown'] == 0){
					echo '<li class="nav-item  ">';
						echo '<a href="'.base_url().'/'.$module['route'].'" class="nav-link '.( (uri_string() == $module['route']) ? "active":" ").'">';
						echo $module['module_icon'];	
						echo ' <p>';
						echo $module['module_name'];	
						echo '  </p>';
						echo '</a>';
					echo '</li>';
				}
				else if ($module['module_name'] !== 'Users'  && $module['is_dropdown'] == 1)
				{	
					echo '<li class="nav-item">';
						echo '<a href="#" class="nav-link">';
						echo getIcon($module['id'], $_SESSION['appmodules'], false);
						echo '&nbsp<p>';
						echo $module['module_name'];
						// echo ucwords(name_on_system($module['id'], $_SESSION['appmodules'], 'modules'));
						echo '&nbsp <i class="fas fa-angle-left right"></i>';
						echo '</p>';
						echo '</a>';

					foreach($array_permissions as $permission)
					{
						echo '<ul class="nav nav-treeview">';

						if($permission['status'] == 'a' && $permission['module_id'] == $module['id'] && $permission['func_type'] == 1 && in_array($_SESSION['rid'], json_decode($permission['allowed_roles'])))
						{
							echo '<li class="nav-item" class="bg-white py-2 collapse-inner rounded">';
							echo '	<a id="color" class="nav-link '.( (uri_string() == $permission['table_name']) ? "active":" ").' " title="'.ucwords($permission['function_name']) .'" href="'. base_url() .'/'.$permission['table_name'].'">&nbsp';
							echo getIcon($permission['id'], $_SESSION['userPermmissions']);
							echo '<p>';
							echo ucwords($permission['function_name']);
							echo '</p>';
							echo '</a>';
							echo '</li>';
						}
						echo '</ul>';

					}
					echo '</li>';

				}else{
					echo ' <li class="nav-header">Users</li>';
					foreach($array_permissions as $permission)
					{
						if($permission['status'] == 'a' && $permission['module_id'] == $module['id'] && $permission['func_type'] == 1 && in_array($_SESSION['rid'], json_decode($permission['allowed_roles'])))
						{
							echo '<li class="nav-item  ">';
							echo '<a href="'.base_url().'/'.$permission['table_name'].'" class="nav-link '.( (uri_string() == $permission['table_name']) ? "active":" ").'">';
							echo getIcon($permission['id'], $_SESSION['userPermmissions']);	
							echo ' <p>';
							echo ucwords($permission['function_name']);	
							echo '  </p>';
							echo '</a>';
							echo '</li>';
						}
					}
				}

				
			}
		}
	}
}
if (! function_exists('user_add_link'))
{
	function user_add_link(string $table, array $array_permissions)
	{
		foreach($array_permissions as $permission)
		{
			if($permission['table_name'] == $table && $permission['func_type'] == 3 && in_array($_SESSION['rid'], json_decode($permission['allowed_roles'])))
			{
				echo  '<a href="'. base_url() .''.str_replace("_","-",$table).'/add" class="btn btn-sm btn-success btn-block float-left">Add '.ucwords(str_replace('_', ' ', $table)) .'</a>';
				break;
			}
		}

	}
}

if (! function_exists('user_edit_link'))
{
	function user_edit_link(string $table, string $slugs, array $array_permissions, $id)
	{
		foreach($array_permissions as $permission)
		{
			if($permission['slugs'] == $slugs && $permission['func_type'] == 3 && in_array($_SESSION['rid'], json_decode($permission['allowed_roles'])))
			{
				echo  '<a href="'. base_url() .''.str_replace("_","-",$table).'/edit/'.$id.'" class="btn btn-sm btn-dark btn-block"><i class="far fa-edit"></i> Edit</a>';
				break;
			}
		}

	}
}

if (! function_exists('maintenance_detail_add_link'))
{
	function maintenance_detail_add_link(string $table, array $array_permissions)
	{
		foreach($array_permissions as $permission)
		{
			if($permission['table_name'] == $table && $permission['func_type'] == 3 && in_array($_SESSION['rid'], json_decode($permission['allowed_roles'])))
			{
				switch($table)
				{
					case 'genders':
						echo  '<a href="'. base_url() .''.str_replace("_","-",$table).'/add" class="btn btn-sm btn-primary btn-block float-right"><i class="fas fa-plus"></i> Add '.ucwords(str_replace('_', ' ', $table)) .'</a>';
						break;
					case 'years':
						echo  '<a href="'. base_url() .''.str_replace("_","-",$table).'/add" class="btn btn-sm btn-primary btn-block float-right"><i class="fas fa-plus"></i> Add '.ucwords(str_replace('_', ' ', $table)) .'</a>';
						break;
					case 'sections':
						echo  '<a href="'. base_url() .''.str_replace("_","-",$table).'/add" class="btn btn-sm btn-primary btn-block float-right"><i class="fas fa-plus"></i> Add '.ucwords(str_replace('_', ' ', $table)) .'</a>';
						break;
					case 'penalties':
						echo  '<a href="'. base_url() .''.str_replace("_","-",$table).'/add" class="btn btn-sm btn-primary btn-block float-right"><i class="fas fa-plus"></i> Add '.ucwords(str_replace('_', ' ', $table)) .'</a>';
						break;
					case 'subjects':
						echo  '<a href="'. base_url() .''.str_replace("_","-",$table).'/add" class="btn btn-sm btn-primary btn-block float-right"><i class="fas fa-plus"></i> Add '.ucwords(str_replace('_', ' ', $table)) .'</a>';
						break;
					default:
						echo  '<a href="'. base_url() .''.str_replace("_","-",$table).'/add" class="btn btn-sm btn-primary btn-block float-right"><i class="fas fa-plus"></i> Add '.ucwords(str_replace('_', ' ', $table)) .'</a>';
						break;
				}
				break;
			}
		}
	}
}
if (! function_exists('maintenance_action'))
{
	function maintenance_action(string $table, array $array_permissions, $id, $pId = 0)
	{

		foreach($array_permissions as $permission)
		{
			if($permission['table_name'] == $table && $permission['func_type'] == 3 && in_array($_SESSION['rid'], json_decode($permission['allowed_roles'])))
			{
				switch($permission['func_action'])
				{
					case 'edit':
						switch($table){
							case 'genders':
								echo '<a class="btn btn-default btn-sm" style="border: 1px solid #343a40;" title="edit" href="'. base_url() .''.str_replace("_","-",$table).'/'.$permission['func_action'].'/'. $id.'"><i class="far fa-edit"></i></a> ';
							break;
							default:
								// echo '<a class="btn btn-warning btn-lg" title="edit" href="'. base_url() .''.str_replace("_","-",$table).'/'.$permission['func_action'].'/'. $id.'/'.$pId . '"><i class="far fa-clipboard"></i> Take Assessment</a> ';
								echo '<a class="btn btn-default btn-sm" style="border: 1px solid #343a40;" title="edit" href="'. base_url() .''.str_replace("_","-",$table).'/'.$permission['func_action'].'/'. $id.'"><i class="far fa-edit"></i></a> ';
							break;
						}
						break;

						case 'delete':
							switch($table){
								case 'subjects':
										echo '<a class="btn btn-danger btn-sm remove" onClick="confirmDelete(\''.base_url() .''.str_replace("_","-",$table).'/delete/\','.$id.')" title="delete"><i class="fas fa-archive"></i></a> ';
								break;
								case 'penalties':
										echo '<a class="btn btn-danger btn-sm remove" onClick="confirmDelete(\''.base_url() .''.str_replace("_","-",$table).'/delete/\','.$id.')" title="delete"><i class="fas fa-archive"></i></a> ';
								break;
								case 'sections':
										echo '<a class="btn btn-danger btn-sm remove" onClick="confirmDelete(\''.base_url() .''.str_replace("_","-",$table).'/delete/\','.$id.')" title="delete"><i class="fas fa-archive"></i></a> ';
								break;
								case 'genders':
										echo '<a class="btn btn-danger btn-sm remove" onClick="confirmDelete(\''.base_url() .''.str_replace("_","-",$table).'/delete/\','.$id.')" title="delete"><i class="fas fa-archive"></i></a> ';
								break;
								case 'years':
										echo '<a class="btn btn-danger btn-sm remove" onClick="confirmDelete(\''.base_url() .''.str_replace("_","-",$table).'/delete/\','.$id.')" title="delete"><i class="fas fa-archive"></i></a> ';
								break;
								default:
										echo  '<a class="btn btn-default btn-sm remove" style="border: 1px solid #343a40;" onClick="confirmDelete(\''.base_url().''.str_replace("_","-",$table).'/delete/'.$id.'\')" title="delete"><i class="far fa-trash-alt"></i></a>';
								break;
							}
							break;
				}
			}
		}
	}
}
if (! function_exists('users_action'))
{
	function users_action(string $table, array $array_permissions, $id)
	{

		foreach($array_permissions as $permission)
		{
			if($permission['table_name'] == $table && $permission['func_type'] == 3 && in_array($_SESSION['rid'], json_decode($permission['allowed_roles'])))
			{
				switch($permission['func_action'])
				{
					case 'show':
						echo '<a class="btn btn-dark btn-sm" title="show" href="'. base_url() .''.str_replace("_","-",$table).'/'.$permission['func_action'].'/'. $id.'"><i class="fas fa-bars"></i></a> ';
						break;
					case 'edit':
						echo '<a class="btn btn-success btn-sm" title="edit" href="'. base_url() .''.str_replace("_","-",$table).'/'.$permission['func_action'].'/'. $id.'"><i class="far fa-edit"></i></a> ';
						break;
					case 'delete':
						echo '<a class="btn btn-danger btn-sm remove" onClick="confirmDelete(\''.base_url() .''.str_replace("_","-",$table).'/delete/\','.$id.')" title="delete"><i class="fas fa-archive"></i></a> ';
						break;


				}
			}
		}
	}
}
if (! function_exists('users_edit'))
{
	function users_edit(string $table, array $array_permissions, $id)
	{

		foreach($array_permissions as $permission)
		{
			if($permission['table_name'] == $table && $permission['func_type'] == 3 && in_array($_SESSION['rid'], json_decode($permission['allowed_roles'])))
			{
				switch($permission['func_action'])
				{
					case 'edit':
						echo '<a class="btn btn-success btn-sm" title="edit" href="'. base_url() .''.str_replace("_","-",$table).'/'.$permission['func_action'].'/'. $id.'"><i class="far fa-edit"></i></a> ';
						break;
					case 'delete':
						echo '<a class="btn btn-danger btn-sm remove" onClick="confirmDelete(\''.base_url() .''.str_replace("_","-",$table).'/delete/\','.$id.')" title="delete"><i class="fas fa-archive"></i></a> ';
						break;
				}
			}
		}
	}
}
if (! function_exists('user_link'))
{
	function user_link(string $slugs, array $array_permissions)
	{
		$isValidSlug = 0;

		if(!empty($array_permissions))
		{
			foreach($array_permissions as $permission)
			{
				if(in_array($slugs, $permission))
				{
					return 1;
				}
			}

			if($isValidSlug == 0)
			{
				return 0;
			}

		}
	}
}
