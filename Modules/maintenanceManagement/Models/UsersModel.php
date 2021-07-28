<?php
namespace Modules\maintenanceManagement\Models;

use CodeIgniter\Model;

class UsersModel extends \CodeIgniter\Model
{
    protected $table = 'users';

    protected $allowedFields = ['last_name', 'first_name','m_initial', 'username', 'email', 'password', 'role_id', 'status', 'created_at','updated_at', 'deleted_at', 'title', 'description'];

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

	public function getUsersWithRoles()
	{	
		$this->select('users.*, roles.*, users.id as id, users.status as status');
		$this->join('roles', 'users.role_id = roles.id', 'left');
	    return $this->findAll();
	}

	public function getUsersWithRolesById($id)
	{	
		$this->select('users.*, roles.*, users.id as id');
		$this->join('roles', 'users.role_id = roles.id', 'left');
		$this->where('users.id', $id);
	    return $this->first();
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
		// $val_array['password'] = $this->encrypting($val_array['password']);

	    return $this->save($val_array);
	}

    public function editUsers($val_array, $id)
	{
		$user = $this->find($id);

		$val_array['updated_at'] = (new \DateTime())->format('Y-m-d H:i:s');
		$val_array['status'] = 'a';
		if(empty($val_array['password']))
		{
			$val_array['password'] = $user['password'];
		}
		else
		{
			$val_array['password'] = password_hash($val_array['password'], PASSWORD_DEFAULT);
			// $val_array['password'] = $this->encrypting($val_array['password']);
		}

	
		return $this->update($id, $val_array);
	}

	public function inactive($id){
		$data['status'] = 'd';
		return $this->update($id, $data);
	}
	  
	public function active($id){
		$data['status'] = 'a';
		return $this->update($id, $data);
	}

	public function addStudentAccount($val_array = [])
	{
		$val_array['username'] = $val_array['student_num'];
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
		$this->join('permissions p', 'r.function_id = p.id', 'inner');
		$this->where('r.id', $role_id);
		$query = $this->first();

		return $query;
	}

	function encrypting($string)
	{
		$encrypt_method = "AES-256-CBC";
		$secret_key = 'AA74CDCC2BBRT935136HH7B63C27'; // user define private key
		$secret_iv = '5fgf5HJ5g27'; // user define secret key
		$key = hash('sha256', $secret_key);
		$iv = substr(hash('sha256', $secret_iv), 0, 16); // sha256 is hash_hmac_algo
		$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
		$output = base64_encode($output);
		return $output;
	}
}
