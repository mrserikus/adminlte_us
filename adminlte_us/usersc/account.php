<?php
// This is a user-facing page
/*
UserSpice 5
An Open Source PHP User Management System
by the UserSpice Team at http://UserSpice.com

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/
require_once '../users/init.php';
if (!securePage($_SERVER['PHP_SELF'])) {
    die();
}
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
$hooks = getMyHooks();
includeHook($hooks, 'pre');


if (!empty($_POST['uncloak'])) {
    logger($user->data()->id, 'Cloaking', 'Attempting Uncloak');
    if (isset($_SESSION['cloak_to'])) {
        $to = $_SESSION['cloak_to'];
        $from = $_SESSION['cloak_from'];
        unset($_SESSION['cloak_to']);
        $_SESSION[Config::get('session/session_name')] = $_SESSION['cloak_from'];
        unset($_SESSION['cloak_from']);
        logger($from, 'Cloaking', 'uncloaked from '.$to);
        Redirect::to($us_url_root.'users/admin.php?view=users&err=You+are+now+you!');
    } else {
        Redirect::to($us_url_root.'users/logout.php?err=Something+went+wrong.+Please+login+again');
    }
}

//dealing with if the user is logged in
if ($user->isLoggedIn() || !$user->isLoggedIn() && !checkMenu(2, $user->data()->id)) {
    if (($settings->site_offline == 1) && (!in_array($user->data()->id, $master_account)) && ($currentPage != 'login.php') && ($currentPage != 'maintenance.php')) {
        $user->logout();
        logger($user->data()->id, 'Errors', 'Sending to Maint');
        Redirect::to($us_url_root.'users/maintenance.php');
    }
}
$grav = get_gravatar(strtolower(trim($user->data()->email)));
$get_info_id = $user->data()->id;
// $groupname = ucfirst($loggedInUser->title);
$raw = date_parse($user->data()->join_date);
$signupdate = $raw['month'].'/'.$raw['day'].'/'.$raw['year'];
$userdetails = fetchUserDetails(null, null, $get_info_id); //Fetch user details
?>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <?php
                  if (isset($user->data()->steam_avatar) && $user->data()->steam_avatar != '') {
                      $grav = $user->data()->steam_avatar;
                  } elseif (isset($user->data()->picture) && $user->data()->picture != '') {
                      $grav = $user->data()->picture;
                  }
                  ?>
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="<?=$grav; ?>"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?=ucfirst($user->data()->fname).' '.ucfirst($user->data()->lname); ?> </h3>

                <p class="text-muted text-center"><?=echousername($user->data()->id); ?></p>


                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b><?=lang('ACCT_SINCE'); ?></b> <a class="float-right"><?=$signupdate; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b><?=lang('ACCT_LOGINS'); ?></b> <a class="float-right"><?=$user->data()->logins; ?></a>
                  </li>
                </ul>

                <?php if (isset($_SESSION['cloak_to'])) { ?>
                  <form class="" action="" method="post">
                    <input type="submit" name="uncloak" value="Uncloak!" class='btn btn-danger btn-block'>
                  </form><br>
                  <?php }
                      ?>



              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          <div class="col-md-9">
            <?php includeHook($hooks, 'body'); ?>
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="settings">
                    <form class="form-horizontal">
                      <div class="form-group row">
                        <a class="btn btn-app" href="../users/user_settings.php" >
                          <i class="fas fa-edit"></i> <?=lang('ACCT_EDIT');?>
                        </a>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
            <?php
                includeHook($hooks, 'bottom'); ?>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; ?>
