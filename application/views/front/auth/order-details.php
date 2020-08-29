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
                                    <h3> <b>ORDER DETAILS</b> </h3>

                                    <p>INVOICE ORDER : <b><?php echo $order_history_detail_row->id_trans; ?></b>
                                          <br>Order place on : <?php echo date('d-m-Y, H:i', strtotime($order_history_detail_row->waktu_trans)) . ' WIB' ?>
                                          <br>Bank Transfer Destination : <?php echo $order->nama_banktujuan; ?>
                                          <br>Shipping Time : <b><?php if ($order->waktu_kirim == NULL) {
                                                                        echo "Not Available";
                                                                  } else {
                                                                        echo date("d-m-Y", strtotime($order->waktu_kirim));
                                                                  } ?></b>
                                          <br>Resi : <b><?php if ($order->resi == NULL) {
                                                                  echo 'Not Available';
                                                            } else {
                                                                  echo $order->resi;
                                                            } ?></b> <br>

                                    </p>
                                    <?php echo form_open('download-invoice/' . $order_history_detail_row->id_trans, 'id ="invoice" target="_blank" ') ?>
                                    <button type="submit" name="download_invoice" class="btn btn-danger">Download Invoice</button>
                                    <?php echo form_close() ?>
                                    <p></p>
                                    <?php if ($order_history_detail_row->status == '1') { ?>
                                          <div class="alert alert-warning" role="alert">
                                                <strong>Waiting for Payment !</strong> Thank you for your order.
                                          </div>
                                    <?php } elseif ($order_history_detail_row->status == '2') { ?>
                                          <div class="alert alert-success" role="alert">
                                                <strong>Confirmation Success</strong> Thank you for confirmation your order. Please wait until the status changes to Payment Accepted and Processing.
                                                <p>Products will be processed after payment is verified and sent ± 7 days later.
                                                </p>
                                          </div>
                                    <?php } elseif ($order_history_detail_row->status == '3') { ?>
                                          <div class="alert alert-info" role="alert">
                                                <strong>Payment Accepted and Processing</strong> Thank you for your payment. Orders will be processing.
                                          </div>
                                    <?php } elseif ($order_history_detail_row->status == '4') { ?>
                                          <div class="alert alert-info" role="alert">
                                                <strong>Shipped to Destination Address</strong> Thank you for shopping with us. Please wait for your order to arrive at home.
                                          </div>
                                    <?php } elseif ($order_history_detail_row->status == '5') { ?>
                                          <div class="alert alert-danger" role="alert">
                                                <strong>Cancelled</strong> Your order has been canceled.
                                          </div>
                                    <?php } ?>

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
                                                                  foreach ($order_history_detail as $history) : ?>
                                                                        <tr>
                                                                              <td style="text-align:center"><br><?php echo $start++ ?></td>
                                                                              <td style="text-align:center">
                                                                                    <a href="<?php echo base_url("product/$history->slug_produk") ?>"><img src="<?php echo base_url('assets/images/produk/') . $history->foto . $history->foto_type; ?>" width='70' alt="Gulderose_product"></a>
                                                                              </td>
                                                                              <td style="text-align:left"><br><?php echo $history->judul_produk ?></td>
                                                                              <td style="text-align:center"><br><?php echo 'Rp. ' . number_format($history->harga, 2, ',', '.') ?></td>
                                                                              <td style="text-align:center"><br><?php echo $history->berat; ?></td>
                                                                              <td style="text-align:center"><br><?php echo $history->total_berat; ?></td>
                                                                              <td style="text-align:center"><br><?php echo $history->total_qty; ?></td>
                                                                              <td style="text-align:center"><br><?php echo 'Rp. ' . number_format($history->subtotal, 2, ',', '.') ?></td>
                                                                        </tr>
                                                                  <?php endforeach; ?>
                                                            </tbody>
                                                      </table>
                                                </div>
                                          </div>

                                    </div> <br>
                                    <div class="row">
                                          <div class="col-lg-12">
                                                <table class="table table-hover table-bordered table-striped table-responsive">
                                                      <tbody>
                                                            <tr>
                                                                  <th>Amount of weight</th>
                                                                  <td colspan="2" align="right"><?php echo $order_history_total_berat->total_berat ?> (gram) / <?php echo $order_history_total_berat->total_berat / 1000 ?> kg</td>
                                                            </tr>
                                                            <tr>
                                                                  <th>SubTotal</th>
                                                                  <td></td>
                                                                  <td align="right"><?php echo 'Rp. ' . number_format($order_history_subtotal->subtotal, 2, ',', '.') ?></td>
                                                            </tr>
                                                            <tr>
                                                                  <th>Shipping Cost</th>
                                                                  <td align="right">Via: <?php echo strtoupper($order_history_detail_row->kurir) . ' ( ' . $order_history_detail_row->service . ' )' ?></td>
                                                                  <td align="right"><?php echo 'Rp. ' . number_format($order_history_detail_row->ongkir, 2, ',', '.') ?></td>
                                                            </tr>
                                                            <tr>
                                                                  <th scope="row">
                                                                        <h4><b>Grand Total</b></h4>
                                                                  </th>
                                                                  <td align="right">
                                                                        <h4><b>Subtotal + Total Shipping Cost</b></h4>
                                                                  </td>
                                                                  <td align="right">
                                                                        <h4><b><?php echo 'Rp. ' . number_format(($order_history_detail_row->ongkir + $order_history_subtotal->subtotal), 2, ',', '.'); ?></b></h4>
                                                                  </td>
                                                            </tr>
                                                      </tbody>
                                                </table>
                                          </div>
                                    </div> <br>
                                    <a href="<?php echo base_url('my-account') ?>"><input type="submit" name='submit' class="btn btn-info" value="Back to My Account"></a>

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