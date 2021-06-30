<?php namespace Modules\MaintenanceManagement\Controllers;

use App\Controllers\BaseController;
use Modules\MaintenanceManagement\Models as MaintenanceManagement;
use Modules\MaintenanceManagement\Models\SectionsModel;

class Sections extends BaseController {

  function __construct(){
    $this->sectionsModel = new MaintenanceManagement\sectionsModel();
  }

  public function index(){
    $data['sections'] = $this->sectionsModel->get();
    $data['view'] = 'Modules\MaintenanceManagement\Views\sections\index';
    return view('template/index', $data);
  }

  public function add(){
    $sectionModel = new SectionsModel;
    $data['edit'] = false;
    $data['view'] = 'Modules\MaintenanceManagement\Views\sections\form';
    if($this->request->getMethod() === 'post'){
      if($this->validate('sections')){
        if( $sectionModel->add($_POST)){
          $this->session->setFlashData('success_message', 'Sucessfuly created a section');
        } else {
          $this->session->setFlashData('error_message', 'Something went wrong!');
        }
        return redirect()->to(base_url('admin/sections'));
      } else {
        $data['value'] = $_POST;
        $data['errors'] = $this->validation->getErrors();
      }
    }
    return view('template/index', $data);
  }

  public function edit($id){
    $data['edit'] = true;
    $data['view'] = 'Modules\MaintenanceManagement\Views\sections\form';
    $data['id'] = $id;
    $data['value'] = $this->sectionsModel->get(['id' => $id])[0];
    if(empty($data['value'])){
      die('Some Error Code Here (No Record)');
    }
    if($this->request->getMethod() === 'post'){
      if($this->validate('sections')){
        if($this->sectionsModel->edit($id, $_POST)){
          $this->session->setFlashData('success_message', 'Sucessfuly edited a section');
        } else {
          $this->session->setFlashData('error_message', 'Something went wrong!');
        }
        return redirect()->to(base_url('admin/sections'));
      } else {
        $data['value'] = $_POST;
        $data['errors'] = $this->validation->getErrors();
      }
    }
    return view('template/index', $data);
  }

  public function delete($id){
    $sectionModel = new SectionsModel;

    if( $sectionModel->inactive($id)) {
      $this->session->setFlashData('success_message', 'Successfully deleted section');
    } else {
      $this->session->setFlashData('error_message', 'Something went wrong!');
    }
    return redirect()->to(base_url('admin/sections'));
  }
  public function active($id){
    $sectionModel = new SectionsModel;

    if( $sectionModel->active($id)) {
      $this->session->setFlashData('success_message', 'Successfully restored section');
    } else {
      $this->session->setFlashData('error_message', 'Something went wrong!');
    }
    return redirect()->to(base_url('admin/sections'));
  }

  public function view($id){
    $data['view'] = 'Modules\MaintenanceManagement\Views\sections\view';
    $data['id'] = $id;
    $data['value'] = $this->sectionsModel->get(['id' => $id])[0];
    return view('template/index', $data);
  }

}
