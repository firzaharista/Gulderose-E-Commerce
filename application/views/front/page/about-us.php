<?php $this->load->view('front/meta-mix') ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-contact.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-res-contact.css">

</head>

<body>
      <?php $this->load->view('front/navbar-all') ?>
      <div class="container content">
            <div class="menu-breadcrumb">
                  <ul class="breadcrumb">
                        <li><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li><a href="<?php echo base_url('about-us'); ?>">About Us</a></li>
                  </ul>
            </div>
            <div class="wellcome">
                  <div class="container">
                        <div class="row">
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-well">
                                    <div class="media">
                                          <div class="media-body">
                                                <h1>WELLCOME</h1>
                                                <h2>Hello! I am Sita Stya Harista <br>Founder of <?php echo $about->nama_company; ?></h2>
                                          </div>


                                    </div>
                                    <p><?php echo $about->des_company; ?></p>
                                    <div class="social-well">
                                    </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 img-well">
                                    <figure id="img-about"><a href="#"><img src="<?php echo base_url('assets/template/frontend/'); ?>img/gul6.jpg" class="img-responsive" alt="img-holiwood"></a></figure>
                              </div>
                        </div>
                  </div>
            </div>
            <!-- ------------------------- -->
            <br><br><br>
            <div class="img-link">
                  <div class="container">
                        <div class="row">
                              <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <div class="img-color-1">
                                          <div class="img-content">
                                                <img src="<?php echo base_url('assets/template/frontend/'); ?>img/gul3.jpg" width='150' class="img-responsive" alt="img-holiwood">
                                          </div>
                                          <h1>100%</h1>
                                          <h2>Product quality protection</h2>
                                    </div>

                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <div class="img-color-2">
                                          <div class="img-content">
                                                <img src="<?php echo base_url('assets/template/frontend/'); ?>img/gul3.jpg" width='150' class="img-responsive" alt="img-holiwood">
                                          </div>
                                          <h1>100%</h1>
                                          <h2>Payment protection</h2>
                                    </div>

                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <div class="img-color-3">
                                          <div class="img-content">
                                                <img src="<?php echo base_url('assets/template/frontend/'); ?>img/gul3.jpg" width='150' class="img-responsive" alt="img-holiwood">
                                          </div>
                                          <h1>100%</h1>
                                          <h2>On-time shipment protection</h2>
                                    </div>

                              </div>

                        </div>
                  </div>
            </div>
      </div>
            <?php $this->load->view('front/footer-all') ?>
            <?php $this->load->view('front/js-mix') ?>
            <!-- js file -->
            <script src="<?php echo base_url('assets/template/frontend/'); ?>js/function-back-top.js"></script>
            <script src="<?php echo base_url('assets/template/frontend/'); ?>js/function-sidebar.js"></script>
            <script src="<?php echo base_url('assets/template/frontend/'); ?>js/funtion-header-v3.js"></script>
            <script src="<?php echo base_url('assets/template/frontend/'); ?>js/function-search-v2.js"></script>
</body>

</html>