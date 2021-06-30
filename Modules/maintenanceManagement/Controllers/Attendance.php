<?php namespace Modules\MaintenanceManagement\Controllers;

use App\Controllers\BaseController;
use Modules\MaintenanceManagement\Models\SchedlabsModel;
use Modules\MaintenanceManagement\Models\LabsModel;
use Modules\MaintenanceManagement\Models\CategoriesModel;
use Modules\MaintenanceManagement\Models\SubjectsModel;
use Modules\MaintenanceManagement\Models\CoursesModel;
use Modules\MaintenanceManagement\Models\ProfessorsModel;
use Modules\MaintenanceManagement\Models\SemestersModel;
use Modules\MaintenanceManagement\Models\SchoolyearsModel;
use Modules\MaintenanceManagement\Models\SchedsubjsModel;
use Modules\MaintenanceManagement\Models\SectionsModel;
use Modules\MaintenanceManagement\Models\StudentsModel;
use Modules\MaintenanceManagement\Models\AttendancesModel;


class Attendance extends BaseController {

  public function index(){
    $attendanceModel = new AttendancesModel();
    $schedsubj = new SchedsubjsModel;
    $data['attendances'] = $attendanceModel->getAttendances();
    $data['view'] = 'Modules\MaintenanceManagement\Views\attendance\frmAttendance';
    return view('template/index', $data);
  }

  	
public function verify(){
	$studentModel = new StudentsModel();
  $attendanceModel = new AttendancesModel();
  $schedsubj = new SchedsubjsModel;

  $students = $studentModel->getStudentByStudNum($_POST['student_num']);

	if(!empty($students) ) {
 
    $schedule = $schedsubj->checkSchedule($students['course_id'], $students['section_id']);
		$attendance = $attendanceModel->getAttendance($students['id'],$schedule['id']);
    
		if (!empty($schedule)) {
      $data['student_id'] = $students['id'];
      $data['student_number'] = $_POST['student_num'];
      $data['schedule_id'] = $schedule['id'];
     
      $attendance = $attendanceModel->getAttendance($students['id'],$schedule['id']);
   
      if(empty($attendance)){
      
        if($attendanceModel->insertAttendance($data)){
          $this->session->setFlashData('success_message', 'You have succesfully time in!');
          return redirect()->to(base_url('admin/attendance'));
        }else {
          $_SESSION['error_message'] = 'Something Went Wrong!';
          $this->session->setFlashData('error_message');
          return redirect()->to(base_url('admin/attendance'));
        }

      }else{
        $_SESSION['error_message'] = 'You already Time in!';
        $this->session->setFlashData('error_message');
        return redirect()->to(base_url('admin/attendance'));
      }
        
    

    }else{
      $_SESSION['error_message'] = 'You haven`t class today';
      $this->session->setFlashData('error_message');
      return redirect()->to(base_url('admin/attendance'));

    }
  }else{
    $this->session->setFlashData('error_message','Student Number Not Found');
		return redirect()->to(base_url('admin/attendance'));

  }
}

  public function attendance_time_out(){
    $studentModel = new StudentsModel();
    $attendanceModel = new AttendancesModel();
    $schedsubj = new SchedsubjsModel;

    $students = $studentModel->getStudentByStudNum($_POST['student_num']);
 
    if(!empty($students) ) {
        $schedule = $schedsubj->checkSchedule($students['course_id'], $students['section_id']);
        $attendance = $attendanceModel->getAttendance($students['id'],$schedule['id']);
       
        if(!empty($attendance) || !empty($schedule)){
            if ($attendance[0]['timeout'] == null) {
              if ($attendanceModel->timeOut($attendance[0]['id'])) {
                $this->session->setFlashData('success_message', 'You have succesfully time out!');
                return redirect()->to(base_url('admin/attendance/'));
              } else {
                $_SESSION['error_message'] = 'Something Went Wrong!';
                $this->session->setFlashData('error_message');
                return redirect()->to(base_url('admin/attendance/'));
              }
            }else{
                $_SESSION['error_message'] = "You cant time out again! Please Time-in on another day!";
                $this->session->setFlashData('error_message');
                return redirect()->to(base_url('admin/attendance/'));
            }
      }
    } else{
      $this->session->setFlashData('error_message','Student Number Not Found');
      return redirect()->to(base_url('admin/attendance/'));
    }
      
  }

}
