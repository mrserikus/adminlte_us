<?php
require_once($abs_us_root . $us_url_root . 'users/includes/template/database_navigation_prep.php');
?>


<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="<?php echo $us_url_root; ?>index.php" class="brand-link">
    <img src="<?php echo $us_url_root; ?>users/images/logo.png" alt="LOGO" class="img img-fluid" height="82">

  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="info">
        <a class="d-block" href="<?=$us_url_root?>users/account.php"><i class="fa fa-fw fa-user"></i> <?php echo echouser($user->data()->id);?></a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search not programmed" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->

             <?php
               require_once($abs_us_root . $us_url_root . 'usersc/templates/' . $settings->template . '/assets/functions/dbnav.php');
             ?>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>



<?php
    if(isset($_GET['err'])){
      err("<font color='red'>".$err."</font>");
    }

    if(isset($_GET['msg'])){
      err($msg);
    }
