<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid ">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-0">List of Categories</h2>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Category</li>
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
                         <a href="<?=base_url('admin/categories/add')?>" class="btn btn-sm btn-primary">+ Category</a>
                         <!-- <h4>List of Categories</h4> -->
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                          <thead>
                          <tr class="text-center">
                            <th>#</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                          </thead>
                          <tbody class="text-center">
                          <?php $ctr = 1?>
                            <?php if(empty($categories)): ?>
                              <tr>
                                <td colspan="6" class="text-center"> No Data Available </td>
                              </tr>
                          <?php else: ?>
                            <?php foreach($categories as $category): ?>
                            <tr>
                              <td><?=esc($ctr)?></td>
                              <td><?=esc($category['category'])?></td>
                              <td><?=esc(($category['status'] == 'a') ? 'Active':'Inactive')?></td>
                              <td>
                               <a class="btn btn-secondary btn-sm" href="<?=base_url('admin/categories/view/' . esc($category['id'], 'url'))?>"> View</a>
                                <a class="btn btn-outline-info btn-sm" href="<?=base_url('admin/categories/edit/' . esc($category['id'], 'url'))?>"> Edit </a>
                                <?php if($category['status'] == 'a'):?>
                                  <a class="btn btn-danger btn-sm remove" onclick=" confirmUpdateStatus('<?= base_urL('admin/categories/delete/')?>',<?=$category['id']?>,'d')" title="deactivate">Delete</i></a>
                                <?php else:?>
                                  <a class="btn btn-success btn-sm remove" onclick=" confirmUpdateStatus('<?= base_urL('admin/categories/active/')?>',<?=$category['id']?>,'a')" title="activate">Restore</i></a>
                                <?php endif;?>
                              </td>
                              </td>
                            </tr>
                            <?php $ctr++?>
                            <?php endforeach; ?>
                          <?php endif; ?>
                          </tbody>
                          <!-- <tfoot>
                          <tr class="text-center">
                             <th>#</th>
                            <th>Category</th>
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
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Category</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
             <label class="form-label" for="category">Category</label>
              <div class="input-group mb-3">
                <input type="text" class="form-control" value="<?=isset($value['category']) ? esc($value['category']): ''?>" placeholder="Category" id="category" name="category">
              </div>
                <?php if(isset($errors['category'])):?>
                  <p class="text-danger"><?=esc($errors['category'])?><p>
                <?php endif;?>
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
              <a class="btn btn-danger" href="<?=base_url('admin/categories/delete/' . esc($category['id'], 'url'))?>"> Yes </a>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
