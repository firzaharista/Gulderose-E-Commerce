<?php $this->load->view('front/meta-mix') ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-contact.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-res-contact.css">
<style type="text/css">
      .google-maps {
            position: relative;
            padding-bottom: 75%;
            height: 0;
            overflow: hidden;
            /* width: 100% !important;
                                          height: 100% !important; */
      }

      .google-maps iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100;
            height: 100;
      }
</style>
</head>

<body>
      <?php $this->load->view('front/navbar-all') ?>
      <div class="container content">
            <div class="menu-breadcrumb">
                  <ul class="breadcrumb">
                        <li><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li><a href="<?php echo base_url('contact-us'); ?>">Contact Us</a></li>
                  </ul>
            </div>
            <div class="img-link">
                  <div class="container">
                        <div class="row">
                              <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <div class="img-color-1">
                                          <div class="img-content">
                                                <img src="<?php echo base_url('assets/template/frontend/'); ?>img/gul6.jpg" width='250' class="img-responsive" alt="img-holiwood">
                                          </div>
                                          <h1>Our Address</h1>
                                          <h2><?php echo $contact->alamat_company; ?></h2>
                                    </div>

                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <div class="img-color-2">
                                          <div class="img-content">
                                                <img src="<?php echo base_url('assets/template/frontend/'); ?>img/gul6.jpg" width='250' class="img-responsive" alt="img-holiwood">
                                          </div>
                                          <h1>Phone Number</h1>
                                          <h2><i class='fab fa-whatsapp'></i> Whatsapp : <?php echo $contact->no_hp ?></h2>
                                    </div>

                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <div class="img-color-3">
                                          <div class="img-content">
                                                <img src="<?php echo base_url('assets/template/frontend/'); ?>img/gul6.jpg" width='250' class="img-responsive" alt="img-holiwood">
                                          </div>
                                          <h1>Email Address</h1>
                                          <h2><?php echo $contact->email_company ?></h2>
                                    </div>

                              </div>
                        </div>
                  </div>
            </div>


            <?php $this->load->view('front/footer-all') ?>
            <?php $this->load->view('front/js-mix') ?>
            <!-- js file -->
            <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBnMr64OtHBrpxBLLbYX2K2Waf4enq8sp0&callback"></!--> -->

            <script src="<?php echo base_url('assets/template/frontend/'); ?>js/function-back-top.js"></script>
            <script src="<?php echo base_url('assets/template/frontend/'); ?>js/function-sidebar.js"></script>
            <script src="<?php echo base_url('assets/template/frontend/'); ?>js/funtion-header-v3.js"></script>
            <script src="<?php echo base_url('assets/template/frontend/'); ?>js/function-search-v2.js"></script>
</body>

</html>