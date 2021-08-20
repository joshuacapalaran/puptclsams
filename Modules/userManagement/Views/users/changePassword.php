
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid ">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-0"> Change Password</h2>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Change Password</li>
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
       
          <form action="<?= base_url("admin/users/change-password/".$_SESSION['uid'])?>" method="post" accept-charset="utf-8">
            <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="old_password">Old Password*</label>
                      <input name="old_password" type="password" value="" class="form-control <?= isset($errors['old_password']) ? 'is-invalid':' ' ?>" id="old_password" placeholder="Old Password">
                      <?php if(isset($errors['old_password'])):?>
                        <p class="text-danger"><?=esc($errors['old_password'])?><p>
                      <?php endif;?>  
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="password">New Password*</label>
                      <input name="password" type="password" value="" class="form-control <?= isset($errors['password']) ? 'is-invalid':' '  ?>" id="password" placeholder="Password">
                      <?php if(isset($errors['password'])):?>
                        <p class="text-danger"><?=esc($errors['password'])?><p>
                      <?php endif;?>  
                    </div>
                  </div>

                </div>
               

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="password_retype">Password Re-type*</label>
                      <input name="password_retype" type="password" value="" class="form-control <?= isset($errors['password_retype']) ? 'is-invalid':' '  ?>" id="password_retype" placeholder="Password Re-type">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" onclick="myFunction()">
                        <label class="form-check-label" for="exampleCheck1">Show Password</label>
                      </div>
                      <?php if(isset($errors['password_retype'])):?>
                        <p class="text-danger"><?=esc($errors['password_retype'])?><p>
                      <?php endif;?>  
                    </div>
                  </div>

                 
                </div>
                <div class="row">
                  <div class="col-md-6 offset-md-6">
                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                  </div>
                </div>
            </div>
  
          </form>
      </div>
    </div>
  </div>


    <!-- /.content -->
</div>

<script src="<?=base_url();?>/plugins/inputmask/inputmask.min.js"></script>
  <script src="<?=base_url();?>/plugins/inputmask/inputmask.extensions.min.js"></script>
  <script type="text/javascript">
    $(function(){
      // var inputmask = new Inputmask("9999-99999-TG-9");
      //     inputmask.mask($('[id*=username]'));
          
      // $('[id*=username]').on('keypress', function (e) {
      //     var number = $(this).val();
      //     if (number.length == 2) {
      //         $(this).val($(this).val() + '-');
      //     }
      //     else if (number.length == 7) {
      //         $(this).val($(this).val() + '-');
      //     }
      // });


      setTimeout(function(){
        $('.alert').hide();
      },5000);
    });

    function myFunction() {
      var x = document.getElementById("password");
      if (x.type === "password" ) {
        x.type = "text";
      } else {
        x.type = "password";
      }
      
      var retype = document.getElementById("password_retype");
      if (retype.type === "password" ) {
        retype.type = "text";
      } else {
        retype.type = "password";
      }
      
      var old_password = document.getElementById("old_password");
      if (old_password.type === "password" ) {
        old_password.type = "text";
      } else {
        old_password.type = "password";
      }
    }
  </script>