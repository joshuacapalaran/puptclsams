<?php namespace Modules\ProgramManagement\Controllers;

use App\Controllers\BaseController;
use Modules\ProgramManagement\Models as ProgramManagement;

class ProgramTypes extends BaseController {

  function __construct(){
    $this->programtypesModel = new ProgramManagement\programtypesModel();
  }

  public function index(){
    $data['programtypes'] = $this->programtypesModel->get();
    $data['view'] = 'Modules\ProgramManagement\Views\programtypes\index';
    return view('template/index', $data);
  }

  public function add(){
    $data['edit'] = false;
    $data['view'] = 'Modules\ProgramManagement\Views\programtypes\form';
    if($this->request->getMethod() === 'post'){
      if($this->validate('programtypes')){
        if($this->programtypesModel->add($_POST)){
          $this->session->setFlashData('success_message', 'Sucessfuly created a Program Type');
        } else {
          $this->session->setFlashData('error_message', 'Something went wrong!');
        }
        return redirect()->to(base_url('admin/programtypes'));
      } else {
        $data['value'] = $_POST;
        $data['errors'] = $this->validation->getErrors();
      }
    }
    return view('template/index', $data);
  }

  public function edit($id){
    $data['edit'] = true;
    $data['view'] = 'Modules\ProgramManagement\Views\programtypes\form';
    $data['id'] = $id;
    $data['value'] = $this->programtypesModel->get(['id' => $id])[0];
    if(empty($data['value'])){
      die('Some Error Code Here (No Record)');
    }
    if($this->request->getMethod() === 'post'){
      if($this->validate('programtypes')){
        if($this->programtypesModel->edit($id, $_POST)){
          $this->session->setFlashData('success_message', 'Sucessfuly edited a Program Type');
        } else {
          $this->session->setFlashData('error_message', 'Something went wrong!');
        }
        return redirect()->to(base_url('admin/programtypes'));
      } else {
        $data['value'] = $_POST;
        $data['errors'] = $this->validation->getErrors();
      }
    }
    return view('template/index', $data);
  }

  public function delete($id){
    if($this->programtypesModel->softDelete($id)) {
      $this->session->setFlashData('success_message', 'Successfully deleted Program');
    } else {
      $this->session->setFlashData('error_message', 'Something went wrong!');
    }
    return redirect()->to(base_url('admin/programtypes'));
  }

  public function view($slug){

  }

}