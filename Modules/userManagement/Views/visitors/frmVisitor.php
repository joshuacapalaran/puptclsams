
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid ">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-0"><?= $edit ? 'Editing': 'Adding'?> Visitor</h2>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Visitor</li>
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
        <form action="<?= base_url('admin/visitors')?>/<?= $edit ? 'edit/'.esc($id): 'add'?>" method="post" accept-charset="utf-8">
          <div class="card-body">
           
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" class="form-control" value="<?=isset($value['name']) ? esc($value['name']): ''?>" placeholder="Year" id="name" name="name" required>
                </div>
                <?php if(isset($errors['name'])):?>
                <p class="text-danger"><?=esc($errors['name'])?><p>
                <?php endif;?>

                
                <div class="form-group">
                <label>Purpose</label>
                 <input type="text" class="form-control" value="<?=isset($value['purpose']) ? esc($value['purpose']): ''?>" placeholder="Section" id="purpose" name="purpose" required>
                </div>
                <?php if(isset($errors['purpose'])):?>
                    <p class="text-danger"><?=esc($errors['purpose'])?><p>
                <?php endif;?>
                <!-- /.form-group -->

                <div class="form-group">
                <label>Laboratory</label>
                <select name="lab_id" id="lab_id" class="form-control">
                  <option selected disabled>-- Please Select Laboratory --</option>
                  <?php foreach($labs as $lab): ?>
                  <option value="<?= $lab['id'] ?>" <?=   ($lab['id'] == $value['lab_id']) ? 'selected':'' ?>><?= ucwords($lab['lab_name']) ?></option>
                  <?php endforeach; ?>
                <!--  -->
                </select>
                </div>
                <?php if(isset($errors['purpose'])):?>
                    <p class="text-danger"><?=esc($errors['purpose'])?><p>
                <?php endif;?>
                <!-- /.form-group -->
                
              </div>
              <!-- /.col -->
                
               
              </div>
              <!-- /.col -->
              <div class="form-group align-right">
                  <button type="submit" class="btn btn-success">Save</button>
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


    <!-- /.content -->
  </div>
  