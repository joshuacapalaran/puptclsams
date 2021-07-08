<?php namespace Modules\MaintenanceManagement\Controllers;

use App\Controllers\BaseController;
use Modules\MaintenanceManagement\Models as MaintenanceManagement;
use Modules\MaintenanceManagement\Models\SubjectsModel;
use Modules\MaintenanceManagement\Models\ActivityLogsModel;

class Subjects extends BaseController {

  function __construct(){
    $this->subjectsModel = new MaintenanceManagement\subjectsModel();
    $this->activityLogsModel = new ActivityLogsModel;
  }

  public function index(){
    $data['subjects'] = $this->subjectsModel->get();
    $data['view'] = 'Modules\MaintenanceManagement\Views\subjects\index';
    return view('template/index', $data);
  }

  public function add(){
    $subjectsModel = new SubjectsModel;

    $data['edit'] = false;
    $data['view'] = 'Modules\MaintenanceManagement\Views\subjects\form';
    if($this->request->getMethod() === 'post'){
      if($this->validate('subjects')){
        if($subjectsModel->add($_POST)){
          $this->activityLogsModel->addLogs($_SESSION['uid'], 'Add Subject', 'admin/subjects', json_encode($_POST));
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
          $this->activityLogsModel->addLogs($_SESSION['uid'], 'Edit Subject', 'admin/subjects', $id);
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
    $subjectsModel = new SubjectsModel;
    if($subjectsModel->inactive($id)) {
      $this->activityLogsModel->addLogs($_SESSION['uid'], 'Archive Subject', 'admin/subjects', $id);
      $this->session->setFlashData('success_message', 'Successfully deleted subject');
    } else {
      $this->session->setFlashData('error_message', 'Something went wrong!');
    }
    return redirect()->to(base_url('admin/subjects'));
  }
  public function active($id){
    $subjectsModel = new SubjectsModel;
    if($subjectsModel->active($id)) {
      $this->activityLogsModel->addLogs($_SESSION['uid'], 'Restore Subject', 'admin/subjects', $id);
      $this->session->setFlashData('success_message', 'Successfully restored subject');
    } else {
      $this->session->setFlashData('error_message', 'Something went wrong!');
    }
    return redirect()->to(base_url('admin/subjects'));
  }

  public function view($id){
    $data['view'] = 'Modules\MaintenanceManagement\Views\subjects\view';
    $data['id'] = $id;
    $data['value'] = $this->subjectsModel->get(['id' => $id])[0];
    return view('template/index', $data);

  }

}
