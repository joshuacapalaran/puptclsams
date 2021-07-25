<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid ">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-0">List of Users</h2>
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
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-outline card-secondary">
                      <div class="card-header">
                         <a href="<?=base_url('admin/users/add')?>" class="btn btn-sm btn-primary">+Add</a>

                      </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                          <thead>
                          <tr class="text-center">
                            <th>#</th>
                            <th>Name</th>
                            <th>User name</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                          </thead>
                          <tbody class="text-center">
                            <?php foreach($users as $user): ?>
                            <tr>
                              <td><?=esc($user['id'])?></td>
                              <td><?=esc($user['last_name'].','.$user['first_name'].' '.$user['m_initial'])?></td>
                              <td><?=esc($user['username'])?></td>
                              <td><?=esc($user['role_name'])?></td>
                              <td><?=esc(($user['status'] == 'a') ? 'Active':'Inactive')?></td>

                              <td>
                              <a class="btn btn-secondary btn-sm" href="<?=base_url('admin/users/view/' . esc($user['id'], 'url'))?>"> View</a>
                               <a class="btn btn-outline-info btn-sm" href="<?=base_url('admin/users/edit/' . esc($user['id'], 'url'))?>"> Edit </a>
                               <?php if($user['status'] == 'a'):?>
                                  <a class="btn btn-danger btn-sm remove" onclick=" confirmUpdateStatus('<?= base_urL('admin/users/delete/')?>',<?=$user['id']?>,'d')" title="deactivate">Delete</i></a>
                                <?php else:?>
                                  <a class="btn btn-success btn-sm remove" onclick=" confirmUpdateStatus('<?= base_urL('admin/users/active/')?>',<?=$user['id']?>,'a')" title="activate">Restore</i></a>
                                <?php endif;?>
                              </td>
                            </tr>
                            <?php endforeach; ?>
                          </tbody>
                        </table>
                      </div>
              <!-- /.card-body -->
            </div>
        </div>
      </div>
    </div>
  </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
