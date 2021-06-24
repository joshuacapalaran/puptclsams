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

class Home extends BaseController {


  public function index(){

    
    $schedlab = new SchedlabsModel;
    $sched = new SchedsubjsModel;
    $schedsubj = $sched->getSubjSchedules();

    $data['schedsubjects'] = $schedsubj;
    $data['view'] = 'Modules\MaintenanceManagement\Views\home\index';
    return view('template/index', $data);
  }
public function get_events(){
  $schedlabsModel = new SchedlabsModel;
  $schedModel = new SchedsubjsModel;

  $schedsubjects = $schedModel->getSubjSchedules();
  $schedlabs = $schedlabsModel->getLabSchedules();

  $data = [];
  foreach($schedsubjects as $schedsubject){

        $dow = [];
        if(!empty($schedsubject['end_day'])){
          $day = $this->getDayNumber($schedsubject['day']);
          $end_day = $this->getDayNumber($schedsubject['end_day']);
          $dow = [$day,$end_day];
        }else{
          $day = $this->getDayNumber($schedsubject['day']);
          $dow = [$day];
        }
        $data[] = [
          'title' => $schedsubject['subj_name'],
          'daysOfWeek' => $dow,
          'id' => $schedsubject['id'],
          'start' => $schedsubject['start_time']
        ];
  }

  foreach($schedlabs as $schedlab){
    $data[] = [
      'title' => $schedlab['event_name'],
      'start' => $schedlab['date']
    ];
  }

  echo json_encode($data);
}
public function getDayNumber($day){
    switch($day){
      case 'Sunday': return 0;
      break;
      case 'Monday': return 1;
      break;
      case 'Tuesday': return 2;
      break;
      case 'Wednesday': return 3;
      break;
      case 'Thursday': return 4;
      break;
      case 'Friday': return 5;
      break;
      case 'Saturday': return 6;
      break;

    }
    return false;
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


		



}
