<?php namespace Modules\MaintenanceManagement\Models;

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;

class SchedsubjsModel extends \CodeIgniter\Model {

  protected $table = 'schedsubjs';

  protected $allowedFields = ['subject_id', 'course_id','category','section_id','professor_id','date','day','lab_id','semester_id','sy_id', 'start_time', 'end_time','status','created_at','updated_at', 'deleted_at'];


  public function getSubjSchedules(){
    $this->select('sched.*,subjects.*, suffixes.*, courses.*,professors.*,semesters.*,schoolyears.*,courses.*, labs.*, sched.id as id, sched.status as status');
    $this->distinct('sched');
    $this->from('schedsubjs sched');
    $this->join('labs','sched.lab_id = labs.id','inner');
    $this->join('subjects','sched.subject_id = subjects.id','inner');
    $this->join('courses','sched.course_id = courses.id','inner');
    $this->join('professors','sched.professor_id = professors.id','inner');
    $this->join('semesters','sched.semester_id = semesters.id','inner');
    $this->join('schoolyears','sched.sy_id = schoolyears.id','inner');
    $this->join('suffixes','professors.suffix_id = suffixes.id','inner');
    // $this->where('sched.deleted_at', null);
    // $this->where('sched.status', 'a');
    return $this->findAll();
  }

  public function getCalendarSubjSchedules(){
    $this->select('sched.*,subjects.*, suffixes.*, courses.*,professors.*,semesters.*,schoolyears.*,courses.*, labs.*, sched.id as id, sched.status as status');
    $this->distinct('sched');
    $this->from('schedsubjs sched');
    $this->join('labs','sched.lab_id = labs.id','inner');
    $this->join('subjects','sched.subject_id = subjects.id','inner');
    $this->join('courses','sched.course_id = courses.id','inner');
    $this->join('professors','sched.professor_id = professors.id','inner');
    $this->join('semesters','sched.semester_id = semesters.id','inner');
    $this->join('schoolyears','sched.sy_id = schoolyears.id','inner');
    $this->join('suffixes','professors.suffix_id = suffixes.id','inner');
    // $this->where('sched.deleted_at', null);
    $this->where('sched.status', 'a');
    return $this->findAll();
  }

  public function getSubjectById($id){
    $this->join('subjects', 'schedsubjs.subject_id = subjects.id');
    $this->join('courses','schedsubjs.course_id = courses.id');
    $this->join('sections','schedsubjs.section_id = sections.id','inner');
    $this->where('schedsubjs.id',$id);
    return $this->first();

  }
  public function getScheduleSubjDetailsById($id){
    $this->select('sched.*,subjects.*, suffixes.*, sections.*,courses.*,professors.*,semesters.*,schoolyears.*,courses.*, labs.*, sched.id as id');
    $this->from('schedsubjs sched');
    $this->join('labs','sched.lab_id = labs.id','inner');
    $this->join('subjects','sched.subject_id = subjects.id','inner');
    $this->join('courses','sched.course_id = courses.id','inner');
    $this->join('professors','sched.professor_id = professors.id','inner');
    $this->join('semesters','sched.semester_id = semesters.id','inner');
    $this->join('schoolyears','sched.sy_id = schoolyears.id','inner');
    $this->join('sections','sched.section_id = sections.id','inner');
    $this->join('suffixes','professors.suffix_id = suffixes.id','inner');
    $this->where('sched.id', $id);
    return $this->first();
  }
  public function checkSchedule($current_day,$current_time){
    // $this->where('end_time >=',$current_time);
    // $this->where('start_time <=',$current_time);
    // $this->like('day', '%'.$current_day.'%');
    // $this->where('status', 'a');
    // $this->where('category', '1');
    $this->where('end_time >=','13:18:00');
    $this->where('start_time <=',' 13:18:00');
    $this->like('day', '%Wednesday%');
    return $this->findAll();
  }

  public function getStudentSchedule($course_id, $section_id,$current_day,$current_time){
    $this->where('course_id', $course_id);
    $this->where('section_id', $section_id);
    $this->where('end_time >=',$current_time);
    $this->where('start_time <=',$current_time);
    $this->like('day', '%'.$current_day.'%');
    $this->where('status', 'a');
    $this->where('category', '1');
    // $this->where('end_time >=','13:18:00');
    // $this->where('start_time <=',' 13:18:00');
    // $this->like('day', '%Wednesday%');
    return $this->findAll();
  }

  public function getScheduleSubjById($id){
    $this->where('id', $id);
    return $this->first();
  }

  
  public function getAllSchedule($day, $current_time){
    $this->like('day', '%'.$day.'%');
    $this->where('end_time <=',$current_time);
    $this->where('start_time >=',$current_time);
    return $this->findAll();
  }
  public function add_schedsubj($val_array = [])
	{
		$val_array['created_at'] = (new \DateTime())->format('Y-m-d H:i:s');
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


  public function edit_schedsubj($id,$val_array)
	{
		$val_array['updated_at'] = (new \DateTime())->format('Y-m-d H:i:s');
    $val_array['status'] = 'a';
		return $this->update($id, $val_array);
	}

    public function delete_schedsubj($id)
	{
		$val_array['deleted_at'] = (new \DateTime())->format('Y-m-d H:i:s');
		$val_array['status'] = 'd';
		return $this->update($id, $val_array);
	}
}
