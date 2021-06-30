<?php namespace Modules\MaintenanceManagement\Models;

use App\Models\BaseModel;

class SchoolyearsModel extends BaseModel {

  protected $table = 'schoolyears';

  protected $allowedFields = ['start_sy', 'end_sy', 'status', 'deleted_at'];


  public function getActiveSchoolYears(){
    return $this->where('status','a')->findAll();
  }

  public function getSchoolYears(){
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
