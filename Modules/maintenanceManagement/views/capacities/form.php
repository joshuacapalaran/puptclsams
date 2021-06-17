  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid ">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-0"><?= $edit ? 'Editing': 'Adding'?> Capacity</h2>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Capacity</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <div class="card card-default">
          <div class="card-header">
            <!-- <h3 class="card-title">Select2 (Default Theme)</h3> -->


            <div class="card-tools">

            <span class="d-none alert alert-success mb-3" id="res_message"></span>
            </div>
          </div>
          <!-- /.card-header -->
        <form action="<?= base_url('admin/capacities')?>/<?= $edit ? 'edit/'.esc($id): 'add'?>" method="post" accept-charset="utf-8">
          <div class="card-body">

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-label" for="lab_id">Laboratory</label>
                  <select class="form-select" aria-label="Default select example" name="lab_id">
                    <option value ='n' <?= !$edit ? "selected" : ''?>> Select Laboratory</option>
                    <?php foreach($labs as $lab):?>
                        <option value="<?=$lab['id'] ?>" <?= isset($errors['lab_id']) || $edit ? 'selected' : ''?>><?=$lab['lab_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <?php if(isset($errors['lab_id'])):?>
                    <p class="text-danger"><?=esc($errors['lab_id'])?><p>
                    <?php endif;?>
                </div>
              </div>

              <!-- /.col -->
              <div class="col-md-6">

                <div class="form-group">
                <label>Capacity</label>
                 <input type="number" class="form-control" value="<?=isset($value['capacity']) ? esc($value['capacity']): ''?>" placeholder="Capacity" id="capacity" name="capacity">
                </div>
                <?php if(isset($errors['capacity'])):?>
                    <p class="text-danger"><?=esc($errors['capacity'])?><p>
                <?php endif;?>
                <!-- /.form-group -->

                <div class="form-group">
                  <button type="submit" class="btn btn-success">Save</button>
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- /.row -->
          </div>
          <!-- /.card-body -->
        </form>
        </div>
        </div>
      </div>


    <!-- /.content -->
  </div>
