<?php namespace Modules\MaintenanceManagement\Controllers;

use App\Controllers\BaseController;
use Modules\MaintenanceManagement\Models as MaintenanceManagement;

class Schedlabs extends BaseController {

  function __construct(){
    $this->schedlabsModel = new MaintenanceManagement\schedlabsModel();
  }

  public function index(){
    $data['schedlabs'] = $this->schedlabsModel->get();
    $data['view'] = 'Modules\MaintenanceManagement\Views\schedlabs\index';
    return view('template/index', $data);
  }

  public function add(){
    $data['edit'] = false;
    $data['view'] = 'Modules\MaintenanceManagement\Views\schedlabs\form';
    if($this->request->getMethod() === 'post'){
      if($this->validate('schedlabs')){
        if($this->schedlabsModel->add($_POST)){
          $this->session->setFlashData('success_message', 'Sucessfuly created a schedsubject');
        } else {
          $this->session->setFlashData('error_message', 'Something went wrong!');
        }
        return redirect()->to(base_url('admin/schedlabs'));
      } else {
        $data['value'] = $_POST;
        $data['errors'] = $this->validation->getErrors();
      }
    }
    return view('template/index', $data);
  }

  public function edit($id){
    $data['edit'] = true;
    $data['view'] = 'Modules\MaintenanceManagement\Views\schedlabs\form';
    $data['id'] = $id;
    $data['value'] = $this->schedlabsModel->get(['id' => $id])[0];
    if(empty($data['value'])){
      die('Some Error Code Here (No Record)');
    }
    if($this->request->getMethod() === 'post'){
      if($this->validate('schedlabs')){
        if($this->schedlabsModel->edit($id, $_POST)){
          $this->session->setFlashData('success_message', 'Sucessfuly edited a schedsubject');
        } else {
          $this->session->setFlashData('error_message', 'Something went wrong!');
        }
        return redirect()->to(base_url('admin/schedlabs'));
      } else {
        $data['value'] = $_POST;
        $data['errors'] = $this->validation->getErrors();
      }
    }
    return view('template/index', $data);
  }

  public function delete($id){
    if($this->schedlabsModel->softDelete($id)) {
      $this->session->setFlashData('success_message', 'Successfully deleted schedsubject');
    } else {
      $this->session->setFlashData('error_message', 'Something went wrong!');
    }
    return redirect()->to(base_url('admin/schedlabs'));
  }

  public function view($slug){

  }

}
