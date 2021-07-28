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
use Modules\MaintenanceManagement\Models\CapacitiesModel;
use Modules\userManagement\Models\VisitorsModel;

class Home extends BaseController {



  public function index(){

    
    $schedlabsModel = new SchedlabsModel;
    $sched = new SchedsubjsModel;
    $holidayModel = new HolidayModel;
    $attendancesModel = new AttendancesModel;
    $capacitiesModel = new CapacitiesModel;
    $studentsModel = new StudentsModel;
    $professorsModel = new ProfessorsModel;
    $visitorsModel = new VisitorsModel;
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

    $capacities = $capacitiesModel->getAllCapacity();
    $students = $studentsModel->getStudents();
    $professors = $professorsModel->getProfessors();
    $total_registered = count($students) + count($professors);

    $total_capacities = 0;
    foreach($capacities as $capacity){

      $total_capacities += $capacity['capacity'];

    }

    $data['total_capacities'] = $total_capacities;
    $data['total_registered'] = $total_registered;
    $data['attendance'] = count($attendancesModel->getAttendances());
    $data['visitors'] = count($visitorsModel->getVisitors());
    $data['schedsubjects'] = $schedsubj;
    $data['holidays'] = $holi;
    $data['view'] = 'Modules\MaintenanceManagement\Views\home\index';
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
