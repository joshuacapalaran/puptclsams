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
    // $this->Where('sched.end_time >=', date('H:i:s','16:30:00'));
    // $this->where('sched.start_time >=', date('H:i:s','13:30:00'));
    $this->where('sched.date', date('Y-m-d'));

    return $this->findAll();
  }

  public function checkEvent($course_id, $section_id,$current_day,$current_time){
    $this->where('course_id', $course_id);
    $this->where('section_id', $section_id);
    // $this->where('end_time <=',$current_time);
    // $this->where('start_time >=',$current_time);
    $this->where('end_time >=','13:17:00');
    $this->where('start_time <=',' 13:17:00');
    $this->like('day', '%Wednesday%');

    return $this->first();
  }

  public function getScheduleLabById($id){
    $this->where('id', $id);
    return $this->first();
  }

  public function getScheduleLabs(){
    return $this->findAll();
  }
  public function getScheduleLabsActive(){
    $this->where('status', 'a');
    return $this->findAll();
  }


  public function checkSchedule($current_date,$current_time){
    // $this->where('end_time >=',$current_time);
    // $this->where('start_time <=',$current_time);
    // $this->where('date', $current_date);
    // $this->where('status', 'a');
    // $this->where('category', '1');
    $this->where('end_time >=','13:18:00');
    $this->where('start_time <=',' 13:18:00');
    $this->where('date', $current_date);
    return $this->findAll();
  }
  
  public function getLabScheduleById($id){
    $this->select('sched.*, category.*,labs.lab_name, sched.id as id, sched.status as status');
    $this->distinct('sched');
    $this->from('schedlabs sched');
    $this->join('categories category', 'category.id = sched.category_id','inner');
    $this->join('labs','sched.lab_id = labs.id','inner');
    $this->where('sched.id', $id);

    return $this->first();
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
