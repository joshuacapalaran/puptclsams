
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid ">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-0"><?= $edit ? 'Editing': 'Adding'?> Role</h2>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Roles</li>
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
          <!-- /.card-header -->
        <form action="<?= base_url("admin/roles")?>/<?= $rec ? 'edit/'.esc($rec['id']): 'add'?>" method="post" accept-charset="utf-8">
          <div class="card-body">
    

          <div class="row">
            <div class="col-md-6 offset-md-3">
              <div class="form-group">
                <label for="role_name">Role name</label>
                <input name="role_name" type="text" value="<?= isset($rec['role_name']) ? $rec['role_name'] : set_value('role_name') ?>" class="form-control <?= isset($errors['role_name']) ? 'is-invalid':' ' ?>" id="role_name" placeholder="Role Name">
                <?php if(isset($errors['role_name'])):?>
                  <p class="text-danger"><?=esc($errors['role_name'])?><p>
                <?php endif;?>  
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 offset-md-3">
              <div class="form-group">
                <label for="description">Role Description</label>
                <textarea name="description" type="text" class="form-control <?= isset($errors['description']) ? 'is-invalid':' '  ?>" id="description" placeholder="Role Description" rows="5"><?= isset($rec['description']) ? $rec['description'] : set_value('description') ?></textarea>
                <?php if(isset($errors['role_name'])):?>
                  <p class="text-danger"><?=esc($errors['role_name'])?><p>
                <?php endif;?>  
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-6 offset-md-3">
              <div class="form-group">
                <!-- <label for="function_id">Landing Page</label>
                <input type="hidden" value="1" name="function_id"> -->
                <label for="function_id">Role's Landing Page</label>
                <select name="function_id" class="form-control <?= isset($errors['function_id']) ? 'is-invalid':' ' ?>">
                  <?php if(isset($rec['function_id'])): ?>
                    <option value="<?= $rec['function_id'] ?>"><?= ucwords(name_on_system($rec['function_id'], $permissions, 'permissions')) ?></option>
                  <?php else: ?>
                    <option value="">Select Landing Page</option>
                  <?php endif; ?>

                  <?php foreach($permissions as $permission): ?>
                    <option value="<?= $permission['id'] ?>"><?= ucwords($permission['function_name']) ?></option>
                  <?php endforeach; ?>
                </select>
                <?php if(isset($errors['role_name'])):?>
                  <p class="text-danger"><?=esc($errors['role_name'])?><p>
                <?php endif;?>  
              </div>
            </div>
          </div>
                <!-- /.form-group -->

                <div class="row">
            <div class="col-md-6 offset-md-3">
              <button type="submit" class="btn btn-primary float-right">Submit</button>
            </div>
          </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
  
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
        </form>
        </div>
        </div>
      </div>


    <!-- /.content -->
  </div>