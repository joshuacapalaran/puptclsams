<?php namespace Modules\MaintenanceManagement\Controllers;

use App\Controllers\BaseController;
use Modules\MaintenanceManagement\Models as MaintenanceManagement;
use Modules\MaintenanceManagement\Models\suffixesModel;

class Suffixes extends BaseController {

  function __construct(){
    $this->suffixesModel = new MaintenanceManagement\suffixesModel();
  }

  public function index(){
    $data['suffixes'] = $this->suffixesModel->get();
    $data['view'] = 'Modules\MaintenanceManagement\Views\suffixes\index';
    return view('template/index', $data);
  }

  public function add(){
    $suffixesModel = new suffixesModel;
    $data['edit'] = false;
    $data['view'] = 'Modules\MaintenanceManagement\Views\suffixes\form';
    if($this->request->getMethod() === 'post'){
      if($this->validate('suffixes')){
        if($suffixesModel->add($_POST)){
          $this->session->setFlashData('success_message', 'Sucessfuly created a suffix');
        } else {
          $this->session->setFlashData('error_message', 'Something went wrong!');
        }
        return redirect()->to(base_url('admin/suffixes'));
      } else {
        $data['value'] = $_POST;
        $data['errors'] = $this->validation->getErrors();
      }
    }
    return view('template/index', $data);
  }

  public function edit($id){
    $data['edit'] = true;
    $data['view'] = 'Modules\MaintenanceManagement\Views\suffixes\form';
    $data['id'] = $id;
    $data['value'] = $this->suffixesModel->get(['id' => $id])[0];
    if(empty($data['value'])){
      die('Some Error Code Here (No Record)');
    }
    if($this->request->getMethod() === 'post'){
      if($this->validate('suffixes')){
        if($this->suffixesModel->edit($id, $_POST)){
          $this->session->setFlashData('success_message', 'Sucessfuly edited a suffix');
        } else {
          $this->session->setFlashData('error_message', 'Something went wrong!');
        }
        return redirect()->to(base_url('admin/suffixes'));
      } else {
        $data['value'] = $_POST;
        $data['errors'] = $this->validation->getErrors();
      }
    }
    return view('template/index', $data);
  }

  public function delete($id){
    $suffixesModel = new suffixesModel;
    if($suffixesModel->inactive($id)) {
      $this->session->setFlashData('success_message', 'Successfully deleted suffix');
    } else {
      $this->session->setFlashData('error_message', 'Something went wrong!');
    }
    return redirect()->to(base_url('admin/suffixes'));
  }

  public function active($id){
    $suffixesModel = new suffixesModel;
    if($suffixesModel->active($id)) {
      $this->session->setFlashData('success_message', 'Successfully restored suffix');
    } else {
      $this->session->setFlashData('error_message', 'Something went wrong!');
    }
    return redirect()->to(base_url('admin/suffixes'));
  }

  public function view($id){
    $data['view'] = 'Modules\MaintenanceManagement\Views\suffixes\view';
    $data['id'] = $id;
    $data['value'] = $this->suffixesModel->get(['id' => $id])[0];
    return view('template/index', $data);

  }

}
