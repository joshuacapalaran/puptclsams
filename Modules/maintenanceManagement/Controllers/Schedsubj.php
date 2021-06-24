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

use \PhpOffice\PhpSpreadsheet\Spreadsheet;
use \PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

class Schedsubj extends BaseController {


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


    $data['categories'] = $categories->getCategories();
    $data['subjects'] = $subj->getSubjects();
    $data['labs'] = $labs->getLabs();
    $data['courses'] = $course->getCourse();
    $data['professor'] = $prof->getProfessors();
    $data['semesters'] = $sems->getSemesters();
    $data['schoolyears'] = $schoolyear->getSchoolYears();
    $data['sections'] = $section->getSections();
    $data['edit'] = false;
    $data['view'] = 'Modules\MaintenanceManagement\Views\schedsubj\form';
    if($this->request->getMethod() === 'post'){
      if($this->validate('schedsubj')){
        if($schedsubj->add_schedsubj($_POST)){
          $this->session->setFlashData('success_message', 'Sucessfuly created a schedsubject');
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


    $data['categories'] = $categories->getCategories();
    $data['subjects'] = $subj->getSubjects();
    $data['labs'] = $labs->getLabs();
    $data['courses'] = $course->getCourse();
    $data['professor'] = $prof->getProfessors();
    $data['semesters'] = $sems->getSemesters();
    $data['schoolyears'] = $schoolyear->getSchoolYears();
    $data['sections'] = $section->getSections();

    $data['edit'] = true;
    $data['view'] = 'Modules\MaintenanceManagement\Views\schedsubj\form';
    $data['id'] = $id;
    $data['value'] = $schedsubj->getScheduleSubjById($id);
    if(empty($data['value'])){
      die('Some Error Code Here (No Record)');
    }
    if($this->request->getMethod() === 'post'){
      if($this->validate('schedsubj')){
        if($schedsubj->edit_schedsubj($id, $_POST)){
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

    if($schedsubj->delete_schedsubj($id)) {
      $this->session->setFlashData('success_message', 'Successfully deleted schedsubject');
    } else {
      $this->session->setFlashData('error_message', 'Something went wrong!');
    }
    return redirect()->to(base_url('admin/schedsubject'));
  }

  public function attendance($id){
    $attendanceModel = new AttendancesModel();
    $schedsubj = new SchedsubjsModel;
    $data['subject'] = $schedsubj->getSubjectById($id);
    $data['attendances'] = $attendanceModel->getAttendancesBySchedule($id);
    $data['schedule_id'] = $id;
    $data['view'] = 'Modules\MaintenanceManagement\Views\schedsubj\frmAttendance';
    return view('template/index', $data);

  }

  	
public function verify(){
	$studentModel = new StudentsModel();
	$attendanceModel = new AttendancesModel();
	$students = $studentModel->getStudentByStudNum($_POST['student_num']);
	if(!empty($students) ) {
    $data['schedule_id'] = $_POST['schedule_id'];
    $data['student_id'] = $students['id'];
    $data['student_number'] = $_POST['student_num'];

		$attendance = $attendanceModel->getAttendance($students['id']);

		if (empty($attendance)) {
			if($attendanceModel->insertAttendance($data)){
				$_SESSION['success'] = 'You have succesfully time in!';
				$this->session->markAsFlashdata('success');
				return redirect()->to(base_url('admin/schedsubject/attendance/'.$_POST['schedule_id']));
			} else {
				$_SESSION['success'] = 'Something Went Wrong!';
				$this->session->markAsFlashdata('error');
				return redirect()->to(base_url('admin/schedsubject/attendance/'.$_POST['schedule_id']));
			}
		} else {
			$_SESSION['error'] = 'You already time-in this day';
			$this->session->markAsFlashdata('error');
			return redirect()->to(base_url('admin/schedsubject/attendance/'.$_POST['schedule_id']));
		}

	} else{
		$_SESSION['error1'] = 'Student Number Not Found';
		$this->session->markAsFlashdata('error1');
		return redirect()->to(base_url('admin/schedsubject/attendance/'.$_POST['schedule_id']));
	}
}

public function attendance_time_out(){
  $studentModel = new StudentsModel();
	$attendanceModel = new AttendancesModel();
  $students = $studentModel->getStudentByStudNum($_POST['student_num']);

	if(!empty($students) ) {
    $attendance = $attendanceModel->getAttendance($students['id']);
  
		if ($attendance[0]['timeout'] == null) {
    
			if ($attendanceModel->timeOut($attendance[0]['id'])) {
				$_SESSION['success'] = 'You have succesfully time out!';
				$this->session->markAsFlashdata('success');
				return redirect()->to(base_url('admin/schedsubject/attendance/'.$_POST['schedule_id']));
			} else {
				$_SESSION['error'] = 'Something Went Wrong!';
				$this->session->markAsFlashdata('error');
				return redirect()->to(base_url('admin/schedsubject/attendance/'.$_POST['schedule_id']));
			}
		}else{
			// if($attendanceModel->insertAttendance($data)){
			// 	$_SESSION['success'] = 'You have succesfully time in!';
			// 	$this->session->markAsFlashdata('success');
			// 	return redirect()->to(base_url('attendance'));
			// }else{
				$_SESSION['error'] = "You cant time out again! Please Time-in on another day!";
				$this->session->markAsFlashdata('error');
				return redirect()->to(base_url('admin/schedsubject/attendance/'.$_POST['schedule_id']));
			// }
		}
	} else{
		$_SESSION['error1'] = 'Student Number Not Found';
		$this->session->markAsFlashdata('error1');
		return redirect()->to(base_url('admin/schedsubject/attendance/'.$_POST['schedule_id']));
	}
		
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
