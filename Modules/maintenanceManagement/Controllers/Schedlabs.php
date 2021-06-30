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
    $schedlabsModel = new SchedlabsModel;
    $categories = new CategoriesModel;
    $labs = new LabsModel;
    $data['categories'] = $categories->getActiveCategories();
    $data['labs'] = $labs->getLabsByActive();
    $data['edit'] = false;
    $data['view'] = 'Modules\MaintenanceManagement\Views\schedlabs\form';
    if($this->request->getMethod() === 'post'){
      if($this->validate('schedlabs')){
        if($schedlabsModel->add($_POST)){
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
    $data['categories'] = $categories->getActiveCategories();
    $data['labs'] = $labs->getLabsByActive();

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
    $schedlabsModel = new SchedlabsModel;

    if($schedlabsModel->inactive($id)) {

      $this->session->setFlashData('success_message', 'Successfully deleted schedsubject');
    } else {
      $this->session->setFlashData('error_message', 'Something went wrong!');
    }
    return redirect()->to(base_url('admin/schedlabs'));
  }

  public function active($id){
    $schedlabsModel = new SchedlabsModel;

    if($schedlabsModel->active($id)) {
      $this->session->setFlashData('success_message', 'Successfully restored schedsubject');
    } else {
      $this->session->setFlashData('error_message', 'Something went wrong!');
    }
    return redirect()->to(base_url('admin/schedlabs'));
  }

  public function view($id){
    $categories = new CategoriesModel;
    $labs = new LabsModel;
    $data['categories'] = $categories->getCategories();
    $data['labs'] = $labs->getLabs();

    $data['edit'] = true;
    $data['view'] = 'Modules\MaintenanceManagement\Views\schedlabs\view';
    $data['id'] = $id;
    $data['value'] = $this->schedlabsModel->get(['id' => $id])[0];
    return view('template/index', $data);

  }

  public function get_events(){
    $schedlabsModel = new SchedlabsModel;
    $schedlabs = $schedlabsModel->getLabSchedules();

    $data = [];
    foreach($schedlabs as $schedlab){
       $data[] = [
         'title' => $schedlab['event_name'],
         'start' => $schedlab['date'].'T'.$schedlab['start_time'],
         'end' => 'T'.$schedlab['end_time']
       ];
     }
    echo json_encode($data);
  }
  
  public function getDayNumber($day){
      switch($day){
        case 'Sunday': return 0;
        break;
        case 'Monday': return 1;
        break;
        case 'Tuesday': return 2;
        break;
        case 'Wednesday': return 3;
        break;
        case 'Thursday': return 4;
        break;
        case 'Friday': return 5;
        break;
        case 'Saturday': return 6;
        break;
  
      }
      return false;
    }
  
}
