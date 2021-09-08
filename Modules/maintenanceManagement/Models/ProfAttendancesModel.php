<?php
namespace Modules\maintenanceManagement\Models;


use CodeIgniter\Model;

class ProfAttendancesModel extends \CodeIgniter\Model
{
  protected $table = 'prof_attendance';

  protected $allowedFields = ['schedule_id','lab_id','professor_id','faculty_code','subject_id','date','time_in','time_out','remarks','created_at','updated_at', 'deleted_at'];

  public function insertAttendance($data){
    date_default_timezone_set('Asia/Singapore');
    $data['time_in'] = date('H:i:s');
    $data['time_out'] = null;
    $data['remarks'] = 'present';
    $data['created_at'] = date('y-m-d H:i:s');
    return $this->insert($data);
  }
  public function getAttendance($professor_id,$date){
    $this->where('professor_id', $professor_id);
    $this->where('date', $date);
    return $this->first();
  }

  public function getAttendanceLab($professor_id,$lab_id,$date){
    $this->where('professor_id', $professor_id);
    $this->where('lab_id', $lab_id);
    $this->where('date', $date);
    return $this->first();
  }
  public function timeOut($id){
  date_default_timezone_set('Asia/Singapore');
  return $this->where('id', $id)
  ->set(['time_out' => date('H:i:s')])
  ->update();
  }
  public function insertAbsent($data){
    date_default_timezone_set('Asia/Singapore');
    $data['date'] = date('Y-m-d');
    $data['time_in'] = null;
    $data['time_out'] = null;
    $data['remarks'] = 'absent';
    $data['created_at'] = date('y-m-d H:i:s');
    return $this->insert($data);
  }
  public function getAttendances(){
    $this->select('prof_attendance.id as id, students.student_num,students.first_name, students.last_name, students.m_initial, prof_attendance.time_in, prof_attendance.time_out, prof_attendance.date, prof_attendance.remarks,subjects.subj_name,schedlabs.event_name');
    $this->join('students', 'prof_attendance.professor_id = students.id');
    $this->join('schedsubjs', 'prof_attendance.schedule_id = schedsubjs.id', 'LEFT');
    $this->join('schedlabs', 'prof_attendance.lab_id = schedlabs.id', 'LEFT');
    $this->join('subjects', 'schedsubjs.subject_id = subjects.id', 'LEFT');
    return $this->findAll();
  }

  public function getAttendancesBySchedsubj($id){
    $this->select('prof_attendance.id as id, professors.f_code,professors.first_name, professors.last_name, professors.m_initial, prof_attendance.time_in, prof_attendance.time_out, prof_attendance.date, prof_attendance.remarks, subjects.subj_name');
    $this->join('professors', 'prof_attendance.professor_id = professors.id');
    $this->join('schedsubjs', 'prof_attendance.schedule_id = schedsubjs.id');
    $this->join('subjects', 'schedsubjs.subject_id = subjects.id');
    $this->where('prof_attendance.professor_id', $id);
    return $this->findAll();
  }

  public function getAttendancesBySchedlabs($id,$date){
    $this->select('prof_attendance.id as id, students.student_num,students.first_name, students.last_name, students.m_initial, prof_attendance.time_in, prof_attendance.time_out, prof_attendance.date, schedlabs.event_name');
    $this->join('students', 'prof_attendance.professor_id = students.id');
    $this->join('schedlabs', 'prof_attendance.lab_id = schedlabs.id');
    $this->where('prof_attendance.lab_id', $id);
    $this->where('prof_attendance.date', $date);
    return $this->findAll();
  }
  public function getAttendancesByStudent($id = null, $date = null, $type = null){
    $this->select('prof_attendance.id as id, students.student_num,students.first_name, students.last_name, students.m_initial, prof_attendance.time_in,prof_attendance.schedule_id,prof_attendance.faculty_code, prof_attendance.time_out, prof_attendance.date, prof_attendance.remarks');
    $this->join('students', 'prof_attendance.professor_id = students.id','inner');
    $this->groupBy('prof_attendance.faculty_code');
    $this->orderBy('students.last_name ASC');
    if($type == 'event'){
      $this->where('prof_attendance.schedule_id', $id);
      $this->where('prof_attendance.date', $date);
    }elseif($type == 'lab'){
      $this->where('prof_attendance.lab_id', $id);
      $this->where('prof_attendance.date', $date);
    }
 

    return $this->findAll();
  }
  
  public function getAttendancesGroupByDate($id = null, $date = null, $type = null){
    $this->select('date,schedule_id');
    $this->groupBy('date');
    $this->orderBy('date ASC');
    if($type == 'event'){
      $this->where('schedule_id', $id);
      $this->where('date', $date);
    }elseif($type == 'lab'){
      $this->where('lab_id', $id);
      $this->where('date', $date);
    }
    return $this->findAll();
  }

  public function getAttendancesByTime($id = null, $date = null, $type = null){
    if($type == 'event'){
      $this->where('schedule_id', $id);
      $this->where('date', $date);
    }elseif($type == 'lab'){
      $this->where('lab_id', $id);
      $this->where('date', $date);
    }
    $this->orderBy('prof_attendance.date ASC');
    return $this->findAll();
  }

  
  public function getAttendanceById($id){
    $this->where('id', $id);
    return $this->findAll();
  }

  public function getScheduleAttendanceById($id){
    $this->where('schedule_id', $id);
    return $this->findAll();
  }

  public function getAttendancesByFilter($data){
    $this->select('prof_attendance.id as id, students.student_num,students.first_name, students.last_name, students.m_initial, prof_attendance.time_in,prof_attendance.schedule_id,prof_attendance.faculty_code, prof_attendance.time_out, prof_attendance.date, prof_attendance.remarks');
    $this->join('students', 'prof_attendance.professor_id = students.id');
    $this->join('schedsubjs', 'prof_attendance.schedule_id = schedsubjs.id');
   
    if(!empty($data['date'])){
      $this->where('prof_attendance.date', $data['date']);
    }

    if(!empty($data['subject_id'])){
      $this->where('prof_attendance.subject_id', $data['subject_id']);
    }

    if(!empty($data['section_id'])){
      $this->where('students.section_id', $data['section_id']);
    }

    if(!empty($data['course_id'])){
      $this->where('students.course_id', $data['course_id']);
    }
    
    if(!empty($data['semester_id'])){
      $this->where('schedsubjs.semester_id', $data['semester_id']);
    }
        
    if(!empty($data['lab_id'])){
      $this->where('schedsubjs.lab_id', $data['lab_id']);
    }
        
    if(!empty($data['sy_id'])){
      $this->where('schedsubjs.sy_id', $data['sy_id']);
    }

    if(!empty($data['start_time']) && !empty($data['end_time'])){
      $this->where('schedsubjs.start_time', $data['start_time']);
      $this->where('schedsubjs.end_time', $data['end_time']);
    }
 
 
    if(!empty($data['date'])){
      return $this->findAll();
    }
  }

  public function getAttendancesByDate($id,$date){
    $this->select('date,schedule_id');
    $this->groupBy('date');
    $this->orderBy('date ASC');
    if(!empty($date)){
      $this->where('schedule_id', $id);
      $this->where('date', $date);
    }
    return $this->findAll();
  }

  public function getAttendancesOnTime($id,$date){
    
    if(!empty($date)){
      $this->where('schedule_id', $id);
      $this->where('date', $date);
    }
    $this->orderBy('date ASC');
    return $this->findAll();
  }

}
