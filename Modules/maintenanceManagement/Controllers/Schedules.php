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
use Modules\MaintenanceManagement\Models\HolidayModel;

class Schedules extends BaseController {


public function index(){

    
    $schedlabsModel = new SchedlabsModel;
    $sched = new SchedsubjsModel;
    $holidayModel = new HolidayModel;

    $holidays = $holidayModel->getCancelDates();
    $schedlabs = $schedlabsModel->getCalendarLabSchedules();
    $holi = [];

    foreach($holidays as $holiday){
        $holi[] = [
          'date' => $holiday['date'],
          'schedlab_id' => $holiday['schedlab_id'],
          'schedsubj_id' => $holiday['schedsubj_id'],
        ];
    }

 
    $data['schedsubjects'] = $schedsubj;
    $data['holidays'] = $holi;
    $data['view'] = 'Modules\MaintenanceManagement\Views\schedules\index';
    return view('template/index', $data);
}
public function get_events(){
  $schedlabsModel = new SchedlabsModel;
  $schedModel = new SchedsubjsModel;
  $holidayModel = new HolidayModel;

  $schedsubjects = $schedModel->getCalendarSubjSchedules();
  $schedlabs = $schedlabsModel->getCalendarLabSchedules();
  

  $data = [];
  foreach($schedsubjects as $schedsubject){

        if($schedsubject['day'] !== null){
          $day = $this->getDayNumber($schedsubject['day']);
          $dow = $day;
          $data[] = [
            'title' => $schedsubject['subj_name'],
            'id' => $schedsubject['id'],
            'daysOfWeek' => $dow,
            'start' => $schedsubject['start_time'],
            'extendedProps' => [
              'course' => $schedsubject['course_name'],
              'time' => date("h:i A", strtotime($schedsubject['start_time'])).'-'.date("h:i A", strtotime($schedsubject['end_time'])),
              'lab_day' => ($schedsubject['end_day']) ? $schedsubject['day'].' and '.$schedsubject['end_day']:$schedsubject['day'],
              'lab' => $schedsubject['lab_name'],
              'prof' => $schedsubject['first_name'].' '.$schedsubject['last_name'].' '.$schedsubject['suffix_name'] ,
              'sem' => $schedsubject['sem'],
              'sy' => $schedsubject['start_sy'].' - '.$schedsubject['end_sy'],
              'schedule' => 'event',
            ] 
          ];
        }
        
        if($schedsubject['date'] !== null){
          $date = $schedsubject['date'];

          $data[] = [
            'title' => $schedsubject['subj_name'],
            'id' => $schedsubject['id'],
            'date' => $date,
            'extendedProps' => [
              'course' => $schedsubject['course_name'],
              'lab' => $schedsubject['lab_name'],
              'lab_day' => $schedsubject['date'],
              'prof' => $schedsubject['first_name'].' '.$schedsubject['last_name'].' '.$schedsubject['suffix_name'] ,
              'sem' => $schedsubject['sem'],
              'sy' => $schedsubject['start_sy'].' - '.$schedsubject['end_sy'],
              'schedule' => 'event',
            ] 
            
          ];
        }
        
        $data[] = [
          'extendedProps' => [
            'course' => $schedsubject['course_name'],
            'lab' => $schedsubject['lab_name'],
            'prof' => $schedsubject['first_name'].' '.$schedsubject['last_name'].' '.$schedsubject['suffix_name'] ,
            'sem' => $schedsubject['sem'],
            'sy' => $schedsubject['start_sy'].' - '.$schedsubject['end_sy'],
            'schedule' => 'event',
          ] 
          
        ];
       
  }

  
  foreach($schedlabs as $schedlab){

      $data[] = [
        'title' => $schedlab['event_name'],
        'start' => $schedlab['date'],
        'id' => $schedlab['id'],
        'extendedProps' => [
          'lab_id' => $schedlab['id'],
          'category' => $schedlab['category'],
          'time' => date("h:i A", strtotime($schedlab['start_time'])).'-'.date("h:i A", strtotime($schedlab['end_time'])),
          'date' => $schedlab['date'],
          'lab' => $schedlab['lab_name'],
          'assigned_person' => $schedlab['assigned_person'],
          'num_people' => $schedlab['num_people'],
          'schedule' => 'lab',
        ] 
     
      ];
    
  }
  echo json_encode($data);
}


public function cancelSchedule(){
  
  $schedlabsModel = new SchedlabsModel;
  $schedModel = new SchedsubjsModel;
  $holidayModel = new HolidayModel;

  $id = $_POST['id'];
  $lab_id = $_POST['lab_id'];
  $date = $_POST['date'];

  if($_POST['type'] == 'event'){
    $data = [
      'name' => 'cancel class',
      'schedsubj_id' => $id,
      'date' => $date,
      'status' => 'c',
    ];
    $holidayModel->cancel($data);
  }else if($_POST['type'] == 'lab'){
    
    $data = [
      'name' => 'cancel class',
      'schedlab_id' => $lab_id,
      'date' => $date,
      'status' => 'c',
    ];
    $holidayModel->cancel($data);

  }

}

public function attendance()
{
  $attendanceModel = new AttendancesModel();
  $schedsubj = new SchedsubjsModel;
  $schedlabs = new SchedlabsModel;
 
  if($_GET['type'] == 'event'){
    $data['attendances'] = $attendanceModel->getAttendancesBySchedsubj($_GET['id'],$_GET['date']);
    $data['info'] = $schedsubj->getSubjectById($_GET['id']);

  }else{
    $data['attendances'] = $attendanceModel->getAttendancesBySchedlabs($_GET['id'],$_GET['date']);
    $data['info'] = $schedlabs->getScheduleLabById($_GET['id']);

  }
  $data['data'] = $_GET;
  $data['view'] = 'Modules\MaintenanceManagement\Views\schedules\frmAttendance';
  return view('template/index', $data);

}

  	
public function verify(){
	$studentModel = new StudentsModel();
  $attendanceModel = new AttendancesModel();
  $schedsubj = new SchedsubjsModel;
  $schedlabs = new SchedlabsModel;
  $students = $studentModel->getStudentByStudNum($_POST['student_num']);
  
	if(!empty($students) ) {

      if($_POST['sched_data']['type'] == 'event'){
        $data['schedule_id'] = $_POST['sched_data']['id'];
        $attendance = $attendanceModel->getAttendance($students['id'],$_POST['sched_data']['id'],$_POST['sched_data']['date']);

      }else if($_POST['sched_data']['type'] == 'lab'){
        $data['lab_id'] = $_POST['sched_data']['id'];
        $attendance = $attendanceModel->getAttendanceLab($students['id'],$_POST['sched_data']['id'],$_POST['sched_data']['date']);

      }
      $data['student_id'] = $students['id'];
      $data['student_number'] = $_POST['student_num'];
      $data['date'] = $_POST['sched_data']['date'];
     
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
      $date = date('l', $_POST['sched_data']['date']);
      $time = date('H:i:s',time());
   

      if($_POST['sched_data']['type'] == 'event'){
        $data['schedule_id'] = $_POST['sched_data']['id'];
        $attendance = $attendanceModel->getAttendance($students['id'],$_POST['sched_data']['id'],$_POST['sched_data']['date']);
        // $schedule = $schedsubj->checkSchedule($students['course_id'], $students['section_id']);

      }else if($_POST['sched_data']['type'] == 'lab'){
        $data['lab_id'] = $_POST['sched_data']['id'];
        $attendance = $attendanceModel->getAttendanceLab($students['id'],$_POST['sched_data']['id'],$_POST['sched_data']['date']);

      }
  
        if(!empty($attendance) ){
            if ($attendance['time_out'] == null) {
           
              if ($attendanceModel->timeOut($attendance['id'])) {
                $this->session->setFlashData('success', 'You have succesfully time out!');
              } else {
                $_SESSION['error'] = 'Something Went Wrong!';
                $this->session->markAsFlashdata('error');
              }
            }else{
                $_SESSION['error'] = "You cant time out again! Please Time-in on another day!";
                $this->session->markAsFlashdata('error');
            }
      }
    } else{
      $this->session->setFlashData('error','Student Number Not Found');
    }
      
  }

  public function pdf(){
    $attendanceModel = new AttendancesModel();
    $studentModel = new StudentsModel();
    $schedsubj = new SchedsubjsModel;
    $schedlabs = new SchedlabsModel;
    

    $mpdf = new \Mpdf\Mpdf();
    $pdf_data['attendances'] = $attendanceModel->getAttendancesByStudent($_GET['id'], $_GET['date'], $_GET['type']);
    $pdf_data['headers'] = $attendanceModel->getAttendancesGroupByDate($_GET['id'], $_GET['date'], $_GET['type']);
    $pdf_data['times'] = $attendanceModel->getAttendancesByTime($_GET['id'], $_GET['date'], $_GET['type']);

    if($_GET['type'] == 'event'){
      $pdf_data['info'] = $schedsubj->getScheduleSubjDetailsById($_GET['id']);
    }elseif($_GET['type'] == 'lab'){
      $pdf_data['info'] = $schedlabs->getLabScheduleById($_GET['id']);
    }
    $pdf_data['type'] = $_GET['type'];
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
public function getDayNumber($days){
      $sched = [];
      foreach(explode(',',$days) as $day){
        switch($day){
          case 'Sunday': $sched[] = 0;
          break;
          case 'Monday': $sched[] = 1;
          break;
          case 'Tuesday': $sched[] = 2;
          break;
          case 'Wednesday': $sched[] = 3;
          break;
          case 'Thursday': $sched[] = 4;
          break;
          case 'Friday': $sched[] = 5;
          break;
          case 'Saturday': $sched[] = 6;
          break;
    
        }
      }
  
    return $sched;
  }

}
