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
    $studentModel = new StudentsModel();
    $schedsubj = new SchedsubjsModel;
    
    $data['attendances'] = $attendanceModel->getAttendances();
    $data['view'] = 'Modules\MaintenanceManagement\Views\attendance\frmAttendance';
    return view('template/index', $data);
  }

  	
public function verify(){
	$studentModel = new StudentsModel();
  $attendanceModel = new AttendancesModel();
  $schedsubj = new SchedsubjsModel;
  $schedlabs = new SchedlabsModel;
  $students = $studentModel->getStudentByStudNum($_POST['student_num']);
 
	if(!empty($students) ) {
    $current_day = date('l');
    $current_time = date("H:i:s",time());
    $schedule = $schedsubj->checkSchedule($students['course_id'], $students['section_id'],$current_day,$current_time);
    // $event = $schedlabs->checkEvent($students['course_id'], $students['section_id'],$current_day,$current_time);
    // print_r($schedule );
    // die();
		if (!empty($schedule)) {
      $data['student_id'] = $students['id'];
      $data['student_number'] = $_POST['student_num'];
      $data['schedule_id'] = $schedule['id'];
     
      $attendance = $attendanceModel->getAttendance($students['id'],$schedule['id']);
   
      if(empty($attendance)){
      
        if($attendanceModel->insertAttendance($data)){
          $this->session->setFlashData('success', 'You have succesfully time in!');
        }else {
          $_SESSION['error'] = 'Something Went Wrong!';
          $this->session->markAsFlashdata('error');
        }

      }else{
        $_SESSION['error'] = 'You already Time in!';
        $this->session->markAsFlashdata('error');
      }
        
    

    }else{
      $_SESSION['error'] = 'You dont have class today';
      $this->session->markAsFlashdata('error');

    }
  }else{
    $_SESSION['error'] = 'Student Number Not Found';
    $this->session->markAsFlashdata('error');

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
                $this->session->setFlashData('success', 'You have succesfully time out!');
              } else {
                $_SESSION['error_message'] = 'Something Went Wrong!';
                $this->session->setFlashData('error_message');
              }
            }else{
                $_SESSION['error_message'] = "You cant time out again! Please Time-in on another day!";
                $this->session->setFlashData('error_message');
            }
      }
    } else{
      $this->session->setFlashData('error_message','Student Number Not Found');
    }
      
  }

  public function pdf(){
    $attendanceModel = new AttendancesModel();
    $studentModel = new StudentsModel();
    $schedsubj = new SchedsubjsModel;
    
    $mpdf = new \Mpdf\Mpdf();
    $pdf_data['attendances'] = $attendanceModel->getAttendancesByStudent();
    $pdf_data['headers'] = $attendanceModel->getAttendancesGroupByDate();
    $pdf_data['times'] = $attendanceModel->getAttendancesByTime();

    $html = view('html_to_pdf', $pdf_data);
    $mpdf->Addpage('L', // L - landscape, P - portrait
    '', '', '', '', 30, // margin_left
    30, // margin right
    30, // margin top
    30, // margin bottom
    18, // margin header
    12); // margin footer
    $mpdf->WriteHTML($html);
    $this->response->setHeader('Content-Type', 'application/pdf');
    $mpdf->Output('arjun.pdf','I'); // opens in browser

    $data['view'] = 'Modules\MaintenanceManagement\Views\attendance\frmAttendance';
    return view('template/index', $data);
  }
}
