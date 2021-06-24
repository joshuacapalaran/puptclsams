<?php
namespace Modules\maintenanceManagement\Models;


use CodeIgniter\Model;

class AttendancesModel extends \CodeIgniter\Model
{
  protected $table = 'attendances';

  protected $allowedFields = ['schedule_id','student_id','student_number','subject_id','date','time_in','time_out','remarks','created_at','updated_at', 'deleted_at'];

  public function insertAttendance($data = []){
  date_default_timezone_set('Asia/Singapore');
  $data['date'] = date('y-m-d');
  $data['time_in'] = date('H:i:s');
  $data['time_out'] = null;
  $data['remarks'] = 'present';
  $data['created_at'] = date('y-m-d H:i:s');

  return $this->insert($data);
}
  public function getAttendance($student_id){
    date_default_timezone_set('Asia/Singapore');
    $this->where('student_id', $student_id);
    $this->where('date', date('y-m-d'));
    $this->orderBy('id','DESC');
    return $this->findAll();
  }
  public function timeOut($id){
  date_default_timezone_set('Asia/Singapore');
  return $this->where('id', $id)
  ->set(['time_out' => date('H:i:s')])
  ->update();
  }

  public function getAttendancesBySchedule($id){
    // $this->select('attendance.id as id, student.stud_num,student.firstname, student.lastname, student.middlename, attendance.timein, attendance.timeout, attendance.date, subjects.subject');
    $this->join('schedsubjs', 'attendances.schedule_id = schedsubjs.id');
    $this->join('students', 'attendances.student_id = students.id');
    $this->where('schedule_id', $id);
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
}
