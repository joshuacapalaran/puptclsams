  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid ">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-0">View Capacity</h2>
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
          <div class="card card-outline card-secondary">
          <div class="card-header">
            <!-- <h3 class="card-title">Select2 (Default Theme)</h3> -->


            <div class="card-tools">

            <span class="d-none alert alert-success mb-3" id="res_message"></span>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-label" for="lab_id">Laboratory*</label>
                  <select class="form-control select" aria-label="Default select example" name="lab_id" readonly>
                    <option value ='n' selected disabled> Select Laboratory</option>
                    <?php foreach($labs as $lab):?>
                        <option value="<?=$lab['id'] ?>" <?= ( ($value['lab_id'] == $lab['id']) ? 'selected' : '')?>> <?=$lab['lab_name'] ?></option>
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
                <label>Capacity*</label>
                 <input type="number" class="form-control" value="<?=isset($value['capacity']) ? esc($value['capacity']): ''?>" placeholder="Capacity" id="capacity" name="capacity" readonly>
                </div>
                <?php if(isset($errors['capacity'])):?>
                    <p class="text-danger"><?=esc($errors['capacity'])?><p>
                <?php endif;?>
                <!-- /.form-group -->

             
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- /.row -->
          </div>
          <!-- /.card-body -->
        </div>
        </div>
      </div>

