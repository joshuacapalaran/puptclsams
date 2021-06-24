  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid ">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-0">Schedule Subjects</h2>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Schedule Subjects</li>
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
                         <a href="<?=base_url('admin/schedsubject/add')?>" class="btn btn-sm btn-success">+Add</a>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                        <table id="example2" class="table table-bordered table-striped">
                          <thead>
                          <tr class="text-center">
                            <th>Subject</th>
                            <th>Course</th>
                            <th>Time</th>
                            <th>Laboratory Day</th>
                            <th>Laboratory</th>
                            <th>Professor</th>
                            <th>Semester</th>
                            <th>School Year</th>
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
                              <td><?=esc(date("h:i A", strtotime($schedsubject['start_time'])).'-'.date("h:i A", strtotime($schedsubject['end_time'])))?></td>
                              <td><?=esc($schedsubject['day'])?><?=esc((!empty($schedsubject['end_day'])) ? ' To '.$schedsubject['end_day']: ' ')?></td>
                              <td><?=esc($schedsubject['lab_name'])?></td>
                              <td><?=esc($schedsubject['first_name'])?> <?=esc($schedsubject['last_name'])?> <?=esc($schedsubject['suffix_name'])?></td>
                              <td><?=esc($schedsubject['sem'])?></td>
                              <td><?=esc($schedsubject['start_sy'])?> - <?=esc($schedsubject['end_sy'])?></td>
                              <td>
                                <a class="btn btn-outline-info btn" href="<?=base_url('admin/schedsubject/edit/' . esc($schedsubject['id'], 'url'))?>"> Edit </a>
                                <a class="btn btn-danger" href="<?=base_url('admin/schedsubject/delete/' . esc($schedsubject['id'], 'url'))?>"> Delete </a>
                                <a class="btn btn-primary" href="<?=base_url('admin/schedsubject/attendance/' . esc($schedsubject['id'], 'url'))?>"> Attendance </a>
                              </td>
                            </tr>
                            <?php $ctr++?>
                          <?php endforeach; ?>
                        <?php endif; ?>
                          </tbody>
                          <!-- <tfoot>
                          <tr class="text-center">
                           <th>#</th>
                            <th>Event Name</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Laboratory</th>
                            <th>Assigned Person</th>
                            <th>No. of People</th>
                            <th>Action</th>
                          </tr>
                          </tfoot> -->
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
  <!-- EDIT MODAL -->
    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Information</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      <!-- DELETE MODAL -->
      <div class="modal fade" id="modal-delete">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Do you want to delete the data?</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Select "Yes" below if you are ready to delete this data.</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
              <a class="btn btn-danger" href="<?=base_url('admin/schedlabs/delete/' . esc($schedlab['id'], 'url'))?>"> Yes </a>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
