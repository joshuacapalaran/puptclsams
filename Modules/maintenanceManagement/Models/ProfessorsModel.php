<?php namespace Modules\MaintenanceManagement\Models;

use App\Models\BaseModel;

class ProfessorsModel extends BaseModel {

  protected $table = 'professors';

  protected $allowedFields = ['user_id','f_code', 'first_name', 'last_name', 'm_initial', 'suffix_id','status', 'deleted_at'];

  //suffix
  public function getEventsFK(){
      $db = \Config\Database::connect();
      $builder = $db->table('professors p'); //db na kukuhaan
      $builder->select('p.*, pt.suffix_name'); //* = all (lahat ng fields, pwede mag error)
      $builder->join('suffixes pt', 'pt.id = p.suffix_id', 'left');
      //$builder->join('name ng table + alias', 'saan dapat mag ccross')
      //return $builder->get(); (makukua nya lahat pati mga deleted)
      return $builder->getWhere(['p.deleted_at' => null]); //kukuhain lang yung may values na null sa deleted_at
  }

  public function getProfessors(){
    $this->select('p.*, suf.suffix_name, p.id as id');
    $this->from('professors p');
    $this->distinct('p');
    $this->join('suffixes suf', 'suf.id = p.suffix_id', 'left');
    $this->where('p.status', 'a');
    return $this->findAll();
  }
  public function add($val_array){
    $val_array['status'] = 'a';
    return $this->save($val_array);
  }

  public function addProfessor($val_array, $user_id){
    $val_array['user_id'] = $user_id;
    $val_array['f_code'] = $val_array['username'];
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
