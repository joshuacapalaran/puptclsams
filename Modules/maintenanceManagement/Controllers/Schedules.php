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
use Modules\MaintenanceManagement\Models\ActivityLogsModel;
use Modules\userManagement\Models\VisitorsModel;

class Schedules extends BaseController {


  function __construct(){
    $this->activityLogsModel = new ActivityLogsModel;
  }

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
          'holiday_status' => $holiday['status'],
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
              'year_section' => $schedsubject['year'].'-'.$schedsubject['section'],
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
              'year_section' => $schedsubject['year'],
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
        'date' => $schedlab['date'],
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
    $this->activityLogsModel->addLogs($_SESSION['uid'], 'Cancel Schedule Subject', 'admin/schedules', json_encode($data));
    $holidayModel->cancel($data);
  }else if($_POST['type'] == 'lab'){
    
    $data = [
      'name' => 'cancel class',
      'schedlab_id' => $lab_id,
      'date' => $date,
      'status' => 'c',
    ];
    $this->activityLogsModel->addLogs($_SESSION['uid'], 'Cancel Schedule Event', 'admin/schedules', json_encode($_POST));
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
  date_default_timezone_set('Asia/Singapore');
  $current_day = date('l');
  $selected_day = date('l', strtotime($_POST['sched_data']['date']));
  $current_time = date('H:i:s',time());
  $time_now = time();

  $students = $studentModel->getStudentByStudNum($_POST['student_num']);
  
	if(!empty($students) ) {

      if($_POST['sched_data']['type'] == 'event'){
        $data['schedule_id'] = $_POST['sched_data']['id'];
        $attendance = $attendanceModel->getAttendance($students['id'],$_POST['sched_data']['id'],$_POST['sched_data']['date']);
        if($current_day == $selected_day){
          $sched = $schedsubj->getStudentSchedule($students['course_id'],$students['section_id'],$current_day,$current_time);
        }else{
          $sched = array();
        }
      }else if($_POST['sched_data']['type'] == 'lab'){
        $data['lab_id'] = $_POST['sched_data']['id'];
        $attendance = $attendanceModel->getAttendanceLab($students['id'],$_POST['sched_data']['id'],$_POST['sched_data']['date']);
      }
 
      $data['student_id'] = $students['id'];
      $data['student_number'] = $_POST['student_num'];
      $data['date'] = $_POST['sched_data']['date'];
      $data['subject_id'] = $_POST['info']['subject_id'];
      $start_time = strtotime($sched[0]['start_time']);
  
      if(!empty($sched)){

            $difference = $start_time - $time_now;
            $difference_minute =  $difference/60;
              if(empty($attendance)){
                if(abs($difference_minute) >= 15){
                  $data['remarks'] = 'late';
                }else{
                  $data['remarks'] = 'present';
                }
              
                if($attendanceModel->insertAttendance($data)){
                  $this->session->setFlashData('success', 'You have succesfully time in!');
                }else {
                  $_SESSION['error'] = 'Something Went Wrong!';
                  $this->session->markAsFlashdata('error');
                }

              }else{
                // $_SESSION['error'] = 'You already Time in!';
                // $this->session->markAsFlashdata('error');
                if($attendance['time_out'] == null){
                  if ($attendanceModel->timeOut($attendance['id'])) {
                    $this->session->setFlashData('success', 'You have time-in and you succesfully time out!');
                  } 
                }else if($attendance['time_out'] !== null){
                  $this->session->setFlashData('error', 'You have already log, Please Time-in/Time-out on next schedule.');

                }
               
              }
        }else{
          $_SESSION['error'] = 'You are not tagged this schedule.';
          $this->session->markAsFlashdata('error');
        }
      
  }else{
    $_SESSION['error'] = 'Student Number Not Found!';
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
            $difference = $to_time - $time_now;
            $difference_minute =  $difference/60;
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
        }else{
          $this->session->setFlashData('error', 'You dont have yet time-in today!');
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
    $info = $schedsubj->getSubjectById($_GET['id']);
    $course_abbrev = $info['course_abbrev'];
    $section = $info['section'];
    $year = $info['year'];
    $course_abbrev = $info['course_abbrev'];
    $subj_name = $info['subj_name'];
    $pdf_data['type'] = $_GET['type'];
    
    $mpdf->setHTMLHeader('
        <div class="col12" style="padding-left:100px">
            <div class="col6" style=" width:10%;float:left; padding-left:120px;">
            <img src="data:image/png;base64,'.base64_encode(file_get_contents('assets/img/pup_logo.png')).'" style="width:50px; ">
            </div>
            <div class="col6" style=" padding-right:245px;text-align:center;">  
              <b>Polytechnic University of the Philippines</b>
              <br>
              Taguig Branch<br> General Santos Avenue, Lower Bicutan, Taguig City
              <br>
              <br>
              <b>Attendance</b>
            </div>
        </div>
    ');

  
    $html = view('html_to_pdf', $pdf_data);
    // $mpdf->showImage = true;
    // $mpdf->setHTMLHeader(site_url("assets/img/pup_logo.png")); 

  
    
    $mpdf->Addpage('L', // L - landscape, P - portrait
    '', '', '', '', 30, // margin_left
    30, // margin right
    40, // margin top
    30, // margin bottom
    5, // margin header
    5); // margin footer
    $mpdf->WriteHTML($html);
    $this->response->setHeader('Content-Type', 'application/pdf');
    $random = rand();
    $current_date = date('Y-m-d');
    $mpdf->Output("$subj_name  $course_abbrev  $year-$section  $current_date $random .pdf",'I'); // opens in browser

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



  
	public function penalty(){
	  $schedsubj = new SchedsubjsModel;
    $attendanceModel = new AttendancesModel();
    $studentModel = new StudentsModel();
    date_default_timezone_set('Asia/Singapore');

		$data = [];
		$current_day = date('l');
		$current_time = date('H:i:s',time());
    $time_now = time();
    
    $schedules = $schedsubj->checkSchedule($current_day, $current_time);

		foreach($schedules as $schedule){
      $end_time = date('H:i:s',strtotime($schedule['end_time']));
      $data = [];
      $difference = $to_time - $time_now;
      $difference_minute =  $difference/60;

            if( date('H:i:s',strtotime($current_time)) >= date('H:i:s',strtotime($end_time))){
              $students = $studentModel->getStudentBySchedule($schedule['course_id'],$schedule['section_id']);
            
              foreach($students as $student){

                  $attendance = $attendanceModel->getAttendance($student['id'],$schedule['id'],date('Y-m-d'));
             
                    if(empty($attendance)){

                      $data['schedule_id'] = $schedule['id'];
                      $data['student_number'] = $student['student_num'];
                      $data['student_id'] = $student['id'];
                      $attendanceModel->insertAbsent($data);
                    }
                    
                    if($attendance['time_in'] !== null && $attendance['time_out'] == null){
                      $attendanceModel->timeOut($attendance['id']);
                    }
              }
             
            }
        
    }
		
  }
  
  public function visitor_timeout(){
    date_default_timezone_set('Asia/Singapore');

    $schedlabs = new SchedlabsModel;
    $visitorsModel = new VisitorsModel;
    $current_date = date('Y-m-d');
		$current_time = date('H:i:s',time());
		$time_now = time();
    $schedules = $schedlabs->checkSchedule($current_date, $current_time);
    foreach($schedules as $schedule){
      $visitors = $visitorsModel->getVisitorsLabById($schedule['id']);
      foreach($visitors as $visitor){
        if($visitor['time_out'] == null){
          $visitorsModel->logoutVisitor($visitor['id']);
        }

      }

    }
  }
  
}
