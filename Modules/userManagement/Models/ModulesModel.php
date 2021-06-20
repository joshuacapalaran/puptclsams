<?php 
namespace Modules\userManagement\Models;

use CodeIgniter\Model;

class ModulesModel extends \CodeIgniter\Model
{
    protected $table = 'modules';

    protected $allowedFields = ['module_name', 'module_description', 'order','status', 'created_at','updated_at', 'deleted_at'];

 //    public function getRoleWithCondition($conditions = [])
	// {
	// 	foreach($conditions as $field => $value)
	// 	{
	// 		$this->where($field, $value);
	// 	}
	//     return $this->findAll();
	// }

    public function getModules()
	{
	    return $this->findAll();
	}


	public function getModulesPermission()
	{	
		$this->from('modules m');
		$this->join('permissions p', 'm.id = p.module_id');
	    return $this->findAll();
	}

 //    public function addRoles($val_array = [])
	// {
	// 	$val_array['created_at'] = (new \DateTime())->format('Y-m-d H:i:s');
	// 	$val_array['status'] = 'a';
	//     return $this->save($val_array);
	// }

 //    public function editRoles($val_array = [], $id)
	// {
	// 	$val_array['updated_at'] = (new \DateTime())->format('Y-m-d H:i:s');
	// 	$val_array['status'] = 'a';
	// 	return $this->update($id, $val_array);
	// }

 //    public function deleteRole($id)
	// {
	// 	$val_array['deleted_at'] = (new \DateTime())->format('Y-m-d H:i:s');
	// 	$val_array['status'] = 'd';
	// 	return $this->update($id, $val_array);
	// }
}