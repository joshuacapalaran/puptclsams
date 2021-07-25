
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid ">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-0">View User</h2>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Users</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="card card-outline card-secondary">
       
            <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="first_name">First name*</label>
                      <input name="first_name" type="text" value="<?= isset($rec['first_name']) ? $rec['first_name'] : set_value('first_name') ?>" class="form-control <?= isset($errors['first_name']) ? 'is-invalid':' ' ?>" id="first_name" placeholder="First Name" readonly>
                      <?php if(isset($errors['first_name'])):?>
                        <p class="text-danger"><?=esc($errors['first_name'])?><p>
                      <?php endif;?>  
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="last_name">Last Name*</label>
                      <input name="last_name" type="text" value="<?= isset($rec['last_name']) ? $rec['last_name'] : set_value('last_name') ?>" class="form-control <?= isset($errors['last_name']) ? 'is-invalid':' '  ?>" id="last_name" placeholder="Last Name" readonly>
                      <?php if(isset($errors['last_name'])):?>
                        <p class="text-danger"><?=esc($errors['last_name'])?><p>
                      <?php endif;?>  
                    </div>
                  </div>

                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="m_initial">M Initial*</label>
                      <input name="m_initial" type="text" value="<?= isset($rec['m_initial']) ? $rec['m_initial'] : set_value('m_initial') ?>" class="form-control <?= isset($errors['m_initial']) ? 'is-invalid':' '  ?>" id="m_initial" placeholder="M Initial" readonly>
                      <?php if(isset($errors['m_initial'])):?>
                        <p class="text-danger"><?=esc($errors['m_initial'])?><p>
                      <?php endif;?>  
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="username">User Name*</label>
                      <input name="username" type="text" value="<?= isset($rec['username']) ? $rec['username'] : set_value('username') ?>" class="form-control <?= isset($errors['username']) ? 'is-invalid':' '  ?>" id="username" placeholder="User name" readonly>
                      <?php if(isset($errors['username'])):?>
                        <p class="text-danger"><?=esc($errors['username'])?><p>
                      <?php endif;?>  
                    </div>
                  </div>

                  
                </div>
              
               

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="password">Password*</label>
                      <input name="password" type="password" value="<?= isset($rec['password']) ? $rec['password'] : set_value('password') ?>" class="form-control <?= isset($errors['password']) ? 'is-invalid':' '  ?>" id="password" placeholder="Password" readonly>
                      <?php if(isset($errors['password'])):?>
                        <p class="text-danger"><?=esc($errors['password'])?><p>
                      <?php endif;?>  
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="username">Role*</label>
                      <select name="role_id" class="form-control <?= isset($errors['role_id']) ? 'is-invalid':' ' ?>" readonly disabled>
                      <option selected disabled >Please select role</option>
                      <?php foreach($roles as $role): ?>
                        <option value="<?= $role['id'] ?>" <?= ($role['id'] == $rec['role_id'] ? 'selected':'')?>><?= ucwords($role['role_name']) ?></option>
                      <?php endforeach; ?>
                    </select>
                      <?php if(isset($errors['role_id'])):?>
                        <p class="text-danger"><?=esc($errors['role_id'])?><p>
                      <?php endif;?>  
                    </div>
                  </div>

                  
                </div>
               
            </div>
  
      </div>
    </div>
  </div>


    <!-- /.content -->
</div>