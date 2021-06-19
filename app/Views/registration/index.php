<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">


    <title>CWTS-AIS PUPT</title>
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
                <img src="<?= base_url() ?>/public/img/logooff.png" style="position: static; height: 13%; width: 13%; padding-bottom: 5%;">
                <h3>Sign Up to <strong>PUPT-CLSAMS</strong></h3>
                <?php if(isset($_SESSION['error_login'])): ?>
                  <div class="alert alert-danger"><?= $_SESSION['error_login']; ?></div>
                <?php endif; ?>
              </center>
              <form action="<?= base_url("Registration") ?>" method="post">
                <div class="row">
                    <div class="col-sm-12">
                        <div id="" class="form-group">
                            <label>Student Number*</label>
                            <input placeholder="####-#####-TG-#" type="text" class="form-control" name="student_num">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div id="" class="form-group">
                            <label>First Name*</label>
                            <input placeholder="First Name" type="text" class="form-control" name="first_name">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div id="" class="form-group">
                            <label>Middle Initial*</label>
                            <input placeholder="Last Name" type="text" class="form-control" name="m_initial">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div id="" class="form-group">
                            <label>Last Name*</label>
                            <input placeholder="Last Name" type="text" class="form-control" name="last_name">
                        </div>
                    </div>
       
                    <div class="col-sm-6">
                        <div id="" class="form-group">
                            <label>Username*</label>
                            <input placeholder="Username" type="text" class="form-control" name="username">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div id="" class="form-group">
                            <label>Password*</label>
                            <input placeholder="Password" type="text" class="form-control" name="password">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div id="" class="form-group">
                            <label>Re-type Password*</label>
                            <input placeholder="Re-type Password" type="text" class="form-control" name="password_retype">
                        </div>
                    </div>

                    
                    
                </div>
                <input type="submit" value="Submit" class="btn btn-block btn-dark" style="background-color:#4d0000;">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>

  <script type="text/javascript">
    $(function(){
      setTimeout(function(){
        $('.alert').hide();
      },5000);
    });
  </script>
</html>
