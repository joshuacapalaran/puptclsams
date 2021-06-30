<?php namespace Modules\MaintenanceManagement\Models;

use App\Models\BaseModel;

class SubjectsModel extends BaseModel {

  protected $table = 'subjects';

  protected $allowedFields = ['subj_code', 'subj_name','status', 'deleted_at'];

  
  public function getActiveSubjects(){
    return $this->where('status','a')->findAll();
  }
  
  public function getSubjects(){
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
