<?php namespace Modules\MaintenanceManagement\Controllers;

use App\Controllers\BaseController;
use Modules\MaintenanceManagement\Models as MaintenanceManagement;
use Modules\MaintenanceManagement\Models\HolidayModel;
use Modules\MaintenanceManagement\Models\ActivityLogsModel;

class Holiday extends BaseController {

  function __construct(){
    $this->activityLogsModel = new ActivityLogsModel;
  }

  public function index(){
    $holidayModel = new HolidayModel;

    $data['holidays'] =  $holidayModel->getActiveHolidays();
    $data['view'] = 'Modules\MaintenanceManagement\Views\holiday\index';
    return view('template/index', $data);
  }

  public function add(){
    $holidayModel = new HolidayModel;

    $data['edit'] = false;
    $data['view'] = 'Modules\MaintenanceManagement\Views\holiday\form';
    if($this->request->getMethod() === 'post'){
      if($this->validate('holiday')){
        if($holidayModel->add($_POST)){
          $this->activityLogsModel->addLogs($_SESSION['uid'], 'Add Holiday', 'admin/holiday', json_encode($_POST));
          $this->session->setFlashData('success_message', 'Sucessfuly created a school year');
        } else {
          $this->session->setFlashData('error_message', 'Something went wrong!');
        }
        return redirect()->to(base_url('admin/holiday'));
      } else {
        $data['value'] = $_POST;
        $data['errors'] = $this->validation->getErrors();
      }
    }
    return view('template/index', $data);
  }

  public function edit($id){
    $holidayModel = new HolidayModel;

    $data['edit'] = true;
    $data['view'] = 'Modules\MaintenanceManagement\Views\holiday\form';
    $data['id'] = $id;
    $data['value'] =  $holidayModel->get(['id' => $id])[0];
    if(empty($data['value'])){
      die('Some Error Code Here (No Record)');
    }
    if($this->request->getMethod() === 'post'){
      if($this->validate('holiday')){
        if($holidayModel->edit($id, $_POST)){
          $this->activityLogsModel->addLogs($_SESSION['uid'], 'Edit Holiday', 'admin/holiday', $id);
          $this->session->setFlashData('success_message', 'Sucessfuly edited a school year');
        } else {
          $this->session->setFlashData('error_message', 'Something went wrong!');
        }
        return redirect()->to(base_url('admin/holiday'));
      } else {
        $data['value'] = $_POST;
        $data['errors'] = $this->validation->getErrors();
      }
    }
    return view('template/index', $data);
  }

  public function view($id){
    $holidayModel = new HolidayModel;
    $data['view'] = 'Modules\MaintenanceManagement\Views\holiday\view';
    $data['id'] = $id;
    $data['value'] =  $holidayModel->get(['id' => $id])[0];
    return view('template/index', $data);
  }

  public function delete($id){
    $holidayModel = new HolidayModel;
    if($holidayModel->inactive($id)) {
      $this->activityLogsModel->addLogs($_SESSION['uid'], 'Archived Holiday', 'admin/holiday', $id);
      $this->session->setFlashData('success_message', 'Successfully deleted school year');
    } else {
      $this->session->setFlashData('error_message', 'Something went wrong!');
    }
    return redirect()->to(base_url('admin/holiday'));
  }

  public function active($id){
    $holidayModel = new HolidayModel;
    if($holidayModel->active($id)) {
      $this->activityLogsModel->addLogs($_SESSION['uid'], 'Restore Holiday', 'admin/holiday', $id);
      $this->session->setFlashData('success_message', 'Successfully restored school year');
    } else {
      $this->session->setFlashData('error_message', 'Something went wrong!');
    }
    return redirect()->to(base_url('admin/holiday'));
  }


}
