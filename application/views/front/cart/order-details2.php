<?php $this->load->view('front/meta-mix') ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-about.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-res-about.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-faq.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-login.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-shopping.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-checkout.css">

</head>

<body>
      <?php $this->load->view('front/navbar-all') ?>
      <main>
            <div class="content-search">

                  <div class="container container-100">
                        <i class="far fa-times-circle" id="close-search"></i>
                        <h3 class="text-center">what are your looking for ?</h3>
                        <form method="get" action="/search" role="search" style="position: relative;">
                              <input type="text" class="form-control control-search" value="" autocomplete="off" placeholder="Enter Search ..." aria-label="SEARCH" name="q">

                              <button class="button_search" type="submit">search</button>
                        </form>
                  </div>

            </div>
            <!-- End container -->
            <div class="cart-box-container check-out">
                  <div class="container container-ver2">
                        <div class="row">
                              <div class="col-md-12 space-30">
                                    <div class="box">
                                          <h3> <b>ORDER DETAILS</b> </h3>
                                          <p>Order place on : 21-11-2019, 10:00 WIB</p>
                                          <p>INVOICE ORDER : <b>GUL00001</b>
                                                <br>Payment Method : Bank Transfer
                                                <br>Bank Transfer Destination : BNI (No. Rek : 77822137)<br>
                                          </p>
                                          <div class="alert alert-info" role="alert">
                                                <strong>Order Success !</strong> Thank you for your order . . .
                                          </div>

                                          <div class="info-order">
                                                <div class="product-name">
                                                      <ul>
                                                            <li class="head">
                                                                  <span class="name">NO. </span>
                                                                  <span class="name">Product</span>
                                                                  <span class="name">Price</span>
                                                                  <span class="name">Weight</span>
                                                                  <span class="name">Amount of weight</span>
                                                                  <span class="qty"><b>Qty</b></span>
                                                                  <span class="total"><b>Sub Total</b></span>
                                                            </li>
                                                            <li>
                                                                  <span class="name">Modern Chair</span>
                                                                  <span class="qty">01</span>
                                                                  <span class="total">$520.00</span>
                                                            </li>
                                                            <li>
                                                                  <span class="name">Toldbod Lamp</span>
                                                                  <span class="qty">02</span>
                                                                  <span class="total">$190.00</span>
                                                            </li>
                                                            <li>
                                                                  <span class="name">Getama Sofa</span>
                                                                  <span class="qty">03</span>
                                                                  <span class="total">$270.00</span>
                                                            </li>
                                                      </ul>
                                                </div>
                                                <!-- End product-name -->
                                                <ul class="product-order">
                                                      <li>
                                                            <span class="left">CART SUBTOTAL</span>
                                                            <span class="right">$980.00</span>
                                                      </li>
                                                      <li>
                                                            <span class="left">SHIPPING & HANDLING</span>
                                                            <span class="right">Free Shipping</span>
                                                      </li>
                                                      <li>
                                                            <span class="left">ORDER TOTAL</span>
                                                            <span class="right brand">$980.00</span>
                                                      </li>
                                                </ul>
                                          </div>
                                          <!-- End info-order -->
                                          <div class="row">
                                                <div class="col-lg-12">
                                                      <div class="box-body table-responsive padding">
                                                            <table id="datatable" class="table table-striped table-bordered">
                                                                  <thead>
                                                                        <tr>
                                                                              <th style="text-align: center">No.</th>
                                                                              <th style="text-align: center">Produk</th>
                                                                              <th style="text-align: center">Harga</th>
                                                                              <th style="text-align: center">Berat</th>
                                                                              <th style="text-align: center">Jumlah Berat (gram)</th>
                                                                              <th style="text-align: center">Qty</th>
                                                                              <th style="text-align: center">Total</th>
                                                                        </tr>
                                                                  </thead>
                                                                  <tbody>
                                                                        <tr>
                                                                              <td style="text-align:center">skjis</td>
                                                                              <td style="text-align:left">swhsuwhs</td>
                                                                              <td style="text-align:center"></td>
                                                                              <td style="text-align:center"></td>
                                                                              <td style="text-align:center"></td>
                                                                              <td style="text-align:center"></td>
                                                                              <td style="text-align:center"></td>
                                                                        </tr>
                                                                        
                                                                  </tbody>
                                                            </table>
                                                      </div>
                                                </div>
                                          </div>
                                          <a class="link-v1 box lh-50 rt full" href="#" title="PLACE ORDER">PLACE ORDER</a>
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