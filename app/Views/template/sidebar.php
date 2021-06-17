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
          <li class="nav-item menu-close">
            <a href="<?=base_url();?>/home" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Home
               <!--  <i class="right fas fa-angle-left"></i> -->
              </p>
            </a>
           
            <!-- <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="visitors.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Calendar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Time-in/Time-out</p>
                </a>
              </li>
            </ul> -->
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-cog"></i>
              <p>
                User Permission
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-check"></i>
              <p>
                User Role
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          <li class="nav-item menu-close">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Maintenance
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item" class="bg-white py-2 collapse-inner rounded">
                <a href="<?=base_url('admin/schoolyears')?>" class="nav-link">
                  <i class="fas fa-plus-square nav-icon"></i>
                  <p>Add School Year</p>
                </a>
              </li>
              <li class="nav-item" class="bg-white py-2 collapse-inner rounded">
                <a href="<?=base_url('admin/subjects')?>" class="nav-link">
                  <i class="fas fa-plus-square nav-icon"></i>
                  <p>Add Subject</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('admin/courses')?>" class="nav-link">
                  <i class="fas fa-plus-square nav-icon"></i>
                  <p>Add Courses
                    <!-- <span class="right badge badge-danger">New</span> -->
                  </p>
                </a>
              </li>
              <li class="nav-item" class="bg-white py-2 collapse-inner rounded">
                <a href="<?=base_url('admin/sections')?>" class="nav-link">
                  <i class="fas fa-plus-square nav-icon"></i>
                  <p>Add Section</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('admin/semesters')?>" class="nav-link">
                  <i class="fas fa-plus-square nav-icon"></i>
                  <p>Add Semester</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('admin/labs')?>" class="nav-link">
                  <i class="fas fa-plus-square nav-icon"></i>
                  <p>Add Lab</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('admin/capacities')?>" class="nav-link">
                  <i class="fas fa-plus-square nav-icon"></i>
                  <p>Add Capacity</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('admin/categories')?>" class="nav-link">
                  <i class="fas fa-plus-square nav-icon"></i>
                  <p>Add Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('admin/suffixes')?>" class="nav-link">
                  <i class="fas fa-plus-square nav-icon"></i>
                  <p>Add Suffix</p>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="nav-item menu-close">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-calendar alt"></i>
              <p>
                Set Schedule
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
           
            <ul class="nav nav-treeview">
              <!-- <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Schedule Subject</p>
                </a>
              </li> -->
              <li class="nav-item">
                <a href="<?=base_url('admin/schedlabs')?>" class="nav-link">
                  <i class="fas fa-calendar-alt"></i>
                  <p>Schedule Lab</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">Users</li>
          <li class="nav-item">
            <a href="<?=base_url('admin/students')?>" class="nav-link">
              <i class="nav-icon fas fa-user-graduate"></i>
              <p>
                Students
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=base_url('admin/professors')?>" class="nav-link">
              <i class="nav-icon fas fa-fw fa-user-tie"></i>
              <p>
                Professors
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=base_url();?>/visitors" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Visitors
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
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