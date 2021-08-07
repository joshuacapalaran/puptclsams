<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid ">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-0">Attendance</h2>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Attendance</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
  <div class="container-fluid">
  <div class="col-12">
    <div class="card card-outline card-secondary">
        <div class="card-header">
          <div class="row">
            <div class="col-md-12">
              <form action="<?= base_url("admin/attendance") ?>" method="post">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="schyear_id">Date</label>
                      <input type="date" value="<?= isset($rec['date']) ? $rec['date']:''?>"class="form-control" id="date" name="date">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="section_id"> Year & Section</label>
                        <select name="section_id" id="section_id" class="form-control">
                          <option selected disabled>-- Please Select Section --</option>
                          <?php foreach($sections as $section): ?>
                          <option value="<?= $section['id'] ?>" <?=   ($section['id'] == $value['section_id']) ? 'selected':'' ?>><?= ucwords($section['year']) ?> - <?= ucwords($section['section']) ?></option>
                          <?php endforeach; ?>
                        <!--  -->
                        </select>
                      </div>
                      
                      <div class="form-group">
                        <label class="form-label" for="semester_id"> Semester</label>
                        <select name="semester_id" id="semester_id" class="form-control">
                          <option selected disabled>-- Please Select semester --</option>
                          <?php foreach($semesters as $semester): ?>
                          <option value="<?= $semester['id'] ?>" <?=   ($semester['id'] == $value['semester_id']) ? 'selected':'' ?>><?= ucwords($semester['sem']) ?></option>
                          <?php endforeach; ?>
                        <!--  -->
                        </select>
                      </div>

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

                  </div>



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

                  </div>

                </div>
                <div class="row">
                  <div class="col-md-5">
                    <button type="submit" class="btn btn-success">Submit</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>
  </div>
  </div>
</section>
  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-outline card-secondary">
                <div class="card-header">
                  <h3>List of Attendance</h3>
                </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table id="attendance" class="table table-bordered table-striped">
                      <thead>
                      <tr class="text-center">
                        <th>Student Number</th>
                        <th>Name</th>
                        <th>Subject/Event</th>
                        <th>Time in</th>
                        <th>Time out</th>
                        <th>Remarks</th>
                      </tr>
                      </thead>
                      <tbody class="text-center">
                      <?php $ctr = 1?>
                    <?php if(empty($attendances)): ?>
                      <tr>
                        <td colspan="9" class="text-center"> No Data Available </td>
                      </tr>
                    <?php else: ?>
                      <?php foreach($attendances as $attendance): ?>
                        <tr>
                          <td><?=esc($attendance['student_num'])?></td>
                          <td><?=esc($attendance['last_name'])?>, <?=esc($attendance['first_name'])?> <?=esc($attendance['m_initial'])?></td>
                          <td><?=esc($attendance['subj_name'] ? 'Subject: '.$attendance['subj_name']: 'Event: '.$attendance['event_name'])?></td>
                          <td><?=esc(date('H:i:s A', strtotime($attendance['time_in'])))?></td>
                          <td><?=esc(($attendance['time_out']) ? date('H:i:s A', strtotime($attendance['time_out'])):' ')?></td>
                          <td><?=esc($attendance['remarks'])?></td>
                          </tr>
                        <?php $ctr++?>
                      <?php endforeach; ?>
                    <?php endif; ?>
                      </tbody>

                    </table>
                  </div>
              <!-- /.card-body -->
            </div>
          </div>
      </div>

  </section>
</div>

<script>
$(function(){
  $('#attendance').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      dom: 'frtipB',
      buttons: [
        {
            text: 'Generate PDF',
            action: function ( e, dt, node, config ) {
                location.href = "<?= base_url('admin/attendance/pdf') ?>";
            }
        }
      ],
  });
});

$('#time_in').on('click', function(){
  var student_num = $('#stud_num').val();
  $.ajax({
      url: "<?= base_url("admin/attendance/verify")?>",
      type: "POST",
      data: {student_num :student_num},
      success: function(response){
        console.log(response)
        location.reload();
      }
  });
});

$('#time_out').on('click', function(e){
  // e.preventDefault();
  var student_num = $('#stud_num').val();

  $.ajax({
      url: "<?= base_url("admin/attendance/attendanceTimeOut")?>",
      type: "POST",
      data: {student_num :student_num},
      success: function(response){
        console.log(response)
        location.reload();
      }
  });
});

</script>
