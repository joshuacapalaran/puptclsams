<?php namespace Modules\MaintenanceManagement\Models;

use App\Models\BaseModel;

class LabsModel extends BaseModel {

  protected $table = 'labs';

  protected $allowedFields = ['lab_name', 'status','deleted_at'];

  public function getLabsByActive(){
    return $this->where('status','a')->findAll();
  }

  public function getLabs(){
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
