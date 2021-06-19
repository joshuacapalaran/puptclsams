<?php namespace App\Controllers;

use Modules\maintenanceManagement\Models\UsersModel;
use Modules\maintenanceManagement\Models\StudentsModel;

class Registration extends BaseController
{
	public function index()
	{
        if($_POST){
            if(array_search("", $_POST)){
                $_SESSION['error_login'] = 'Please fill up all fields below';
                $this->session->markAsFlashdata('error_login');
                return redirect()->to(base_url("Registration"));
            }else{
                if($_POST['password'] == $_POST['password_retype']){

                    $users_model = new UsersModel();
                    $student_model = new StudentsModel();
                    unset($_POST['password_retype']);
                   
                    if($users_model->addStudentAccount($_POST)){
                        $user_id = $users_model->insertID();
                        if($student_model->addRegisteredStudent($_POST, $user_id)){
                            $_SESSION['success_registered'] = 'You Successfuly have PUP-CLSAMS Account!';
                            $this->session->markAsFlashdata('success_registered');
                            return redirect()->to( base_url());
                        }
                        
                    }else{
                        $_SESSION['error'] = 'You have an error in adding a new record';
                        $this->session->markAsFlashdata('error');
                        return redirect()->to( base_url('Registration'));
                    }
                    
                }else{
                    $_SESSION['error_login'] = 'Your Password and Re-type Password mismatch!';
                    $this->session->markAsFlashdata('error_login');
                    return redirect()->to(base_url("Registration"));
                }
            }
        }
        echo view('App\Views\template\header');
		echo view('App\Views\registration\index');
        echo view('App\Views\template\footer');
		
	}


	
}
