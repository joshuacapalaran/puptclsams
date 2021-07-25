<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid ">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-0">View Semester</h2>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Semester</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="row">
      <div class="col-md-6">
        <div class="container">
          <div class="card card-outline card-secondary">
          <div class="card-header">
          
          
            <div class="card-tools">
               
            <span class="d-none alert alert-success mb-3" id="res_message"></span>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
           
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                   <label class="form-label" for="semester">Semester*</label>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" value="<?=isset($value['sem']) ? esc($value['sem']): ''?>" placeholder="Semester" id="semester" name="semester" readonly>
                    </div>
                      <?php if(isset($errors['sem'])):?>
                        <p class="text-danger"><?=esc($errors['sem'])?><p>
                      <?php endif;?>

             
              </div>
            </div>
            <!-- /.row -->
  
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
        </div>
        </div>
      </div>
    </div>
    </div>

    <!-- /.content -->
  </div>
  