
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid ">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-0"><?= isset($rec) ? 'Editing': 'Adding'?> User</h2>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Users</li>
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
       
          <form action="<?= base_url("admin/users")?>/<?= isset($rec) ? 'edit/'.esc($rec['id']): 'add'?>" method="post" accept-charset="utf-8">
            <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="first_name">First name*</label>
                      <input name="first_name" type="text" value="<?= isset($rec['first_name']) ? $rec['first_name'] : set_value('first_name') ?>" class="form-control <?= isset($errors['first_name']) ? 'is-invalid':' ' ?>" id="first_name" placeholder="First Name">
                      <?php if(isset($errors['first_name'])):?>
                        <p class="text-danger"><?=esc($errors['first_name'])?><p>
                      <?php endif;?>  
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="last_name">Last Name*</label>
                      <input name="last_name" type="text" value="<?= isset($rec['last_name']) ? $rec['last_name'] : set_value('last_name') ?>" class="form-control <?= isset($errors['last_name']) ? 'is-invalid':' '  ?>" id="last_name" placeholder="Last Name">
                      <?php if(isset($errors['last_name'])):?>
                        <p class="text-danger"><?=esc($errors['last_name'])?><p>
                      <?php endif;?>  
                    </div>
                  </div>

                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="m_initial">M Initial*</label>
                      <input name="m_initial" type="text" value="<?= isset($rec['m_initial']) ? $rec['m_initial'] : set_value('m_initial') ?>" class="form-control <?= isset($errors['m_initial']) ? 'is-invalid':' '  ?>" id="m_initial" placeholder="M Initial">
                      <?php if(isset($errors['m_initial'])):?>
                        <p class="text-danger"><?=esc($errors['m_initial'])?><p>
                      <?php endif;?>  
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="username">User Name* (Student Number / Professor Number)</label>
                      <input name="username" type="text" value="<?= isset($rec['username']) ? $rec['username'] : set_value('username') ?>" class="form-control <?= isset($errors['username']) ? 'is-invalid':' '  ?>" id="username" placeholder="User name">
                      <?php if(isset($errors['username'])):?>
                        <p class="text-danger"><?=esc($errors['username'])?><p>
                      <?php endif;?>  
                    </div>
                  </div>

                  

                  
                </div>
              
               

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="password">Password (for change password)*</label>
                      <input name="password" type="password" value="<?= isset($rec['password']) ? '' : set_value('password') ?>" class="form-control <?= isset($errors['password']) ? 'is-invalid':' '  ?>" id="password" placeholder="Password">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" onclick="myFunction()">
                        <label class="form-check-label" for="exampleCheck1">Show Password</label>
                      </div>
                      <?php if(isset($errors['password'])):?>
                        <p class="text-danger"><?=esc($errors['password'])?><p>
                      <?php endif;?>  
                    </div>

                    <div class="input-group" id="section" >
                      <i class="bx bxs-user"></i>
                      <label class="form-label" for="section_id"></label>
                      <select name="section_id" id="section_id" class="form-control">
                        <option selected disabled>-- Please Select Section --</option>
                        <?php foreach($sections as $section): ?>
                        <option value="<?= $section['id'] ?>" <?=   ($section['id'] == $rec['section_id']) ? 'selected':'' ?>><?= ucwords($section['year']) ?> - <?= ucwords($section['section']) ?></option>
                        <?php endforeach; ?>
                      <!--  -->
                      </select>
                    </div>
                    <?php if(isset($errors['section_id'])):?>
                      <p class="text-danger"><?=esc($errors['section_id'])?><p>
                    <?php endif;?>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="username">Role*</label>
                      <select name="role_id" class="form-control <?= isset($errors['role_id']) ? 'is-invalid':' ' ?>" id="role_id">
                      <option selected disabled >Please select role</option>
                      <?php foreach($roles as $role): ?>
                      <?php if($role['id'] !== '1'): ?>
                        <option value="<?= $role['id'] ?>" <?= ($role['id'] == $rec['role_id'] ? 'selected':'')?>><?= ucwords($role['role_name']) ?></option>
                      <?php endif;?>
                      <?php endforeach; ?>
                    </select>
                      <?php if(isset($errors['role_id'])):?>
                        <p class="text-danger"><?=esc($errors['role_id'])?><p>
                      <?php endif;?>  
                    </div>
                    
                    <br>
                    
                    <div class="input-group" id="course" >
                      <i class="bx bxs-user"></i>
                      <label class="form-label" for="course_id" ></label>
                      <select name="course_id" id="course_id" class="form-control">
                        <option selected disabled>-- Please Select Course --</option>
                        <?php foreach($courses as $course): ?>
                        <option value="<?= $course['id'] ?>" <?=   ($course['id'] == $rec['course_id']) ? 'selected':'' ?>><?= ucwords($course['course_abbrev']) ?> - <?= ucwords($course['course_name']) ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <?php if(isset($errors['course_id'])):?>
                      <p class="text-danger"><?=esc($errors['course_id'])?><p>
                    <?php endif;?>
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
      $('#course').hide();
      $('#section').hide();
      var course_id = '<?= $rec['course_id']?>';
      var section_id = '<?= $rec['section_id']?>';
      if(course !== '' && section_id !== ''){
        $('#course').show();
        $('#section').show();
      }
      $(document).on('change','#role_id',function(e){
        if(this.value == 3){
          $('#course').show();
          $('#section').show();
        }else{
          $('#course').hide();
          $('#section').hide();
        }
      });


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
    }
  </script>