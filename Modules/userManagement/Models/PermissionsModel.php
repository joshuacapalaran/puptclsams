<?php 
namespace Modules\userManagement\Models;

use CodeIgniter\Model;

class PermissionsModel extends \CodeIgniter\Model
{
    protected $table = 'permissions';

    protected $allowedFields = ['name_on_class', 'function_name', 'function_description','slugs','page_title','module_id','allowed_roles','status', 'created_at','updated_at', 'deleted_at'];

    public function getPermissionsWithCondition($conditions = [])
	{
		foreach($conditions as $field => $value)
		{
			$this->where($field, $value);
		}
	    return $this->findAll();
	}

    public function getPermissions()
	{
	    return $this->where('status', 'a')->orderBy('order', 'ASC')->findAll();
	}

    public function addRoles($val_array = [])
	{
		$val_array['created_at'] = (new \DateTime())->format('Y-m-d H:i:s');
		$val_array['status'] = 'a';
	    return $this->save($val_array);
	}

    public function update_permitted_role($role_id, $function_id, $prev_function_id = 0)
	{

		$function = $this->find($function_id);
		
		if($prev_function_id == 0)
		{
			$str = str_replace(']', ','.$role_id.']', $function['allowed_roles']); 
			$val_array['allowed_roles'] = $str;
			return $this->update($function_id, $val_array);
		}

		if($prev_function_id != 0 && $prev_function_id == $function_id)
		{
			$val_array['allowed_roles'] = $function['allowed_roles'];
			return $this->update($function_id, $val_array);
		}
		/*
		if($prev_function_id == 0 && in_array($id, json_decode($function['allowed_roles'])))
		{
			$val_array['allowed_roles'] = $function['allowed_roles'];
			return $this->update($id, $val_array);
		}*/

		if($prev_function_id != 0 && $prev_function_id != $function_id)
		{

			$str = str_replace(']', ','.$role_id.']', $function['allowed_roles']); 
			$val_array['allowed_roles'] = $str;
			$this->update($function_id, $val_array);

			$function_prev = $this->find($prev_function_id);
			$str = str_replace(','.$role_id, '', $function_prev['allowed_roles']); 
			$val_array_prev['allowed_roles'] = $str;
			return $this->update($prev_function_id, $val_array_prev);
		}
	}

    public function editPermission($val_array = [], $id)
	{
		$val_array['updated_at'] = (new \DateTime())->format('Y-m-d H:i:s');
		return $this->update($id, $val_array);
	}

    public function deleteRole($id)
	{
		$val_array['deleted_at'] = (new \DateTime())->format('Y-m-d H:i:s');
		$val_array['status'] = 'd';
		return $this->update($id, $val_array);
	}
}