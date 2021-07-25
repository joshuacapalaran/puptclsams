
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid ">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-0">View Year & Section</h2>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Year & Sections</li>
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
              <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button> -->
                <?= \Config\Services::validation()->listErrors(); ?>
            <span class="d-none alert alert-success mb-3" id="res_message"></span>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
           
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Year</label>
                  <input type="text" class="form-control" value="<?=isset($value['year']) ? esc($value['year']): ''?>" placeholder="Year" id="year" name="year" readonly>
                </div>
                <?php if(isset($errors['year'])):?>
                <p class="text-danger"><?=esc($errors['year'])?><p>
                <?php endif;?>
                
              </div>
              <!-- /.col -->
              <div class="col-md-6">

                <div class="form-group">
                <label>Section</label>
                 <input type="text" class="form-control" value="<?=isset($value['section']) ? esc($value['section']): ''?>" placeholder="Section" id="section" name="section" readonly>
                </div>
                <?php if(isset($errors['section'])):?>
                    <p class="text-danger"><?=esc($errors['section'])?><p>
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
  