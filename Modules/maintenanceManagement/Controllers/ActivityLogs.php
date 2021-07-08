<?php namespace Modules\MaintenanceManagement\Controllers;

use App\Controllers\BaseController;
use Modules\MaintenanceManagement\Models as MaintenanceManagement;
use Modules\MaintenanceManagement\Models\ActivityLogsModel;

class ActivityLogs extends BaseController {

  function __construct(){
    $this->activityLogsModel = new ActivityLogsModel;
  }

  public function index(){
    $data['activityLogs'] = $this->activityLogsModel->getActivityLogs();
    $data['view'] = 'Modules\MaintenanceManagement\Views\activityLogs\index';
    return view('template/index', $data);
  }

}
