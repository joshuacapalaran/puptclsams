<?php namespace Modules\MaintenanceManagement\Models;

use App\Models\BaseModel;

class ActivityLogsModel extends BaseModel {

  protected $table = 'activity_logs';

  protected $allowedFields = ['user_id', 'description','properties','data','created_at','updated_at'];

 
  public function getActivityLogs(){
    $this->select('activity_logs.id as id, activity_logs.description,activity_logs.properties,activity_logs.data,activity_logs.created_at');
    $this->join('users','users.id = activity_logs.user_id');
    return $this->findAll();
  }

  public function addLogs($user_id,$description,$properties,$data){
    date_default_timezone_set('Asia/Singapore');
    $val_array['user_id'] = $user_id;
    $val_array['description'] = $description;
    $val_array['properties'] = $properties;
    $val_array['data'] = $data;
    $val_array['created_at'] = date('y-m-d H:i:s');

    return $this->save($val_array);
  }
  

}
