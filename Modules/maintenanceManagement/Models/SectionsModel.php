<?php namespace Modules\MaintenanceManagement\Models;

use App\Models\BaseModel;

class SectionsModel extends BaseModel {

  protected $table = 'sections';

  protected $allowedFields = ['year', 'section', 'deleted_at'];


  public function getSections(){
    return $this->findAll();
  }
}
