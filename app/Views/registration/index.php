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
    <title>SignUp</title>
</head>

<body>
    <!-- Container -->
    <div class="container" id="container">
      <!-- Row -->
    
      <div class="row" >
        <!-- Sign Up -->
        
       
         <div class="col align-center flex-col sign-up">
         <!-- <h5>Sign Up to <strong>PUPT-CLSAMS</strong></h5> -->
          <div class="form-wrapper align-center">
            <form class="form sign-up" action="<?= base_url("Registration") ?>" method="post">
             <div class="form-group">
                <i class="bx bxs-user"></i>
                <input placeholder="Student Number" type="text" class="form-control" name="student_num">
              </div>
             <div class="form-group">
                <i class="bx bxs-user"></i>
                <input placeholder="First Name" type="text" class="form-control" name="first_name">
              </div>
             <div class="form-group">
                <i class="bx bxs-user"></i>
                <input placeholder="Middle Initial" type="text" class="form-control" name="m_initial">
              </div>
              <div class="form-group">
                <i class="bx bxs-user"></i>
                <input placeholder="Last Name" type="text" class="form-control" name="last_name">
              </div>
              <div class="input-group">
                <i class="bx bxs-user"></i>
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
              <div class="input-group">
                <i class="bx bxs-user"></i>
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
              <div class="form-group">
                <i class="bx bxs-user"></i>
                <input placeholder="Username" type="text" class="form-control" name="username">
              </div>
            
              <div class="form-group">
                <i class="bx bxs-lock-alt"></i>
                <input placeholder="Password" type="password" class="form-control" name="password">
              </div>
              <div class="form-group">
                <i class="bx bxs-lock-alt"></i>
                <input placeholder="Re-type Password" type="password" class="form-control" name="password_retype">
              </div>
              <button type="submit" value="Sign Up" class="btn btn-sm btn-dark" style="background-color:rgb(68,68,68)">Sign up</button>
              <p>
                <span>Already have an account?</span>
                <a id="sign-in" href="<?php echo base_url('http://localhost:8080/') ?>">Sign in here</a>
              </p>
            </form>
          </div>
        </div>
        <!-- End Sign Up -->
        <!-- Sign In -->
        <div class="col align-center flex-col sign-in">
          <div class="form-wrapper align-center">
          <form action="<?= base_url() ?> " method="post">
            <div class="form sign-in">
              <div class="input-group">
                <i class="bx bxs-user"></i>
                <input type="text" name="username" class="form-control" placeholder="Your Username" id="username" required>
              </div>
              <div class="input-group">
                <i class="bx bxs-lock-alt"></i>
                <input type="password" name="password" class="form-control" placeholder="Your Password" id="password"required>
              </div>
          </form>
              <button type="submit" value="Sign In" >Sign In</button>
              <?php if(isset($_SESSION["success_registered"])): ?>
                <script type="text/javascript">
                    alert_success('<?= $_SESSION["success_registered"]; ?>');
                </script>
              <?php endif; ?>
              <p>
                <b>Forgot password?</b>
              </p>
              <p>
                <span> Don't have an account? </span>
                <b id="sign-up">Sign up here</b>
              </p>
            </div>
          </div>

          <div class="form-wrapper">
            <div class="social-list align-center sign-in">
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
              Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quae et
              cumque consectetur illo accusamus impedit eos ut. Eos, odit
              facilis.
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
            (CLSAMS) are used to track and monitor the 
            lab users in school hours and late arrivals, early departures, time taken on breaks and absenteeism.
            </p>
          </div>
        </div>
      </div>
    </div>
    <!-- End Container -->

    <!-- Script -->
    <script>
      const container = document.getElementById("container");
      const signIn = document.getElementById("sign-up");
      // const signUp = document.getElementById("sign-in");

      setTimeout(() => {
        container.classList.add("sign-up");
      }, 200);

      const toggle = () => {
        container.classList.toggle("sign-up");
        // container.classList.toggle("sign-in");
      };

      signIn.addEventListener("click", toggle);
      signUp.addEventListener("click", toggle);

    </script>

    <script src="<?=base_url();?>/plugins/jquery/jquery.min.js"></script>
      <script src="<?=base_url();?>/plugins/inputmask/inputmask.min.js"></script>
      <script src="<?=base_url();?>/plugins/inputmask/inputmask.extensions.min.js"></script>
      <script type="text/javascript">
        $(function(){
          var inputmask = new Inputmask("9999-99999-TG-9");
              inputmask.mask($('[id*=student_num]'));

          $('[id*=student_num]').on('keypress', function (e) {
              var number = $(this).val();
              if (number.length == 2) {
                  $(this).val($(this).val() + '-');
              }
              else if (number.length == 7) {
                  $(this).val($(this).val() + '-');
              }
          });


          setTimeout(function(){
            $('.alert').hide();
          },5000);
        });

        function myFunction() {
          var x = document.getElementById("password");
          var retype = document.getElementById("password-retype");
          if (x.type === "password" || retype.type == "password") {
            x.type = "text";
            retype.type = "text";
          } else {
            x.type = "password";
            retype.type = "password";
          }
        }
      </script>
      
  </body>
</html>
