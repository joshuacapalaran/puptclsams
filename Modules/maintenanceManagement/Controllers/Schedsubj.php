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
use Modules\MaintenanceManagement\Models\ActivityLogsModel;

use \PhpOffice\PhpSpreadsheet\Spreadsheet;
use \PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

class Schedsubj extends BaseController {

  function __construct(){
    $this->activityLogsModel = new ActivityLogsModel;
  }
  public function index(){

    
    $sched = new SchedsubjsModel;
    $schedsubj = $sched->getSubjSchedules();
    $data['schedsubjects'] = $schedsubj;
    $data['view'] = 'Modules\MaintenanceManagement\Views\schedsubj\index';
    return view('template/index', $data);
  }

  public function add(){
    $subj = new SubjectsModel;
    $course = new CoursesModel;
    $categories = new CategoriesModel;
    $prof = new ProfessorsModel;
    $labs = new LabsModel;
    $sems = new SemestersModel;
    $schoolyear = new SchoolyearsModel;
    $schedsubj = new SchedsubjsModel;
    $section = new SectionsModel;

  
    $data['categories'] = $categories->getActiveCategories();
    $data['subjects'] = $subj->getActiveSubjects();
    $data['labs'] = $labs->getLabsByActive();
    $data['courses'] = $course->getActiveCourse();
    $data['professor'] = $prof->getProfessors();
    $data['semesters'] = $sems->getActiveSemesters();
    $data['schoolyears'] = $schoolyear->getActiveSchoolYears();
    $data['sections'] = $section->getActiveSections();
    $data['edit'] = false;
    $data['view'] = 'Modules\MaintenanceManagement\Views\schedsubj\form';
    if($this->request->getMethod() === 'post'){
      if($this->validate('schedsubj')){
        if($_POST['day']){
           $_POST['day'] = implode(',',$_POST['day']);
        }
    
        if($schedsubj->add_schedsubj($_POST)){
          $this->activityLogsModel->addLogs($_SESSION['uid'], 'Add Sched Subject', 'admin/schedsubject', json_encode($_POST));
          $this->session->setFlashData('success_message', 'Sucessfuly created a schedsubject');
        } else {
          $this->session->setFlashData('error_message', 'Something went wrong!');
        }
        return redirect()->to(base_url('admin/schedsubject'));
      } else {
        // $data['value'] = $_POST;
        $data['errors'] = $this->validation->getErrors();
      }
    }
    return view('template/index', $data);
  }

  public function edit($id){

    $subj = new SubjectsModel;
    $course = new CoursesModel;
    $categories = new CategoriesModel;
    $prof = new ProfessorsModel;
    $labs = new LabsModel;
    $sems = new SemestersModel;
    $schoolyear = new SchoolyearsModel;
    $schedsubj = new SchedsubjsModel;
    $section = new SectionsModel;


    $data['categories'] = $categories->getActiveCategories();
    $data['subjects'] = $subj->getActiveSubjects();
    $data['labs'] = $labs->getLabsByActive();
    $data['courses'] = $course->getActiveCourse();
    $data['professor'] = $prof->getProfessors();
    $data['semesters'] = $sems->getActiveSemesters();
    $data['schoolyears'] = $schoolyear->getActiveSchoolYears();
    $data['sections'] = $section->getActiveSections();

    $data['edit'] = true;
    $data['view'] = 'Modules\MaintenanceManagement\Views\schedsubj\form';
    $data['id'] = $id;
    $data['value'] = $schedsubj->getScheduleSubjById($id);
    if(empty($data['value'])){
      die('Some Error Code Here (No Record)');
    }
    if($this->request->getMethod() === 'post'){
      if($this->validate('schedsubj')){
        if($_POST['day']){
            $_POST['day'] = implode(',',$_POST['day']);
        }
        if($schedsubj->edit_schedsubj($id, $_POST)){
          $this->activityLogsModel->addLogs($_SESSION['uid'], 'Edit Sched Subject', 'admin/schedsubject', $id);
          $this->session->setFlashData('success_message', 'Sucessfuly edited a schedsubject');
        } else {
          $this->session->setFlashData('error_message', 'Something went wrong!');
        }
        return redirect()->to(base_url('admin/schedsubject'));
      } else {
        $data['value'] = $_POST;
        $data['errors'] = $this->validation->getErrors();
      }
    }
    return view('template/index', $data);
  }

  public function delete($id){
    $schedsubj = new SchedsubjsModel;

    if($schedsubj->inactive($id)) {
          $this->activityLogsModel->addLogs($_SESSION['uid'], 'Archive Sched Subject', 'admin/schedsubject', $id);
          $this->session->setFlashData('success_message', 'Successfully deleted schedsubject');
    } else {
      $this->session->setFlashData('error_message', 'Something went wrong!');
    }
    return redirect()->to(base_url('admin/schedsubject'));
  }

  public function active($id){
    $schedsubj = new SchedsubjsModel;

    if($schedsubj->active($id)) {
          $this->activityLogsModel->addLogs($_SESSION['uid'], 'Restore Sched Subject', 'admin/schedsubject', $id);
          $this->session->setFlashData('success_message', 'Successfully restored schedsubject');
    } else {
      $this->session->setFlashData('error_message', 'Something went wrong!');
    }
    return redirect()->to(base_url('admin/schedsubject'));
  }

  public function view($id){
    $subj = new SubjectsModel;
    $course = new CoursesModel;
    $categories = new CategoriesModel;
    $prof = new ProfessorsModel;
    $labs = new LabsModel;
    $sems = new SemestersModel;
    $schoolyear = new SchoolyearsModel;
    $schedsubj = new SchedsubjsModel;
    $section = new SectionsModel;


    $data['categories'] = $categories->getActiveCategories();
    $data['subjects'] = $subj->getActiveSubjects();
    $data['labs'] = $labs->getLabsByActive();
    $data['courses'] = $course->getActiveCourse();
    $data['professor'] = $prof->getProfessors();
    $data['semesters'] = $sems->getActiveSemesters();
    $data['schoolyears'] = $schoolyear->getActiveSchoolYears();
    $data['sections'] = $section->getActiveSections();

    $data['view'] = 'Modules\MaintenanceManagement\Views\schedsubj\view';
    $data['id'] = $id;
    $data['value'] = $schedsubj->getScheduleSubjById($id);
    return view('template/index', $data);

  }

public function report($id){
  $attendanceModel = new AttendancesModel();
  $schedsubj = new SchedsubjsModel;
  
  $schedule = $schedsubj->getScheduleSubjDetailsById($id);
  $attendances = $attendanceModel->getScheduleAttendanceById($id);
  $spreadsheet = new Spreadsheet();
  $sheet = $spreadsheet->getActiveSheet();
  $htmlString = "<p>Time: </p>
      <table  class='table table-bordered table-striped'>
                    <thead>
                      <tr>
                      <th>Date</th>
                      <th></th>
                      </tr>
                      <tr class='text-center'>
                        <th>Name</th>
                        <th>Time in</th>
                        <th>Time out</th>
                      </tr>
                    </thead>
          <tbody>
            <tr>
              <td>Hello World</td>
            </tr>
            
          </tbody>
</table>";

$reader = new \PhpOffice\PhpSpreadsheet\Reader\Html();
$spreadsheet = $reader->loadFromString($htmlString);


  $writer = new Xlsx($spreadsheet);
  $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Mpdf");
  // die();
  
  $writer->save('hello world.pdf');
  // header("Content-Type: application/vnd.ms-excel");

  header('Content-Disposition: attachment; filename="' . basename('hello world.pdf') . '"');

  header('Expires: 0');

  header('Cache-Control: must-revalidate');

  header('Pragma: public');

  header('Content-Length:' . filesize('hello world.pdf'));

  flush();

  readfile('hello world.pdf');

  exit;
}
}
