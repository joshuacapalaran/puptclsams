<?php
namespace Modules\UserManagement\Models;

use CodeIgniter\Model;

class RolesModel extends \CodeIgniter\Model
{
    protected $table = 'roles';

    protected $allowedFields = ['role_name', 'function_id', 'description','status', 'created_at','updated_at', 'deleted_at'];

    public function getRoleWithCondition($conditions = [])
	{
		foreach($conditions as $field => $value)
		{
			$this->where($field, $value);
		}
	    return $this->findAll();
	}

	public function getRoleWithFunction($args = [])
	{
		$db = \Config\Database::connect();

		$str = "SELECT a.*, b.function_name FROM roles a LEFT JOIN permissions b ON a.function_id = b.id WHERE a.status = '".$args['status']."' LIMIT ". $args['offset'] .','.$args['limit'];
		// print_r($str); die();
		$query = $db->query($str);

		// print_r($query->getResultArray()); die();
	    return $query->getResultArray();
	}

    public function getRoles()
	{
	    return $this->findAll();
	}

    public function addRoles($val_array = [])
	{
		$val_array['created_at'] = (new \DateTime())->format('Y-m-d H:i:s');
		$val_array['status'] = 'a';
	    return $this->save($val_array);
	}

    public function editRoles($val_array = [], $id)
	{
		$val_array['updated_at'] = (new \DateTime())->format('Y-m-d H:i:s');
		$val_array['status'] = 'a';
		return $this->update($id, $val_array);
	}

    public function deleteRole($id)
	{
		$val_array['deleted_at'] = (new \DateTime())->format('Y-m-d H:i:s');
		$val_array['status'] = 'd';
		return $this->update($id, $val_array);
	}
}
