<?php namespace Modules\MaintenanceManagement\Controllers;

use App\Controllers\BaseController;
use Modules\MaintenanceManagement\Models as MaintenanceManagement;
use Modules\MaintenanceManagement\Models\SchedlabsModel;
use Modules\MaintenanceManagement\Models\LabsModel;
use Modules\MaintenanceManagement\Models\CategoriesModel;

class Schedlabs extends BaseController {

  function __construct(){
    $this->schedlabsModel = new MaintenanceManagement\schedlabsModel();
  }

  public function index(){
    $sched = new SchedlabsModel;
    $schedLabs = $sched->getLabSchedules();
    $data['schedlabs'] = $schedLabs;
    $data['view'] = 'Modules\MaintenanceManagement\Views\schedlabs\index';
    return view('template/index', $data);
  }

  public function add(){
    $sched = new SchedlabsModel;
    $categories = new CategoriesModel;
    $labs = new LabsModel;
    $data['categories'] = $categories->getCategories();
    $data['labs'] = $labs->getLabs();
    $data['edit'] = false;
    $data['view'] = 'Modules\MaintenanceManagement\Views\schedlabs\form';
    if($this->request->getMethod() === 'post'){
      if($this->validate('schedlabs')){
        if($this->schedlabsModel->add($_POST)){
          $this->session->setFlashData('success_message', 'Sucessfuly created a schedsubject');
        } else {
          $this->session->setFlashData('error_message', 'Something went wrong!');
        }
        return redirect()->to(base_url('admin/schedlabs'));
      } else {
        $data['value'] = $_POST;
        $data['errors'] = $this->validation->getErrors();
      }
    }
    return view('template/index', $data);
  }

  public function edit($id){

    $categories = new CategoriesModel;
    $labs = new LabsModel;
    $data['categories'] = $categories->getCategories();
    $data['labs'] = $labs->getLabs();

    $data['edit'] = true;
    $data['view'] = 'Modules\MaintenanceManagement\Views\schedlabs\form';
    $data['id'] = $id;
    $data['value'] = $this->schedlabsModel->get(['id' => $id])[0];
    if(empty($data['value'])){
      die('Some Error Code Here (No Record)');
    }
    if($this->request->getMethod() === 'post'){
      if($this->validate('schedlabs')){
        if($this->schedlabsModel->edit($id, $_POST)){
          $this->session->setFlashData('success_message', 'Sucessfuly edited a schedsubject');
        } else {
          $this->session->setFlashData('error_message', 'Something went wrong!');
        }
        return redirect()->to(base_url('admin/schedlabs'));
      } else {
        $data['value'] = $_POST;
        $data['errors'] = $this->validation->getErrors();
      }
    }
    return view('template/index', $data);
  }

  public function delete($id){
    if($this->schedlabsModel->softDelete($id)) {
      $this->session->setFlashData('success_message', 'Successfully deleted schedsubject');
    } else {
      $this->session->setFlashData('error_message', 'Something went wrong!');
    }
    return redirect()->to(base_url('admin/schedlabs'));
  }

  public function view($slug){

  }

}
