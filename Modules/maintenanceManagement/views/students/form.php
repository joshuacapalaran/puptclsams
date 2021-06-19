
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid ">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-0"><?= $edit ? 'Editing': 'Adding'?> Student</h2>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Student</li>
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
        <form action="<?= base_url('admin/students')?>/<?= $edit ? 'edit/'.esc($id): 'add'?>" method="post" accept-charset="utf-8">
          <div class="card-body">
           
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Student Number</label>
                  <input type="text" class="form-control" value="<?=isset($value['student_num']) ? esc($value['student_num']): ''?>" placeholder="Student Number" id="student_num" name="student_num" required>
                </div>
                <?php if(isset($errors['student_num'])):?>
                    <p class="text-danger"><?=esc($errors['student_num'])?><p>
                <?php endif;?>

                <div class="form-group">
                  <label>Last Name</label>
                 <input type="text" class="form-control" value="<?=isset($value['last_name']) ? esc($value['last_name']): ''?>" placeholder="Lastname" id="last_name" name="last_name" required>
                </div>
                <?php if(isset($errors['last_name'])):?>
                    <p class="text-danger"><?=esc($errors['last_name'])?><p>
                <?php endif;?>

                <div class="form-group">
                  <label>First Name</label>
                 <input type="text" class="form-control" value="<?=isset($value['first_name']) ? esc($value['first_name']): ''?>" placeholder="Firstname" id="first_name" name="first_name" required>
                </div>
                <?php if(isset($errors['first_name'])):?>
                  <p class="text-danger"><?=esc($errors['first_name'])?><p>
                <?php endif;?> 

                <div class="form-group">
                  <label>Middle Name</label>
                 <input type="text" class="form-control" value="<?=isset($value['m_initial']) ? esc($value['m_initial']): ''?>" placeholder="Middle Initial" id="m_initial" name="m_initial" required>
                </div>
                <?php if(isset($errors['m_initial'])):?>
                  <p class="text-danger"><?=esc($errors['m_initial'])?><p>
                <?php endif;?>
                <!-- /.form-group -->
                
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="course">Course</label>
                    <select name="course" id="course" class="form-control">
                    <option>-- Please Select Course --</option>
                    <!--  -->
                    </select>
                </div>
                 <!-- /.form-group -->
                <div class="form-group">
                  <label for="year" >Year and Section</label>
                    <select name="year" id="year" class="form-control">
                        <option value="">-- Please Select Year and Section --</option>
                        <option value='I - 1' >I - 1</option>
                        <option value='II - 1'>II - 1</option>
                        <option value='III - 1'>III - 1</option>
                        <option value='IV - 1' >IV - 1</option>
                        <option value='IV - 1' >V - 1</option>
                    </select>
                </div>
                <!-- /.form-group -->
                <!-- <div class="form-group">
                  <label for="pcnum">PC#</label>
                  <input type="number" name="pcnum" class="form-control" id="pcnum" placeholder="Please enter pc number">
                </div>    -->             
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


    <!-- /.content -->
  </div>
  