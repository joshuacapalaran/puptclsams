<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    <link href="<?=base_url();?>/plugins/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url();?>/stemp/css/style.css" rel="stylesheet" type="text/css">


    <title>CLSAMS</title>
  </head>
  <style>
    
  </style>
  <body>
  <div class="login-logo" >
    <a href="" style= "color: WHITE"><b>Welcome</b>LTE</a>
  </div>
    <div class="justify-content-center" class="container" id="container">

      <div class="bg order-1 order-md-2" style="background-image: url('public/images/cover.jpg'); opacity:100%;"></div>
      <div>
        <div class="container">
          <div class="align-items-center">
            <div class="col-md-12">
              <center>
                <!-- <img src="<?= base_url() ?>/public/img/logooff.png" style="position: static; height: 13%; width: 13%; padding-bottom: 5%;"> -->
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
                      <div class="form-group">
                          <label class="form-label" for="course_id" >Course*</label>
                          <select name="course_id" id="course_id" class="form-control">
                            <option selected disabled>-- Please Select Course --</option>
                            <?php foreach($courses as $course): ?>
                            <option value="<?= $course['id'] ?>" <?=   ($course['id'] == $value['course_id']) ? 'selected':'' ?>><?= ucwords($course['course_abbrev']) ?> - <?= ucwords($course['course_name']) ?></option>
                            <?php endforeach; ?>
                          <!--  -->
                          </select>
                      </div>
                      <?php if(isset($errors['course_id'])):?>
                          <p class="text-danger"><?=esc($errors['course_id'])?><p>
                        <?php endif;?>
                    </div>
                   
                    <div class="col-sm-6">
                        <div id="" class="form-group">
                            <label>Username*</label>
                            <input placeholder="Username" type="text" class="form-control" name="username">
                        </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group">
                          <label class="form-label" for="section_id">Section*</label>
                          <select name="section_id" id="section_id" class="form-control">
                            <option selected disabled>-- Please Select Section --</option>
                            <?php foreach($sections as $section): ?>
                            <option value="<?= $section['id'] ?>" <?=   ($section['id'] == $value['section_id']) ? 'selected':'' ?>><?= ucwords($section['year']) ?> - <?= ucwords($section['section']) ?></option>
                            <?php endforeach; ?>
                          <!--  -->
                          </select>
                      </div>
                        <?php if(isset($errors['section_id'])):?>
                          <p class="text-danger"><?=esc($errors['section_id'])?><p>
                        <?php endif;?>
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
                <input type="submit" value="Submit" class="btn btn-sm btn-dark" style="background-color:#4d0000;" style=" padding-bottom: 100%;">
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
