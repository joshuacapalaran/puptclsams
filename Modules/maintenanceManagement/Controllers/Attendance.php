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
use Modules\MaintenanceManagement\Models\ProfAttendancesModel;


class Attendance extends BaseController {

  public function index(){
    $attendanceModel = new AttendancesModel();
    $studentModel = new StudentsModel();
    $schedsubj = new SchedsubjsModel;
    $courseModel = new CoursesModel;
    $sectionModel = new SectionsModel;
    $semsModel = new SemestersModel;
    $labs = new LabsModel;
    $schoolyear = new SchoolyearsModel;
    $subj = new SubjectsModel;
    
    $data['subjects'] = $subj->getActiveSubjects();
    $data['labs'] = $labs->getLabsByActive();
    $data['courses'] = $courseModel->getActiveCourse();
    $data['semesters'] = $semsModel->getActiveSemesters();
    $data['schoolyears'] = $schoolyear->getActiveSchoolYears();
    $data['sections'] = $sectionModel->getActiveSections();

    
    if($_POST){
      if(empty($_POST['date'])){
        $_SESSION['error'] = "Please Select Date";
        $this->session->markAsFlashdata('error');
      }
      if(empty($_POST['start_time']) || empty($_POST['end_time'])){
        $_SESSION['error'] = "Start Time and End Time is required";
        $this->session->markAsFlashdata('error');
      }
       $data['attendances'] = $attendanceModel->getAttendancesByFilter($_POST);
       $data['value'] = $_POST;


    }
    $data['view'] = 'Modules\MaintenanceManagement\Views\attendance\frmAttendance';
    return view('template/index', $data);
  }

  public function pdf(){
    $attendanceModel = new AttendancesModel();
    $studentModel = new StudentsModel();
    $schedsubj = new SchedsubjsModel;
    
    $mpdf = new \Mpdf\Mpdf();
    $data = array();
    $data['date'] = ($_GET['date'] !== 'undefined') ? $_GET['date']:'';
    $data['subject_id'] = ($_GET['subject_id'] !== 'undefined') ? $_GET['subject_id']:'';
    $data['section_id'] = ($_GET['section_id'] !== 'undefined') ? $_GET['section_id']:'';
    $data['course_id'] = ($_GET['course_id'] !== 'undefined') ? $_GET['course_id']:'';
    $data['semester_id'] = ($_GET['semester_id'] !== 'undefined') ? $_GET['semester_id']:'';
    $data['lab_id'] = ($_GET['lab_id'] !== 'undefined') ? $_GET['lab_id']:'';
    $data['sy_id'] = ($_GET['sy_id'] !== 'undefined') ? $_GET['sy_id']:'';
    $data['start_time'] = ($_GET['start_time'] !== 'undefined') ? $_GET['start_time']:'';
    $data['end_time'] = ($_GET['end_time'] !== 'undefined') ? $_GET['end_time']:'';
    $attendance = $attendanceModel->getAttendancesByFilter($data);
    $pdf_data['attendances'] = $attendance;
    $pdf_data['headers'] = $attendanceModel->getAttendancesByDate($attendance[0]['schedule_id'],$data['date']);
    $pdf_data['times'] = $attendanceModel->getAttendancesOnTime($attendance[0]['schedule_id'],$data['date']);

    $pdf_data['info'] = $schedsubj->getScheduleSubjDetailsById($attendance[0]['schedule_id']);
    $info = $schedsubj->getSubjectById($attendance[0]['schedule_id']);
    $course_abbrev = $info['course_abbrev'];
    $section = $info['section'];
    $year = $info['year'];
    $course_abbrev = $info['course_abbrev'];
    $subj_name = $info['subj_name'];
    $pdf_data['type'] = 'event';

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
    $mpdf->Output("$subj_name  $course_abbrev  $year-$section $random.pdf",'I'); // opens in browser

    $data['view'] = 'Modules\MaintenanceManagement\Views\attendance\frmAttendance';
    return view('template/index', $data);
  }


  public function attendance()
  {
    $attendanceModel = new ProfAttendancesModel();
    $schedsubj = new SchedsubjsModel;
    $schedlabs = new SchedlabsModel;
    $professorsModel = new ProfessorsModel();

    $professor = $professorsModel->getProfessorsByUserId($_SESSION['uid']);
    $data['attendances'] = $attendanceModel->getAttendancesBySchedsubj($professor['id']);

    $data['view'] = 'Modules\MaintenanceManagement\Views\attendance\profAttendance';
    return view('template/index', $data);

  }

  public function verify(){
    $professorsModel = new ProfessorsModel();
    $attendanceModel = new ProfAttendancesModel();
    $schedsubj = new SchedsubjsModel;
    $schedlabs = new SchedlabsModel;
    date_default_timezone_set('Asia/Singapore');
      $current_date = date('Y-m-d');
    $current_day = date('l');
    $current_time = date('H:i:s',time());
    // $time_now = time();
    $professor = $professorsModel->getProfessorsByFcode($_POST['faculty_code']);
  
    if(!empty($professor) ) {
  
    

          $attendance = $attendanceModel->getAttendance($professor['id'],$current_date);
      
          $sched = $schedsubj->getStudentScheduleForProf($professor['id'],$current_day,$current_time);
         
          
        $data['professor_id'] = $professor['id'];
        $data['faculty_code'] = $_POST['faculty_code'];
        $data['date'] = $current_date;
        $data['subject_id'] = $sched['subject_id'];
        $data['schedule_id'] = $sched['id'];
   
        if(!empty($sched)){
  
            if(empty($attendance)){

            
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
            $this->session->setFlashData('error', 'You dont have class schedule today.');
          }
        
    }else{
      $_SESSION['error'] = 'Faculty Code Not Found!';
      $this->session->markAsFlashdata('error');
  
  
    }
  }
  
    public function attendance_time_out(){
      $professorsModel = new ProfessorsModel();
      $attendanceModel = new ProfAttendancesModel();
      $schedsubj = new SchedsubjsModel;
  
      $professor = $professorsModel->getProfessorsByFcode($_POST['faculty_code']);
   
      if(!empty($professor) ) {
        $date = date('l');
        $time = date('H:i:s',time());
        $current_date = date('Y-m-d');
     
        $attendance = $attendanceModel->getAttendance($professor['id'],$current_date);
        print_r($professor);
        if(!empty($attendance)){
            if ($attendance['time_out'] == null) {
              if ($attendanceModel->timeOut($attendance['id'])) {
                $this->session->setFlashData('success', 'You have succesfully time out!');
              } else {
                $this->session->setFlashData('error', 'Something Went Wrong!');
              }
            }else{
                $this->session->setFlashData('error', 'You cant time out again! Please Time-in on another day!');

            }
        }else{
          $this->session->setFlashData('error', 'You dont have yet time-in today!');
        }
      } else{
        $this->session->setFlashData('error','Faculty Code Not Found!');
  
      }
        
    }
  
    
  public function profPdf(){
    $attendanceModel = new ProfAttendancesModel(); 
    $professorsModel = new ProfessorsModel();
    $schedsubj = new SchedsubjsModel;
    $schedlabs = new SchedlabsModel;
    

    $mpdf = new \Mpdf\Mpdf();
    $professor = $professorsModel->getProfessorsByUserId($_SESSION['uid']);
    $pdf_data['attendances'] = $attendanceModel->getAttendancesBySchedsubj($professor['id']);
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

  
    $html = view('prof_pdf', $pdf_data);
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
    $mpdf->Output(".pdf",'I'); // opens in browser

    $data['view'] = 'Modules\MaintenanceManagement\Views\attendance\frmAttendance';
    return view('template/index', $data);
  }
}
