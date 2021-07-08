<?php namespace Modules\MaintenanceManagement\Controllers;

use App\Controllers\BaseController;
use Modules\MaintenanceManagement\Models as MaintenanceManagement;
use Modules\MaintenanceManagement\Models\semestersModel;
use Modules\MaintenanceManagement\Models\ActivityLogsModel;

class Semesters extends BaseController {

  function __construct(){
    $this->semestersModel = new MaintenanceManagement\semestersModel();
    $this->activityLogsModel = new ActivityLogsModel;
  }

  public function index(){
    $data['semesters'] = $this->semestersModel->get();
    $data['view'] = 'Modules\MaintenanceManagement\Views\semesters\index';
    return view('template/index', $data);
  }

  public function add(){
    $semestersModel = new semestersModel;
    $data['edit'] = false;
    $data['view'] = 'Modules\MaintenanceManagement\Views\semesters\form';
    if($this->request->getMethod() === 'post'){
      if($this->validate('semesters')){
        if($semestersModel->add($_POST)){
          $this->activityLogsModel->addLogs($_SESSION['uid'], 'Add School year', 'admin/semesters/add', json_encode($_POST));
          $this->session->setFlashData('success_message', 'Sucessfuly created a semester');
        } else {
          $this->session->setFlashData('error_message', 'Something went wrong!');
        }
        return redirect()->to(base_url('admin/semesters'));
      } else {
        $data['value'] = $_POST;
        $data['errors'] = $this->validation->getErrors();
      }
    }
    return view('template/index', $data);
  }

  public function edit($id){
    $data['edit'] = true;
    $data['view'] = 'Modules\MaintenanceManagement\Views\semesters\form';
    $data['id'] = $id;
    $data['value'] = $this->semestersModel->get(['id' => $id])[0];
    if(empty($data['value'])){
      die('Some Error Code Here (No Record)');
    }
    if($this->request->getMethod() === 'post'){
      if($this->validate('semesters')){
        if($this->semestersModel->edit($id, $_POST)){
          $this->activityLogsModel->addLogs($_SESSION['uid'], 'Edit School year', 'admin/semesters/edit', $id);
          $this->session->setFlashData('success_message', 'Sucessfuly edited a semester');
        } else {
          $this->session->setFlashData('error_message', 'Something went wrong!');
        }
        return redirect()->to(base_url('admin/semesters'));
      } else {
        $data['value'] = $_POST;
        $data['errors'] = $this->validation->getErrors();
      }
    }
    return view('template/index', $data);
  }

  public function delete($id){
    $semestersModel = new semestersModel;

    if($semestersModel->inactive($id)) {
          $this->activityLogsModel->addLogs($_SESSION['uid'], 'Archive School year', 'admin/semesters/delete', $id);
          $this->session->setFlashData('success_message', 'Successfully deleted semester');
    } else {
      $this->session->setFlashData('error_message', 'Something went wrong!');
    }
    return redirect()->to(base_url('admin/semesters'));
  }

  public function active($id){
    $semestersModel = new semestersModel;

    if($semestersModel->active($id)) {
      $this->activityLogsModel->addLogs($_SESSION['uid'], 'Restore School year', 'admin/semesters/active', $id);
      $this->session->setFlashData('success_message', 'Successfully restored semester');
    } else {
      $this->session->setFlashData('error_message', 'Something went wrong!');
    }
    return redirect()->to(base_url('admin/semesters'));
  }

  public function view($id){
    $data['view'] = 'Modules\MaintenanceManagement\Views\semesters\view';
    $data['id'] = $id;
    $data['value'] = $this->semestersModel->get(['id' => $id])[0];
    return view('template/index', $data);
  }

}
