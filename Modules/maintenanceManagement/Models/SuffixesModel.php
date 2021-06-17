<?php namespace Modules\MaintenanceManagement\Models;

use App\Models\BaseModel;

class SuffixesModel extends BaseModel {

  protected $table = 'suffixes';

  protected $allowedFields = ['suffix_name', 'deleted_at'];

}
