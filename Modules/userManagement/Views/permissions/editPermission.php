
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid ">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-0"><?= $edit ? 'Editing': 'Adding'?>Permission</h2>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Permission</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <div class="card card-default">
          <div class="card-header">
            <!-- <h3 class="card-title">Select2 (Default Theme)</h3> -->
            
          
            <div class="card-tools">
                <?= \Config\Services::validation()->listErrors(); ?>
            <span class="d-none alert alert-success mb-3" id="res_message"></span>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-2 offset-md-10">

                  <a href="<?= base_url("Permission/edit_permission") ?>" class="btn btn-sm btn-primary btn-block float-right">Edit Permissions</a>
              </div>
            </div>
            <br>
            <?php foreach($modules as $module): ?>
              <h3><?= ucwords($module['module_name']) ?></h3>
                <table class="table">
                  <thead class="thead-dark">
                    <tr>
                      <th>#</th>
                      <th>Function Name</th>
                      <th>Allowed Roles</th>
                    </tr>
                  </thead>
                  <tbody>
                  <form method="post" action="<?= base_url('admin/permissions/edit') ?>">
                   <?php foreach($permissions as $permission): ?>
                    <?php if($permission['module_id'] == $module['id']): ?>
                      <tr>
                        <th scope="row"><?= $permission['order'] ?></th>
                        <td><?= ucwords($permission['function_name']) ?></td>
                        <td>
                          <?php foreach($roles as $role): ?>
                            <?php
                              $allowed_roles = substr($permission['allowed_roles'], 0, -1);
                              $allowed_roles = ltrim($allowed_roles, '[');
                              $finalAllowed = explode(',',$allowed_roles);
                              if(in_array($role['id'], $finalAllowed))
                              {
                                echo '<input type="checkbox" name="allowedUsers['.$permission['id'].']['.$role['id'].']" checked>';
                              }
                              else
                              {
                                echo '<input type="checkbox" name="allowedUsers['.$permission['id'].']['.$role['id'].']">';
                              }
                              echo ' '.$role['role_name'];
                            ?>
                          <?php endforeach; ?>
                        </td>
                      </tr>
                    <?php endif; ?>
                    <?php endforeach; ?>
                    </tbody>
                    </table>
                    <?php endforeach; ?>
                    <input type="submit" vaue="submit" class="btn btn-primary float-right">
                  </form>
            <br><br><br>
          </div>
        </div>
        </div>
      </div>


    <!-- /.content -->
  </div>
  