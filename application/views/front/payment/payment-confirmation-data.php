<?php $this->load->view('front/meta-mix') ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-about.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-res-about.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-faq.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-login.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-shopping.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-404.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-res-product-detail.css">


</head>

<body>
      <?php $this->load->view('front/navbar-all') ?>
      <div class="container content">
            <div class="menu-breadcrumb">
                  <ul class="breadcrumb">
                        <li><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li><a href="<?php echo base_url('payment-confirmation'); ?>">Payment Confirmation</a></li>
                  </ul>
            </div>
      </div>
      <?php if (isset($_SESSION['identity']) && $_SESSION['id_group'] == '3') { ?>
      <div class="container container-ver2">
            <div class="page-login box space-50">
                  <div class="row">
                        <?php echo validation_errors() ?>
                        <?php if ($this->session->flashdata('message')) {
                              echo $this->session->flashdata('message');
                        } ?>
                        <?php if ($payment_data == NULL) {
                              echo ' <br><br>
                                    <div class="page-404">
                                          <!-- End images -->
                                          <div class="text center">
                                                <h3>EMPTY PAYMENT CONFIRMATION</h3>
                                                ' ?>
                              <p>Please try one of the following pages <a href="<?php echo base_url('product/all-products'); ?>" title="link">product <i class="fa fa-angle-double-right"></i></a></p>
                  </div>
                  <!-- End text -->
            </div>
            <!-- End page404 -->

      <?php } else { ?>
            <div class="container container-ver2">
                  <div class="page-login box space-50">
                        <h2> <b>PAYMENT CONFIRMATION</b> </h2>
                        <div class="row">
                              <div class="col-lg-12">
                                    <div class="box-body table-responsive padding">
                                          <table id="datatable" class="table table-hover table-bordered table-striped table-responsive">
                                                <thead>
                                                      <tr>
                                                            <th style="text-align: center">No.</th>
                                                            <th style="text-align: center">Invoice Order</th>
                                                            <th style="text-align: center">Date of Order</th>
                                                            <th style="text-align: center">Status</th>
                                                            <th style="text-align: center">Action</th>
                                                      </tr>
                                                </thead>
                                                <tbody>
                                                      <?php $no = 1;
                                                      foreach ($payment_data as $payment) : ?>
                                                            <tr>
                                                                  <td style="text-align:center"><?php echo $no++ ?></td>
                                                                  <td style="text-align:center"><?php echo $payment->id_trans ?></td>
                                                                  <td style="text-align:center"><?php echo date("d-m-Y, H:i", strtotime($payment->waktu_trans)) . ' WIB'; ?></td>
                                                                  <td style="text-align:center">
                                                                        <?php if ($payment->status == '1') { ?>
                                                                              <button type="button" name="status" class="btn btn-warning">Waiting for Payment</button>
                                                                        <?php } ?>
                                                                  </td>
                                                                  <td style="text-align:center">
                                                                        <a href="<?php echo base_url('payment-confirmation-form/') . $payment->id_trans; ?>"><input type="submit" name="submit" class="btn btn-danger" value="Confirmation"> </a>
                                                                  </td>
                                                            </tr>
                                                      <?php endforeach; ?>
                                                </tbody>
                                          </table>
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
      <?php } ?>
     <div class="row">
            <div class="col-lg-10">
            <?php } else {
            echo ' <br><br>
                  <div class="page-404">
                        <!-- End images -->
                        <div class="text center">
                              <h3>PLEASE LOGIN</h3>
                              ' ?>
                  <p>If you will check your payment confirmation, please try one of the following pages <a href="<?php echo base_url('user-login'); ?>" title="link">Login <i class="fa fa-angle-double-right"></i></a></p>
            </div>
            <!-- End text -->
      </div>
      <!-- End page404 -->
<?php } ?>
      <?php $this->load->view('front/footer-all') ?>
      <?php $this->load->view('front/js-mix') ?>
      <!-- js file -->
      <script src="<?php echo base_url('assets/template/frontend/'); ?>js/function-back-top.js"></script>
      <script src="<?php echo base_url('assets/template/frontend/'); ?>js/function-sidebar.js"></script>
      <script src="<?php echo base_url('assets/template/frontend/'); ?>js/funtion-header-v3.js"></script>
      <script src="<?php echo base_url('assets/template/frontend/'); ?>js/function-search-v2.js"></script>
</body>

</html>