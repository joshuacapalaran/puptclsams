<sidebar class = "main-sidebar">
	<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: rgb(68,68,68);">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link d-flex align-items-center justify-content-center">
      <img src="<?=base_url();?>/stemp/img/taguig.png" alt="PUP logo" style="width: 70px; height: 70px">
     <!-- <span class="brand-text font-weight-light">CLAMS</span> -->
    </a>
     

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- SidebarSearch Form -->
     <!--  <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <?php if(isset($_SESSION['userPermmissions'])):?>
				       <?php user_primary_links($_SESSION['userPermmissions']);?>
            <?php else:?>
            <?php endif;?>

        </ul>
        
       
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->
</sidebar>
<script src="<?=base_url();?>/plugins/jquery/jquery.min.js"></script>

<script>


$('li.nav-item ul.nav-treeview li.nav-item a').each(function(){
	if($(this).hasClass('active')){
		$(this).parent().parent().parent().addClass('menu-is-opening menu-open');
	}
});

// var mins = 60 * 60;
// var active = setTimeout("logout()",(mins*1000));
// function logout()
// {
//     location='<?= base_url('logout'); ?>'; // <-- put your controller function here to destroy the session object and redirect the user to the login page.
// }


</script>