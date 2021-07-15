<?php namespace Modules\MaintenanceManagement\Models;

use App\Models\BaseModel;

class SchedlabsModel extends BaseModel {

  protected $table = 'schedlabs';

  protected $allowedFields = ['event_name', 'category_id', 'date', 'start_time', 'end_time', 'lab_id', 'assigned_person', 'num_people', 'status','created_at','updated_at','deleted_at'];


  public function getLabSchedules(){
    $this->select('sched.*, category.*, labs.*, sched.id as id, sched.status as status');
    $this->distinct('sched');
    $this->from('schedlabs sched');
    $this->join('categories category', 'category.id = sched.category_id','inner');
    $this->join('labs','sched.lab_id = labs.id','inner');
    return $this->findAll();
  }

  public function getCalendarLabSchedules(){
    $this->select('sched.*, category.*, labs.*, sched.id as id, sched.status as status');
    $this->distinct('sched');
    $this->from('schedlabs sched');
    $this->join('categories category', 'category.id = sched.category_id','inner');
    $this->join('labs','sched.lab_id = labs.id','inner');
    $this->where('sched.status', 'a');
    return $this->findAll();
  }

  public function getEventByCurrentDate(){
    date_default_timezone_set('Asia/Singapore');
    $this->select('sched.*, category.*, labs.*, sched.id as id, sched.status as status');
    $this->distinct('sched');
    $this->from('schedlabs sched');
    $this->join('categories category', 'category.id = sched.category_id','inner');
    $this->join('labs','sched.lab_id = labs.id','inner');
    $this->where('sched.date', date('Y-m-d'));
    return $this->findAll();
  }

  public function add($val_array){
    $val_array['status'] = 'a';
    return $this->save($val_array);
  }
  
  public function inactive($id){
    $data['status'] = 'd';
    return $this->update($id, $data);
  }
  
  public function active($id){
    $data['status'] = 'a';
    return $this->update($id, $data);
  }
}
