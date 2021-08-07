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
    $data['attendances'] = $attendanceModel->getAttendancesByStudent();
    $data['view'] = 'Modules\MaintenanceManagement\Views\attendance\frmAttendance';
    return view('template/index', $data);
  }

  public function pdf(){
    $attendanceModel = new AttendancesModel();
    $studentModel = new StudentsModel();
    $schedsubj = new SchedsubjsModel;
    
    $mpdf = new \Mpdf\Mpdf();
    $pdf_data['attendances'] = $attendanceModel->getAttendancesByStudent();
    $pdf_data['headers'] = $attendanceModel->getAttendancesGroupByDate();
    $pdf_data['times'] = $attendanceModel->getAttendancesByTime();

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
}
