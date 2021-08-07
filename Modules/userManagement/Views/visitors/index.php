
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid ">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-0">List of Visitors </h2>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Visitors</li>
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
              <form action="<?= base_url("admin/visitors") ?>" method="post">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="schyear_id">Date</label>
                      <input type="date" value="<?= isset($rec['date']) ? $rec['date']:''?>"class="form-control" id="date" name="date">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="attendee">Attendee</label>
                      <select id="attendee" class="form-control" name="attendee" >
                        <option value="all">All</option>
                        <?php foreach($schedlabs as $sched):?>
                          <option value="<?= $sched['id'];?>" <?= ($sched['id'] == $rec['attendee']) ? 'selected':''?>><?= $sched['event_name'];?> </option>
                        <?php endforeach;?>
                        <option value="others" <?= ($rec['attendee'] == 'others') ? 'selected':''?>>Others</option>

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
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- form -->

          <div class="col-12">
            <div class="card card-outline card-secondary">
                <div class="card-header">
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                  <table id="visitorTable" class="table table-bordered table-striped">
                    <thead>
                    <tr class="text-center">
                      <th>#</th>
                      <th>Name</th>
                      <th>Laboratory Name</th>
                      <th>Date</th>
                      <!-- <th>Time out</th> -->
                    </tr>
                    </thead>
                    <tbody class="text-center">
                    <?php $ctr = 1?>
                      <?php if(empty($visitors)): ?>
                        <tr>
                          <td colspan="6" class="text-center"> No Data Available </td>
                        </tr>
                      <?php else: ?>
                        <?php foreach($visitors as $visitor): ?>
                          <tr>
                            <td><?=esc($ctr)?></td>
                            <td><?=esc($visitor['name'])?></td>
                            <td><?=esc($visitor['lab_name'])?></td>
                            <td><?=esc(date('F d, Y', strtotime($visitor['date'])))?></td>

                            <!-- <td><?=esc(date('h:i A', strtotime($visitor['time_in'])))?></td>
                            <td><?=esc(($visitor['time_out'] != '0000-00-00 00:00:00') ? date('h:i A', strtotime($visitor['time_out'])) :'')?></td> -->


                      </tr>
                      <?php $ctr++?>
                      <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                    <!-- <tfoot>
                    <tr class="text-center">
                      <th>#</th>
                      <th>Laboratory Name</th>
                      <th>Action</th>
                    </tr>
                    </tfoot> -->
                  </table>
                </div>
              <!-- /.card-body -->
            </div>
        </div>
        <!-- col 7 -->
      </div>
    </div>
  </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script src="<?= base_url();?>public/js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script type="text/javascript" charset="utf8" src="<?= base_url();?>\public\plugins\datatables-buttons\js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8" src="<?= base_url();?>\public\plugins\datatables-buttons\js/buttons.html5.min.js"></script>
<script type="text/javascript" src="<?= base_url();?>\public\plugins\datatables-buttons\js/pdfmake.min.js"></script>
<script type="text/javascript" src="<?= base_url();?>\public\plugins\datatables-buttons\js/vfs_fonts.js"></script>

<script>
	$(document).ready( function () {
		var date = $('#date').val();
		var attendee = $('#attendee').find(":selected").text();
    if(date == ''){
      current_date = new Date();
      month = current_date.getMonth() + 1;
      date = month + '-' + current_date.getDate() + '-' +  current_date.getFullYear();
    }
    if(attendee == 'All'){
      attendee = ' ';
    }
		$('#visitorTable').DataTable({
			"bInfo": false,
			dom: 'lft<"#space">Bip',
			buttons: [
				// 'csvHtml5',
				// 'excelHtml5',
				{
					extend: 'pdfHtml5',
					text: 'To PDF',
					className: 'btn btn-sm btn-primary rounded-pill px-3 mb-3 mb-sm-0',
					messageTop: ' ',
					download: 'open',
					orientation: 'landscape',
					title: attendee+' ('+date+')',
					customize: function ( doc, btn, tbl ) {

						pdfMake.tableLayouts = {
							exampleLayout: {
							hLineWidth: function (i) {
								return 0.5;
							},
							vLineWidth: function (i) {
								return 0.5;
							},
							hLineColor: function (i) {
								return 'black';
							},
							vLineColor: function (i) {
								return 'black';
							},
							paddingLeft: function (i) {
							 return i === 0 ? 0 : 50;
							},
							paddingRight: function (i, node) {
							 return (i === node.table.widths.length - 1) ? 0 : 50;
							}
							}
						};

						doc.content[2].layout = 'exampleLayout';



					}
					// pageSize: 'LEGAL'
            	}
			]
		});
	});


</script>
