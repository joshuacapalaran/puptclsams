<?php namespace Modules\MaintenanceManagement\Models;

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;

class SchedsubjsModel extends \CodeIgniter\Model {

  protected $table = 'schedsubjs';

  protected $allowedFields = ['subject_id', 'course_id','category','section_id','professor_id','date','day','end_day','lab_id','semester_id','sy_id', 'start_time', 'end_time','status','created_at','updated_at', 'deleted_at'];


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
  public function checkSchedule($course_id, $section_id){
    $this->where('course_id', $course_id);
    $this->where('section_id', $section_id);
    // $this->where('start_time >=','22:30:00');
    // $this->where('end_time', '<','22:35:00');
    // $this->where('day', 'Monday');
    return $this->first();
  }

  public function getScheduleSubjById($id){
    $this->where('id', $id);
    return $this->first();
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
