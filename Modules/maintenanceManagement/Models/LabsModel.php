<?php namespace Modules\MaintenanceManagement\Models;

use App\Models\BaseModel;

class LabsModel extends BaseModel {

  protected $table = 'labs';

  protected $allowedFields = ['lab_name', 'deleted_at'];


  public function getLabs(){
    return $this->findAll();
  }

}
