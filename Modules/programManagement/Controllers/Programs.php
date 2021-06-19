<?php namespace Modules\ProgramManagement\Controllers;

use App\Controllers\BaseController;
use Modules\ProgramManagement\Models as ProgramManagement;

class Programs extends BaseController {

  function __construct(){
    $this->programsModel = new ProgramManagement\programsModel();
    $this->programTypesModel = new ProgramManagement\programTypesModel();
  }

  public function index(){
    $data['programs'] = $this->programsModel->getEventsFK()->getResultArray();
    $data['view'] = 'Modules\ProgramManagement\Views\programs\index';
    return view('template/index', $data);
  }

  public function add(){
    $data['edit'] = false;
    $data['view'] = 'Modules\ProgramManagement\Views\programs\form';
    $data['programTypes'] = $this->programTypesModel->get();
    if($this->request->getMethod() === 'post'){
      if($this->validate('programs')){
        if($this->programsModel->add($_POST)){
          $this->session->setFlashData('success_message', 'Sucessfuly created a Program');
        } else {
          $this->session->setFlashData('error_message', 'Something went wrong!');
        }
        return redirect()->to(base_url('admin/programs'));
      } else {
        $data['value'] = $_POST;
        $data['errors'] = $this->validation->getErrors();
      }
    }
    return view('template/index', $data);
  }

  public function edit($id){
    $data['edit'] = true;
    $data['view'] = 'Modules\ProgramManagement\Views\programs\form';
    $data['id'] = $id;
    $data['value'] = $this->programsModel->get(['id' => $id])[0];
    $data['programTypes'] = $this->programTypesModel->get();
    if(empty($data['value'])){
      die('Some Error Code Here (No Record)');
    }
    if($this->request->getMethod() === 'post'){
      if($this->validate('programs')){
        if($this->programsModel->edit($id, $_POST)){
          $this->session->setFlashData('success_message', 'Sucessfuly edited a Program');
        } else {
          $this->session->setFlashData('error_message', 'Something went wrong!');
        }
        return redirect()->to(base_url('admin/programs'));
      } else {
        $data['value'] = $_POST;
        $data['errors'] = $this->validation->getErrors();
      }
    }
    return view('template/index', $data);
  }

  public function delete($id){
    if($this->programsModel->softDelete($id)) {
      $this->session->setFlashData('success_message', 'Successfully deleted Program');
    } else {
      $this->session->setFlashData('error_message', 'Something went wrong!');
    }
    return redirect()->to(base_url('admin/programs'));
  }

  public function view($slug){

  }

}