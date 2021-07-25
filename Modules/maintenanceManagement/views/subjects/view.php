
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid ">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-0">View Subjects</h2>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Subjects</li>
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
                <?= \Config\Services::validation()->listErrors(); ?>
            <span class="d-none alert alert-success mb-3" id="res_message"></span>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-label" for="subj_code">Subject Code</label>
                <input type="text" class="form-control" value="<?=isset($value['subj_code']) ? esc($value['subj_code']): ''?>" placeholder="Subject Code" id="subj_code" name="subj_code" readonly>
                </div>
                <?php if(isset($errors['subj_code'])):?>
                  <p class="text-danger"><?=esc($errors['subj_code'])?><p>
                <?php endif;?>
             </div>
              <!-- /.col -->
              <div class="col-md-6">

                <div class="form-group">
                 <label class="form-label" for="subj_name">Subject Name</label>
                <input type="text" class="form-control" value="<?=isset($value['subj_name']) ? esc($value['subj_name']): ''?>" placeholder="Subject Name" id="subj_name" name="subj_name" readonly>
                </div>
                <?php if(isset($errors['subj_name'])):?>
                  <p class="text-danger"><?=esc($errors['subj_name'])?><p>
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


    <!-- /.content -->
  </div>
