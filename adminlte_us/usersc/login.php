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
ini_set("allow_url_fopen", 1);
if(isset($_SESSION)){session_destroy();}
require_once '../users/init.php';
//require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
$hooks =  getMyHooks();
includeHook($hooks,'pre');
?>
<?php

//$errors = $successes = [];
if (Input::get('err') != '') {
    $errors[] = Input::get('err');
}

if($user->isLoggedIn()) Redirect::to($us_url_root.'index.php');

if (!empty($_POST['login_hook'])) {
  $token = Input::get('csrf');
  if(!Token::check($token)){
    include($abs_us_root.$us_url_root.'usersc/scripts/token_error.php');
  }

    $validate = new Validate();
    $validation = $validate->check($_POST, array(
      'username' => array('display' => 'Username','required' => true),
      'password' => array('display' => 'Password', 'required' => true)));
      //plugin goes here with the ability to kill validation
      includeHook($hooks,'post');
      if ($validation->passed()) {
        //Log user in
        $remember = false;
        $user = new User();
        $login = $user->loginEmail(Input::get('username'), trim(Input::get('password')), $remember);
        if ($login) {
          $hooks =  getMyHooks(['page'=>'loginSuccess']);
          includeHook($hooks,'body');
          $dest = sanitizedDest('dest');
              # if user was attempting to get to a page before login, go there
              $_SESSION['last_confirm']=date("Y-m-d H:i:s");

              if (!empty($dest)) {
                $redirect=html_entity_decode(Input::get('redirect'));
                if(!empty($redirect) || $redirect!=='') Redirect::to($redirect);
                else Redirect::to($dest);
              } elseif (file_exists($abs_us_root.$us_url_root.'usersc/scripts/custom_login_script.php')) {

                # if site has custom login script, use it
                # Note that the custom_login_script.php normally contains a Redirect::to() call
                require_once $abs_us_root.$us_url_root.'usersc/scripts/custom_login_script.php';
              } else {
                if (($dest = Config::get('homepage')) ||
                ($dest = 'account.php')) {
                  Redirect::to($dest);
                }
              }

          } else {
            logger("0","Login Fail","A failed login on login.php");
            $errors = "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h5><i class='icon fas fa-ban'></i>".lang("SIGNIN_UORE")."</h5>".lang("SIGNIN_PLEASE_CHK")."</div>";          }
        }else{
          $errors = $validation->errors();
        }
    }
    if (empty($dest = sanitizedDest('dest'))) {
      $dest = '';
    }
    $token = Token::generate();
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title><?php echo $settings->site_name;?></title>

      <!-- Google Font: Source Sans Pro -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="<?=$us_url_root?>usersc/templates/<?=$settings->template?>/plugins/fontawesome-free/css/all.min.css">
      <!-- icheck bootstrap -->
      <link rel="stylesheet" href="<?=$us_url_root?>usersc/templates/<?=$settings->template?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="<?=$us_url_root?>usersc/templates/<?=$settings->template?>/assets/css/adminlte.min.css">
    </head>
    <body class="hold-transition login-page">

    <div class="login-box">
      <!-- /.login-logo -->
      <?php echo $errors; ?>
      <div class="card card-outline card-primary">
        <div class="card-header text-center">
          <a href="#" class="h1"><?php echo $settings->site_name;?></a>
        </div>
        <div class="card-body">
          <p class="login-box-msg"><?=lang("SIGNIN_TITLE","");?></p>
          <form name="login" id="login-form" class="form-signin" action="" method="post">
            <input type="hidden" name="dest" value="<?= $dest ?>" />
            <div class="input-group mb-3"><input class="form-control" type="text" name="username" id="username" placeholder="<?=lang("SIGNIN_UORE")?>" required autofocus autocomplete="username">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control"  name="password" id="password"  placeholder="<?=lang("SIGNIN_PASS")?>" required autocomplete="current-password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-8">
                <div class="icheck-primary">
                  <input type="checkbox" id="remember">
                  <label for="remember">
                    Atcereties
                  </label>
                </div>
              </div>
              <!-- /.col -->
              <input type="hidden" name="login_hook" value="1">
              <input type="hidden" name="csrf" value="<?=$token?>">
              <input type="hidden" name="redirect" value="<?=Input::get('redirect')?>" />
              <!-- / -->
              <div class="col-4">

                <button type="submit" class="btn btn-primary btn-block" id="next_button"><?=lang("SIGNIN_BUTTONTEXT","");?></button>
              </div>
              <!-- /.col -->
            </div>
          </form>
          <!--
          <div class="social-auth-links text-center mt-2 mb-3">
            <a href="#" class="btn btn-block btn-primary">
              <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
            </a>
            <a href="#" class="btn btn-block btn-danger">
              <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
            </a>
          </div>
          <!-/- /.social-auth-links -->

          <p class="mb-1">
            <a href='../users/forgot_password.php'><i class="fa fa-wrench"></i> <?=lang("SIGNIN_FORGOTPASS","");?></a>
          </p>
          <?php languageSwitcher();?>
          <!--<p class="mb-0">
            <a href="register.html" class="text-center">Register a new membership</a>
          </p>-->
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.login-box -->


    <!-- jQuery -->
    <script src="<?=$us_url_root?>usersc/templates/<?=$settings->template?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?=$us_url_root?>usersc/templates/<?=$settings->template?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?=$us_url_root?>usersc/templates/<?=$settings->template?>/assets/js/adminlte.min.js"></script>
    </body>
    </html>
