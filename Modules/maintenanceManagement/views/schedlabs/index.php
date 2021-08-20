  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid ">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-0">Schedule Event</h2>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Schedule</li>
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
                         <a href="<?=base_url('admin/schedlabs/add')?>" class="btn btn-sm btn-primary">+ Schedule Event</a>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                        <table id="schedlabTable" class="table table-bordered table-striped">
                          <thead>
                          <tr class="text-center">
                            <th>#</th>
                            <th>Event Name</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Laboratory</th>
                            <th>Assigned Person</th>
                            <th>No. of People</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                          </thead>
                          <tbody class="text-center">
                          <?php $ctr = 1?>
                        <?php if(empty($schedlabs)): ?>
                          <tr>
                            <td colspan="9" class="text-center"> No Data Available </td>
                          </tr>
                        <?php else: ?>
                          <?php foreach($schedlabs as $schedlab): ?>
                            <tr>
                              <td><?=esc($ctr)?></td>
                              <td><?=esc($schedlab['event_name'])?></td>
                              <td><?=esc($schedlab['category'])?></td>
                              <td><?=esc($schedlab['date'])?></td>
                              <td><?=esc(date("h:i A",strtotime($schedlab['start_time'])).' -'.date("h:i A", strtotime($schedlab['end_time'])))?></td>
                              <td><?=esc($schedlab['lab_name'])?></td>
                              <td><?=esc($schedlab['assigned_person'])?></td>
                              <td><?=esc($schedlab['num_people'])?></td>
                              <td><?=esc(($schedlab['status'] == 'a') ? 'Active':'Inactive')?></td>
                              <td>
                               <a class="btn btn-secondary btn-sm" href="<?=base_url('admin/schedlabs/view/' . esc($schedlab['id'], 'url'))?>"> View </a>
                                <a class="btn btn-outline-info btn-sm" href="<?=base_url('admin/schedlabs/edit/' . esc($schedlab['id'], 'url'))?>"> Edit </a>
                                <?php if($schedlab['status'] == 'a'):?>
                                  <a class="btn btn-danger btn-sm fas" onclick=" confirmUpdateStatus('<?= base_urL('admin/schedlabs/delete/')?>',<?=$schedlab['id']?>,'d')" title="deactivate"> Delete</i></a>
                                <?php else:?>
                                  <a class="btn btn-success btn-sm remove" onclick=" confirmUpdateStatus('<?= base_urL('admin/schedlabs/active/')?>',<?=$schedlab['id']?>,'a')" title="activate">Restore</i></a>
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

<script>


</script>
