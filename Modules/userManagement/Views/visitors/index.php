
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid ">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-0">List of Visitors </h2>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Visitors</li>
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
          <!-- form -->

          <div class="col-12">
            <div class="card card-outline card-secondary">
                <div class="card-header">
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr class="text-center">
                      <th>#</th>
                      <th>Name</th>
                      <th>Purpose</th>
                      <th>Laboratory Name</th>
                      <th>Time in</th>
                      <th>Time out</th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                    <?php $ctr = 1?>
                      <?php if(empty($visitors)): ?>
                        <tr>
                          <td colspan="6" class="text-center"> No Data Available </td>
                        </tr>
                      <?php else: ?>
                        <?php foreach($visitors as $visitor): ?>
                          <tr>
                            <td><?=esc($ctr)?></td>
                            <td><?=esc($visitor['name'])?></td>
                            <td><?=esc($visitor['purpose'])?></td>
                            <td><?=esc($visitor['lab_name'])?></td>
                            <td><?=esc(date('h:i A', strtotime($visitor['time_in'])))?></td>
                            <td><?=esc(($visitor['time_out'] != '0000-00-00 00:00:00') ? date('h:i A', strtotime($visitor['time_out'])) :'')?></td>

                     
                      </tr>
                      <?php $ctr++?>
                      <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                    <!-- <tfoot>
                    <tr class="text-center">
                      <th>#</th>
                      <th>Laboratory Name</th>
                      <th>Action</th>
                    </tr>
                    </tfoot> -->
                  </table>
                </div>
              <!-- /.card-body -->
            </div>
        </div>
        <!-- col 7 -->
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
              <a class="btn btn-danger" href="<?=base_url('admin/labs/delete/' . esc($lab['id'], 'url'))?>"> Yes </a>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
