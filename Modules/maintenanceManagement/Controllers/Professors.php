<?php namespace Modules\MaintenanceManagement\Controllers;

use App\Controllers\BaseController;
use Modules\MaintenanceManagement\Models as MaintenanceManagement;
use Modules\MaintenanceManagement\Models\professorsModel;

class Professors extends BaseController {

  function __construct(){
    $this->professorsModel = new MaintenanceManagement\professorsModel();
    $this->suffixesModel = new MaintenanceManagement\suffixesModel();
  }

  public function index(){
    $data['professors'] = $this->professorsModel->getEventsFK()->getResultArray();
    $data['view'] = 'Modules\MaintenanceManagement\Views\professors\index';
    return view('template/index', $data);
  }

  public function add(){
    $professorsModel = new professorsModel;
    $data['edit'] = false;
    $data['view'] = 'Modules\MaintenanceManagement\Views\professors\form';
    $data['suffixes'] = $this->suffixesModel->get();
    if($this->request->getMethod() === 'post'){
      if($this->validate('professors')){
        if($professorsModel->add($_POST)){
          $this->session->setFlashData('success_message', 'Sucessfuly created a professor');
        } else {
          $this->session->setFlashData('error_message', 'Something went wrong!');
        }
        return redirect()->to(base_url('admin/professors'));
      } else {
        $data['value'] = $_POST;
        $data['errors'] = $this->validation->getErrors();
      }
    }
    return view('template/index', $data);
  }

  public function edit($id){
    $data['edit'] = true;
    $data['view'] = 'Modules\MaintenanceManagement\Views\professors\form';
    $data['id'] = $id;
    $data['value'] = $this->professorsModel->get(['id' => $id])[0];
    $data['suffixes'] = $this->suffixesModel->get();
    if(empty($data['value'])){
      die('Some Error Code Here (No Record)');
    }
    if($this->request->getMethod() === 'post'){
      if($this->validate('professors')){
        if($this->professorsModel->edit($id, $_POST)){
          $this->session->setFlashData('success_message', 'Sucessfuly edited a professor');
        } else {
          $this->session->setFlashData('error_message', 'Something went wrong!');
        }
        return redirect()->to(base_url('admin/professors'));
      } else {
        $data['value'] = $_POST;
        $data['errors'] = $this->validation->getErrors();
      }
    }
    return view('template/index', $data);
  }

  public function delete($id){
    $professorsModel = new professorsModel;

    if($professorsModel->inactive($id)) {
      $this->session->setFlashData('success_message', 'Successfully deleted professor');
    } else {
      $this->session->setFlashData('error_message', 'Something went wrong!');
    }
    return redirect()->to(base_url('admin/professors'));
  }

  public function active($id){
    $professorsModel = new professorsModel;

    if($professorsModel->active($id)) {
      $this->session->setFlashData('success_message', 'Successfully deleted professor');
    } else {
      $this->session->setFlashData('error_message', 'Something went wrong!');
    }
    return redirect()->to(base_url('admin/professors'));
  }

  

  public function view($id){
    $data['view'] = 'Modules\MaintenanceManagement\Views\professors\view';
    $data['id'] = $id;
    $data['value'] = $this->professorsModel->get(['id' => $id])[0];
    $data['suffixes'] = $this->suffixesModel->get();
    return view('template/index', $data);

  }

}
