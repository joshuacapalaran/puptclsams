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
                  <form method="post">
                  <div class="form-group col-md-6 offset-md-3">

                      <label for="stud_num" class="form-label">Student Number</label><br>
                      <span>  <?= $info['event_name'] ? 'Event: '.$info['event_name']:'Subject: '.$info['subj_code'].' - '.$info['subj_name']; ?> <br> Date:  <?= $data['date']?> <br> Time: <?= $info['start_time']?> - <?=$info['end_time']?></span>
                      <br>
                      <input name="stud_num" class="form-control" type="text" autocomplete="on" id="stud_num" placeholder="Student Number" required>
                  </div>
                  <div class="col-md-12">

                <center>
                  <button id="time_in" type="submit" class="btn btn-success m-3">TIME IN</button>
                  <button id="time_out" type="submit" class="btn btn-danger m-3"> TIME OUT</button>
                </center>
                  </div>
                </form>

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
                          <td><?=esc($attendance['subj_name'] ? $attendance['subj_name']:$attendance['event_name'])?></td>
                          <td><?=esc(($attendance['time_in']) ? date('h:i:s A', strtotime($attendance['time_in'])):' ')?></td>
                          <td><?=esc(($attendance['time_out']) ? date('h:i:s A', strtotime($attendance['time_out'])):' ')?></td>
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
var sched_data =  JSON.parse('<?= json_encode($data);?>');
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
            text: 'Generate Report',
            action: function ( e, dt, node, config ) {
                location.href = "<?= base_url('admin/schedules/pdf') ?>?id="+sched_data['id']+"&date="+sched_data['date']+"&type="+sched_data['type'];
            }
        }
      ],
  });
});

$('#time_in').on('click', function(e){
  e.preventDefault();
  var student_num = $('#stud_num').val();
  $.ajax({
      url: "<?= base_url("admin/schedules/verify")?>",
      type: "POST",
      data: {student_num :student_num,sched_data:sched_data},
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
      url: "<?= base_url("admin/schedules/attendanceTimeOut")?>",
      type: "POST",
      data: {student_num :student_num,sched_data:sched_data},
      success: function(response){
        console.log(response)
        location.reload();
      }
  });
});
// $(function(){
//   setTimeout(function(){
//     $('.alert').hide();
//   },5000);
// });
</script>
