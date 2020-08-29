<?php $this->load->view('front/meta-mix') ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-about.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-res-about.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-faq.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-res-product-detail.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-login.css">
<!-- slick -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>slick/slick.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>slick/slick-theme.css">


<?php echo $script_captcha; // javascript recaptcha 
?>
</head>

<body>
      <?php $this->load->view('front/navbar-all') ?>
      <div class="container">
            <div class="menu-breadcrumb">
                  <ul class="breadcrumb">
                        <li><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li><a href="<?php echo base_url('user-login'); ?>">Login Account</a></li>
                  </ul>
            </div>
      </div>
      <div class="container container-ver2">
            <div class="page-login box space-50">
                  <div class="row">
                        <div class="container container-ver2">
                              <div class="page-login box space-50">
                                    <div class="row">
                                          <div class="col-md-6 col-md-offset-3 sign-in space-30">
                                                <h2><b>LOGIN ACCOUNT</b></h2>
                                                <p>Don't have an account? Please create account <b><a href="<?php echo base_url('create-account'); ?>">here</a> </b></p>
                                                <?php echo $message; ?>
                                                <?php echo form_open_multipart('user-login'); ?>
                                                <div class="group box space-20">
                                                      <label class="control-label" for="username">Username *</label>
                                                      <?php echo form_input($identity); ?>
                                                </div>
                                                <div class="group box space-20">
                                                      <label class="control-label" for="password">Password *</label>
                                                      <?php echo form_password($password); ?>
                                                </div>
                                                <?php echo $captcha ?> <br>

                                                <div class="form-group">
                                                      <input type="submit" name='submit' class="btn btn-danger" value='SIGN IN'>
                                                </div>
                                                <?php echo form_close(); ?>
                                                <!-- End form -->



                                          </div>

                                    </div>
                              </div>

                        </div>
                  </div>
            </div>
      </div>

      <?php $this->load->view('front/footer-all') ?>
      <?php $this->load->view('front/js-mix') ?>
      <!-- js file -->

      <script src="<?php echo base_url('assets/template/frontend/'); ?>js/function-select-custom.js"></script>
      <script src="<?php echo base_url('assets/template/frontend/'); ?>js/function-back-top.js"></script>
      <script src="<?php echo base_url('assets/template/frontend/'); ?>js/function-sidebar.js"></script>
      <script src="<?php echo base_url('assets/template/frontend/'); ?>js/funtion-header-v3.js"></script>
      <script src="<?php echo base_url('assets/template/frontend/'); ?>js/function-search-v2.js"></script>


</body>

</html>