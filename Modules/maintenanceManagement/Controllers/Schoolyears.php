<?php namespace Modules\MaintenanceManagement\Controllers;

use App\Controllers\BaseController;
use Modules\MaintenanceManagement\Models as MaintenanceManagement;

class Schoolyears extends BaseController {

  function __construct(){
    $this->schoolyearsModel = new MaintenanceManagement\schoolyearsModel();
  }

  public function index(){
    $data['schoolyears'] = $this->schoolyearsModel->get();
    $data['view'] = 'Modules\MaintenanceManagement\Views\schoolyears\index';
    return view('template/index', $data);
  }

  public function add(){
    $data['edit'] = false;
    $data['view'] = 'Modules\MaintenanceManagement\Views\schoolyears\form';
    if($this->request->getMethod() === 'post'){
      if($this->validate('schoolyears')){
        if($this->schoolyearsModel->add($_POST)){
          $this->session->setFlashData('success_message', 'Sucessfuly created a school year');
        } else {
          $this->session->setFlashData('error_message', 'Something went wrong!');
        }
        return redirect()->to(base_url('admin/schoolyears'));
      } else {
        $data['value'] = $_POST;
        $data['errors'] = $this->validation->getErrors();
      }
    }
    return view('template/index', $data);
  }

  public function edit($id){
    $data['edit'] = true;
    $data['view'] = 'Modules\MaintenanceManagement\Views\schoolyears\form';
    $data['id'] = $id;
    $data['value'] = $this->schoolyearsModel->get(['id' => $id])[0];
    if(empty($data['value'])){
      die('Some Error Code Here (No Record)');
    }
    if($this->request->getMethod() === 'post'){
      if($this->validate('schoolyears')){
        if($this->schoolyearsModel->edit($id, $_POST)){
          $this->session->setFlashData('success_message', 'Sucessfuly edited a school year');
        } else {
          $this->session->setFlashData('error_message', 'Something went wrong!');
        }
        return redirect()->to(base_url('admin/schoolyears'));
      } else {
        $data['value'] = $_POST;
        $data['errors'] = $this->validation->getErrors();
      }
    }
    return view('template/index', $data);
  }

  public function delete($id){
    if($this->schoolyearsModel->softDelete($id)) {
      $this->session->setFlashData('success_message', 'Successfully deleted school year');
    } else {
      $this->session->setFlashData('error_message', 'Something went wrong!');
    }
    return redirect()->to(base_url('admin/schoolyears'));
  }

  public function view($slug){

  }

}
