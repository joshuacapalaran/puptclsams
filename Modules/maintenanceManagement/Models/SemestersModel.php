<?php namespace Modules\MaintenanceManagement\Models;

use App\Models\BaseModel;

class SemestersModel extends BaseModel {

  protected $table = 'semesters';

  protected $allowedFields = ['sem', 'status','deleted_at'];

  public function getActiveSemesters(){
    return $this->where('status','a')->findAll();
  }
  public function getSemesters(){
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
