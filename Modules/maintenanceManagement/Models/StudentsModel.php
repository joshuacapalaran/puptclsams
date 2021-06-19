<?php namespace Modules\MaintenanceManagement\Models;

use App\Models\BaseModel;

class StudentsModel extends BaseModel {

  protected $table = 'students';

  protected $allowedFields = ['student_num', 'first_name', 'last_name', 'm_initial', 'suffix_id', 'course_id', 'section_id', 'deleted_at'];


  public function addRegisteredStudent($data, $user_id){
		unset($data['username']);
    unset($data['password']);
    
    $data['user_id'] = $user_id;
    $data['status'] = 'a';
    $data['created_at'] = (new \DateTime())->format('Y-m-d H:i:s');

    return $this->save($data);
  }
}
