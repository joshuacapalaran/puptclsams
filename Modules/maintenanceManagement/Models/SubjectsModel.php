<?php namespace Modules\MaintenanceManagement\Models;

use App\Models\BaseModel;

class SubjectsModel extends BaseModel {

  protected $table = 'subjects';

  protected $allowedFields = ['subj_code', 'subj_name', 'deleted_at'];


  public function getSubjects(){
    return $this->findAll();
  }

}
