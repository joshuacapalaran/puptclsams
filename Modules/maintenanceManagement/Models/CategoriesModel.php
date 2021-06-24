<?php namespace Modules\MaintenanceManagement\Models;

use App\Models\BaseModel;

class CategoriesModel extends BaseModel {

  protected $table = 'categories';

  protected $allowedFields = ['category', 'deleted_at'];

  public function getCategories(){
    return $this->findAll();
  }

}
