
<br><div class="card bg-light ">
  <div class="card-body">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <div class="col-md-12">
          <h3><?= $function_title?></h3>
        </div>
        <br>
        <div class="row">
          <div class="col-md-12">
            <span class="field">Role Name</span>
            <span class="field-value"><?= ucfirst($role[0]['role_name']) ?></span>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <span class="field">Description</span>
            <span class="field-value"><?= ucfirst($role[0]['description']) ?></span>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <span class="field">Landing Page</span>
            <span class="field-value"><?= ucwords(name_on_system($role[0]['function_id'], $permissions, 'permissions')) ?></span>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-3 offset-8">
            <?php
            user_edit_link('roles','edit-role', $permissions, $role[0]['id']);
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<br>
