<?php
namespace Modules\UserManagement\Controllers;

use Modules\UserManagement\Models\RolesModel;
use Modules\UserManagement\Models\PermissionsModel;
use App\Controllers\BaseController;
use Modules\MaintenanceManagement\Models\ActivityLogsModel;

class Roles extends BaseController
{
	//private $permissions;

	public function __construct()
	{
		parent:: __construct();

		$permissions_model = new PermissionsModel();
		$this->permissions = $permissions_model->getPermissionsWithCondition(['status' => 'a']);
		$this->activityLogsModel = new ActivityLogsModel;
	}

    public function index($offset = 0)
    {
    	// $this->hasPermissionRedirect('add-role');

    	$model = new RolesModel();

    	//kailangan ito para sa pagination
       	$data['all_items'] = $model->getRoleWithCondition(['status'=> 'a']);
       	$data['offset'] = $offset;

        $data['roles'] = $model->getRoleWithFunction();

        $data['view'] = 'Modules\UserManagement\Views\roles\index';
        return view('App\Views\template\index', $data);
    }

    public function show_role($id)
	{
		
		
		$data['permissions'] = $this->permissions;

		$model = new RolesModel();

		$data['role'] = $model->getRoleWithCondition(['id' => $id]);

		$data['function_title'] = "Role Details";
    $data['view'] = 'Modules\UserManagement\Views\roles\roleDetails';
        echo view('App\Views\template\index', $data);
	}

    public function add_role()
    {

    	$permissions_model = new PermissionsModel();

    	$data['permissions'] = $this->permissions;

    	helper(['form', 'url']);
    	$model = new RolesModel();

    	if(!empty($_POST))
    	{
	    	if (!$this->validate('role'))
		    {
		    	$data['errors'] = \Config\Services::validation()->getErrors();
		        $data['function_title'] = "Adding Role";
		        $data['view'] = 'Modules\UserManagement\Views\roles\frmRole';
		        echo view('App\Views\template\index', $data);
		    }
		    else
		    {
		        if($model->addRoles($_POST))
		        {
		        	$role_id = $model->insertID();
		        	$permissions_model->update_permitted_role($role_id, $_POST['function_id']);
					$this->activityLogsModel->addLogs($_SESSION['uid'], 'Add Role', 'admin/roles', json_encode($_POST));
					$_SESSION['success'] = 'You have added a new record';
					$this->session->markAsFlashdata('success');
		        	return redirect()->to(base_url('admin/roles'));
		        }
		        else
		        {
		        	$_SESSION['error'] = 'You have an error in adding a new record';
					$this->session->markAsFlashdata('error');
		        	return redirect()->to(base_url('admi/roles'));
		        }
		    }
    	}
    	else
    	{

	    	$data['function_title'] = "Adding Role";
	        $data['view'] = 'Modules\UserManagement\Views\roles\frmRole';
	        echo view('App\Views\template\index', $data);
    	}
    }

    public function edit_role($id)
    {
    	helper(['form', 'url']);
    	$model = new RolesModel();
    	$data['rec'] = $model->find($id);
    	$permissions_model = new PermissionsModel();
    	$data['permissions'] = $this->permissions;

    	if(!empty($_POST))
    	{
	    	if (!$this->validate('role'))
		    {
		    	$data['errors'] = \Config\Services::validation()->getErrors();
		        $data['function_title'] = "Edit of Role";
		        $data['view'] = 'Modules\UserManagement\Views\roles\frmRole';
		        echo view('App\Views\template\index', $data);
		    }
		    else
		    {
		    	if($model->editRoles($_POST, $id))
		        {
		        	$permissions_model->update_permitted_role($id, $_POST['function_id'], $data['rec']['function_id']);
					$this->activityLogsModel->addLogs($_SESSION['uid'], 'Edit Role', 'admin/roles', $id);
		        	$_SESSION['success'] = 'You have updated a record';
					$this->session->markAsFlashdata('success');
		        	return redirect()->to(base_url('admin/roles'));
		        }
		        else
		        {
		        	$_SESSION['error'] = 'You an error in updating a record';
					$this->session->markAsFlashdata('error');
		        	return redirect()->to( base_url('admin/roles'));
		        }
		    }
    	}
    	else
    	{
	    	$data['function_title'] = "Editing of Role";
	        $data['view'] = 'Modules\UserManagement\Views\roles\frmRole';
	        echo view('App\Views\template\index', $data);
    	}
    }

    public function delete_role($id)
    {
    	$model = new RolesModel();
    	if($model->deleteRole($id)){
		  $this->activityLogsModel->addLogs($_SESSION['uid'], 'Archive Role', 'admin/roles', $id);
		  $this->session->setFlashData('success_message', 'Successfully deleted role');
		} else {
		  $this->session->setFlashData('error_message', 'Something went wrong!');
		}
		return redirect()->to(base_url('admin/roles'));
	}

	public function active($id)
    {
    	$model = new RolesModel();
    	if($model->active($id)){
		  $this->activityLogsModel->addLogs($_SESSION['uid'], 'Restore Role', 'admin/roles', $id);
		  $this->session->setFlashData('success_message', 'Successfully restored role');
		} else {
		  $this->session->setFlashData('error_message', 'Something went wrong!');
		}
		return redirect()->to(base_url('admin/roles'));
	}
	
	public function view($id){
		helper(['form', 'url']);
    	$model = new RolesModel();
		$data['rec'] = $model->find($id);
    	$data['permissions'] = $this->permissions;

		$data['function_title'] = "View Role";
		$data['view'] = 'Modules\UserManagement\Views\roles\view';
		echo view('App\Views\template\index', $data);
	}

}
