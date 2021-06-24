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
<div class="login-logo" >
    <a href="" style= "color: WHITE"><b>Welcome</b>LTE</a>
  </div>
      <div class="container" id="container">
        <div class="form-container sign-in-container center">
          <!-- login -->
          <form action="<?= base_url() ?> " method="post">
            <h1>Sign In</h1>
          <span>use your account</span>
          <?php if(isset($_SESSION['error_login'])): ?>
                  <div class="alert alert-danger"><?= $_SESSION['error_login']; ?></div>
          <?php endif; ?>
          <input type="text" name="username" class="form-control" placeholder="Your Username" id="username" required>
          <input type="password" name="password" class="form-control" placeholder="Your Password" id="password"required>
          <a href="#">Forgot Your Password</a>

          <button type="submit" value="Sign In" >Sign In</button>
          <!-- <input type="submit" value="Sign In" class="btn btn-block btn-dark" style="background-color:#E1AD01;"> -->
          </form>
          <!-- log in -->
        </div>
        <div class="overlay-container">
          <div class="overlay">
            <div class="overlay-panel overlay-left">
              <h1>Welcome Back!</h1>
              <p>To keep connected with us please login with your personal info</p>
              <button class="ghost" id="signIn">Sign In</button>
            </div>
            <div class="overlay-panel overlay-right">
              <img src="<?= base_url() ?>/stemp/img/puplogo.ico" style="width: 120px; height: 120px">
              <h1>C.L.S.A.M.S</h1>
              <p>Enter your details and start journey with us</p>
              <button class="ghost" >
              <a href="<?php echo base_url('Registration') ?>" style="color: #E1AD01">Create account</a></button>
            </div>
          </div>
        </div>
      </div>

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


</body>
</html>
