  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid ">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-0"><?= $edit ? 'Editing': 'Adding'?> Holiday</h2>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Holiday</li>
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
               
            <span class="d-none alert alert-success mb-3" id="res_message"></span>
            </div>
          </div>
          <!-- /.card-header -->
        <form action="<?= base_url('admin/holiday')?>/<?= $edit ? 'edit/'.esc($id): 'add'?>" method="post" accept-charset="utf-8">
          <div class="card-body">
           
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Holiday*</label>
                  <input type="text" class="form-control" value="<?=isset($value['name']) ? esc($value['name']): ''?>" placeholder="Holiday" id="name" name="name">

                </div>
                <?php if(isset($errors['name'])):?>
                      <p class="text-danger"><?=esc($errors['name'])?><p>
                <?php endif;?> 
                
              </div>
              <!-- /.col -->
              <div class="col-md-6">

                <div class="form-group">
                <label>Date*</label>
                <input type="text" class="form-control" value="<?=isset($value['date']) ? esc($value['date']): ''?>" placeholder="Date" id="datepicker1"  name="date">
                
                </div>
                <?php if(isset($errors['date'])):?>
                    <p class="text-danger"><?=esc($errors['date'])?><p>
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
      </div>


    <!-- /.content -->
  </div>
  <script src="<?=base_url();?>/plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>
  <link href="<?=base_url();?>/plugins/bootstrap-datepicker/bootstrap-datepicker.css" rel="stylesheet"/>

  <script>

$(function() { 
});
$.fn.datepicker.dates.en.titleFormat="MM";
$("#datepicker1").datepicker( {
    format: 'mm-dd',
    autoclose: true,
      startView: 1,
      maxViewMode: "months",
      orientation: "bottom left",        
});

  </script>