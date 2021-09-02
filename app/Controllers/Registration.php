<?php namespace App\Controllers;

use Modules\maintenanceManagement\Models\UsersModel;
use Modules\maintenanceManagement\Models\StudentsModel;
use Modules\MaintenanceManagement\Models\CoursesModel;
use Modules\MaintenanceManagement\Models\SectionsModel;
use Modules\MaintenanceManagement\Models\SuffixesModel;

class Registration extends BaseController
{
	public function index()
	{
        $course = new CoursesModel;
        $section = new SectionsModel;
        $suffixes = new SuffixesModel();
        $data['suffixes'] = $suffixes->getSuffixes();
        $data['courses'] = $course->getActiveCourse();
        $data['sections'] = $section->getActiveSections();
    

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
                            $this->session->setFlashData('success_registered',$_SESSION['success_registered']);
                            return redirect()->to( base_url());
                        }
                        
                    }else{
                        $_SESSION['error_message'] = 'You have an error in adding a new record';
                        $this->session->setFlashData('error_message',$_SESSION['error_message']);
                        return redirect()->to( base_url('Registration'))        ;
                    }
                    
                }else{
                    $_SESSION['error_message'] = 'Your Password and Re-type Password mismatch!';
                    $this->session->setFlashData('error_message', $_SESSION['error_message']);
                    return redirect()->to(base_url("Registration"));
                }
            }
        }
        echo view('App\Views\template\header');
		echo view('App\Views\registration\index',$data);
        echo view('App\Views\template\footer');
		
	}


	
}
