  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid ">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-0">Schedule Class</h2>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Schedule Class</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- calendar -->
 
    <!-- Main content -->
  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-outline card-secondary">
                      <div class="card-header">
                         <a href="<?=base_url('admin/schedsubject/add')?>" class="btn btn-sm btn-primary">+Add</a>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                        <table id="schedulesubjTable" class="table table-bordered table-striped">
                          <thead>
                          <tr class="text-center">
                            <th>Subject</th>
                            <th>Course</th>
                            <th>Category</th>
                            <th>Time</th>
                            <th>Laboratory Day</th>
                            <th>Laboratory</th>
                            <th>Professor</th>
                            <th>Semester</th>
                            <th>School Year</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                          </thead>
                          <tbody class="text-center">
                          <?php $ctr = 1?>
                        <?php if(empty($schedsubjects)): ?>
                          <tr>
                            <td colspan="9" class="text-center"> No Data Available </td>
                          </tr>
                        <?php else: ?>
                          <?php foreach($schedsubjects as $schedsubject): ?>
                            <tr>
                              <td><?=esc($schedsubject['subj_name'])?></td>
                              <td><?=esc($schedsubject['course_name'])?></td>
                              <td><?=esc(($schedsubject['category'] == 1) ? 'Regular Class':'Make-Up Class' )?></td>
                              <td><?=esc(($schedsubject['category'] == 1) ? date("h:i A", strtotime($schedsubject['start_time'])).'-'.date("h:i A", strtotime($schedsubject['end_time'])): '')?></td>
                              <td><?=esc($schedsubject['day'])?><?=esc($schedsubject['day'] ? json_decode($schedsubject['day']):date('F d, Y',strtotime($schedsubject['date'])))?></td>
                              <td><?=esc($schedsubject['lab_name'])?></td>
                              <td><?=esc($schedsubject['first_name'])?> <?=esc($schedsubject['last_name'])?> <?=esc($schedsubject['suffix_name'])?></td>
                              <td><?=esc($schedsubject['sem'])?></td>
                              <td><?=esc($schedsubject['start_sy'])?> - <?=esc($schedsubject['end_sy'])?></td>
                              <td><?=esc(($schedsubject['status'] == 'a') ? 'Active':'Inactive')?></td>

                              <td>
                               <a class="btn btn-secondary btn-sm" href="<?=base_url('admin/schedsubject/view/' . esc($schedsubject['id'], 'url'))?>"> View</a>
                                <a class="btn btn-outline-info btn-sm" href="<?=base_url('admin/schedsubject/edit/' . esc($schedsubject['id'], 'url'))?>"> Edit </a>
                                <?php if($schedsubject['status'] == 'a'):?>
                                  <a class="btn btn-danger btn-sm remove" onclick=" confirmUpdateStatus('<?= base_urL('admin/schedsubject/delete/')?>',<?=$schedsubject['id']?>,'d')" title="deactivate">Delete</i></a>
                                <?php else:?>
                                  <a class="btn btn-success btn-sm remove" onclick=" confirmUpdateStatus('<?= base_urL('admin/schedsubject/active/')?>',<?=$schedsubject['id']?>,'a')" title="activate">Restore</i></a>
                                <?php endif;?>
                                
                              </td>
                            </tr>
                            <?php $ctr++?>
                          <?php endforeach; ?>
                        <?php endif; ?>
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
