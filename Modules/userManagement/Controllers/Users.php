<?php
namespace Modules\UserManagement\Controllers;

use Modules\UserManagement\Models\RolesModel;
use Modules\maintenanceManagement\Models\UsersModel;
use Modules\MaintenanceManagement\Models\ActivityLogsModel;
use App\Controllers\BaseController;

class Users extends BaseController
{
	//private $permissions;

	public function __construct()
	{
		parent:: __construct();
		$this->activityLogsModel = new ActivityLogsModel;
	}

    public function index($offset = 0)
    {
    	// $this->hasPermissionRedirect('add-role');

    	$model = new UsersModel();
    	$roleModel = new RolesModel();

    	//kailangan ito para sa pagination
        $data['users'] = $model->getUsersWithRoles();

        $data['view'] = 'Modules\UserManagement\Views\users\index';
        return view('template\index', $data);
    }


    public function add()
    {

    	helper(['form', 'url']);
		$model = new UsersModel();
    	$roleModel = new RolesModel();
		$data['roles'] = $roleModel->getRoles();
		
    	if(!empty($_POST))
    	{
	    	if (!$this->validate('users'))
		    {
		    	$data['errors'] = \Config\Services::validation()->getErrors();
		        $data['function_title'] = "Adding User";
		        $data['view'] = 'Modules\UserManagement\Views\users\frmUser';
		        echo view('App\Views\template\index', $data);
		    }
		    else
		    {
		        if($model->addUsers($_POST))
		        {
					$this->activityLogsModel->addLogs($_SESSION['uid'], 'Add Users', 'admin/users', json_encode($_POST));
					$_SESSION['success'] = 'You have added a new record';
					$this->session->markAsFlashdata('success');
		        	return redirect()->to(base_url('admin/users'));
		        }
		        else
		        {
		        	$_SESSION['error'] = 'You have an error in adding a new record';
					$this->session->markAsFlashdata('error');
		        	return redirect()->to(base_url('admi/users'));
		        }
		    }
    	}
    	else
    	{

	    	$data['function_title'] = "Adding User";
	        $data['view'] = 'Modules\UserManagement\Views\users\frmUser';
	        echo view('App\Views\template\index', $data);
    	}
    }

    public function edit($id)
    {
    	helper(['form', 'url']);
		$model = new UsersModel();
		$roleModel = new RolesModel();
		$data['roles'] = $roleModel->getRoles();
		$data['rec'] = $model->getUsersWithRolesById($id);
    	if(!empty($_POST))
    	{
	    	if (!$this->validate('users'))
		    {
		    	$data['errors'] = \Config\Services::validation()->getErrors();
		        $data['function_title'] = "Edit of Role";
		        $data['view'] = 'Modules\UserManagement\Views\users\frmUser';
		        echo view('App\Views\template\index', $data);
		    }
		    else
		    {
		    	if($model->editUsers($_POST, $id))
		        {
					$this->activityLogsModel->addLogs($_SESSION['uid'], 'Edit Users', 'admin/users', $id);
		        	$_SESSION['success'] = 'You have updated a record';
					$this->session->markAsFlashdata('success');
		        	return redirect()->to(base_url('admin/users'));
		        }
		        else
		        {
		        	$_SESSION['error'] = 'You an error in updating a record';
					$this->session->markAsFlashdata('error');
		        	return redirect()->to( base_url('admin/users'));
		        }
		    }
    	}
    	else
    	{
	    	$data['function_title'] = "Editing of Role";
	        $data['view'] = 'Modules\UserManagement\Views\users\frmUser';
	        echo view('App\Views\template\index', $data);
    	}
    }

    public function delete($id)
    {
    	$model = new UsersModel();
    	if($model->inactive($id)){
		  $this->activityLogsModel->addLogs($_SESSION['uid'], 'Archive Users', 'admin/users', $id);
		  $this->session->setFlashData('success_message', 'Successfully deleted user');
		} else {
		  $this->session->setFlashData('error_message', 'Something went wrong!');
		}
		return redirect()->to(base_url('admin/users'));
	}

	public function active($id)
    {
    	$model = new UsersModel();
    	if($model->active($id)){
		  $this->activityLogsModel->addLogs($_SESSION['uid'], 'Restore Users', 'admin/users', $id);
		  $this->session->setFlashData('success_message', 'Successfully restored user');
		} else {
		  $this->session->setFlashData('error_message', 'Something went wrong!');
		}
		return redirect()->to(base_url('admin/users'));
	}
	
	public function view($id){
		helper(['form', 'url']);
    	$model = new UsersModel();
		$roleModel = new RolesModel();
		$data['roles'] = $roleModel->getRoles();
		$data['rec'] = $model->getUsersWithRolesById($id);
		
		$data['function_title'] = "View Role";
		$data['view'] = 'Modules\UserManagement\Views\users\view';
		echo view('App\Views\template\index', $data);
	}

}
