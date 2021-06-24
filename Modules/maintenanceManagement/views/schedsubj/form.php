
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid ">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-0"><?= $edit ? 'Editing': 'Adding'?> Subject Schedule</h2>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Subjects Schedule</li>
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
                      <!-- <?= \Config\Services::validation()->listErrors(); ?> -->
                      <span class="d-none alert alert-success mb-3" id="res_message"></span>
                  </div>
              </div>
              <!-- /.card-header -->
            <form action="<?= base_url('admin/schedsubject')?>/<?= $edit ? 'edit/'.esc($id): 'add'?>" method="post" accept-charset="utf-8">
                <div class="card-body">

                  <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="subject_id">Subject</label>
                        <select name="subject_id" id="subject_id" class="form-control">
                          <option selected disabled>-- Please Select Subject --</option>
                          <?php foreach($subjects as $subject): ?>
                          <option value="<?= $subject['id'] ?>" <?=   ($subject['id'] == $value['subject_id']) ? 'selected':'' ?>><?= ucwords($subject['subj_name']) ?></option>
                          <?php endforeach; ?>
                        <!--  -->
                        </select>
                      </div>
                        <?php if(isset($errors['subject_id'])):?>
                          <p class="text-danger"><?=esc($errors['subject_id'])?><p>
                        <?php endif;?>

                    <div class="form-group">
                        <label class="form-label" for="course_id">Course</label>
                        <select name="course_id" id="course_id" class="form-control">
                          <option selected disabled>-- Please Select Course --</option>
                          <?php foreach($courses as $course): ?>
                          <option value="<?= $course['id'] ?>" <?=   ($course['id'] == $value['course_id']) ? 'selected':'' ?>><?= ucwords($course['course_abbrev']) ?> - <?= ucwords($course['course_name']) ?></option>
                          <?php endforeach; ?>
                        <!--  -->
                        </select>
                    </div>
                        <?php if(isset($errors['course_id'])):?>
                          <p class="text-danger"><?=esc($errors['course_id'])?><p>
                        <?php endif;?>
                        <div class="form-group">
                        <label class="form-label" for="section_id">Section</label>
                        <select name="section_id" id="section_id" class="form-control">
                          <option selected disabled>-- Please Select Section --</option>
                          <?php foreach($sections as $section): ?>
                          <option value="<?= $section['id'] ?>" <?=   ($section['id'] == $value['section_id']) ? 'selected':'' ?>><?= ucwords($section['year']) ?> - <?= ucwords($section['section']) ?></option>
                          <?php endforeach; ?>
                        <!--  -->
                        </select>
                    </div>
                        <?php if(isset($errors['section_id'])):?>
                          <p class="text-danger"><?=esc($errors['section_id'])?><p>
                        <?php endif;?>
                    <div class="form-group">
                        <label class="form-label" for="lab_id">Laboratory</label>
                        <select name="lab_id" id="lab_id" class="form-control">
                          <option selected disabled>-- Please Select Laboratory --</option>
                          <?php foreach($labs as $lab): ?>
                          <option value="<?= $lab['id'] ?>" <?=   ($lab['id'] == $value['lab_id']) ? 'selected':'' ?>><?= ucwords($lab['lab_name']) ?></option>
                          <?php endforeach; ?>
                        <!--  -->
                        </select>
                      </div>
                        <?php if(isset($errors['lab_id'])):?>
                          <p class="text-danger"><?=esc($errors['lab_id'])?><p>
                        <?php endif;?>


                        <div class="form-group">
                        <label class="form-label" for="professor_id">Professor</label>
                        <select name="professor_id" id="professor_id" class="form-control">
                          <option selected disabled>-- Please Select Professor --</option>
                          <?php foreach($professor as $prof): ?>
                          <option value="<?= $prof['id'] ?>" <?= ($prof['id'] == $value['professor_id']) ? 'selected':'' ?>><?= ucwords($prof['first_name']) ?> <?= ucwords($prof['last_name']) ?> <?= ucwords($prof['suffix_name']) ?> </option>
                          <?php endforeach; ?>
                        <!--  -->
                        </select>
                      </div>
                        <?php if(isset($errors['professor_id'])):?>
                          <p class="text-danger"><?=esc($errors['professor_id'])?><p>
                        <?php endif;?>


                        <div class="form-group">
                      <label class="form-label" for="start_time">Start Time</label>
                      <input type="time" class="form-control" value="<?=isset($value['start_time']) ? esc($value['start_time']): ''?>" placeholder="Start Time" id="start_time" name="start_time">
                    </div>
                      <?php if(isset($errors['start_time'])):?>
                        <p class="text-danger"><?=esc($errors['start_time'])?><p>
                      <?php endif;?>

                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">

                    <div class="form-group">
                        <label class="form-label" for="semester_id">Semester</label>
                        <select name="semester_id" id="semester_id" class="form-control">
                          <option selected disabled>-- Please Select Semester --</option>
                          <?php foreach($semesters as $semester): ?>
                          <option value="<?= $semester['id'] ?>" <?=   ($semester['id'] == $value['semester_id']) ? 'selected':'' ?>><?= ucwords($semester['sem']) ?></option>
                          <?php endforeach; ?>
                        <!--  -->
                        </select>
                      </div>
                        <?php if(isset($errors['semester_id'])):?>
                          <p class="text-danger"><?=esc($errors['semester_id'])?><p>
                        <?php endif;?>

                        <div class="form-group">
                        <label class="form-label" for="sy_id">School Year</label>
                        <select name="sy_id" id="sy_id" class="form-control">
                          <option selected disabled>-- Please Select School Year --</option>
                          <?php foreach($schoolyears as $schoolyear): ?>
                          <option value="<?= $schoolyear['id'] ?>" <?=   ($schoolyear['id'] == $value['sy_id']) ? 'selected':'' ?>><?= ucwords($schoolyear['start_sy']) ?> - <?= ucwords($schoolyear['end_sy']) ?></option>
                          <?php endforeach; ?>
                        <!--  -->
                        </select>
                      </div>
                        <?php if(isset($errors['sy_id'])):?>
                          <p class="text-danger"><?=esc($errors['sy_id'])?><p>
                        <?php endif;?>

                    <div class="form-group">
                      <label class="form-label" for="day">Day</label>
                      <select name="day" id="day" class="form-control">
                          <option selected disabled>-- Please Select Day --</option>
                          <option value="Monday" <?= ($value['day'] == 'Monday') ? 'selected':''?>> Monday </option>
                          <option value="Tuesday" <?= ($value['day'] == 'Tuesday') ? 'selected':''?>> Tuesday </option>
                          <option value="Wednesday"<?= ($value['day'] == 'Wednesday') ? 'selected':''?>> Wednesday </option>
                          <option value="Thursday"<?= ($value['day'] == 'Thursday') ? 'selected':''?>> Thursday </option>
                          <option value="Friday"<?= ($value['day'] == 'Friday') ? 'selected':''?>> Friday </option>
                          <option value="Satutrday"<?= ($value['day'] == 'Satutrday') ? 'selected':''?>> Satutrday </option>
                          <option value="Sunday"<?= ($value['day'] == 'Sunday') ? 'selected':''?>> Sunday </option>

                        <!--  -->
                        </select>
                    </div>
                      <?php if(isset($errors['day'])):?>
                        <p class="text-danger"><?=esc($errors['day'])?><p>
                      <?php endif;?>

                      <div class="form-group">
                      <label class="form-label" for="end_day">To Day (optional)</label>
                      <select name="end_day" id="end_day" class="form-control">
                          <option selected disabled>-- Please Select Day --</option>
                          <option value="Monday" <?= ($value['end_day'] == 'Monday') ? 'selected':''?>> Monday </option>
                          <option value="Tuesday" <?= ($value['end_day'] == 'Tuesday') ? 'selected':''?>> Tuesday </option>
                          <option value="Wednesday"<?= ($value['end_day'] == 'Wednesday') ? 'selected':''?>> Wednesday </option>
                          <option value="Thursday"<?= ($value['end_day'] == 'Thursday') ? 'selected':''?>> Thursday </option>
                          <option value="Friday"<?= ($value['end_day'] == 'Friday') ? 'selected':''?>> Friday </option>
                          <option value="Saturday"<?= ($value['end_day'] == 'Saturday') ? 'selected':''?>> Saturday </option>
                          <option value="Sunday"<?= ($value['end_day'] == 'Sunday') ? 'selected':''?>> Sunday </option>

                        <!--  -->
                        </select>
                    </div>
                      <?php if(isset($errors['end_day'])):?>
                        <p class="text-danger"><?=esc($errors['end_day'])?><p>
                      <?php endif;?>

                 <!-- /.form-group -->

                    <div class="form-group">
                       <label class="form-label" for="end_time">End Time</label>
                        <input type="time" class="form-control" value="<?=isset($value['end_time']) ? esc($value['end_time']): ''?>" placeholder="End Time" id="end_time" name="end_time">
                    </div>
                      <?php if(isset($errors['end_time'])):?>
                        <p class="text-danger"><?=esc($errors['end_time'])?><p>
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
        <!-- content -->
      </div>



    <!-- /.content -->
  </div>
