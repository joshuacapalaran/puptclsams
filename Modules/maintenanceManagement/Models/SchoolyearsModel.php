<?php namespace Modules\MaintenanceManagement\Models;

use App\Models\BaseModel;

class SchoolyearsModel extends BaseModel {

  protected $table = 'schoolyears';

  protected $allowedFields = ['start_sy', 'end_sy', 'deleted_at'];

  public function getSchoolYears(){
    return $this->findAll();
  }

}
