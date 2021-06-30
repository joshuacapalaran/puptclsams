<?php namespace Modules\MaintenanceManagement\Models;

use App\Models\BaseModel;

class CoursesModel extends BaseModel {

  protected $table = 'courses';

  protected $allowedFields = ['course_name', 'course_abbrev', 'status', 'deleted_at'];


  public function getActiveCourse(){
    return $this->where('status','a')->findAll();
  }
  public function getCourse(){
    return $this->findAll();
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
