<?php namespace Modules\MaintenanceManagement\Models;

use App\Models\BaseModel;

class CategoriesModel extends BaseModel {

  protected $table = 'categories';

  protected $allowedFields = ['category', 'status','deleted_at'];

  public function getActiveCategories(){
    return $this->where('status','a')->findAll();
  }
  public function getCategories(){
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
