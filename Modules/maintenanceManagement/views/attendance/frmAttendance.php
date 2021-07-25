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
    <div class="col-md-12">
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Time in / Time out</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <div class="form-group col-md-6 offset-md-3">
                      
                      <label for="stud_num" class="form-label">Student Number</label>
                      <br>
                      <input name="stud_num" class="form-control" type="text" autocomplete="on" id="stud_num" placeholder="Student Number" required>
                  </div>
                  <div class="col-md-12">

                <center>
                  <button id="time_in" class="btn btn-success m-3">TIME IN</button>
                  <button id="time_out" class="btn btn-danger m-3"> TIME OUT</button>
                </center>
              </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
      </div>
       
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
                    <table id="example1" class="table table-bordered table-striped">
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
