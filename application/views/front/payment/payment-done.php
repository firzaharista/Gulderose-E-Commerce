<?php $this->load->view('front/meta-mix') ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-about.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-res-about.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-faq.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-login.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-shopping.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-checkout.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-order.css">
</head>

<body>
      <?php $this->load->view('front/navbar-all') ?>
      <div class="cart-box-container check-out">
            <div class="container container-ver2">
                  <div class="row">
                        <div class="col-md-12 space-30">
                              <div class="box">
                                    <h3> <b>PAYMENT - DONE </b> </h3> <br><br>
                                    <div class="row">
                                          <div class="col-lg-12">
                                                <div class="container container-ver2">
                                                      <div class="box float-left order-complete center space-50">
                                                            <div class="icon space-20">
                                                                  <img src="<?php echo base_url('assets/images/') ?>icon-order-complete.png" alt="icon">
                                                            </div>
                                                            <p class="box center space-50">Thank you for payment confirmation, your order is complete!</p>
                                                            <div class="col-lg-6 col-md-offset-3">
                                                                  <div class="row">
                                                                        <div class="col-md-10 col-md-offset-1">
                                                                              <table class="table table-hover table-bordered table-responsive">
                                                                                    <thead>
                                                                                          <tr>
                                                                                                <th style="text-align: left">
                                                                                                      Thanks. Your order has been received. <br>
                                                                                                      <ul>
                                                                                                            <li>Invoice Order : <?php echo $payment_done->id_trans ?></li>
                                                                                                            <li>Email : <?php echo $payment_done->email ?></li>
                                                                                                            <li>Bank Transfer Destination : <?php echo $bank_destination->nama_banktujuan ?></li>
                                                                                                            <h3>
                                                                                                                  <b>
                                                                                                                        <li>Total : <?php echo 'Rp. ' . number_format(($payment_done->ongkir + $total_berat_dan_subtotal->subtotal), 2, ',', '.'); ?></li>
                                                                                                                        <br>
                                                                                                                        <div class='col-lg-12 col-sm-offset-3'>
                                                                                                                              <?php echo form_open('download-invoice/' . $payment_done->id_trans, 'id ="invoice" target="_blank" ') ?>
                                                                                                                              <button type="submit" name="download_invoice" class="btn btn-info">Download Invoice</button>
                                                                                                                              <?php echo form_close() ?>
                                                                                                                        </div> <br><br>
                                                                                                                  </b>
                                                                                                            </h3>
                                                                                                            <i class="text-muted">The product will be processed after the admin verifies your payment. If verified, the product will be processed and sent ± 7 days after payment is verified.</i>
                                                                                                            <br> <br>
                                                                                                      </ul>
                                                                                                </th>
                                                                                          </tr>
                                                                                    </thead>
                                                                              </table>
                                                                        </div>
                                                                  </div>
                                                            </div>
                                                      </div>
                                                </div>
                                          </div>
                                    </div>
                                    <div class="row">
                                          <div class="col-lg-6 col-md-offset-4">
                                                <div class="box">
                                                      <a class="link-v1 lh-50 margin-right-20 space-20 color-brand" href="<?php echo base_url() ?>" title="HOME PAGE">HOME PAGE</a>
                                                      <a class="link-v1 lh-50 rt space-20" href="<?php echo base_url('product/all-products') ?>" title="CONTINUE SHOPPING">CONTINUE SHOPPING</a>
                                                </div>
                                          </div>
                                    </div>
                              </div>
                        </div>
                  </div>
                  <!-- End row -->
            </div>
            <!-- End container -->
      </div>
      <!-- End cat-box-container -->
      <?php $this->load->view('front/footer-all') ?>
      <?php $this->load->view('front/js-mix') ?>
      <!-- js file -->
      <script src="<?php echo base_url('assets/template/frontend/'); ?>js/function-back-top.js"></script>
      <script src="<?php echo base_url('assets/template/frontend/'); ?>js/function-sidebar.js"></script>
      <script src="<?php echo base_url('assets/template/frontend/'); ?>js/funtion-header-v3.js"></script>
      <script src="<?php echo base_url('assets/template/frontend/'); ?>js/function-search-v2.js"></script>
      <script src="<?php echo base_url('assets/template/frontend/'); ?>js/function-shopping-cart.js"></script>
      <script src="<?php echo base_url('assets/template/frontend/'); ?>js/function-store.js"></script>

</body>

</html>