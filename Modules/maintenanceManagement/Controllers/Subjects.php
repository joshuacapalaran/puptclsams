<?php namespace Modules\MaintenanceManagement\Controllers;

use App\Controllers\BaseController;
use Modules\MaintenanceManagement\Models as MaintenanceManagement;

class Subjects extends BaseController {

  function __construct(){
    $this->subjectsModel = new MaintenanceManagement\subjectsModel();
  }

  public function index(){
    $data['subjects'] = $this->subjectsModel->get();
    $data['view'] = 'Modules\MaintenanceManagement\Views\subjects\index';
    return view('template/index', $data);
  }

  public function add(){
    $data['edit'] = false;
    $data['view'] = 'Modules\MaintenanceManagement\Views\subjects\form';
    if($this->request->getMethod() === 'post'){
      if($this->validate('subjects')){
        if($this->subjectsModel->add($_POST)){
          $this->session->setFlashData('success_message', 'Sucessfuly created a subject');
        } else {
          $this->session->setFlashData('error_message', 'Something went wrong!');
        }
        return redirect()->to(base_url('admin/subjects'));
      } else {
        $data['value'] = $_POST;
        $data['errors'] = $this->validation->getErrors();
      }
    }
    return view('template/index', $data);
  }

  public function edit($id){
    $data['edit'] = true;
    $data['view'] = 'Modules\MaintenanceManagement\Views\subjects\form';
    $data['id'] = $id;
    $data['value'] = $this->subjectsModel->get(['id' => $id])[0];
    if(empty($data['value'])){
      die('Some Error Code Here (No Record)');
    }
    if($this->request->getMethod() === 'post'){
      if($this->validate('subjects')){
        if($this->subjectsModel->edit($id, $_POST)){
          $this->session->setFlashData('success_message', 'Sucessfuly edited a subject');
        } else {
          $this->session->setFlashData('error_message', 'Something went wrong!');
        }
        return redirect()->to(base_url('admin/subjects'));
      } else {
        $data['value'] = $_POST;
        $data['errors'] = $this->validation->getErrors();
      }
    }
    return view('template/index', $data);
  }

  public function delete($id){
    if($this->subjectsModel->softDelete($id)) {
      $this->session->setFlashData('success_message', 'Successfully deleted subject');
    } else {
      $this->session->setFlashData('error_message', 'Something went wrong!');
    }
    return redirect()->to(base_url('admin/subjects'));
  }

  public function view($slug){

  }

}
