<!doctype html>
<html class="no-js " lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

  <title>:: Gulderose Bunga Flanel Admin ::</title>
  <!-- Favicon-->
  <link rel="icon" href="<?php echo base_url('assets/images/company/').$company_data->foto.$company_data->foto_type ?>" type="image/x-icon">
  <!-- Custom Css -->
  <link rel="stylesheet" href="<?php echo base_url('assets/template/backend/') ?>assets/plugins/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/template/backend/') ?>assets/css/main.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/template/backend/') ?>assets/css/authentication.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/template/backend/') ?>assets/css/color_skins.css">
  <?php echo $script_captcha; // javascript recaptcha 
  ?>
</head>

<body class="theme-purple authentication sidebar-collapse">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg fixed-top navbar-transparent">
    <div class="container">
      <div class="navbar-translate n_logo">
        <a class="navbar-brand" href="javascript:void(0);" title="" target="_blank">- Gulderose Bunga Flanel Kendal -</a>
        <button class="navbar-toggler" type="button">
          <span class="navbar-toggler-bar bar1"></span>
          <span class="navbar-toggler-bar bar2"></span>
          <span class="navbar-toggler-bar bar3"></span>
        </button>
      </div>
      <div class="navbar-collapse">
        <ul class="navbar-nav">
          <!-- <li class="nav-item">
            <a class="nav-link" title="Like us on Facebook" href="https://www.facebook.com/gulderose.co" target="_blank">
              <i class="zmdi zmdi-facebook"></i>
              <p class="d-lg-none d-xl-none">Facebook</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" title="Follow us on Instagram" href="https://www.instagram.com/gulderose.co/?hl=id" target="_blank">
              <i class="zmdi zmdi-instagram"></i>
              <p class="d-lg-none d-xl-none">Instagram</p>
            </a>
          </li> -->
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->
  <div class="page-header">
    <div class="page-header-image" style="background-image:url(<?php echo base_url('assets/images/'); ?>login.jpg)"></div>
    <div class="container">
      <div class="col-md-12 content-center">
        <div class="card-plain">
          <!-- <form class="form" method="" action=""> -->
          <?php echo form_open("admin_gulderose/auth/login"); ?>
          <div class="header">
            <div class="logo-container">
              <img src="<?php echo base_url('assets/images/') ?>logo.svg" alt="">
            </div>
            <h5>Log in</h5>
            <div id="infoMessage"><?php echo $message; ?></div>
          </div>
          <div class="content">
            <div class="input-group input-lg">
              <!-- <input type="text" class="form-control" placeholder="Enter User Name" value=""> -->
              <?php echo form_input($identity); ?>
              <span class="input-group-addon">
                <i class="zmdi zmdi-account-circle"></i>
              </span>
            </div>
            <div class="input-group input-lg">
              <!-- <input type="password" placeholder="Password" class="form-control" /> -->
              <?php echo form_input($password); ?>
              <span class="input-group-addon">
                <i class="zmdi zmdi-lock"></i>
              </span>
            </div>
          </div>
          <p><?php echo $captcha ?></p>
          <div class="footer text-center">
            <button type="submit" name="submit" class="btn btn-primary btn-round btn-lg- btn-block">SIGN IN</button>
          </div>
          <?php echo form_close(); ?>
        </div>
      </div>
    </div>
    <footer class="footer">
      <div class="container">
        <nav>
          <ul class="copyright">

            <span>Copyright &copy; 2020 by Firza Affan Harista</span>
          </ul>
        </nav>
        <div class="copyright">
          <!-- &copy; 2019 -->
          <!-- <span>Theme by ThemeMakker</span> -->
        </div>
      </div>
    </footer>
  </div>

  <!-- Jquery Core Js -->
  <script src="<?php echo base_url('assets/template/backend/') ?>assets/bundles/libscripts.bundle.js"></script>
  <script src="<?php echo base_url('assets/template/backend/') ?>assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->

  <script>
    $(".navbar-toggler").on('click', function() {
      $("html").toggleClass("nav-open");
    });
    //=============================================================================
    $('.form-control').on("focus", function() {
      $(this).parent('.input-group').addClass("input-group-focus");
    }).on("blur", function() {
      $(this).parent(".input-group").removeClass("input-group-focus");
    });
  </script>
</body>

</html>