
<br>
<div class="card bg-light ">
  <div class="card-body">
    <div class="row">
       <div class="col-md-4">
         <h1> <?=$function_title?> </h1>
       </div>
       <div class="col-md-2 offset-md-6">
        <?php user_add_link('users', $_SESSION['userPermmissions']) ?>
       </div>
     </div>
    <br>
      <?php $uri = new \CodeIgniter\HTTP\URI(current_url()); ?>
     <div class="table-responsive">
       <table class="table table-sm table-striped table-bordered index-table">
        <thead class="thead-dark">
          <tr align="center">
            <th>#</th>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>User Role</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($users)): ?>
          <?php else: ?>
            <?php $cnt = 1; ?>
            <?php foreach($users as $user): ?>
            <tr id="<?php echo $user['id']; ?>">
              <th scope="row"><?= $cnt++ ?></th>
              <td><?= $user['firstname'].' '.$user['lastname'] ?></td>
              <td><?= $user['username'] ?></td>
              <td><?= $user['email'] ?></td>
              <td><?= strtoupper($user['role_name']) ?></td>
              <td class="text-center">
               <?php
                  users_action('users', $_SESSION['userPermmissions'], $user['id']);
               ?>
              </td>
            </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
     </div>
    <hr>
    <div class="row">
      <div class="col-md-6 offset-md-6">
        <?php paginater('users', count($all_items), PERPAGE, $offset) ?>
      </div>
    </div>
  </div>
</div>
