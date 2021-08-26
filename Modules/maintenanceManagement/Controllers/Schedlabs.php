<?php namespace Modules\MaintenanceManagement\Controllers;

use App\Controllers\BaseController;
use Modules\MaintenanceManagement\Models as MaintenanceManagement;
use Modules\MaintenanceManagement\Models\SchedlabsModel;
use Modules\MaintenanceManagement\Models\LabsModel;
use Modules\MaintenanceManagement\Models\CategoriesModel;
use Modules\MaintenanceManagement\Models\ActivityLogsModel;
use Modules\MaintenanceManagement\Models\CapacitiesModel;
use Modules\MaintenanceManagement\Models\HolidayModel;

class Schedlabs extends BaseController {

  function __construct(){
    $this->schedlabsModel = new MaintenanceManagement\schedlabsModel();
    $this->activityLogsModel = new ActivityLogsModel;
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
    $capacitiesModel = new CapacitiesModel;
    $labs = new LabsModel;
    $holidayModel = new HolidayModel;
  
    $holidays = $holidayModel->getCancelDates();

    $holi = [];

    
    foreach($holidays as $holiday){
      if($holiday['status'] == 'c'){
        $holi[] = date('m/d/Y',strtotime($holiday['date']));
      }else{
        $holi[] = date('m/d/Y',strtotime(date('Y').'-'.$holiday['date']));
        
      }
    }

    $data['categories'] = $categories->getActiveCategories();
    $data['labs'] = $labs->getLabsByActive();
    $data['capacities'] = $capacitiesModel->getAllCapacity();
    $data['edit'] = false;
    $data['view'] = 'Modules\MaintenanceManagement\Views\schedlabs\form';
    if($this->request->getMethod() === 'post'){
      if($this->validate('schedlabs')){
        if(in_array($_POST['date'], $holi )){
          $this->session->setFlashData('error', 'You cant add schedule on holiday dates');
          $data['value'] = $_POST;
          // return redirect()->to(base_url('admin/schedlabs/add'));
        }else{
            foreach($_POST['date'] as $key => $date){
              $_POST['date'] = $date;
              $_POST['start_time'] = $_POST['start_time'][$key];
              $_POST['end_time'] = $_POST['end_time'][$key];
              $schedlabsModel->add($_POST);

            }
            $this->activityLogsModel->addLogs($_SESSION['uid'], 'Add Sched lab', 'admin/schedlabs', json_encode($_POST));
            $this->session->setFlashData('success', 'Sucessfuly created a schedlab');
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
    $holidayModel = new HolidayModel;

    
    $holidays = $holidayModel->getCancelDates();

    $holi = [];

    
    foreach($holidays as $holiday){
      if($holiday['status'] == 'c'){
        $holi[] = date('Y-m-d',strtotime($holiday['date']));
      }else{
        $holi[] = date('Y-m-d',strtotime(date('Y').'-'.$holiday['date']));
        
      }
    }
    $data['edit'] = true;
    $data['view'] = 'Modules\MaintenanceManagement\Views\schedlabs\form';
    $data['id'] = $id;
    $data['value'] = $this->schedlabsModel->get(['id' => $id])[0];
    if(empty($data['value'])){
      die('Some Error Code Here (No Record)');
    }
    if($this->request->getMethod() === 'post'){
      if($this->validate('schedlabs')){
        if(in_array($_POST['date'], $holi )){
          $this->session->setFlashData('error', 'You cant add schedule on holiday dates');
          $data['value'] = $_POST;
          // return redirect()->to(base_url('admin/schedlabs/add'));
        }else{
          if($_POST['date']){
            $_POST['date'] = $_POST['date'][0];
            $_POST['start_time'] = $_POST['start_time'][0];
            $_POST['end_time'] = $_POST['end_time'][0];
          }
          if($this->schedlabsModel->edit($id, $_POST)){
            $this->activityLogsModel->addLogs($_SESSION['uid'], 'Edit Sched lab', 'admin/schedlabs', $id);
            $this->session->setFlashData('success_message', 'Sucessfuly edited a schedsubject');
          } else {
            $this->session->setFlashData('error_message', 'Something went wrong!');
          }
          return redirect()->to(base_url('admin/schedlabs'));
        }
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
      $this->activityLogsModel->addLogs($_SESSION['uid'], 'Archive Sched lab', 'admin/schedlabs', $id);
      $this->session->setFlashData('success_message', 'Successfully deleted schedsubject');
    } else {
      $this->session->setFlashData('error_message', 'Something went wrong!');
    }
    return redirect()->to(base_url('admin/schedlabs'));
  }

  public function active($id){
    $schedlabsModel = new SchedlabsModel;

    if($schedlabsModel->active($id)) {
      $this->activityLogsModel->addLogs($_SESSION['uid'], 'Restore Sched lab', 'admin/schedlabs', $id);
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
