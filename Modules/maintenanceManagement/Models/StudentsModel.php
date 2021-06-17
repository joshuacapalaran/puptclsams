<?php namespace Modules\MaintenanceManagement\Models;

use App\Models\BaseModel;

class StudentsModel extends BaseModel {

  protected $table = 'students';

  protected $allowedFields = ['student_num', 'first_name', 'last_name', 'm_initial', 'suffix_id', 'course_id', 'section_id', 'deleted_at'];

}
