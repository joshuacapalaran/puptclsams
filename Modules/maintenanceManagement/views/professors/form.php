
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid ">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-0"><?= $edit ? 'Editing': 'Adding'?> Professor</h2>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Professor</li>
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
        <form action="<?= base_url('admin/professors')?>/<?= $edit ? 'edit/'.esc($id): 'add'?>" method="post" accept-charset="utf-8">
          <div class="card-body">

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Faculty Code*</label>
                  <input type="text" class="form-control" value="<?=isset($value['f_code']) ? esc($value['f_code']): ''?>" placeholder="Faculty Code" id="f_code" name="f_code" required>
                </div>
                <?php if(isset($errors['f_code'])):?>
                    <p class="text-danger"><?=esc($errors['f_code'])?><p>
                <?php endif;?>

                <div class="form-group">
                  <label>First Name*</label>
                 <input type="text" class="form-control" value="<?=isset($value['first_name']) ? esc($value['first_name']): ''?>" placeholder="Firstname" id="first_name" name="first_name" required>
                </div>
                <?php if(isset($errors['first_name'])):?>
                  <p class="text-danger"><?=esc($errors['first_name'])?><p>
                <?php endif;?>


              </div>
              <!-- /.col -->
              <div class="col-md-6">

                <div class="form-group">
                <label>Last Name*</label>
                 <input type="text" class="form-control" value="<?=isset($value['last_name']) ? esc($value['last_name']): ''?>" placeholder="Lastname" id="last_name" name="last_name" required>
                </div>
                <?php if(isset($errors['last_name'])):?>
                    <p class="text-danger"><?=esc($errors['last_name'])?><p>
                <?php endif;?>
                <!-- /.form-group -->

                <div class="form-group">
                  <label>Middle Name*</label>
                 <input type="text" class="form-control" value="<?=isset($value['m_initial']) ? esc($value['m_initial']): ''?>" placeholder="Middle Initial" id="m_initial" name="m_initial" required>
                </div>
                <?php if(isset($errors['m_initial'])):?>
                  <p class="text-danger"><?=esc($errors['m_initial'])?><p>
                <?php endif;?>
                <!-- /.form-group -->

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-label" for="suffix_id">Suffix*</label>
                      <select class="form-control select" aria-label="Default select example" name="suffix_id">
                        <option value ='n' <?= !$edit ? "selected" : ''?>> Select Suffix</option>
                        <?php foreach($suffixes as $suffix):?>
                            <option value="<?=$suffix['id'] ?>" <?= ($value['suffix_id'] == $suffix['id'])  ? 'selected' : ''?>><?=$suffix['suffix_name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <?php if(isset($errors['suffix_id'])):?>
                      <p class="text-danger"><?=esc($errors['suffix_id'])?><p>
                      <?php endif;?>
                  </div>
                </div>

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


    <!-- /.content -->
  </div>
