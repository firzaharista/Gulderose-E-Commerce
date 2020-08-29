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
      <div class="cart-box-container check-out">
            <div class="container container-ver2">
                  <div class="row">
                        <div class="col-md-12 space-30">
                              <div class="box">
                                    <h3> <b>CHECKOUT - FINISHED </b> </h3> <br><br>
                                    <div class="row">
                                          <div class="col-lg-6">
                                                <p>
                                                      Thank you for your order. Make payments immediately according to your total order. to our account below: <b><?php echo $bank_destination->nama_banktujuan ?></b> :
                                                </p>
                                                <hr>
                                                <h4 align='center'>
                                                      <b><?php echo $bank_destination->no_rektujuan ?><br>
                                                            A/n <?php echo $bank_destination->atas_namatujuan ?></b>
                                                </h4>
                                                <hr>
                                                <p align='center'><i>If you have already made a payment, please confirm by clicking the button below so that the product you ordered is processed immediately</i></p>
                                                <div class="col-lg-6 col-md-offset-3">
                                                      <a href="<?php echo base_url('payment-confirmation') ?>"><button type="submit" class="link-v1 rt">Konfirmasi</button></a>
                                                </div> <br> <br> <br>
                                                <p align='center'><i>Please note that payment must be made within 1x24 hours (maximum) so the order is not canceled by the admin</i></p>
                                                <hr>
                                                <div class="row">
                                                      <div class="box">
                                                            <h3 class="title-brand">YOUR ORDER</h3>
                                                            <div class="info-order">
                                                                  <div class="product-name">
                                                                        <ul>
                                                                              <li class="head">
                                                                                    <span class="name">PRODUCTS NAME</span>
                                                                                    <span class="qty"><b>QTY</b></span>
                                                                                    <span class="total"><b>TOTAL</b></span>
                                                                              </li>
                                                                              <?php foreach ($cart_finished as $cart) : ?>
                                                                                    <li>
                                                                                          <span class="name"><?php echo $cart->judul_produk ?></span>
                                                                                          <span class="qty">&nbsp;&nbsp;&nbsp;<?php echo $cart->total_qty ?></span>
                                                                                          <span class="total"><?php echo 'Rp. ' . number_format($cart->subtotal, 2, ',', '.') ?></span>
                                                                                    </li>
                                                                              <?php endforeach; ?>
                                                                        </ul>
                                                                  </div>

                                                                  <!-- End product-name -->
                                                                  <ul class="product-order">
                                                                        <li>
                                                                              <span class="left">CART SUBTOTAL</span>
                                                                              <span class="right"><?php echo 'Rp. ' . number_format($total_berat_dan_subtotal->subtotal, 2, ',', '.') ?></span>
                                                                        </li>
                                                                        <li>
                                                                              <span class="left">SHIPPING COST</span>
                                                                              <span class="right"><?php echo 'Rp. ' . number_format(($customer_data->ongkir), 2, ',', '.'); ?></span>
                                                                        </li>
                                                                        <li>
                                                                              <span class="left">ORDER TOTAL</span>
                                                                              <span class="right brand"><b><?php echo 'Rp. ' . number_format(($customer_data->ongkir + $total_berat_dan_subtotal->subtotal), 2, ',', '.'); ?></b></span>
                                                                        </li>
                                                                  </ul>
                                                            </div>
                                                      </div>
                                                </div>
                                          </div>
                                          <div class="col-lg-6">
                                                <div class="row">
                                                      <div class="col-md-10 col-md-offset-1">
                                                            <table class="table table-hover table-bordered table-responsive">
                                                                  <thead>
                                                                        <tr>
                                                                              <th style="text-align: left">
                                                                                    Thanks. Your order has been received.<br>
                                                                                    <ul>
                                                                                          <li>Invoice Order : <?php echo $customer_data->id_trans ?></li>
                                                                                          <li>Email : <?php echo $customer_data->email ?></li>

                                                                                          <li>Bank Transfer Destination : <?php echo $bank_destination->nama_banktujuan ?></li>
                                                                                          <h3>
                                                                                                <b>
                                                                                                      <li>Total : <?php echo 'Rp. ' . number_format(($customer_data->ongkir + $total_berat_dan_subtotal->subtotal), 2, ',', '.'); ?></li>
                                                                                                      <br>
                                                                                                      <?php echo form_open('download-invoice/' . $customer_data->id_trans, 'id ="invoice" target="_blank" ') ?>
                                                                                                      <button type="submit" name="download_invoice" class="btn btn-info">Download Invoice</button>
                                                                                                      <?php echo form_close() ?>

                                                                                                </b>
                                                                                          </h3>
                                                                                    </ul>
                                                                              </th>

                                                                        </tr>
                                                                  </thead>
                                                            </table>
                                                      </div>
                                                </div> <br><br>
                                                <div class="row">
                                                      <div class="col-md-10 col-md-offset-1">
                                                            <hr>
                                                            <h4><b>Billing Address</b></h4>
                                                            <hr>
                                                            <table class="table table-hover table-bordered table-striped table-responsive">
                                                                  <thead>
                                                                        <tr>
                                                                              <th style="text-align: center">Name</th>
                                                                              <th style="text-align: center">Phone</th>
                                                                              <th style="text-align: center">Address</th>
                                                                        </tr>
                                                                  </thead>
                                                                  <tbody>
                                                                        <tr>
                                                                              <td align="center"><?php echo $profil->nama; ?></td>
                                                                              <td align="center"><?php echo $profil->phone; ?></td>
                                                                              <td align="center"><?php echo $profil->address . ', ' . $profil->nama_kota . ', ' . $profil->nama_provinsi; ?></td>
                                                                        </tr>
                                                                  </tbody>
                                                            </table>
                                                      </div>
                                                </div>
                                                <div class="row">
                                                      <div class="col-md-10 col-md-offset-1">
                                                            <hr>
                                                            <h4><b>Destination Address</b></h4>
                                                            <hr>
                                                            <table class="table table-hover table-bordered table-striped table-responsive">
                                                                  <thead>
                                                                        <tr>
                                                                              <th style="text-align: center">Name</th>
                                                                              <th style="text-align: center">Phone</th>
                                                                              <th style="text-align: center">Address</th>
                                                                        </tr>
                                                                  </thead>
                                                                  <tbody>
                                                                        <tr>
                                                                              <td align="center"><?php echo $profil->nama; ?></td>
                                                                              <td align="center"><?php echo $profil->phone; ?></td>
                                                                              <td align="center"><?php echo $profil->address . ', ' . $profil->nama_kota . ', ' . $profil->nama_provinsi; ?></td>
                                                                        </tr>
                                                                  </tbody>
                                                            </table>
                                                      </div>
                                                </div>
                                                <div class="row">
                                                      <div class="col-md-10 col-md-offset-1">
                                                            <hr>
                                                            <h4>Link I-Banking <small>(If you want to pay with I-Banking, Click Images)</small></h4>
                                                            <hr>
                                                            <ul>
                                                                  <li><a href="https://ibank.bni.co.id" target="_blank"><img src="<?php echo base_url('assets/images/bank/bni.png') ?>" alt="bank_gulderose_bni" width="110"></a></li>
                                                            </ul> <br>
                                                            <ul>
                                                                  <li><a href="https://ib.bri.co.id/" target="_blank"><img src="<?php echo base_url('assets/images/bank/bri.png') ?>" alt="bank_gulderose_bni" width="130"></a></li>
                                                            </ul> <br>
                                                            <ul>
                                                                  <li><a href="https://ibank.klikbca.com/" target="_blank"><img src="<?php echo base_url('assets/images/bank/bca.png') ?>" alt="bank_gulderose_bni" width="110"></a></li>
                                                            </ul> <br>
                                                            <ul>
                                                                  <li><a href="https://ib.bankmandiri.co.id/" target="_blank"><img src="<?php echo base_url('assets/images/bank/mandiri.png') ?>" alt="bank_gulderose_bni" width="130"></a></li>
                                                            </ul>
                                                      </div>
                                                </div>
                                          </div>
                                          <input type="hidden" name="id_trans" value="<?php echo $customer_data->id_trans ?>">
                                          <input type="hidden" name="total" id="total" value="<?php echo $total_berat_subtotal->subtotal ?>" />
                                          <input type="hidden" name="ongkir" id="ongkir" value="0" />
                                          <?php echo form_close() ?>
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