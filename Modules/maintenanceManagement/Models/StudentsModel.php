<?php namespace Modules\MaintenanceManagement\Models;

use App\Models\BaseModel;

class StudentsModel extends BaseModel {

  protected $table = 'students';

  protected $allowedFields = ['student_num', 'first_name', 'last_name', 'm_initial', 'suffix_id', 'course_id', 'section_id','status','created_at','updated_at','deleted_at'];


  public function getStudents(){
    $this->select('stud.*,sec.*,cours.*,suffixes.*, stud.id as id, stud.status as status');
    $this->from('students stud');
    $this->distinct('stud.id');
    $this->join('sections sec', 'stud.section_id = sec.id', 'inner');
    $this->join('courses cours', 'stud.course_id = cours.id','inner');
    $this->join('suffixes', 'stud.suffix_id = suffixes.id','left');
    // $this->groupBy('stud.first_name');
    $this->where('stud.deleted_at', null);
    return $this->findAll();
  }
 
  public function getStudentById($id){
    $this->where('id', $id);
    return $this->first();
  }
  public function delete_Student($id){
    return $this->delete($id);
  }

  public function getStudentByStudNum($student_num){
    $this->where('student_num', $student_num);
    return $this->first();

  }
  public function addRegisteredStudent($data, $user_id){
		unset($data['username']);
    unset($data['password']);
    
    $data['user_id'] = $user_id;
    $data['status'] = 'a';
    $data['created_at'] = (new \DateTime())->format('Y-m-d H:i:s');

    return $this->save($data);
  }

  public function add($val_array){
    $val_array['status'] = 'a';
    return $this->save($val_array);
  }
  
  public function inactive($id){
    $data['status'] = 'd';
    return $this->update($id, $data);
  }
  
  public function active($id){
    $data['status'] = 'a';
    return $this->update($id, $data);
  }
}
