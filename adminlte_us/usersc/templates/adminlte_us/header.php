<?php
require_once($abs_us_root.$us_url_root.'users/includes/template/header1_must_include.php'); require_once($abs_us_root.$us_url_root.'usersc/templates/'.$settings->template.'/assets/fonts/glyphicons.php');
?>
<link rel="stylesheet" href="<?=$us_url_root?>usersc/templates/<?=$settings->template?>/assets/fonts/glyphicons.css">

<link href="<?=$us_url_root?>users/css/datatables.css" rel="stylesheet">
<link rel="stylesheet" href="<?=$us_url_root?>users/fonts/css/font-awesome.min.css">

<!-- Font Awesome -->
<link rel="stylesheet" href="<?=$us_url_root?>usersc/templates/<?=$settings->template?>/plugins/fontawesome-free/css/all.min.css">

<!-- Theme style -->
<link rel="stylesheet" href="<?=$us_url_root?>usersc/templates/<?=$settings->template?>/assets/css/adminlte.min.css">

<link rel="stylesheet" href="<?=$us_url_root?>usersc/templates/<?=$settings->template?>/plugins/summernote/summernote-bs4.min.css">

<!-- jQuery -->
<script src="<?=$us_url_root?>usersc/templates/<?=$settings->template?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=$us_url_root?>usersc/templates/<?=$settings->template?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" crossorigin="anonymous"></script>


</head>
<script>
$(function () {
  $('[data-toggle="popover"]').popover()
})
</script>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
<?php require_once($abs_us_root.$us_url_root.'users/includes/template/header3_must_include.php');
      require_once('navbar.php'); ?>
