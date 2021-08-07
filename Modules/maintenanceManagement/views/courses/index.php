  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid ">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-0">List of Programs/Course</h2>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Courses</li>
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
                         <a href="<?=base_url('admin/courses/add')?>" class="btn btn-sm btn-primary">+ Course</a>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                          <thead>
                          <tr class="text-center">
                            <th>#</th>
                            <th>Course Name</th>
                            <th>Course Abbreviation</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                          </thead>
                          <tbody class="text-center">
                          <?php $ctr = 1?>
                            <?php if(empty($courses)): ?>
                              <tr>
                                <td colspan="6" class="text-center"> No Data Available </td>
                              </tr>
                          <?php else: ?>
                            <?php foreach($courses as $course): ?>
                            <tr>
                              <td><?=esc($ctr)?></td>
                              <td><?=esc($course['course_name'])?></td>
                              <td><?=esc($course['course_abbrev'])?></td>
                              <td><?=esc(($course['status'] == 'a') ? 'Active':'Inactive')?></td>

                              <td>
                               <a class="btn btn-outline-secondary btn-sm fas fa-eye" href="<?=base_url('admin/courses/view/' . esc($course['id'], 'url'))?>"> </a>
                               <a class="btn btn-outline-info btn-sm fas fa-edit" href="<?=base_url('admin/courses/edit/' . esc($course['id'], 'url'))?>"> </a>
                               <?php if($course['status'] == 'a'):?>
                                  <a class="btn btn-outline-danger btn-sm fas fa-trash-alt" onclick=" confirmUpdateStatus('<?= base_urL('admin/courses/delete/')?>',<?=$course['id']?>,'d')" title="deactivate"> </i></a>
                                <?php else:?> 
                                  <a class="btn btn-success btn-sm" onclick=" confirmUpdateStatus('<?= base_urL('admin/courses/active/')?>',<?=$course['id']?>,'a')" title="activate"> Restore</i></a>
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
                            <th>Course Name</th>
                            <th>Course Abbreviation</th>
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
              <a class="btn btn-danger" href="<?=base_url('admin/courses/delete/' . esc($course['id'], 'url'))?>"> Yes </a>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      <!-- /DELETE MODAL
