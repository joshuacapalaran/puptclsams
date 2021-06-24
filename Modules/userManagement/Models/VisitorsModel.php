<?php
namespace Modules\UserManagement\Models;

use CodeIgniter\Model;

class VisitorsModel extends \CodeIgniter\Model
{
    protected $table = 'visitors';

    protected $allowedFields = ['name', 'purpose', 'lab_id', 'time_in','time_out', 'created_at','updated_at', 'deleted_at'];

    public function getVisitorWithCondition($conditions = [])
	{
		foreach($conditions as $field => $value)
		{
			$this->where($field, $value);
		}
	    return $this->findAll();
	}

	public function getVisitorWithFunction()
	{
		$db = \Config\Database::connect();

		$str = "SELECT a.*, b.function_name FROM roles a LEFT JOIN permissions b ON a.function_id = b.id WHERE a.status = 'a'";
		// print_r($str); die();
		$query = $db->query($str);

		// print_r($query->getResultArray()); die();
	    return $query->getResultArray();
	}

    public function getVisitors()
	{
	    return $this->findAll();
	}

    public function loginVisitor($val_array = [])
	{
		date_default_timezone_set('Asia/Singapore');
		$val_array['time_in'] = date('H:i:s');
		$val_array['created_at'] = (new \DateTime())->format('Y-m-d H:i:s');
	    return $this->save($val_array);
	}

    public function logoutVisitor($val_array = [], $id)
	{
		$val_array['updated_at'] = (new \DateTime())->format('Y-m-d H:i:s');
		$val_array['time_out'] = date('H:i:s');
		return $this->update($id, $val_array);
	}

   
}
