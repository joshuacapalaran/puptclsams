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
        <div class="row">
          <div class="col-12">
            <div class="card">
                <div class="card-header">
                  <div class="form-group col-md-6 offset-md-3">
                      <input id="schedule_id" name="schedule_id" value="<?= $schedule_id;?>" hidden>
                      <label class="form-label"><?= $subject['subj_code']?> <?= $subject['subj_name']?></label><br>

                      <label for="stud_num" class="form-label">Student Number</label>
                      <br>
                      <input name="stud_num" class="form-control" type="text" autocomplete="on" id="stud_num" placeholder="Student Number" required>
                  </div>
                  <div class="col-md-12">

                <center>
                  <button id="time_in" class="btn btn-success m-3">TIME IN</button>
                  <button id="time_out" class="btn btn-success m-3"> TIME OUT</button>
                </center>
              </div>
                </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table id="attendance" class="table table-bordered table-striped">
                      <thead>
                      <tr class="text-center">
                        <th>Student Number</th>
                        <th>Name</th>
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
      'excel'
      ]
  });
});

$('#time_in').on('click', function(){
  var student_num = $('#stud_num').val();
  var schedule_id = $('#schedule_id').val();
  $.ajax({
      url: "<?= base_url("admin/schedsubject/verify")?>",
      type: "POST",
      data: {student_num :student_num, schedule_id:schedule_id},
      success: function(response){
        console.log(response)
        location.reload();
      }
  });
});

$('#time_out').on('click', function(e){
  // e.preventDefault();
  var student_num = $('#stud_num').val();
  var schedule_id = $('#schedule_id').val();
  $.ajax({
      url: "<?= base_url("admin/schedsubject/attendanceTimeOut")?>",
      type: "POST",
      data: {student_num :student_num, schedule_id:schedule_id},
      success: function(response){
        console.log(response)
        // location.reload();
      }
  });
});
</script>
