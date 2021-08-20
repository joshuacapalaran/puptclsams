<?php namespace Modules\MaintenanceManagement\Controllers;

use App\Controllers\BaseController;
use Modules\MaintenanceManagement\Models as MaintenanceManagement;
use Modules\MaintenanceManagement\Models\capacitiesModel;
use Modules\MaintenanceManagement\Models\ActivityLogsModel;
use Modules\MaintenanceManagement\Models\labsModel;

class Capacities extends BaseController {

  function __construct(){
    $this->capacitiesModel = new MaintenanceManagement\capacitiesModel();
    $this->labsModel = new MaintenanceManagement\labsModel();
    $this->activityLogsModel = new ActivityLogsModel;

  }

  public function index(){
    $data['capacities'] = $this->capacitiesModel->getEventsFK()->getResultArray();
    $data['view'] = 'Modules\MaintenanceManagement\Views\capacities\index';
    return view('template/index', $data);
  }

  public function add(){
    $capacitiesModel = new capacitiesModel;
    $labsModel = new labsModel;
    $data['edit'] = false;
    $data['view'] = 'Modules\MaintenanceManagement\Views\capacities\form';
    $data['labs'] = $labsModel->getLabsByActive();
    if($this->request->getMethod() === 'post'){
      if($this->validate('capacities')){
        if($capacitiesModel->add($_POST)){
          $this->activityLogsModel->addLogs($_SESSION['uid'], 'Add Capacity', 'admin/capacities/add', json_encode($_POST));
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
          $this->activityLogsModel->addLogs($_SESSION['uid'], 'Edit Capacity', 'admin/capacities/edit', $id);
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
    $capacitiesModel = new capacitiesModel;

    if($capacitiesModel->inactive($id)) {
      $this->activityLogsModel->addLogs($_SESSION['uid'], 'Archived Capacity', 'admin/capacities/delete', $id);
      $this->session->setFlashData('success_message', 'Successfully deleted capacity');
    } else {
      $this->session->setFlashData('error_message', 'Something went wrong!');
    }
    return redirect()->to(base_url('admin/capacities'));
  }
  public function active($id){
    $capacitiesModel = new capacitiesModel;

    if($capacitiesModel->active($id)) {
      $this->activityLogsModel->addLogs($_SESSION['uid'], 'Restore Capacity', 'admin/capacities/active', $id);
      $this->session->setFlashData('success_message', 'Successfully restored capacity');
    } else {
      $this->session->setFlashData('error_message', 'Something went wrong!');
    }
    return redirect()->to(base_url('admin/capacities'));
  }

  public function view($id){
    $data['view'] = 'Modules\MaintenanceManagement\Views\capacities\view';
    $data['id'] = $id;
    $data['value'] = $this->capacitiesModel->get(['id' => $id])[0];
    $data['labs'] = $this->labsModel->get();

    return view('template/index', $data);
  }

}
