
<br>
<div class="card bg-light ">
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
        <form action="<?= base_url() ?>roles/<?= isset($rec) ? 'edit/'.$rec['id'] : 'add' ?>" method="post">
          <div class="row">
            <div class="col-md-6 offset-md-3">
              <div class="form-group">
                <label for="role_name">Role name</label>
                <input name="role_name" type="text" value="<?= isset($rec['role_name']) ? $rec['role_name'] : set_value('role_name') ?>" class="form-control <?= isset($errors['role_name']) ? 'is-invalid':' ' ?>" id="role_name" placeholder="Role Name">
                  <?php if(isset($errors['role_name'])): ?>
                    <div class="invalid-feedback">
                      <?= $errors['role_name'] ?>
                    </div>
                  <?php endif; ?>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 offset-md-3">
              <div class="form-group">
                <label for="description">Role Description</label>
                <textarea name="description" type="text" class="form-control <?= isset($errors['description']) ? 'is-invalid':' '  ?>" id="description" placeholder="Role Description" rows="5"><?= isset($rec['description']) ? $rec['description'] : set_value('description') ?></textarea>
                <?php if(isset($errors['description'])): ?>
                    <div class="invalid-feedback">
                      <?= $errors['description'] ?>
                    </div>
                  <?php endif; ?>
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
                 <?php if(isset($errors['function_id'])): ?>
                    <div class="invalid-feedback">
                      <?= $errors['function_id'] ?>
                    </div>
                  <?php endif; ?>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 offset-md-3">
              <button type="submit" class="btn btn-primary float-right">Submit</button>
            </div>
          </div>
        </form>
        <p style="clear: both"></p>
      </div>
    </div>
  </div>
