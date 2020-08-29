<?php $this->load->view('front/meta-mix') ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-about.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-res-about.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-faq.css">

</head>

<body>
      <?php $this->load->view('front/navbar-all') ?>
      <div class="container content">
            <div class="menu-breadcrumb">
                  <ul class="breadcrumb">
                        <li><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li><a href="<?php echo base_url('terms-of-service'); ?>">Terms of Service</a></li>
                  </ul>
            </div>
            <div class="page-faq">
                  <div class="container container-ver2">
                        <?php foreach ($terms as $t) : ?>
                              <div class="content-text space-50">
                                    <h2 align='center'><?php echo $t->judul_terms ?></h2>
                                    <div class="row">
                                          <div class="col-md-6 col-md-offset-3 space-50">
                                                <!-- <h3 align='center'>What Shipping Methods Are Available?</!-->
                                                <p><?php echo $t->isi_terms ?></p>
                                          </div>
                                    </div>
                              </div>
                        <?php endforeach; ?>
                        <!-- End content-text -->
                  </div>
                  <!-- End container -->
            </div>
            <!-- End page faq -->
            <?php $this->load->view('front/footer-all') ?>
            <?php $this->load->view('front/js-mix') ?>
            <!-- js file -->
            <script src="<?php echo base_url('assets/template/frontend/'); ?>js/function-back-top.js"></script>
            <script src="<?php echo base_url('assets/template/frontend/'); ?>js/function-sidebar.js"></script>
            <script src="<?php echo base_url('assets/template/frontend/'); ?>js/funtion-header-v3.js"></script>
            <script src="<?php echo base_url('assets/template/frontend/'); ?>js/function-search-v2.js"></script>
</body>

</html>