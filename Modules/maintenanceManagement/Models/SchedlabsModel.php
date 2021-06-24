<?php namespace Modules\MaintenanceManagement\Models;

use App\Models\BaseModel;

class SchedlabsModel extends BaseModel {

  protected $table = 'schedlabs';

  protected $allowedFields = ['event_name', 'category_id', 'date', 'start_time', 'end_time', 'lab_id', 'assigned_person', 'num_people', 'deleted_at'];


  public function getLabSchedules(){
    $this->select('sched.*, category.*, labs.*, sched.id as id');
    $this->distinct('sched');
    $this->from('schedlabs sched');
    $this->join('categories category', 'category.id = sched.category_id','inner');
    $this->join('labs','sched.lab_id = labs.id','inner');
    $this->where('sched.deleted_at', null);
    return $this->findAll();
  }
}
