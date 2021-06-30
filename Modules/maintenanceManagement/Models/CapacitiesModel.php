<?php namespace Modules\MaintenanceManagement\Models;

use App\Models\BaseModel;

class CapacitiesModel extends BaseModel {

  protected $table = 'capacities';

  protected $allowedFields = ['lab_id', 'capacity', 'status', 'deleted_at'];

  //labs
  public function getEventsFK(){
      $db = \Config\Database::connect();
      $builder = $db->table('capacities p'); //db na kukuhaan
      $builder->select('p.*, pt.lab_name'); //* = all (lahat ng fields, pwede mag error)
      $builder->join('labs pt', 'pt.id = p.lab_id');
      //$builder->join('name ng table + alias', 'saan dapat mag ccross')
      //return $builder->get(); (makukua nya lahat pati mga deleted)
      return $builder->getWhere(['p.deleted_at' => null]); //kukuhain lang yung may values na null sa deleted_at
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
