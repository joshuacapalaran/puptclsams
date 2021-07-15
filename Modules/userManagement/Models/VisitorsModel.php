<?php
namespace Modules\UserManagement\Models;

use CodeIgniter\Model;

class VisitorsModel extends \CodeIgniter\Model
{
    protected $table = 'visitors';

    protected $allowedFields = ['name', 'purpose', 'lab_id','event_id', 'time_in','time_out', 'created_at','updated_at', 'deleted_at'];

    public function getVisitorWithCondition($conditions = [])
	{
		foreach($conditions as $field => $value)
		{
			$this->where($field, $value);
		}
	    return $this->findAll();
	}

	public function getVisitorsLab(){
		$this->distinct('visitors.id');
		$this->join('labs', 'visitors.lab_id = labs.id');
		return $this->find();
	}
    public function getVisitors()
	{
	    return $this->findAll();
	}

	public function getVisitorByName($name){
		$this->where('name', $name);
		return $this->first();
	}
    public function loginVisitor($val_array = [])
	{
		date_default_timezone_set('Asia/Singapore');
		$val_array['time_in'] = date('Y-m-d H:i:s');
		$val_array['created_at'] = (new \DateTime())->format('Y-m-d H:i:s');
	    return $this->save($val_array);
	}

    public function logoutVisitor($val_array = [],$id)
	{
		date_default_timezone_set('Asia/Singapore');
		$val_array['updated_at'] = (new \DateTime())->format('Y-m-d H:i:s');
		$val_array['time_out'] = date('Y-m-d H:i:s');
		return $this->update($id, $val_array);
	}

   
}
