<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid ">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-0">Student's Record</h2>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Students</li>
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
                         <!-- <a href="<?=base_url('admin/students/add')?>" class="btn btn-sm btn-primary">+Add</a> -->
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                          <thead>
                          <tr class="text-center">
                            <th>#</th>
                           <th>Student Number</th>
                            <th>Name</th>
                            <th>Course</th>
                            <th>Year and Section</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                          </thead>
                          <tbody class="text-center">
                          <?php $ctr = 1?>
                          <?php if(empty($students)): ?>
                            <tr>
                            <td colspan="6" class="text-center"> No Data Available </td>
                            </tr>
                            <?php else: ?>
                              <?php foreach($students as $student): ?>
                                <tr>
                                  <td><?=esc($ctr)?></td>
                                  <td><?=esc($student['student_num'])?></td>
                                  <td><?=esc($student['last_name'].', '.$student['first_name'].' '.$student['m_initial'].'.')?></td>
                                  <td><?=esc($student['course_abbrev'])?></td>
                                  <td><?=esc($student['year'].'-'.$student['section'])?></td>
                                  <td><?=esc(($student['status'] == 'a') ? 'Active':'Inactive')?></td>
                                  <td>
                                    <a class="btn btn-secondary btn-sm" href="<?=base_url('admin/students/view/' . esc($student['id'], 'url'))?>"> View</a>
                                    <a class="btn btn-outline-info btn-sm" href="<?=base_url('admin/students/edit/' . esc($student['id'], 'url'))?>"> Edit </a>
                                    <?php if($student['status'] == 'a'):?>
                                      <a class="btn btn-danger btn-sm remove" onclick=" confirmUpdateStatus('<?= base_urL('admin/students/delete_student/')?>',<?=$student['id']?>,'d')" title="deactivate">Delete</i></a>
                                    <?php else:?>
                                      <a class="btn btn-success btn-sm remove" onclick=" confirmUpdateStatus('<?= base_urL('admin/students/active/')?>',<?=$student['id']?>,'a')" title="activate">Restore</i></a>
                                    <?php endif;?>
                                  </td>
                                </tr>
                                  <?php $ctr++?>
                              <?php endforeach; ?>
                          <?php endif; ?>
                          </tbody>
                          <!-- <tfoot>
                          <tr class="text-center">
                            <th>#</th>
                            <th>Student Number</th>
                            <th>Name</th>
                            <th>Course</th>
                            <th>Year and Section</th>
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
              <p>Select "Yes" below if you are ready to delete the data.</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
              <a class="btn btn-danger" href="<?=base_url('admin/students/delete_student/' . esc($student['id'], 'url'))?>"> Yes </a>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      <!-- /DELETE MODAL -->
