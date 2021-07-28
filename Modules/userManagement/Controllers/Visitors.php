<?php
namespace Modules\UserManagement\Controllers;

use Modules\UserManagement\Models\UsersModel;
use Modules\UserManagement\Models\PermissionsModel;
use Modules\maintenanceManagement\Models\labsModel;
use Modules\UserManagement\Models\VisitorsModel;
use Modules\maintenanceManagement\Models\SchedlabsModel;
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
    	$schedLabsmodel = new SchedlabsModel();
		$data['schedlabs'] = $schedLabsmodel->getScheduleLabs();
        $data['visitors'] = $model->getVisitorsLabByDateAttendee($_POST['date'],$_POST['attendee']);
		$data['rec'] = $_POST;
        $data['view'] = 'Modules\UserManagement\Views\visitors\index';
        return view('template\index', $data);
    }

    public function add_visitor()
    {

		$labs = new labsModel();
    	$model = new VisitorsModel();
    	$schedLabsmodel = new SchedlabsModel();
		
		$data['labs'] = $labs->getLabs();
		$visit = $model->getVisitorByName($_POST['name']);
    	helper(['form', 'url']);

    	if(!empty($_POST))
    	{
	    	// if (!$this->validate('visitor'))
		    // {
		    // 	$data['errors'] = \Config\Services::validation()->getErrors();
		    //     $data['function_title'] = "Adding Role";
		    //     $data['view'] = 'Modules\UserManagement\Views\visitors\frmVisitor';
		    //     echo view('App\Views\template\index', $data);
		    // }
		    // else
		    // {
				if(!empty($visit)){
					if($model->logoutVisitor($visit['id']))
					{
						$_SESSION['success'] = 'You successfuly logout';
						$this->session->markAsFlashdata('success');
						return redirect()->to(base_url());
					}
					else
					{
						$_SESSION['error'] = 'You have an error in adding a new record';
						$this->session->markAsFlashdata('error');
						return redirect()->to(base_url());
					}
				}else{
					$schedlab = $schedLabsmodel->getScheduleLabById($_POST['event_id']);
					$visitor_total = count($model->getVisitorsLabById($_POST['event_id']));
					
				
					if($visitor_total >= $schedlab['num_people']){
						$_SESSION['error'] = 'You cant login, Laboratory is full';
						$this->session->markAsFlashdata('error');
						return redirect()->to(base_url());

					}else{
					
						if($model->loginVisitor($_POST))
						{
							$_SESSION['success'] = 'You successfuly login as visitor';
							$this->session->markAsFlashdata('success');
							return redirect()->to(base_url());
						}
						else
						{
							$_SESSION['error'] = 'You have an error in adding a new record';
							$this->session->markAsFlashdata('error');
							return redirect()->to(base_url());
						}
					}
					
				}
		        
		    // }
    	}
    	else
    	{

	    	$data['function_title'] = "Adding Visitor";
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
