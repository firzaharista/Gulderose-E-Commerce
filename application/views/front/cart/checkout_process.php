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
                                    <h3> <b>CHECKOUT</b> </h3>
                                    <div class="row">
                                          <div class="col-lg-12">
                                                <div class="box-body table-responsive padding">
                                                      <table id="datatable" class="table table-hover table-bordered table-striped table-responsive">
                                                            <thead>
                                                                  <tr>
                                                                        <th style="text-align: center">No.</th>
                                                                        <th style="text-align: center">Product</th>
                                                                        <th style="text-align: center">Product Name</th>
                                                                        <th style="text-align: center">Price</th>
                                                                        <th style="text-align: center">Weight (gram)</th>
                                                                        <th style="text-align: center">Amount of weight (gram)</th>
                                                                        <th style="text-align: center">Qty</th>
                                                                        <th style="text-align: center">Total</th>
                                                                  </tr>
                                                            </thead>
                                                            <tbody>
                                                                  <?php $start = 1;
                                                                  foreach ($cart_data as $cart) : ?>
                                                                        <tr>
                                                                              <td style="text-align:center"><br><?php echo $start++ ?>
                                                                              </td>
                                                                              <td style="text-align:center">
                                                                                    <img src="<?php echo base_url('assets/images/produk/') . $cart->foto . $cart->foto_type; ?>" width='70' alt="Gulderose_product">
                                                                              </td>
                                                                              <td style="text-align:center"> <br><?php echo $cart->judul_produk ?></td>

                                                                              <td style="text-align:center;"><br><?php echo 'Rp. ' . number_format($cart->harga, 2, ',', '.') ?></td>
                                                                              <td style="text-align:center"><br><?php echo $cart->berat; ?></td>
                                                                              <td style="text-align:center"><br><?php echo $cart->total_berat; ?></td>
                                                                              <td style="text-align:center"><br><?php echo $cart->total_qty; ?></td>
                                                                              <td style="text-align:center"><br><?php echo 'Rp. ' . number_format($cart->subtotal, 2, ',', '.') ?></td>
                                                                        </tr>
                                                                  <?php endforeach; ?>
                                                            </tbody>
                                                      </table>
                                                </div>
                                          </div>

                                    </div> <br>
                                    <div class="row">
                                          <div class="col-lg-12">
                                                <?php echo form_open('checkout/finished') ?>
                                                <table class="table table-hover table-bordered table-striped table-responsive">
                                                      <tbody>
                                                            <tr>
                                                                  <th>Bank Transfer</th>
                                                                  <td colspan="2" align="right"><?php echo $bank_tujuan_percustomer->nama_banktujuan ?></td>
                                                            </tr>
                                                            <tr>
                                                                  <th>Amount of weight</th>
                                                                  <td colspan="2" align="right"><?php echo $total_berat_subtotal->total_berat; ?> (gram) / <?php echo $total_berat_subtotal->total_berat / 1000 ?> kg</td>
                                                            </tr>
                                                            <tr>
                                                                  <th>SubTotal</th>
                                                                  <td></td>
                                                                  <td align="right"><?php echo 'Rp. ' . number_format($total_berat_subtotal->subtotal, 2, ',', '.') ?></td>
                                                            </tr>
                                                            <tr>
                                                                  <th>Shipping Cost</th>
                                                                  <td align="right">Via : <?php echo strtoupper($customer_data->kurir) . ' ( ' . $customer_data->service . ' )'; ?> </td>
                                                                  <td align="right"><?php echo 'Rp. ' . number_format($customer_data->ongkir, 2, ',', '.'); ?></td>
                                                            </tr>
                                                            <tr>
                                                                  <th scope="row">
                                                                        <h4><b>Grand Total</b></h4>
                                                                  </th>
                                                                  <td align="right">
                                                                        <h4><b>Subtotal + Shipping Cost</b></h4>
                                                                  </td>
                                                                  <td align="right">
                                                                        <h4><b><?php echo 'Rp. ' . number_format(($customer_data->ongkir + $total_berat_subtotal->subtotal), 2, ',', '.'); ?></b></h4>

                                                                  </td>
                                                            </tr>
                                                      </tbody>
                                                </table>
                                          </div>
                                    </div> <br> <br>
                                    <div class="row">
                                          <div class="col-lg-12">
                                                <div class="col-lg-6">
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
                                                <div class="col-lg-6">
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
                                    </div>
                                    <br>
                                    <div class="row">
                                          <div class="col-lg-12">
                                                <h4><b>Attention *</b></h4>
                                                <ul>
                                                      <li>If there are errors in personal data, please change the data on the My Account page (user icon) or can be on the following link, <a href="<?php echo base_url('my-account') ?>"><b>klik disini</b></a> </li>
                                                      <li>JNE shipping costs under 1.4kg will be considered 1kg (tolerance of 300 gram), while TIKI and POS below 1.3kg will be considered 1kg (tolerance of 200 gram)</li>
                                                </ul>
                                          </div>
                                    </div>
                                    <br> <br>
                                    <div class="row">
                                          <div class="col-lg-12">
                                                <div align='right'>
                                                      <button name="checkout" type="submit" class="btn btn-info" aria-label="Left Align" title="Place Order">
                                                            <h5>PLACE ORDER <i class='fa fa-spinner'></i></h5>
                                                      </button>
                                                </div>
                                          </div>
                                    </div>

                                    <input type="hidden" name="id_trans" value="<?php echo $customer_data->id_trans ?>">
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