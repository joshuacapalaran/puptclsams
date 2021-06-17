
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid ">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-0"><?= $edit ? 'Editing': 'Adding'?> Lab Schedule</h2>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Lab Schedule</li>
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
                      <?= \Config\Services::validation()->listErrors(); ?>
                      <span class="d-none alert alert-success mb-3" id="res_message"></span>
                  </div>
              </div>
              <!-- /.card-header -->
            <form action="<?= base_url('admin/schedlabs')?>/<?= $edit ? 'edit/'.esc($id): 'add'?>" method="post" accept-charset="utf-8">
                <div class="card-body">
                 
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-label" for="event_name">Event Name</label>
                          <input type="text" class="form-control" value="<?=isset($value['event_name']) ? esc($value['event_name']): ''?>" placeholder="Event Name" id="event_name" name="event_name">
                      </div>
                        <?php if(isset($errors['event_name'])):?>
                          <p class="text-danger"><?=esc($errors['event_name'])?><p>
                        <?php endif;?>

                    <div class="form-group">
                      <label class="form-label" for="assigned_person">Assigned Person</label>
                    
                      <input type="text" class="form-control" value="<?=isset($value['assigned_person']) ? esc($value['assigned_person']): ''?>" placeholder="Assigned Person" id="assigned_person" name="assigned_person">
                    </div>
                      <?php if(isset($errors['assigned_person'])):?>
                        <p class="text-danger"><?=esc($errors['assigned_person'])?><p>
                      <?php endif;?>

                    <div class="form-group">
                      <label class="form-label" for="num_people">No. of People</label>
                        <input type="number" class="form-control" value="<?=isset($value['num_people']) ? esc($value['num_people']): ''?>" placeholder="No. of People" id="num_people" name="num_people">
                      </div>
                        <?php if(isset($errors['num_people'])):?>
                          <p class="text-danger"><?=esc($errors['num_people'])?><p>
                        <?php endif;?>
                      
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="form-group">
                      <label class="form-label" for="date">Dates</label>
                      <input type="date" class="form-control" value="<?=isset($value['date']) ? esc($value['date']): ''?>" placeholder="Date" id="date" name="date">
                    </div>
                      <?php if(isset($errors['date'])):?>
                        <p class="text-danger"><?=esc($errors['date'])?><p>
                      <?php endif;?>              
                 
                 <!-- /.form-group -->
                    <div class="form-group">
                      <label class="form-label" for="start_time">Start Time</label>
                      <input type="time" class="form-control" value="<?=isset($value['start_time']) ? esc($value['start_time']): ''?>" placeholder="Start Time" id="start_time" name="start_time">
                    </div>
                      <?php if(isset($errors['start_time'])):?>
                        <p class="text-danger"><?=esc($errors['start_time'])?><p>
                      <?php endif;?>
             
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
  