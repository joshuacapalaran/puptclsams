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

class Schedules extends BaseController {


public function index(){

    
    $schedlab = new SchedlabsModel;
    $sched = new SchedsubjsModel;
    $schedsubj = $sched->getSubjSchedules();

    $data['schedsubjects'] = $schedsubj;
    $data['view'] = 'Modules\MaintenanceManagement\Views\schedules\index';
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

  foreach($schedlabs as $schedlab){
    $data[] = [
      'title' => $schedlab['event_name'],
      'start' => $schedlab['date'],
      'id' => $schedlab['id'],
      'extendedProps' => [
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

}
