<?php namespace Modules\MaintenanceManagement\Models;

use App\Models\BaseModel;

class HolidayModel extends BaseModel {

  protected $table = 'holiday';

  protected $allowedFields = ['name', 'date','schedlab_id','schedsubj_id','status', 'deleted_at'];


  public function getActiveHolidays(){
    return $this->where('status','a')->findAll();
  }
  public function getCancelDates(){
    return $this->select('schedlab_id , schedsubj_id, date, status')->findAll();
  }

  public function getHolidays(){
    return $this->findAll();
  }

  public function add($val_array){
    $val_array['status'] = 'a';
    return $this->save($val_array);
  }
  public function cancel($val_array){
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
