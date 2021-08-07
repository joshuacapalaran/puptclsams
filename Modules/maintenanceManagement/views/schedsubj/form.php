
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
          <div class="card card-outline card-info">
              <div class="card-header">
                <h3 class="card-title">Note: Please fill all data field.</h3>

                  <div class="card-tools">
                      <!-- <?= \Config\Services::validation()->listErrors(); ?> -->
                      <span class="d-none alert alert-success mb-3" id="res_message"></span>
                  </div>
              </div>
              <!-- /.card-header -->
            <form action="<?= base_url('admin/schedsubject')?>/<?= $edit ? 'edit/'.esc($id): 'add'?>" method="post" accept-charset="utf-8">
                <div class="card-body">

                  <div class="row">
                    <div class="col-md-6" id="first-column">
                      <div class="form-group">
                        <label class="form-label" for="subject_id">Subject*</label>
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
                          <label class="form-label" for="course_id">Course*</label>
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
                        <label class="form-label" for="section_id"> Year & Section*</label>
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
                        <label class="form-label" for="lab_id">Laboratory*</label>
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


                      <div class="form-group" id="date-div" hidden>
                       <label class="form-label" for="date">Date*</label>
                      <input type="text" class="form-control" value="<?=isset($value['date']) ? esc($value['date']): ''?>" placeholder="Date" id="datepicker1"  name="date">
                      
                      </div>
                      <?php if(isset($errors['date'])):?>
                        <p class="text-danger"><?=esc($errors['date'])?><p>
                      <?php endif;?>


                      <div class="form-group" id="day-div">
                        <label class="form-label" for="day">Day*</label>
                        <!-- <select name="day[]" id="day" class="form-control select2" multiple="multiple"> -->
                        <select name="day[]" id="day" class="form-control">
                            <option value="Monday" <?= in_array('Monday', explode(',',$value['day'] )) ? 'selected':''?>> Monday </option>
                            <option value="Tuesday" <?= in_array('Tuesday', explode(',',$value['day'] )) ? 'selected':''?>> Tuesday </option>
                            <option value="Wednesday"<?= in_array('Wednesday', explode(',',$value['day'] )) ? 'selected':''?>> Wednesday </option>
                            <option value="Thursday"<?= in_array('Thursday', explode(',',$value['day'] )) ? 'selected':''?>> Thursday </option>
                            <option value="Friday"<?= in_array('Friday', explode(',',$value['day'] )) ? 'selected':''?>> Friday </option>
                            <option value="Satutrday"<?= in_array('Satutrday', explode(',',$value['day'] )) ? 'selected':''?>> Satutrday </option>
                            <option value="Sunday"<?= in_array('Sunday', explode(',',$value['day'] )) ? 'selected':''?>> Sunday </option>
                        </select>
                      </div>
                      <!-- <?php if(isset($errors['day'])):?>
                        <p class="text-danger"><?=esc($errors['day'])?><p>
                      <?php endif;?> -->  


                      <div class="form-group" id="end-time-div">
                          <label class="form-label" for="end_time">End Time*</label>
                          <div class="input-group">
                              <input type="time" class="form-control" value="<?=isset($value['end_time']) ? esc($value['end_time']): ''?>" placeholder="End Time" id="end_time" name="end_time[]">
                              <div class="input-group-append" id="add-more-div">
                                <button class="input-group-text" id="add-more-input"><i class="fa fa-plus"></i></button>
                              </div>
                          </div>
                        </div>
                          <!-- <?php if(isset($errors['end_time'])):?>
                            <p class="text-danger"><?=esc($errors['end_time'])?><p>
                          <?php endif;?> -->

                        
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6" id="second-column">
                    <div class="form-group">
                        <label class="form-label" for="category">Category*</label>
                        <select name="category" id="category" class="form-control">
                          <option selected disabled>-- Please Select Category --</option>
                          <option value="1" <?= ( $value['category'] == 1) ? 'selected':'' ?>> Regular Class</option>
                          <option value="2" <?= ( $value['category'] == 2) ? 'selected':'' ?>> Make-up Class</option>
                        </select>
                      </div>
                      <?php if(isset($errors['category'])):?>
                        <p class="text-danger"><?=esc($errors['category'])?><p>
                      <?php endif;?>

                      <div class="form-group">
                        <label class="form-label" for="semester_id"> Semester*</label>
                        <select name="semester_id" id="semester_id" class="form-control">
                          <option selected disabled>-- Please Select semester --</option>
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
                        <label class="form-label" for="sy_id">School Year*</label>
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
                        <label class="form-label" for="professor_id">Professor*</label>
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

                        <div class="form-group" id="start-time-div">
                          <label class="form-label" for="start_time">Start Time*</label>
                          <input type="time" class="form-control" value="<?=isset($value['start_time']) ? esc($value['start_time']): ''?>" placeholder="Start Time" id="start_time" name="start_time[]">
                        </div>
                      <!-- <?php if(isset($errors['start_time'])):?>
                        <p class="text-danger"><?=esc($errors['start_time'])?><p>
                      <?php endif;?> -->
                        <div class="form-group col-md-12" id="blank-div">

                        <div class="col-md-12">&nbsp;<br></div><br><br>
                        </div>


                   
                    <!-- /.form-group -->
                    
                    </div>
                   
                    <!-- /.col -->
                  </div>
                  <div class="panel-footer text-right">
                      <button type="submit" class="btn btn-success pull-right">Save</button>
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
  <script src="<?=base_url();?>/plugins/select2/js/select2.min.js"></script>
  <script src="<?=base_url();?>/plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>
  <link href="<?=base_url();?>/plugins/bootstrap-datepicker/bootstrap-datepicker.css" rel="stylesheet"/>


  <script>
  $(".select2").select2({
    placeholder:'Please Select Day',
    width: "100%"
  });

$("#datepicker1").datepicker( {
  startDate: new Date()      
});
$(document).ready(function(){
    var dropdown = $('#category').find(':selected').val();
  if(dropdown == 2){
      $('#day-div').prop('hidden', true);
      $('#date-div').prop('hidden', false);
      
    }

  $(document).on('change','#category',function(){
    var category = $(this).val();
    if(category == 2){
      $('#day-div').prop('hidden', true);
      $('#date-div').prop('hidden', false);
      $('#add-more-div').prop('hidden', true);


    }else{
      $('#day-div').prop('hidden', false);
      $('#date-div').prop('hidden', true);
      $('#add-more-div').prop('hidden', false);

    }

  });
  $(document).on('click', '#add-more-input', function(e){
      e.preventDefault();

      startDiv = $('#start-time-div').html();
      endDiv = $('#end-time-div').html();
      dayDiv = $('#day-div').html();
      blankDiv = $('#blank-div').html();

     $('#first-column').append(dayDiv+endDiv);
     $('#second-column').append(startDiv+blankDiv);
  });

});
  </script>
