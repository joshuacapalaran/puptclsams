<?php namespace Modules\MaintenanceManagement\Models;

use App\Models\BaseModel;

class ActivityLogsModel extends BaseModel {

  protected $table = 'activity_logs';

  protected $allowedFields = ['user_id', 'description','properties','data','created_at','updated_at'];

 
  public function getActivityLogs(){
    $this->join('users','users.id = activity_logs.user_id');
    return $this->findAll();
  }

  public function addLogs($user_id,$description,$properties,$data){
    $val_array['user_id'] = $user_id;
    $val_array['description'] = $description;
    $val_array['properties'] = $properties;
    $val_array['data'] = $data;
    return $this->save($val_array);
  }
  

}
