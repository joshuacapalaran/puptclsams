
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid ">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-0">View Course</h2>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Courses</li>
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
                  <label>Course Name*</label>
                  <input type="text" class="form-control" value="<?=isset($value['course_name']) ? esc($value['course_name']): ''?>" placeholder="Course Name" id="course_name" name="course_name" readonly>
                </div>
                <?php if(isset($errors['course_name'])):?>
                    <p class="text-danger"><?=esc($errors['course_name'])?><p>
                <?php endif;?>
                
              </div>
              <!-- /.col -->
              <div class="col-md-6">

                <div class="form-group">
                <label>Course Abbreviation*</label>
                 <input type="text" class="form-control" value="<?=isset($value['course_abbrev']) ? esc($value['course_abbrev']): ''?>" placeholder="Course Abbreviation" id="course_abbrev" name="course_abbrev" readonly>
                </div>
                <?php if(isset($errors['course_abbrev'])):?>
                    <p class="text-danger"><?=esc($errors['course_abbrev'])?><p>
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
  