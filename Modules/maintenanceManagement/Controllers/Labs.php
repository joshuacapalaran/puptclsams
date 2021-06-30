<?php namespace Modules\MaintenanceManagement\Controllers;

use App\Controllers\BaseController;
use Modules\MaintenanceManagement\Models as MaintenanceManagement;
use Modules\MaintenanceManagement\Models\LabsModel;

class Labs extends BaseController {

  function __construct(){
    $this->labsModel = new MaintenanceManagement\labsModel();
  }

  public function index(){
    $data['labs'] = $this->labsModel->get();
    $data['view'] = 'Modules\MaintenanceManagement\Views\labs\index';
    return view('template/index', $data);
  }

  public function add(){
    $labsModel = new LabsModel;
    $data['edit'] = false;
    $data['view'] = 'Modules\MaintenanceManagement\Views\labs\form';
    if($this->request->getMethod() === 'post'){
      if($this->validate('labs')){
        if($labsModel->add($_POST)){
          $this->session->setFlashData('success_message', 'Sucessfuly created a lab');
        } else {
          $this->session->setFlashData('error_message', 'Something went wrong!');
        }
        return redirect()->to(base_url('admin/labs'));
      } else {
        $data['value'] = $_POST;
        $data['errors'] = $this->validation->getErrors();
      }
    }
    return view('template/index', $data);
  }

  public function edit($id){
    $data['edit'] = true;
    $data['view'] = 'Modules\MaintenanceManagement\Views\labs\form';
    $data['id'] = $id;
    $data['value'] = $this->labsModel->get(['id' => $id])[0];
    if(empty($data['value'])){
      die('Some Error Code Here (No Record)');
    }
    if($this->request->getMethod() === 'post'){
      if($this->validate('labs')){
        if($this->labsModel->edit($id, $_POST)){
          $this->session->setFlashData('success_message', 'Sucessfuly edited a lab');
        } else {
          $this->session->setFlashData('error_message', 'Something went wrong!');
        }
        return redirect()->to(base_url('admin/labs'));
      } else {
        $data['value'] = $_POST;
        $data['errors'] = $this->validation->getErrors();
      }
    }
    return view('template/index', $data);
  }

  public function delete($id){
    $labsModel = new LabsModel;

    if($labsModel->inactive($id)) {
      $this->session->setFlashData('success_message', 'Successfully deleted lab');
    } else {
      $this->session->setFlashData('error_message', 'Something went wrong!');
    }
    return redirect()->to(base_url('admin/labs'));
  }

  public function active($id){
    $labsModel = new LabsModel;

    if($labsModel->active($id)) {
      $this->session->setFlashData('success_message', 'Successfully restored lab');
    } else {
      $this->session->setFlashData('error_message', 'Something went wrong!');
    }
    return redirect()->to(base_url('admin/labs'));
  }

  public function view($id){
    $data['view'] = 'Modules\MaintenanceManagement\Views\labs\view';
    $data['id'] = $id;
    $data['value'] = $this->labsModel->get(['id' => $id])[0];
    return view('template/index', $data);
  }
}
