  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid ">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-0">List of Activity</h2>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Activity</li>
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
            <div class="card">
                      <div class="card-header">
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                        <table id="example2" class="table table-bordered table-striped">
                          <thead>
                          <tr class="text-center">
                            <th>#</th>
                            <th>User</th>
                            <th>Description</th>
                            <th>Properties</th>
                            <th>Date</th>
                          </tr>
                          </thead>
                          <tbody class="text-center">
                          <?php $ctr = 1?>
                          <?php if(empty($activityLogs)): ?>
                            <tr>
                              <td colspan="6" class="text-center"> No Data Available </td>
                            </tr>
                          <?php else: ?>
                            <?php foreach($activityLogs as $activityLog): ?>
                              <tr>
                                <td><?=esc($ctr)?></td>
                                <td><?=esc($activityLog['username'])?></td>
                                <td><?=esc($activityLog['description'])?></td>
                                <td><?=esc($activityLog['properties'])?></td>
                                <td><?=esc(date('M d y, H:i:s a',strtotime($activityLog['created_at'])))?></td>
                              </tr>
                              <?php $ctr++?>
                            <?php endforeach; ?>
                          <?php endif; ?>
                          </tbody>
                        </table>
                      </div>
            </div>
        </div>
      </div>
    </div>
  </section>
    <!-- /.content -->
  </div>
 