<?php namespace Modules\MaintenanceManagement\Models;

use App\Models\BaseModel;

class SchedlabsModel extends BaseModel {

  protected $table = 'schedlabs';

  protected $allowedFields = ['event_name', 'category_id', 'date', 'start_time', 'end_time', 'lab_id', 'assigned_person', 'num_people', 'deleted_at'];

}
