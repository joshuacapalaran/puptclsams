<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid ">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-0">View Holiday</h2>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Holiday</li>
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
          <div class="card-body">
           
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Holiday*</label>
                  <input type="text" class="form-control" value="<?=isset($value['name']) ? esc($value['name']): ''?>" placeholder="Holiday"  name="name" readonly>
                </div>
                <?php if(isset($errors['name'])):?>
                      <p class="text-danger"><?=esc($errors['name'])?><p>
                <?php endif;?> 
                
              </div>
              <!-- /.col -->
              <div class="col-md-6">

                <div class="form-group">
                <label>Date*</label>
                <input type="date" class="form-control" value="<?=isset($value['date']) ? esc($value['date']): ''?>" placeholder="Date"  name="date" readonly>
                
                </div>
                <?php if(isset($errors['date'])):?>
                      <p class="text-danger"><?=esc($errors['date'])?><p>
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
  