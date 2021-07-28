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
					// if($this->decryptions($user['password']) == trim($_POST['password']))

					if(password_verify($_POST['password'], $user['password']))
					{
						$loginOK = 1;
						$_SESSION['user_logged_in'] = 1;
						$_SESSION['uid'] = $user['id'];
						$_SESSION['uname'] = $user['username'];
						$_SESSION['fullname'] = $user['first_name'].' '.$user['last_name'];
						$_SESSION['rid'] = $user['role_id'];
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
				// $_SESSION['success_login'] = 'Welcome '.$user['username'].'!';
				// $this->session->markAsFlashdata('success_login');
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
			echo view('App\Views\template\notification');

        }
	}

	public function logout()
	{
		$this->session->destroy();
		$_SESSION['success'] = 'Thank you. Come Again!';
		$this->session->markAsFlashdata('success');
    	return redirect()->to(base_url());
	}

	function decryptions($string)
	{
		$encrypt_method = "AES-256-CBC";
		$secret_key = 'AA74CDCC2BBRT935136HH7B63C27'; // user define private key
		$secret_iv = '5fgf5HJ5g27'; // user define secret key
		$key = hash('sha256', $secret_key);
		$iv = substr(hash('sha256', $secret_iv), 0, 16); // sha256 is hash_hmac_algo
		$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
		return $output;
	}
}
