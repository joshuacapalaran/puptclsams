<?php namespace Modules\MaintenanceManagement\Controllers;

use App\Controllers\BaseController;
use Modules\MaintenanceManagement\Models as MaintenanceManagement;

class Capacities extends BaseController {

  function __construct(){
    $this->capacitiesModel = new MaintenanceManagement\capacitiesModel();
    $this->labsModel = new MaintenanceManagement\labsModel();
  }

  public function index(){
    $data['capacities'] = $this->capacitiesModel->getEventsFK()->getResultArray();
    $data['view'] = 'Modules\MaintenanceManagement\Views\capacities\index';
    return view('template/index', $data);
  }

  public function add(){
    $data['edit'] = false;
    $data['view'] = 'Modules\MaintenanceManagement\Views\capacities\form';
    $data['labs'] = $this->labsModel->get();
    if($this->request->getMethod() === 'post'){
      if($this->validate('capacities')){
        if($this->capacitiesModel->add($_POST)){
          $this->session->setFlashData('success_message', 'Sucessfuly created a capacity');
        } else {
          $this->session->setFlashData('error_message', 'Something went wrong!');
        }
        return redirect()->to(base_url('admin/capacities'));
      } else {
        $data['value'] = $_POST;
        $data['errors'] = $this->validation->getErrors();
      }
    }
    return view('template/index', $data);
  }

  public function edit($id){
    $data['edit'] = true;
    $data['view'] = 'Modules\MaintenanceManagement\Views\capacities\form';
    $data['id'] = $id;
    $data['value'] = $this->capacitiesModel->get(['id' => $id])[0];
      $data['labs'] = $this->labsModel->get();
    if(empty($data['value'])){
      die('Some Error Code Here (No Record)');
    }
    if($this->request->getMethod() === 'post'){
      if($this->validate('capacities')){
        if($this->capacitiesModel->edit($id, $_POST)){
          $this->session->setFlashData('success_message', 'Sucessfuly edited a capacity');
        } else {
          $this->session->setFlashData('error_message', 'Something went wrong!');
        }
        return redirect()->to(base_url('admin/capacities'));
      } else {
        $data['value'] = $_POST;
        $data['errors'] = $this->validation->getErrors();
      }
    }
    return view('template/index', $data);
  }

  public function delete($id){
    if($this->capacitiesModel->softDelete($id)) {
      $this->session->setFlashData('success_message', 'Successfully deleted capacity');
    } else {
      $this->session->setFlashData('error_message', 'Something went wrong!');
    }
    return redirect()->to(base_url('admin/capacities'));
  }

  public function view($slug){

  }

}
