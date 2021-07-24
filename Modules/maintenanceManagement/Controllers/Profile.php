<?php namespace Modules\MaintenanceManagement\Controllers;

use App\Controllers\BaseController;
use Modules\MaintenanceManagement\Models as MaintenanceManagement;
use Modules\MaintenanceManagement\Models\UsersModel;
use Modules\userManagement\Models\RolesModel;

class Profile extends BaseController {

  function __construct(){
  }


  public function index()
  {
    helper(['form', 'url', 'html']);
    $id = $_SESSION['uid'];
    $model = new UsersModel();
    $roleModel = new RolesModel();
    $data['roles'] = $roleModel->getRoles();
    $data['rec'] = $model->getUsersWithRolesById($id);
       
    $data['view'] = 'Modules\MaintenanceManagement\Views\profile\frmUser';
    echo view('App\Views\template\index', $data);
  }

  public function edit($id){
    die('as');
    $model = new UsersModel();
    $roleModel = new RolesModel();
    $data['roles'] = $roleModel->getRoles();
    $data['rec'] = $model->getUsersWithRolesById($id);
    if(!empty($_POST))
    {
      if (!$this->validate('users'))
      {
        $data['errors'] = \Config\Services::validation()->getErrors();
          $data['function_title'] = "Profile";
          $data['view'] = 'Modules\MaintenanceManagement\Views\profile\frmUser';
          echo view('App\Views\template\index', $data);
      }
      else
      {
        if($model->editUsers($_POST, $id))
          {
            $this->activityLogsModel->addLogs($_SESSION['uid'], 'Edit Users', 'admin/profile', $id);
            $_SESSION['success'] = 'You have updated a record';
            $this->session->markAsFlashdata('success');
            return redirect()->to(base_url('admin/profile'));
          }
          else
          {
            $_SESSION['error'] = 'You an error in updating a record';
            $this->session->markAsFlashdata('error');
            return redirect()->to( base_url('admin/profile'));
          }
      }
    }
    else
    {
      $data['function_title'] = "Profile";
        $data['view'] = 'Modules\MaintenanceManagement\Views\profile\frmUser';
        echo view('App\Views\template\index', $data);
    }
  }
  }
