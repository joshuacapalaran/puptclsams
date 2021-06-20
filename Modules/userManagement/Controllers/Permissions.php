<?php 
namespace Modules\userManagement\Controllers;

use Modules\userManagement\Models\PermissionsModel;
use Modules\userManagement\Models\ModulesModel;
use Modules\userManagement\Models\RolesModel;

use App\Controllers\BaseController;

class Permissions extends BaseController
{
	public function __construct()
	{
		parent:: __construct();
	}

    public function index()
    {
    	// $this->hasPermissionRedirect('role-permissions');

    	$model = new PermissionsModel();
    	$module_model = new ModulesModel();
    	$role_model = new RolesModel();

        $data['permissions'] = $model->getPermissions();
        $data['roles'] = $role_model->getRoles();
        $data['modules'] = $module_model->getModules();

        $data['view'] = 'Modules\UserManagement\Views\permissions\index';
        return view('template/index', $data);
    }

    public function edit_permission()
    {
    	// $this->hasPermissionRedirect('edit-role-permissions');
    	$model = new PermissionsModel();
    	$module_model = new ModulesModel();
    	$role_model = new RolesModel();

    	$isUpdated = 0;
    	$str = '';
    	if($_POST)
    	{
    		foreach($_POST['allowedUsers'] as $permissionID => $permittedRoles)
    		{
    			$str = '[';
    			foreach($permittedRoles as $ind => $val)
    			{
    				$str .= $ind.',';
    			}
    			$str = rtrim($str, ',');
    			$str .= ']';

    			$dataVal = 	['allowed_roles' => $str];
    			if($model->editPermission($dataVal, $permissionID))
				{
					$isUpdated = 1;
				}

    		}

     		if($isUpdated == 1)
	         {
	         	$_SESSION['success'] = 'You have updated the permissions';
				 $this->session->markAsFlashdata('success');
	         	return redirect()->to(base_url('admin/permissions'));
	         }
	         else
	         {
	         	$_SESSION['error'] = 'You have an error in updating the permissions';
				 $this->session->markAsFlashdata('error');
	         	return redirect()->to(base_url('admin/permissions'));
	         }
    	}



        $data['permissions'] = $model->getPermissions();
        $data['roles'] = $role_model->getRoles();
        $data['modules'] = $module_model->getModules();

        $data['view'] = 'Modules\UserManagement\Views\permissions\editPermission';
		return view('template/index', $data);

	}
	
	public function add_permission(){
		$data['view'] = 'Modules\userManagement\Views\permissions\addPermission';
		if($this->request->getMethod() === 'post'){
		  if($this->validate('subjects')){
			if($this->subjectsModel->add($_POST)){
			  $this->session->setFlashData('success_message', 'Sucessfuly created a subject');
			} else {
			  $this->session->setFlashData('error_message', 'Something went wrong!');
			}
			return redirect()->to(base_url('admin/subjects'));
		  } else {
			$data['value'] = $_POST;
			$data['errors'] = $this->validation->getErrors();
		  }
		}
		return view('template/index', $data);
	  }
}
