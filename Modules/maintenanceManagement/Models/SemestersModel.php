<?php namespace Modules\MaintenanceManagement\Models;

use App\Models\BaseModel;

class SemestersModel extends BaseModel {

  protected $table = 'semesters';

  protected $allowedFields = ['sem', 'deleted_at'];


  public function getSemesters(){
    return $this->findAll();
  }

}
