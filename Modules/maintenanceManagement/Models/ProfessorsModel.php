<?php namespace Modules\MaintenanceManagement\Models;

use App\Models\BaseModel;

class ProfessorsModel extends BaseModel {

  protected $table = 'professors';

  protected $allowedFields = ['f_code', 'first_name', 'last_name', 'm_initial', 'suffix_id', 'deleted_at'];

  //suffix
  public function getEventsFK(){
      $db = \Config\Database::connect();
      $builder = $db->table('professors p'); //db na kukuhaan
      $builder->select('p.*, pt.suffix_name'); //* = all (lahat ng fields, pwede mag error)
      $builder->join('suffixes pt', 'pt.id = p.suffix_id');
      //$builder->join('name ng table + alias', 'saan dapat mag ccross')
      //return $builder->get(); (makukua nya lahat pati mga deleted)
      return $builder->getWhere(['p.deleted_at' => null]); //kukuhain lang yung may values na null sa deleted_at
  }

  public function getProfessors(){
    $this->select('p.*, suf.suffix_name, p.id as id');
    $this->from('professors p');
    $this->distinct('p');
    $this->join('suffixes suf', 'suf.id = p.suffix_id');
    $this->where('p.deleted_at', null);
    return $this->findAll();
  }
}
