<?php namespace Modules\MaintenanceManagement\Controllers;

use App\Controllers\BaseController;
use Modules\MaintenanceManagement\Models as MaintenanceManagement;
use Modules\MaintenanceManagement\Models\CoursesModel;

class Courses extends BaseController {

  function __construct(){
    $this->coursesModel = new MaintenanceManagement\coursesModel();
  }

  public function index(){
    $data['courses'] = $this->coursesModel->get();
    $data['view'] = 'Modules\MaintenanceManagement\Views\courses\index';
    return view('template/index', $data);
  }

  public function add(){
    $courseModel = new CoursesModel;
    $data['edit'] = false;
    $data['view'] = 'Modules\MaintenanceManagement\Views\courses\form';
    if($this->request->getMethod() === 'post'){
      if($this->validate('courses')){
        if($courseModel->add($_POST)){
          $this->session->setFlashData('success_message', 'Sucessfuly created a course');
        } else {
          $this->session->setFlashData('error_message', 'Something went wrong!');
        }
        return redirect()->to(base_url('admin/courses'));
      } else {
        $data['value'] = $_POST;
        $data['errors'] = $this->validation->getErrors();
      }
    }
    return view('template/index', $data);
  }

  public function edit($id){
    $data['edit'] = true;
    $data['view'] = 'Modules\MaintenanceManagement\Views\courses\form';
    $data['id'] = $id;
    $data['value'] = $this->coursesModel->get(['id' => $id])[0];
    if(empty($data['value'])){
      die('Some Error Code Here (No Record)');
    }
    if($this->request->getMethod() === 'post'){
      if($this->validate('courses')){
        if($this->coursesModel->edit($id, $_POST)){
          $this->session->setFlashData('success_message', 'Sucessfuly edited a course');
        } else {
          $this->session->setFlashData('error_message', 'Something went wrong!');
        }
        return redirect()->to(base_url('admin/courses'));
      } else {
        $data['value'] = $_POST;
        $data['errors'] = $this->validation->getErrors();
      }
    }
    return view('template/index', $data);
  }

  public function delete($id){
    $courseModel = new CoursesModel;

    if($courseModel->inactive($id)) {
      $this->session->setFlashData('success_message', 'Successfully deleted course');
    } else {
      $this->session->setFlashData('error_message', 'Something went wrong!');
    }
    return redirect()->to(base_url('admin/courses'));
  }

  public function active($id){
    $courseModel = new CoursesModel;

    if($courseModel->active($id)) {
      $this->session->setFlashData('success_message', 'Successfully restored course');
    } else {
      $this->session->setFlashData('error_message', 'Something went wrong!');
    }
    return redirect()->to(base_url('admin/courses'));
  }

  public function view($id){
    $data['view'] = 'Modules\MaintenanceManagement\Views\courses\view';
    $data['id'] = $id;
    $data['value'] = $this->coursesModel->get(['id' => $id])[0];
    return view('template/index', $data);

  }

}
