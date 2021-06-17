<?php namespace Modules\MaintenanceManagement\Controllers;

use App\Controllers\BaseController;
use Modules\MaintenanceManagement\Models as MaintenanceManagement;

class Students extends BaseController {

  function __construct(){
    $this->studentsModel = new MaintenanceManagement\studentsModel();
  }

  public function index(){
    $data['students'] = $this->studentsModel->get();
    $data['view'] = 'Modules\MaintenanceManagement\Views\students\index';
    return view('template/index', $data);
  }

  public function add(){
    $data['edit'] = false;
    $data['view'] = 'Modules\MaintenanceManagement\Views\students\form';
    if($this->request->getMethod() === 'post'){
      if($this->validate('students')){
        if($this->studentsModel->add($_POST)){
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
    $data['value'] = $this->studentsModel->get(['id' => $id])[0];
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

  public function delete($id){
    if($this->studentsModel->softDelete($id)) {
      $this->session->setFlashData('success_message', 'Successfully deleted student');
    } else {
      $this->session->setFlashData('error_message', 'Something went wrong!');
    }
    return redirect()->to(base_url('admin/students'));
  }

  public function view($slug){

  }

}
