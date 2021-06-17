<?php namespace Modules\ProgramManagement\Models;

use App\Models\BaseModel;

class ProgramsModel extends BaseModel {

  protected $table = 'programs';

  protected $allowedFields = ['program', 'abbreviation','description','program_type','deleted_at'];

  //program types
  public function getEventsFK(){
      $db = \Config\Database::connect();
      $builder = $db->table('programs p'); //db na kukuhaan
      $builder->select('p.*, pt.type'); //* = all (lahat ng fields, pwede mag error)
      $builder->join('program_type pt', 'pt.id = p.program_type');
      //$builder->join('name ng table + alias', 'saan dapat mag ccross')
      //return $builder->get(); (makukua nya lahat pati mga deleted)
      return $builder->getWhere(['p.deleted_at' => null]); //kukuhain lang yung may values na null sa deleted_at
    }
}