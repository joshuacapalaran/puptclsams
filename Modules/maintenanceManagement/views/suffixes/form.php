
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid ">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-0"><?= $edit ? 'Editing': 'Adding'?> Suffix</h2>
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
          <div class="card card-outline card-info">
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
        <form action="<?= base_url('admin/suffixes')?>/<?= $edit ? 'edit/'.esc($id): 'add'?>" method="post" accept-charset="utf-8">
          <div class="card-body">
           
            <div class="row">
              <!-- /.col -->
              <div class="col-md-12">

                <div class="form-group">
                <label class="form-label" for="suffix">Suffix*</label>
                <div class="input-group mb-3">
                  <input type="text" class="form-control" value="<?=isset($value['suffix_name']) ? esc($value['suffix_name']): ''?>" placeholder="Suffix" id="suffix" name="suffix_name">
                </div>
                  <?php if(isset($errors['suffix_name'])):?>
                    <p class="text-danger"><?=esc($errors['suffix_name'])?><p>
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
    </div>

</div>
    <!-- /.content -->
  </div>
  