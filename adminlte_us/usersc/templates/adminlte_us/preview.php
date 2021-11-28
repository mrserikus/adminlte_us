<?php
$template_override = "standard";
require_once '../../../users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
if(!hasPerm([2],$user->data()->id)){
  die("no permission to be here");
}
?>

    <div class="text-center">
        <h2><a href="../../../users/admin.php?view=templates"><span class="fa fa-arrow-left"></span> Back to Themes</a></h2>
    </div>

    <a class="btn btn-primary" href="https://adminlte.io/themes/v3/" target="_blank">
            </i> Check on official website
    </a>
