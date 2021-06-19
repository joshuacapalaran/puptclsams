<!doctype html>
<html lang="en">
  <head>
    <title>PUPTCLSAMS</title>
  </head>
  <style>

  </style>
  <body>
    <div class="d-lg-flex half">
      <div class="bg order-1 order-md-2" style="background-image: url('public/images/cover.jpg'); opacity:100%;"></div>
      <div class="contents order-2 order-md-1">
        <div class="container">
          <div class="row align-items-center justify-content-center">
            <div class="col-md-8">
              <center>
                <h3>Sign in to <strong>PUPTCLSAMS</strong></h3>
                <?php if(isset($_SESSION['error_login'])): ?>
                  <div class="alert alert-danger"><?= $_SESSION['error_login']; ?></div>
                <?php endif; ?>
              </center>
              <form action="<?= base_url() ?> " method="post">
                <div class="form-group first">
                  <label for="username">Username</label>
                  <input type="text" name="username" class="form-control" placeholder="Your Username" id="username" required>
                </div>
                <div class="form-group last mb-3">
                  <label for="password">Password</label>
                  <input type="password" name="password" class="form-control" placeholder="Your Password" id="password"required>
                </div>
                <input type="submit" value="Sign In" class="btn btn-block btn-dark" style="background-color:#E1AD01;">
                <hr>
                <a href="<?= base_url("Registration")?>"> <input type="button"  value="Sign Up" class="btn btn-block btn-dark" style="background-color:#4d0000;"> </a>
              </form>
            </div>
           <!--  <div class="col-md-7">
              <img src="<?= base_url() ?>/public/img/logooff.png" id="pup">
              <center><h3>Sign in to <strong>CWTSIS</strong></h3></center>
             <center><p class="mb-4">Civic Welfare Training Service Information System.</p></center>
              <?php if(isset($_SESSION['error_login'])): ?>
              <?= $_SESSION['error_login']; ?>
              </div>
              <?php endif; ?>
              <form action="<?= base_url() ?>" method="post">
                <div class="form-group first">
                  <label for="username">Username</label>
                  <input type="text" autocomplete="off" name="username" class="form-control" placeholder="Your Username" id="username" required>
                </div>
                <div class="form-group last mb-3">
                  <label for="password">Password</label>
                  <input type="password" name="password" class="form-control" placeholder="Your Password" id="password"required>
                </div>
                <input type="submit" value="Sign In" class="btn btn-block btn-dark" style="background-color:#E1AD01;">

              </form>
            </div> -->
          </div>
        </div>
      </div>
    </div>
  </body>
  <?php if(isset($_SESSION["success_registered"])): ?>
	<script type="text/javascript">
	    alert_success('<?= $_SESSION["success_registered"]; ?>');
	</script>
<?php endif; ?>
  <script type="text/javascript">
    $(function(){
      setTimeout(function(){
        $('.alert').hide();
      },5000);
    });
  </script>
</html>
