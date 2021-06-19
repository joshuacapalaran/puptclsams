<?php
namespace Modules\maintenanceManagement\Models;

use CodeIgniter\Model;

class UsersModel extends \CodeIgniter\Model
{
    protected $table = 'users';

    protected $allowedFields = ['lastname', 'firstname', 'username', 'email', 'password', 'birthdate', 'role_id', 'status', 'created_at','updated_at', 'deleted_at', 'title', 'description'];

    public function getUserWithCondition($conditions = [])
	{
		foreach($conditions as $field => $value)
		{
			$this->where($field, $value);
		}
	    return $this->findAll();
	}

	public function getUsersWithRole($args = [])
	{
		$db = \Config\Database::connect();

		$str = "SELECT a.*, b.role_name FROM users a LEFT JOIN roles b ON a.role_id = b.id WHERE a.status = '".$args['status']."' LIMIT ". $args['offset'] .','.$args['limit'];
		//print_r($str); die();
		$query = $db->query($str);

		// print_r($query->getResultArray()); die();
	    return $query->getResultArray();
	}


    public function getUsers()
	{
	    return $this->findAll();
	}

    public function addUsers($val_array = [])
	{
		$val_array['created_at'] = (new \DateTime())->format('Y-m-d H:i:s');
		$val_array['status'] = 'a';
		$val_array['password'] = password_hash($val_array['password'], PASSWORD_DEFAULT);

	    return $this->save($val_array);
	}

    public function editUsers($val_array = [], $id)
	{
		$user = $this->find($id);

		$val_array['updated_at'] = (new \DateTime())->format('Y-m-d H:i:s');
		$val_array['status'] = 'a';
		//print_r($val_array); die();
		if(empty($val_array['password']))
		{
			$val_array['password'] = $user['password'];
		}
		else
		{
			$val_array['password'] = password_hash($val_array['password'], PASSWORD_DEFAULT);
		}

		return $this->update($id, $val_array);
	}

    public function deleteUser($id)
	{
		$val_array['deleted_at'] = (new \DateTime())->format('Y-m-d H:i:s');
		$val_array['status'] = 'd';
		return $this->update($id, $val_array);
	}

	public function addStudentAccount($val_array = [])
	{
		unset($val_array['stud_num']);
		$val_array['created_at'] = (new \DateTime())->format('Y-m-d H:i:s');
		$val_array['status'] = 'a';
		$val_array['role_id'] = 3;
		$val_array['password'] = password_hash($val_array['password'], PASSWORD_DEFAULT);

	    return $this->save($val_array);
	}

	public function getLandingPage($role_id){
		$this->select('*');
		$this->from('users u');
		$this->join('roles r', 'u.role_id = r.id', 'inner');
		// $this->join('permissions p', 'r.function_id = p.id', 'inner');
		$this->where('r.id', $role_id);
		$query = $this->first();

		return $query;
	}
}
