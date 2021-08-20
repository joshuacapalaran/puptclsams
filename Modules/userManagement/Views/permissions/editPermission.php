
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid ">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-0"><?= $edit ? 'Editing': 'Adding'?> Permission</h2>
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
    <div class="col">
      <div class="card card-outline card-warning shadow-sm">
              <div class="card-header">
                <h4 class="card-title">Warning : Changes affects users permission to access each transactions.</h4>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
       </div>
            <!-- /.card -->
    </div>

    <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <div class="card card-outline card-info">
          <div class="card-header">
            <!-- <h3 class="card-title">Select2 (Default Theme)</h3> -->
              <!-- <div class="col-md-2 offset-md-10">
                  <a href="<?= base_url("admin/permissions/edit") ?>" class="btn btn-sm btn-primary btn-block float-right">Edit Permissions</a>
              </div>
             -->
          
            <div class="card-tools">
                <?= \Config\Services::validation()->listErrors(); ?>
            <span class="d-none alert alert-success mb-3" id="res_message"></span>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
            </div>
            <br>
            <?php foreach($modules as $module): ?>
              <h3><?= ucwords($module['module_name']) ?></h3>
                <table class="table" id="<?= str_replace(' ', '_', $module['module_name'])?>">
                  <thead class="thead-dark">
                    <tr>
                      <th>#</th>
                      <th>Function Name</th>
                      <th>Allowed Roles 
                      <?php foreach($roles as $role): ?>
                        <?php if($role['role_name'] !== 'Super administrator'):?>
                          &nbsp<input class='header_<?= str_replace(' ', '_',$role['role_name'])?>' type="checkbox" name="chk">
                          <?php
                                  echo ' '.$role['role_name'];
                          
                          ?>
                        <?php endif;?>

                          <?php endforeach; ?>
                          
                          </th>
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
                                        echo '<input class='.str_replace(" ", "_", $role["role_name"]).' type="checkbox" name="allowedUsers['.$permission['id'].']['.$role['id'].']" checked>';
                                      }
                                      else
                                      {
                                        echo '<input class='.str_replace(" ", "_", $role["role_name"]).' type="checkbox" name="allowedUsers['.$permission['id'].']['.$role['id'].']">';
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
  <script>
var roles = JSON.parse('<?= json_encode($roles);?>');
var modules = JSON.parse(JSON.stringify(<?= json_encode($modules);?>));
                      
$(document).ready(function(){
  modules.forEach( function(modules){
      roles.forEach(function(role){
        
        $('.header_'+role.role_name.replace(' ', '_')).change(function(e){
          var table = $(e.target).closest('table');
          console.log(table)

          table.find('input.'+role.role_name.replace(' ', '_')).prop('checked', true);
          
          if(!$(this).prop("checked")) {
            table.find('input.'+role.role_name.replace(' ', '_')).prop('checked', false);
          }

        });
      });

    });
    
});

</script>