<?php namespace Modules\MaintenanceManagement\Models;

use App\Models\BaseModel;

class CoursesModel extends BaseModel {

  protected $table = 'courses';

  protected $allowedFields = ['course_name', 'course_abbrev', 'deleted_at'];


  public function getCourse(){
    return $this->findAll();
  }

}
