<?php
namespace Modules\UserManagement\Controllers;

use Modules\UserManagement\Models\UsersModel;
use Modules\UserManagement\Models\PermissionsModel;
use Modules\maintenanceManagement\Models\labsModel;
use Modules\UserManagement\Models\VisitorsModel;
use App\Controllers\BaseController;

class Visitors extends BaseController
{
	//private $permissions;

	public function __construct()
	{
		parent:: __construct();

		$permissions_model = new PermissionsModel();
		$this->permissions = $permissions_model->getPermissionsWithCondition(['status' => 'a']);
	}

    public function index($offset = 0)
    {

    	$model = new VisitorsModel();

        $data['visitors'] = $model->getVisitors();

        $data['view'] = 'Modules\UserManagement\Views\visitors\index';
        return view('template\index', $data);
    }

    public function add_visitor()
    {

		$labs = new labsModel();
    	$model = new VisitorsModel();
		
		$data['labs'] = $labs->getLabs();

    	helper(['form', 'url']);

    	if(!empty($_POST))
    	{
	    	if (!$this->validate('visitor'))
		    {
		    	$data['errors'] = \Config\Services::validation()->getErrors();
		        $data['function_title'] = "Adding Role";
		        $data['view'] = 'Modules\UserManagement\Views\visitors\frmVisitor';
		        echo view('App\Views\template\index', $data);
		    }
		    else
		    {
		        if($model->loginVisitor($_POST))
		        {
		        	$_SESSION['success'] = 'You have added a new record';
					$this->session->markAsFlashdata('success');
		        	return redirect()->to(base_url('admin/visitors'));
		        }
		        else
		        {
		        	$_SESSION['error'] = 'You have an error in adding a new record';
					$this->session->markAsFlashdata('error');
		        	return redirect()->to(base_url('admin/visitors'));
		        }
		    }
    	}
    	else
    	{

	    	$data['function_title'] = "Adding Visitor";
	        $data['view'] = 'Modules\UserManagement\Views\visitors\frmVisitor';
	        echo view('App\Views\template\index', $data);
    	}
    }

    public function logout_visitor($id)
    {
    	helper(['form', 'url']);
    	$model = new RolesModel();
    	$data['rec'] = $model->find($id);
    	$permissions_model = new PermissionsModel();
    	$data['permissions'] = $this->permissions;

    	if(!empty($_POST))
    	{
	    	if (!$this->validate('visitor'))
		    {
		    	$data['errors'] = \Config\Services::validation()->getErrors();
		        $data['function_title'] = "Edit of Visitor";
		        $data['view'] = 'Modules\UserManagement\Views\visitors\frmVisitor';
		        echo view('App\Views\template\index', $data);
		    }
		    else
		    {
		    	if($model->editVisitors($_POST, $id))
		        {
		        	$permissions_model->update_permitted_role($id, $_POST['function_id'], $data['rec']['function_id']);
		        	$_SESSION['success'] = 'You have updated a record';
					$this->session->markAsFlashdata('success');
		        	return redirect()->to(base_url('admin/visitors'));
		        }
		        else
		        {
		        	$_SESSION['error'] = 'You an error in updating a record';
					$this->session->markAsFlashdata('error');
		        	return redirect()->to( base_url('admin/visitors'));
		        }
		    }
    	}
    	else
    	{
	    	$data['function_title'] = "Editing of Visitor";
	        $data['view'] = 'Modules\UserManagement\Views\visitors\frmVisitor';
	        echo view('App\Views\template\index', $data);
    	}
    }

    public function delete($id)
    {
    	$model = new RolesModel();
    	if($model->deleteVisitor($id)){
			$this->session->setFlashData('success_message', 'Successfully deleted role');
		} else {
		  $this->session->setFlashData('error_message', 'Something went wrong!');
		}
		return redirect()->to(base_url('admin/visitors'));
    }

}
