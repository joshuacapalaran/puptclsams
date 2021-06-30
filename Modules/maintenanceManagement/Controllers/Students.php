<?php namespace Modules\MaintenanceManagement\Controllers;

use App\Controllers\BaseController;
use Modules\MaintenanceManagement\Models as MaintenanceManagement;
use Modules\MaintenanceManagement\Models\StudentsModel;
use Modules\MaintenanceManagement\Models\CoursesModel;
use Modules\MaintenanceManagement\Models\SectionsModel;
use Modules\MaintenanceManagement\Models\SuffixesModel;

class Students extends BaseController {

  function __construct(){
    $this->studentsModel = new MaintenanceManagement\studentsModel();
  }

  public function index(){
    $student = new StudentsModel;
    $data['students'] = $student->getStudents();
    $data['view'] = 'Modules\MaintenanceManagement\Views\students\index';
    return view('template/index', $data);
  }

  public function add(){
    $student = new StudentsModel;
    $course = new CoursesModel;
    $section = new SectionsModel;
    $suffix = new SuffixesModel;

    $data['courses'] = $course->getCourse();
    $data['sections'] = $section->getSections();
    $data['suffixes'] = $suffix->getSuffixes();
    $data['edit'] = false;
    $data['view'] = 'Modules\MaintenanceManagement\Views\students\form';
    if($this->request->getMethod() === 'post'){
      if($this->validate('students')){
        if($student->add($_POST)){
          $this->session->setFlashData('success_message', 'Sucessfuly created a student');
        } else {
          $this->session->setFlashData('error_message', 'Something went wrong!');
        }
        return redirect()->to(base_url('admin/students'));
      } else {
        $data['value'] = $_POST;
        $data['errors'] = $this->validation->getErrors();
      }
    }
    return view('template/index', $data);
  }

  public function edit($id){
    $data['edit'] = true;
    $data['view'] = 'Modules\MaintenanceManagement\Views\students\form';
    $data['id'] = $id;
    $course = new CoursesModel;
    $section = new SectionsModel;
    $suffix = new SuffixesModel;
    $student = new StudentsModel;

    $data['courses'] = $course->getCourse();
    $data['sections'] = $section->getSections();
    $data['suffixes'] = $suffix->getSuffixes();
    $data['value'] = $student->getStudentById($id);

    if(empty($data['value'])){
      die('Some Error Code Here (No Record)');
    }
    if($this->request->getMethod() === 'post'){
      if($this->validate('students')){
        if($this->studentsModel->edit($id, $_POST)){
          $this->session->setFlashData('success_message', 'Sucessfuly edited a student');
        } else {
          $this->session->setFlashData('error_message', 'Something went wrong!');
        }
        return redirect()->to(base_url('admin/students'));
      } else {
        $data['value'] = $_POST;
        $data['errors'] = $this->validation->getErrors();
      }
    }
    return view('template/index', $data);
  }

  public function delete_student($id){
    $studentsModel = new StudentsModel;
    
    if($studentsModel->inactive($id)) {
      $this->session->setFlashData('success_message', 'Successfully deleted student');
    } else {
      $this->session->setFlashData('error_message', 'Something went wrong!');
    }
    return redirect()->to(base_url('admin/students'));
  }

  public function active($id){
    $studentsModel = new StudentsModel;
    
    if($studentsModel->active($id)) {
      $this->session->setFlashData('success_message', 'Successfully restored student');
    } else {
      $this->session->setFlashData('error_message', 'Something went wrong!');
    }
    return redirect()->to(base_url('admin/students'));
  }

  public function view($id){
    $data['view'] = 'Modules\MaintenanceManagement\Views\students\view';
    $data['id'] = $id;
    $course = new CoursesModel;
    $section = new SectionsModel;
    $suffix = new SuffixesModel;
    $student = new StudentsModel;

    $data['courses'] = $course->getCourse();
    $data['sections'] = $section->getSections();
    $data['suffixes'] = $suffix->getSuffixes();
    $data['value'] = $student->getStudentById($id);
    return view('template/index', $data);


  }

}
