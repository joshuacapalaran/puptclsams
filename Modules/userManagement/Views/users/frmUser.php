<br><div class="card bg-light ">
  <div class="card-body">
     <div class="row">
       <div class="col-md-10">
         <h3> <?=$function_title?> </h3>
       </div>
       <div class="col-md-2">
         <!--  <a href="<?= base_url() ?>node/add" class="btn btn-sm btn-primary btn-block float-right">Add Node</a> -->
       </div>
     </div>
    <br>
    <div class="row">
      <div class="col-md-12">
        <form action="<?= base_url() ?>users/<?= isset($rec) ? 'edit/'.$rec['id'] : 'add' ?>" method="post">
          <div class="row">
            <div class="col-md-5 offset-md-1">
              <div class="form-group">
                <label for="firstname">Firstname</label>
                <input name="firstname" type="text" value="<?= isset($rec['firstname']) ? $rec['firstname'] : set_value('firstname') ?>" class="form-control <?= isset($errors['firstname']) ? 'is-invalid':' ' ?>" id="firstname" placeholder="Firstname">
                  <?php if(isset($errors['firstname'])): ?>
                    <div class="invalid-feedback">
                      <?= $errors['firstname'] ?>
                    </div>
                  <?php endif; ?>
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group">
                <label for="lastname">Lastname</label>
                <input name="lastname" type="text" value="<?= isset($rec['lastname']) ? $rec['lastname'] : set_value('lastname') ?>" class="form-control <?= isset($errors['lastname']) ? 'is-invalid':' ' ?>" id="lastname" placeholder="Lastname">
                  <?php if(isset($errors['lastname'])): ?>
                    <div class="invalid-feedback">
                      <?= $errors['lastname'] ?>
                    </div>
                  <?php endif; ?>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-5 offset-md-1">
              <div class="form-group">
                <label for="username">Username</label>
                <input name="username" type="text" value="<?= isset($rec['username']) ? $rec['username'] : set_value('username') ?>" class="form-control <?= isset($errors['username']) ? 'is-invalid':' ' ?>" id="username" placeholder="Username">
                  <?php if(isset($errors['username'])): ?>
                    <div class="invalid-feedback">
                      <?= $errors['username'] ?>
                    </div>
                  <?php endif; ?>
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group">
                <label for="email">Email</label>
                <input name="email" type="email" value="<?= isset($rec['email']) ? $rec['email'] : set_value('email') ?>" class="form-control <?= isset($errors['email']) ? 'is-invalid':' ' ?>" id="email" placeholder="Email">
                  <?php if(isset($errors['email'])): ?>
                    <div class="invalid-feedback">
                      <?= $errors['email'] ?>
                    </div>
                  <?php endif; ?>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-5 offset-md-1">
              <div class="form-group">
                <label for="password">Password</label>
                <input name="password" type="password" value="<?= isset($rec['password']) ? '': set_value('password') ?>" class="form-control <?= isset($errors['password']) ? 'is-invalid':' ' ?>" id="password" placeholder="Password">
                  <?php if(isset($errors['password'])): ?>
                    <div class="invalid-feedback">
                      <?= $errors['password'] ?>
                    </div>
                  <?php endif; ?>
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group">
                <label for="password_retype">Password Re-type</label>
                <input name="password_retype" type="password" value="<?= isset($rec['password']) ? '' : set_value('password_retype') ?>" class="form-control <?= isset($errors['password_retype']) ? 'is-invalid':' ' ?>" id="password_retype" placeholder="Password Re-type">
                  <?php if(isset($errors['password_retype'])): ?>
                    <div class="invalid-feedback">
                      <?= $errors['password_retype'] ?>
                    </div>
                  <?php endif; ?>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-5 offset-md-1">
              <div class="form-group">
                <label for="birthdate">Birthdate</label>
                <input name="birthdate" type="date" value="<?= isset($rec['birthdate']) ? $rec['birthdate'] : set_value('birthdate') ?>" class="form-control <?= isset($errors['birthdate']) ? 'is-invalid':' ' ?>" id="birthdate" placeholder="Birthdate">
                  <?php if(isset($errors['birthdate'])): ?>
                    <div class="invalid-feedback">
                      <?= $errors['birthdate'] ?>
                    </div>
                  <?php endif; ?>
              </div>
            </div>
            <div class="col-md-5">
              <label for="role_id">User Role</label>
              <select name="role_id" class="form-control <?= isset($errors['role_id']) ? 'is-invalid':' ' ?>">
                <?php if(isset($rec['role_id'])): ?>
                  <option value="<?= $rec['role_id'] ?>"><?= name_on_system($rec['role_id'], $roles, 'roles') ?></option>
                <?php else: ?>
                  <option value="">Select User Role</option>
                <?php endif; ?>

                <?php foreach($roles as $role): ?>
                  <option value="<?= $role['id'] ?>"><?= ucwords($role['role_name']) ?></option>
                <?php endforeach; ?>
              </select>
               <?php if(isset($errors['role_id'])): ?>
                  <div class="invalid-feedback">
                    <?= $errors['role_id'] ?>
                  </div>
                <?php endif; ?>
            </div>
          </div>
          <button type="submit" class="btn btn-primary float-right">Submit</button>
        </form>
        <p style="clear: both"></p>
      </div>
    </div>
    </div>
    </div>
