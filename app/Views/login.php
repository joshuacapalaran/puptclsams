<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    <link href="<?=base_url();?>/plugins/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url();?>/stemp/css/style.css" rel="stylesheet" type="text/css">
    <title>Login</title>
</head>

<body>
    <!-- Container -->
    <div class="container" id="container">
      <!-- Row -->
      <div class="row">
        <!-- Sign Up -->
        <div class="col align-center flex-col sign-up">
          <div class="form-wrapper align-center">
            <form class="form sign-up">
              <div class="input-group">
                <i class="bx bxs-user"></i>
                <input type="text" placeholder="Username" />
              </div>
              <div class="input-group">
                <i class="bx bx-mail-send"></i>
                <input type="email" placeholder="Email" />
              </div>
              <div class="input-group">
                <i class="bx bxs-lock-alt"></i>
                <input type="password" placeholder="Password" />
              </div>
              <div class="input-group">
                <i class="bx bxs-lock-alt"></i>
                <input type="password" placeholder="Confirm password" />
              </div>
              <button>Sign up</button>
              <p>
                <span>Already have an account?</span>
                <b id="sign-in">Sign in here</b>
              </p>
            </form>
          </div>

          <div class="form-wrapper">
            <div class="social-list align-center sign-up">
              <div class="align-center facebook-bg">
                <i class="bx bxl-facebook"></i>
              </div>
              <div class="align-center google-bg">
                <i class="bx bxl-google"></i>
              </div>
              <div class="align-center twitter-bg">
                <i class="bx bxl-twitter"></i>
              </div>
              <div class="align-center insta-bg">
                <i class="bx bxl-instagram-alt"></i>
              </div>
            </div>
          </div>
        </div>
        <!-- End Sign Up -->
        <!-- Sign In -->
        <div class="col align-center flex-col sign-in">
          <div class="form-wrapper align-center">
          <form action="<?= base_url() ?> " method="post">
            <h1>Sign In</h1>
          <span>use your account</span>
          <?php if(isset($_SESSION['error_login'])): ?>
                  <div class="alert alert-danger"><?= $_SESSION['error_login']; ?></div>
          <?php endif; ?>
          <input type="text" name="username" class="form-control" placeholder="Your Username" id="username" required>
          <input type="password" name="password" class="form-control" placeholder="Your Password" id="password"required>
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" onclick="myFunction()">
            <label class="form-check-label" for="exampleCheck1">Show Password</label>
          </div>
          <button type="submit" value="Sign In" >Sign In</button>
          <!-- <input type="submit" value="Sign In" class="btn btn-block btn-dark" style="background-color:#E1AD01;"> -->
          </form>
              <button type="submit" value="Sign In" class="btn btn-sm btn-dark" style="background-color:rgb(68,68,68)">Sign In</button>
              <p>
                <span> Are you visitor? </span>
                <a data-toggle="modal" data-target="#modal-edit">Click here</a>
              </p>
              <p>
                <span> Don't have an account? </span>
                <a id="sign-up" href="<?php echo base_url('Registration') ?>">Sign up here</a>
              </p>
            </div>
          </div>

        </div>
        <!-- End Sign In -->
      </div>
      <!-- End Row -->
      <!-- Content Section -->
      <div class="row content-row">
        <!-- Sign In Content -->
        <div class="col align-items flex-col">
          <div class="text sign-in">
            <h2>Welcome Back</h2>
            <p>
              Computer Laboratory Scheduling, Attendance, and Monitoring System.
            </p>
          </div>
          <div class="img sign-in">
            <img src="<?= base_url() ?>/stemp/img/taguig.svg" alt="" />
          </div>
        </div>

        <!-- Sign Up Content -->
        <div class="col align-items flex-col">
          <div class="img sign-up">
            <img src="<?= base_url() ?>/stemp/img/taguig.svg" alt="" />
          </div>
          <div class="text sign-up">
            <h2>Join with us</h2>
            <p>
              Enter your details and start your journey with us.
            </p>
          </div>
        </div>
      </div>
    </div>
    <!-- End Container -->
    <!-- modal -->
    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Information</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="card-body">
              <form action="<?= base_url('admin/visitors/add')?>" method="post" accept-charset="utf-8">

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" class="form-control" value="<?=isset($value['name']) ? esc($value['name']): ''?>" placeholder="Name" id="name" name="name" required>
                    </div>
                    <?php if(isset($errors['name'])):?>
                    <p class="text-danger"><?=esc($errors['name'])?><p>
                    <?php endif;?>


                    <div class="form-group">
                    <label>Purpose</label>
                      <input type="text" class="form-control" value="<?=isset($value['purpose']) ? esc($value['purpose']): ''?>" placeholder="Purpose" id="purpose" name="purpose">
                    </div>
                    <?php if(isset($errors['purpose'])):?>
                        <p class="text-danger"><?=esc($errors['purpose'])?><p>
                    <?php endif;?>
                    <!-- /.form-group -->

                    <div class="form-group">
                    <label>Laboratory</label>
                    <select name="lab_id" id="lab_id" class="form-control">
                      <option selected disabled>-- Please Select Laboratory --</option>
                      <?php foreach($labs as $lab): ?>
                      <option value="<?= $lab['id'] ?>" <?=   ($lab['id'] == $value['lab_id']) ? 'selected':'' ?>><?= ucwords($lab['lab_name']) ?></option>
                      <?php endforeach; ?>
                    <!--  -->
                    </select>
                    </div>
                    <?php if(isset($errors['lab_id'])):?>
                        <p class="text-danger"><?=esc($errors['lab_id'])?><p>
                    <?php endif;?>

                    <div class="form-group">
                      <label>Event</label>
                      <select name="event_id" id="event_id" class="form-control">
                        <option selected disabled>-- Please Select Event --</option>
                        <?php foreach($events as $event): ?>
                        <option value="<?= $event['id'] ?>" <?=   ($event['id'] == $value['event_id']) ? 'selected':'' ?>><?= ucwords($event['event_name']) ?></option>
                        <?php endforeach; ?>
                      <!--  -->
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Others</label>
                          <input type="text" class="form-control" value="<?=isset($value['others']) ? esc($value['others']): ''?>" placeholder="Others" id="others" name="others">
                    </div>
                    <!-- /.form-group -->
                    </div>
                  <!-- /.col -->
                  </div>
                <!-- /.row -->

           <!-- /.row -->
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary"> Save changes</button>
            </div>
            </form>

          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
<?php if(isset($_SESSION["success_registered"])): ?>
	<script type="text/javascript">
	    alert_success('<?= $_SESSION["success_registered"]; ?>');
	</script>
<?php endif; ?>
  <script type="text/javascript">
    // $(function(){
    //   setTimeout(function(){
    //     $('.alert').hide();
    //   },5000);
    // });

    function myFunction() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
  </script>


</body>
</html>
