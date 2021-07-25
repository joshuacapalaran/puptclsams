<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid ">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-0"><?= $edit ? 'Editing': 'Adding'?> Category</h2>
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
    <div class="row">
      <div class="col-md-6">
        <div class="container">
          <div class="card card-outline card-info">
          <div class="card-header">
          
          
            <div class="card-tools">
               
            <span class="d-none alert alert-success mb-3" id="res_message"></span>
            </div>
          </div>
          <!-- /.card-header -->
        <form action="<?= base_url('admin/categories')?>/<?= $edit ? 'edit/'.esc($id): 'add'?>" method="post" accept-charset="utf-8">
          <div class="card-body">
           
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                   <label class="form-label" for="category">Category*</label>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" value="<?=isset($value['category']) ? esc($value['category']): ''?>" placeholder="Category" id="category" name="category">
                    </div>
                      <?php if(isset($errors['category'])):?>
                        <p class="text-danger"><?=esc($errors['category'])?><p>
                      <?php endif;?>

                   <div class="form-group">
                    <button type="submit" class="btn btn-success">Save</button>
                  </div>
              </div>
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
  