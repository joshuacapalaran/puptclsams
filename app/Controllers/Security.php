<?php namespace App\Controllers;

use Modules\maintenanceManagement\Models\UsersModel;
use Modules\maintenanceManagement\Models\labsModel;
use Modules\maintenanceManagement\Models\SchedlabsModel;
use Modules\maintenanceManagement\Models\SuffixesModel;

class Security extends BaseController
{
	public function index()
	{
		$model = new UsersModel();
		
		if($_POST)
		{
			$loginOK = 0;
			$users = $model->getUserWithCondition(['username' => $_POST['username'],'status'=>'a']);

			//checking of user existense
			if(!empty($users))
			{
				foreach($users as $user)
				{
					if(password_verify($_POST['password'], $user['password']))
					{
						$loginOK = 1;
						$_SESSION['uid'] = $user['id'];
						$_SESSION['uname'] = $user['username'];
						$_SESSION['rid'] = $user['role_id'];
						$_SESSION['user_logged_in'] = 1;
						break;
					}
				}
			}
			else
			{

				$_SESSION['error'] = 'Cannot Find Username';
				$this->session->markAsFlashdata('error');
	        	return redirect()->to(base_url());
			}

			//checking if user is user credential is valid
			if($loginOK == 1)
			{
				$landing_page = $model->getLandingPage($_SESSION['rid']);
				// die('logged in');
				$_SESSION['success_login'] = 'Welcome '.$user['username'].'!';
				$this->session->markAsFlashdata('success_login');
				if($_SESSION['rid'] == '1'){
					return redirect()->to(base_url('admin/home'));
				}else{
					return redirect()->to(base_url($landing_page['table_name']));
				}
			}
			else
			{
				//die('error login');
				$_SESSION['error'] = 'Username and Password mismatch!';
				$this->session->markAsFlashdata('error');
	        	return redirect()->to(base_url());
			}
		}
		else
		{
			$labs = new labsModel();
			$schedLabsModel = new SchedlabsModel();
			$suffixes = new SuffixesModel();
			$data['labs'] = $labs->getLabsByActive();
			$data['suffixes'] = $suffixes->getSuffixes();
			$data['events'] = $schedLabsModel->getEventByCurrentDate();

			echo view('App\Views\template\header');
			echo view('App\Views\login',$data);
			echo view('App\Views\template\footer');

        }
	}

	public function logout()
	{
		$this->session->destroy();
		$_SESSION['success'] = 'Thank you. Come Again!';
		$this->session->markAsFlashdata('success');
    	return redirect()->to(base_url());
	}
}
