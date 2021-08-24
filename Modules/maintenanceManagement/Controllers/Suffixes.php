<?php namespace Modules\MaintenanceManagement\Controllers;

use App\Controllers\BaseController;
use Modules\MaintenanceManagement\Models as MaintenanceManagement;
use Modules\MaintenanceManagement\Models\suffixesModel;
use Modules\MaintenanceManagement\Models\ActivityLogsModel;

class Suffixes extends BaseController {

  function __construct(){
    $this->suffixesModel = new MaintenanceManagement\suffixesModel();
    $this->activityLogsModel = new ActivityLogsModel;
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
          $this->activityLogsModel->addLogs($_SESSION['uid'], 'Add suffix', 'admin/suffixes', json_encode($_POST));
          $this->session->setFlashData('success', 'Sucessfuly created a suffix');
        } else {
          $this->session->setFlashData('error', 'Something went wrong!');
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
          $this->activityLogsModel->addLogs($_SESSION['uid'], 'Edit suffix', 'admin/suffixes', $id);
          $this->session->setFlashData('success', 'Sucessfuly edited a suffix');
        } else {
          $this->session->setFlashData('error', 'Something went wrong!');
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
      $this->activityLogsModel->addLogs($_SESSION['uid'], 'Archive suffix', 'admin/suffixes', $id);
      $this->session->setFlashData('success', 'Successfully deleted suffix');
    } else {
      $this->session->setFlashData('error', 'Something went wrong!');
    }
    return redirect()->to(base_url('admin/suffixes'));
  }

  public function active($id){
    $suffixesModel = new suffixesModel;
    if($suffixesModel->active($id)) {
      $this->activityLogsModel->addLogs($_SESSION['uid'], 'Restore suffix', 'admin/suffixes', $id);
      $this->session->setFlashData('success', 'Successfully restored suffix');
    } else {
      $this->session->setFlashData('error', 'Something went wrong!');
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
