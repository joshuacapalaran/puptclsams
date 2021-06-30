<?php namespace Modules\MaintenanceManagement\Models;

use App\Models\BaseModel;

class SectionsModel extends BaseModel {

  protected $table = 'sections';

  protected $allowedFields = ['year', 'section', 'status', 'deleted_at'];

  public function getActiveSections(){
    return $this->where('status','a')->findAll();
  }

  public function getSections(){
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
