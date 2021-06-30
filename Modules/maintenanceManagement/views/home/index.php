<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid ">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <h2 class="m-0">Schedule Home</h2> -->
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Schedules</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
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
        </div>
    </div>
</div>
  <link href='https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.css' rel='stylesheet' />
<link href='https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.13.1/css/all.css' rel='stylesheet'>
<script>


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
        // console.log(event.event.extendedProps)
        $('#fullCalModal').modal();
        $('#modalTitle').html(event.event.title);
        
        var html = '';
        if(event.event.extendedProps.schedule == 'event'){
            html += '<span> Class: '+ event.event.title+'</span> <br>';
            html += '<span> Course: '+ event.event.extendedProps.course+'</span> <br>';
            html += '<span> Time: '+ event.event.extendedProps.time+'</span><br>';
            html += '<span> Laboratory Day: '+ event.event.extendedProps.lab_day+'</span><br>';
            html += '<span> Professor: '+ event.event.extendedProps.prof+'</span><br>';
        }else{
          html += '<span> Event Name: '+ event.event.title+'</span> <br>';
          html += '<span> Category: '+ event.event.extendedProps.category+'</span> <br>';
          html += '<span> Date: '+ event.event.extendedProps.date+'</span> <br>';
          html += '<span> Time: '+ event.event.extendedProps.time+'</span> <br>';
          html += '<span> Laboratory: '+ event.event.extendedProps.lab_name+'</span> <br>';
          html += '<span> Assigned Person: '+ event.event.extendedProps.assigned_person+'</span> <br>';
          html += '<span> No. of People: '+ event.event.extendedProps.num_people+'</span> <br>';

        }
          
        $('#modalBody').html(html);
      },

      failure: function() {
      alert('there was an error while fetching events!');
      },
     
    });
    calendar.render();
  });

</script>