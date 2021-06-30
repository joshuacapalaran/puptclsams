    
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
      
      <div class="col-md-5">
        <div class="container">
          <div class="card card-default">
          <div class="card-header">
            
            <div class="card-tools">
               
            <span class="d-none alert alert-success mb-3" id="res_message"></span>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
           
            <div class="row">
              <!-- /.col -->
              <div class="col-md-12">

                <div class="form-group">
                <label class="form-label" for="sem">Semester</label>
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" value="<?=isset($value['sem']) ? esc($value['sem']): ''?>" placeholder="Example: 1st" id="sem" name="sem" readonly>
                  </div>
                    <?php if(isset($errors['sem'])):?>
                      <p class="text-danger"><?=esc($errors['sem'])?><p>
                    <?php endif;?>
                
               
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
  























  <div class="col-md-5">
    <div class="card">
    <div class="card-header">
  <h4><?= $edit ? 'Editing': 'Adding'?> Semester</h4>
  <form action="<?= base_url('admin/semesters')?>/<?= $edit ? 'edit/'.esc($id): 'add'?>" method="post">
    </div>
    <div class="card">
    <div class="card-header">
      <div class="card-body">

        <label class="form-label" for="sem">Semester</label>
        <div class="input-group mb-3">
          <input type="text" class="form-control" value="<?=isset($value['sem']) ? esc($value['sem']): ''?>" placeholder="Example: 1st" id="sem" name="sem">
        </div>
          <?php if(isset($errors['sem'])):?>
            <p class="text-danger"><?=esc($errors['sem'])?><p>
          <?php endif;?>

      </div>
    </div>
    <button class="btn btn-sm btn-success" type="submit"> Submit </button>
  </div>
    
  </form>
  
  </div>
  </div>
