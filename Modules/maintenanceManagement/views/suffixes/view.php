
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid ">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-0">View Suffix</h2>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Suffix</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="row">
      
      <div class="col-md-5">
        <div class="container">
          <div class="card card-default">
          <div class="card-header">
            
            <div class="card-tools">
              <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button> -->
               
            <span class="d-none alert alert-success mb-3" id="res_message"></span>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
           
            <div class="row">
              <!-- /.col -->
              <div class="col-md-12">

                <div class="form-group">
                <label class="form-label" for="suffix">Suffix</label>
                <div class="input-group mb-3">
                  <input type="text" class="form-control" value="<?=isset($value['suffix_name']) ? esc($value['suffix_name']): ''?>" placeholder="Suffix" id="suffix" name="suffix" readonly>
                </div>
                  <?php if(isset($errors['suffix'])):?>
                    <p class="text-danger"><?=esc($errors['suffix'])?><p>
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
    </div>

</div>
    <!-- /.content -->
  </div>
  