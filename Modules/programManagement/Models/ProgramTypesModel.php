<?php namespace Modules\ProgramManagement\Models;

use App\Models\BaseModel;

class ProgramTypesModel extends BaseModel {

  protected $table = 'program_type';

  protected $allowedFields = ['type','deleted_at'];

}