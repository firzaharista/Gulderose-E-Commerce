<?php $this->load->view('front/meta-mix') ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-about.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-res-about.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-faq.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-shopping.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-404.css">

</head>

<body>
      <?php $this->load->view('front/navbar-all') ?>
      <div class="cart-box-container">
            <div class="container container-ver2">
                  <div class="box cart-container">
                        <?php if (isset($_SESSION['identity']) && $_SESSION['id_group'] == '3') { ?>
                              <div class="row">
                                    <div class="col-md-12 col-md-offset-1 space-30">
                                          <div class="box">
                                                <h3> <b>SHOPPING CART</b> </h3>
                                                <div class="row">
                                                      <div class="col-lg-10">
                                                            <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                                                            <?php if ($cart_data == NULL) {
                                                                  echo ' <br><br>
                                                                        <div class="page-404">
                                                                              <!-- End images -->
                                                                              <div class="text center">
                                                                                    <h3>EMPTY SHOPPING CART</h3>
                                                                                    ' ?>
                                                                  <p>Please try one of the following pages <a href="<?php echo base_url('product/all-products'); ?>" title="link">product <i class="fa fa-angle-double-right"></i></a></p>
                                                      </div>
                                                      <!-- End text -->
                                                </div>
                                                <!-- End page404 -->';

                                          <?php } else { ?>
                                                <div class="box-body table-responsive padding">
                                                      <table id="datatable" class="table table-hover table-bordered table-striped table-responsive">
                                                            <thead>
                                                                  <tr>
                                                                        <th style="text-align: center">No.</th>
                                                                        <th style="text-align: center">Product</th>
                                                                        <th style="text-align: center">Product Name</th>
                                                                        <th style="text-align: center">Size</th>
                                                                        <th style="text-align: center">Price</th>
                                                                        <th style="text-align: center">Qty</th>
                                                                        <th style="text-align: center">Total</th>
                                                                        <th style="text-align: center">Action</th>
                                                                  </tr>
                                                            </thead>
                                                            <tbody>
                                                                  <?php $start = 1;
                                                                  foreach ($cart_data as $cart) : ?>
                                                                        <tr>
                                                                              <td style="text-align:center"><br><?php echo $start++ ?></td>
                                                                              <td style="text-align:center">
                                                                                    <a href="<?php echo base_url("product/$cart->slug_produk")?>"><img src="<?php echo base_url('assets/images/produk/') . $cart->foto . $cart->foto_type; ?>" width='70' alt="Gulderose_product"></a>
                                                                              </td>
                                                                              <td style="text-align:center"> <br><?php echo $cart->judul_produk ?></td>
                                                                              <td style="text-align:center"> <br><?php echo ucwords($cart->ukuran) ?></td>
                                                                              <td style="text-align:center;"><br><?php echo 'Rp. ' . number_format($cart->harga, 2, ',', '.') ?></td>
                                                                              <form action="<?php echo base_url('cart/update/') . $cart->produk_id ?>" method="post">
                                                                                    <td style="text-align:center"><br>
                                                                                          <input type="hidden" name="produk_id" value="<?php echo $cart->produk_id ?>">
                                                                                          <input type="number" name="qty" style="width: 50px" value="<?php echo $cart->total_qty ?>">
                                                                                    </td>
                                                                                    <td style="text-align:center"><br><?php echo 'Rp. ' . number_format($cart->subtotal, 2, ',', '.') ?></td>
                                                                                    <td style="text-align: center"> <br>
                                                                                          <button type="submit" name="update" class="btn btn-sm btn-warning">Update</button>
                                                                                          <button type="submit" name="delete" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button>
                                                                                    </td>
                                                                              </form>
                                                                        </tr>
                                                                  <?php endforeach; ?>
                                                                  <tr>
                                                                        <td colspan="6" align='center'>
                                                                              <h4><b>SUBTOTAL</b></h4>
                                                                        </td>
                                                                        <td colspan="2" align='center'>
                                                                              <h4><b><?php echo 'Rp. ' . number_format($total_berat_subtotal->subtotal, 2, ',', '.') ?></b></h4>
                                                                        </td>
                                                                  </tr>
                                                            </tbody>
                                                      </table>
                                                </div>
                                          </div>
                                    </div> <br>
                                    <?php if (!empty($customer_data->id_trans)) { ?>
                                          <div class="row">
                                                <div class="col-lg-10">
                                                      <a href="<?php echo base_url('cart/empty_cart/') . $customer_data->id_trans; ?>">
                                                            <button name="hapus" type="button" class="btn btn-danger" aria-label="Left Align" title="Empty the Cart" OnClick="return confirm('Apakah Anda yakin?');">
                                                                  <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Empty the Cart
                                                            </button>
                                                      </a>
                                                      <a href="<?php echo base_url('checkout/order-information'); ?>">
                                                            <button name="continue" type="button" class="btn btn-info" aria-label="Left Align" title="Checkout">
                                                                  <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Checkout
                                                            </button>
                                                      </a>
                                                      <a href="<?php echo base_url('product/all-products'); ?>">
                                                            <button name="continue" type="button" class="btn btn-success" aria-label="Left Align" title="Continue Shopping">
                                                                  <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Continue Shopping
                                                            </button>
                                                      </a>
                                                </div>
                                          </div>
                                    <?php } ?>
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
                                          <p>If you will check your cart, please try one of the following pages <a href="<?php echo base_url('user-login'); ?>" title="link">Login <i class="fa fa-angle-double-right"></i></a></p>
                                    </div>
                                    <!-- End text -->
                              </div>
                              <!-- End page404 -->
                        <?php } ?>
                              </div>
                  </div>
            </div>
      </div>
      <!-- End container -->
      </div>
      <!-- End cat-box-container -->
      </div>
      <?php $this->load->view('front/footer-all') ?>
      <?php $this->load->view('front/js-mix') ?>
      <!-- js file -->
      <script src="<?php echo base_url('assets/template/frontend/'); ?>js/function-back-top.js"></script>
      <script src="<?php echo base_url('assets/template/frontend/'); ?>js/function-sidebar.js"></script>
      <script src="<?php echo base_url('assets/template/frontend/'); ?>js/funtion-header-v3.js"></script>
      <script src="<?php echo base_url('assets/template/frontend/'); ?>js/function-search-v2.js"></script>
      <script src="<?php echo base_url('assets/template/frontend/'); ?>js/function-shopping-cart.js"></script>
</body>

</html>