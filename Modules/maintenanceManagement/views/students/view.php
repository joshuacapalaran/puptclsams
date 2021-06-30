
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid ">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-0">View Student</h2>
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
          <div class="card-body">
           
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Student Number</label>
                  <input type="text" class="form-control" value="<?=isset($value['student_num']) ? esc($value['student_num']): ''?>" placeholder="Student Number" id="student_num" name="student_num" readonly>
                </div>
                <?php if(isset($errors['student_num'])):?>
                    <p class="text-danger"><?=esc($errors['student_num'])?><p>
                <?php endif;?>

                <div class="form-group">
                  <label>Last Name</label>
                 <input type="text" class="form-control" value="<?=isset($value['last_name']) ? esc($value['last_name']): ''?>" placeholder="Lastname" id="last_name" name="last_name" readonly>
                </div>
                <?php if(isset($errors['last_name'])):?>
                    <p class="text-danger"><?=esc($errors['last_name'])?><p>
                <?php endif;?>

                <div class="form-group">
                  <label>First Name</label>
                 <input type="text" class="form-control" value="<?=isset($value['first_name']) ? esc($value['first_name']): ''?>" placeholder="Firstname" id="first_name" name="first_name" readonly>
                </div>
                <?php if(isset($errors['first_name'])):?>
                  <p class="text-danger"><?=esc($errors['first_name'])?><p>
                <?php endif;?> 

                <div class="form-group">
                  <label>Middle Name</label>
                 <input type="text" class="form-control" value="<?=isset($value['m_initial']) ? esc($value['m_initial']): ''?>" placeholder="Middle Initial" id="m_initial" name="m_initial" readonly>
                </div>
                <?php if(isset($errors['m_initial'])):?>
                  <p class="text-danger"><?=esc($errors['m_initial'])?><p>
                <?php endif;?>
                <!-- /.form-group -->
                
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="suffix_id">Suffix (optional)</label>
                    <select name="suffix_id" id="suffix_id" class="form-control" readonly>
                    <option>-- Please Select Course --</option>
                    <?php foreach($suffixes as $suffix): ?>
                    <option value="<?= $suffix['id'] ?>" <?=   ($suffix['id'] == $value['suffix_id']) ? 'selected':'' ?>><?= ucwords($suffix['suffix_name']) ?> </option>
                    <?php endforeach; ?>
                    <!--  -->
                    </select>
                </div>
                <div class="form-group">
                  <label for="course_id">Course</label>
                    <select name="course_id" id="course_id" class="form-control" readonly>
                    <option selected disabled>-- Please Select Course --</option>
                    <?php foreach($courses as $course): ?>
                    <option value="<?= $course['id'] ?>" <?=   ($course['id'] == $value['course_id']) ? 'selected':'' ?>><?= ucwords($course['course_abbrev']) ?> - <?= ucwords($course['course_name'])?></option>
                    <?php endforeach; ?>
                    <!--  -->
                    </select>
                </div>
                 <!-- /.form-group -->
                <div class="form-group">
                  <label for="section_id" >Year and Section</label>
                    <select name="section_id" id="section_id" class="form-control" readonly>
                        <option selected disabled>-- Please Select Year and Section --</option>
                        <?php foreach($sections as $section): ?>
                        <option value="<?= $section['id'] ?>" <?=   ($section['id'] == $value['section_id']) ? 'selected':'' ?>><?= ucwords($section['year']) ?> - <?= ucwords($section['section'])?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <!-- /.form-group -->
                <!-- <div class="form-group">
                  <label for="pcnum">PC#</label>
                  <input type="number" name="pcnum" class="form-control" id="pcnum" placeholder="Please enter pc number">
                </div>    -->             
                 <!-- /.form-group -->
                 </div>
                 <div class="col-md-12 text-right">
                   
                  </div>
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
  