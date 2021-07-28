<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid ">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-0">Dashboard</h2>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
  <!-- dashboard -->
  <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $attendance;?></h3>

                <p>Time-in</p>
              </div>
              <div class="icon">
                <i class="far fa-clock"></i>
              </div>
              <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= $total_capacities;?></sup></h3>

                <p>Room Capacity</p>
              </div>
              <div class="icon">
              <i class="fas fa-chart-bar"></i>
              </div>
              <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= $total_registered;?></h3>

                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-plus"></i>
              </div>
              <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?= $visitors;?></h3>

                <p>Visitors</p>
              </div>
              <div class="icon">
                 <i class="fas fa-users"></i>
              </div>
              <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->
        <!-- <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Monthly Recap Report</h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                      <i class="fas fa-wrench"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                      <a href="#" class="dropdown-item">Action</a>
                      <a href="#" class="dropdown-item">Another action</a>
                      <a href="#" class="dropdown-item">Something else here</a>
                      <a class="dropdown-divider"></a>
                      <a href="#" class="dropdown-item">Separated link</a>
                    </div>
                  </div>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-8">
                    <p class="text-center">
                      <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
                    </p>

                    <div class="chart">
                      <canvas id="salesChart" height="180" style="height: 180px;"></canvas>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <p class="text-center">
                      <strong>Goal Completion</strong>
                    </p>

                    <div class="progress-group">
                      Add Products to Cart
                      <span class="float-right"><b>160</b>/200</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: 80%"></div>
                      </div>
                    </div>

                    <div class="progress-group">
                      Complete Purchase
                      <span class="float-right"><b>310</b>/400</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" style="width: 75%"></div>
                      </div>
                    </div>

                    <div class="progress-group">
                      <span class="progress-text">Visit Premium Page</span>
                      <span class="float-right"><b>480</b>/800</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-success" style="width: 60%"></div>
                      </div>
                    </div>

                    <div class="progress-group">
                      Send Inquiries
                      <span class="float-right"><b>250</b>/500</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-warning" style="width: 50%"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> -->
      </div>
   </section>

   <div class="content-header">
      <div class="container-fluid ">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3 class="m-0">Calendar</h3>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
  <!-- calendar -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
         <!-- <div class="card card-primary">
            <div class="card-body p-0">
                  <div id="calendar"></div>
            </div>
          </div> -->
          <div class="card card-outline card-secondary">
              <div class="card-header">
                <h3 class="card-title">Note: Click on the specific schedule to view details.</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div id="calendar"></div>
              </div>
            </div>
        </div>
        </div>
  </section>
    <!-- /.content -->
  </div>

  <div id="fullCalModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="modalTitle" class="modal-title"></h4>
            </div>
            <div id="modalBody" class="modal-body">

            </div>
            <div class="modal-footer">
              <button type="submit" id="cancel-schedule" class="btn btn-success">Cancel Schedule</button>
              <button type="submit" id="attendance" class="btn btn-primary">Attendance</button>
            </div>
        </div>
    </div>
</div>
  <link href='https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.css' rel='stylesheet' />
<link href='https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.13.1/css/all.css' rel='stylesheet'>
<script>

var holidays = JSON.parse('<?= json_encode($holidays); ?>');

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      // initialView: 'dayGridMonth',
      events: {
        url: "<?= base_url('admin/schedules/events')?>",
        timeZone: 'H:mm',

      },
      headerToolbar: {
        start: 'prev,next today',
        center: 'title',
        end: 'dayGridMonth,dayGridWeek,dayGridDay,dayGridlist'
      },
      eventClick: function(event) {
        var eventDate = moment(event.event.start).format('YYYY-MM-DD');
        $('#fullCalModal').modal();
        if(event.event.extendedProps.time !== undefined && event.event.extendedProps.lab_day !== undefined){
          $('#attendance').show();
        }else{
          $('#attendance').hide();

        }
        $('#cancel-schedule').click(function(e){
          e.preventDefault();
            $.ajax({
              url:"<?= base_url('admin/schedules/cancelSchedule')?>",
              type: "POST",
              data: {id:event.event.id,lab_id:event.event.extendedProps.lab_id, type: event.event.extendedProps.schedule, date: eventDate},
              success:function(response){
                console.log(response)
                location.reload()
              }
            });
        });
        
        $('#attendance').click(function(e){
            window.location.href = "<?= base_url('admin/schedules/attendance') ?>?id="+event.event.id+"&type="+event.event.extendedProps.schedule+"&date="+eventDate;
        });

        $('#modalTitle').html(event.event.title);

        var months = ["January", "Febuary", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        var html = '';
        if(event.event.extendedProps.schedule == 'event'){
            html += '<span> Class: '+ event.event.title+'</span> <br>';
            html += '<span> Course: '+ event.event.extendedProps.course+'</span> <br>';
          if(event.event.extendedProps.time !== undefined && event.event.extendedProps.lab_day !== undefined){
            html += '<span> Time: '+ event.event.extendedProps.time+'</span><br>';
            html += '<span> Laboratory Day: '+ event.event.extendedProps.lab_day+'</span><br>';
          }else{
            var date = new Date(event.event.extendedProps.lab_day);
            var month = months[date.getMonth()];
            html += '<span> Laboratory Day: '+month+' '+date.getDate()+', '+date.getFullYear()+'</span><br>';
          }
            html += '<span> Professor: '+ event.event.extendedProps.prof+'</span><br>';

        }else{
          html += '<span> Event Name: '+ event.event.title+'</span> <br>';
          html += '<span> Category: '+ event.event.extendedProps.category+'</span> <br>';
          var date = new Date(event.event.extendedProps.date);
          var month = months[date.getMonth()];
          html += '<span> Date: '+month+' '+date.getDate()+', '+date.getFullYear()+'</span> <br>';
          html += '<span> Time: '+ event.event.extendedProps.time+'</span> <br>';
          html += '<span> Laboratory: '+ event.event.extendedProps.lab+'</span> <br>';
          html += '<span> Assigned Person: '+ event.event.extendedProps.assigned_person+'</span> <br>';
          html += '<span> No. of People: '+ event.event.extendedProps.num_people+'</span> <br>';

        }

        $('#modalBody').html(html);
      },
      eventDidMount: function(arg) {
        var eventDate = moment(arg.event.start).format('YYYY-MM-DD');
        var eventId = arg.event._def.publicId;

        if(arg.event.extendedProps.schedule == 'event'){

          $.each(holidays,function(index,val){
            if(val.schedsubj_id == eventId && val.date == eventDate){
              // console.log(val.schedsubj_id)
              $(arg.el).hide();

            }
          });

        }
        else if(arg.event.extendedProps.schedule == 'lab'){

          $.each(holidays,function(index,val){
            if(val.schedlab_id == eventId && val.date == eventDate){
              // console.log(val.schedsubj_id)
              $(arg.el).hide();
            }
          });
        }

      },
      failure: function() {
      alert('there was an error while fetching events!');
      },

    });
    calendar.render();
  });

</script>