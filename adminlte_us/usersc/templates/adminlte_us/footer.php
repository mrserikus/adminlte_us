<?php
require_once $abs_us_root . $us_url_root . 'usersc/templates/' . $settings->template . '/container_close.php';
require_once $abs_us_root . $us_url_root . 'users/includes/page_footer.php';

?>

<footer class="main-footer">
  <div class="float-right d-none d-sm-block">
    <b>Version</b> 0.1.0 Beta Template
  </div>
  <strong>&copy; <?php echo date("Y"); ?> <?=$settings->copyright; ?></strong>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<!-- AdminLTE App -->
<script src="<?=$us_url_root?>usersc/templates/<?=$settings->template?>/assets/js/adminlte.min.js"></script>

<script src="<?=$us_url_root?>usersc/templates/<?=$settings->template?>/plugins/summernote/summernote-bs4.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=$us_url_root?>usersc/templates/<?=$settings->template?>/assets/js/demo.js"></script>
<?php require_once($abs_us_root.$us_url_root.'users/includes/html_footer.php');?>
