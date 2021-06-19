<?php namespace App\Models;

use CodeIgniter\Model;

class BaseModel extends Model 
{
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;

  protected $useSoftDeletes = true;


  protected $useTimestamps = true;
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
  protected $deletedField  = 'deleted_at';

  public function get($conditions = []){
    foreach($conditions as $key => $value){
      $this->where($key, $value);
    }

    return $this->findAll();
  }

  public function add($data){
    return $this->insert($data);
  }

  public function edit($id, $data){
    return $this->update($id, $data);
  } 

  public function softDelete($id){
    return $this->delete($id);
  }

}