
<br><div class="card bg-light ">
  <div class="card-body">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <div class="row">
          <div class="col-md-12">
            <span class="field">Name</span>
            <span class="field-value"><?= ucfirst($user[0]['firstname']).' '.ucfirst($user[0]['lastname']) ?></span>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <span class="field">Username</span>
            <span class="field-value"><?= ucfirst($user[0]['username']) ?></span>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <span class="field">Email</span>
            <span class="field-value"><?= $user[0]['email'] ?></span>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <span class="field">Birthdate</span>
            <span class="field-value"><?= $user[0]['birthdate'] ?> (<?= floor((time() - strtotime($user[0]['birthdate'])) / 31556926) ?> yrs old) </span>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-12">
           <?php
              //user_edit_link('users','edit-user', $permissions, $user[0]['id']);
            ?>
          </div>
        </div>
      </div>
    </div>
      </div>
    </div>
<br>
