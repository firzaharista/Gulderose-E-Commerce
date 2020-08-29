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
                                                <?php echo form_open('cart/checkout') ?>
                                                <table class="table table-hover table-bordered table-striped table-responsive">
                                                      <tbody>
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
                                                                  <td align="left">Via :
                                                                        <select name="kurir" class="kurir" required>
                                                                              <option value="">--Silahkan Pilih--</option>
                                                                              <?php
                                                                              $kurir = array('jne', 'pos', 'tiki');
                                                                              foreach ($kurir as $data_kurir) {
                                                                                    ?>
                                                                                    <option value="<?= $data_kurir; ?>"><?= strtoupper($data_kurir); ?></option>
                                                                              <?php } ?>
                                                                        </select>
                                                                        <div id="kuririnfo" style="display: none;"><br>
                                                                              <label>Service</label>
                                                                              <div class="col-lg-12" id="kurirserviceinfo">
                                                                                    <p class="form-control-static kurirserviceinfo" id="kurirserviceinfo"></p>
                                                                              </div>
                                                                        </div>
                                                                  </td>
                                                                  <td align="right">
                                                                       <font id="totalongkir"></font>
                                                                  </td>
                                                            </tr>
                                                            <tr>
                                                                  <th scope="row">Grand Total</th>
                                                                  <td align="right">Subtotal + Total Shipping Costs</td>
                                                                  <td align="right"><b>
                                                                              <div id="grandtotal"></div>
                                                                        </b></td>
                                                            </tr>
                                                      </tbody>
                                                </table>
                                          </div>
                                    </div> <br>
                                    <div class="row">
                                          <div class="col-lg-12">
                                                <hr>
                                                <h4>Destination Address</h4>
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
                                                </table> <br>
                                                <h4><b>Perhatian *</b></h4>
                                                <ul>
                                                      <li>Apabila terdapat kesalahan pada data diatas, harap mengubahnya pada halaman edit profil pada menu berikut ini, <a href="<?php echo base_url('auth/edit_profil/') . $this->session->userdata('user_id') ?>">klik disini</a></li>
                                                      <li>Ongkos kirim <b>JNE</b> dibawah 1.4kg akan dianggap 1kg (toleransi 300gram), sedangkan <b>TIKI</b> dan <b>POS</b> dibawah 1.3kg akan dianggap 1kg (toleransi 200gram)</li>
                                                </ul>
                                          </div>
                                    </div> <br>
                                    <a href="<?php echo base_url('cart') ?>"><input type="submit" name='submit' class="btn btn-warning" value="Back to My Cart"></a>
                                    <a href="<?php echo base_url('auth/my_account') ?>"><input type="submit" name='submit' class="btn btn-info" value="Place Order"></a>

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

      <script type="text/javascript">
            $(document).ready(function() {
                  $(".kurir").each(function() {
                        $(this).on("change", function() {
                              var did = $(this).val();
                              var berat = "<?php echo $total_berat_subtotal->total_berat ?>";
                              var kota = "<?php echo $customer_data->id_kota ?>";
                              $.ajax({
                                          method: "get",
                                          dataType: "html",
                                          url: "<?= base_url(); ?>cart/kurirdata",
                                          data: "kurir=" + did + "&berat=" + berat + "&kota=" + kota,
                                    })
                                    .done(function(x) {
                                          $("#kurirserviceinfo").html(x);
                                          $("#kuririnfo").show();
                                    })
                                    .fail(function() {
                                          $("#kurirserviceinfo").html("");
                                          $("#kuririnfo").hide();
                                    });
                        });
                  });
                  hitung();
            });

            function hitung() {
                  var total = $('#total').val();
                  var ongkir = $("#ongkir").val();
                  var totalongkir = ongkir;
                  var bayar = (parseFloat(total) + parseFloat(totalongkir));
                  if (parseFloat(ongkir) > 0) {
                        $("#oksimpan").show();
                  } else {
                        $("#oksimpan").hide();
                  }
                  $("#totalongkir").html(toRp(totalongkir));
                  $("#grandtotal").html(toRp(bayar));
            }

            function toRp(a, b, c, d, e) {
                  e = function(f) {
                        return f.split('').reverse().join('')
                  };
                  b = e(parseInt(a, 10).toString());
                  for (c = 0, d = ''; c < b.length; c++) {
                        d += b[c];
                        if ((c + 1) % 3 === 0 && c !== (b.length - 1)) {
                              d += '.';
                        }
                  }
                  return 'Rp.\t' + e(d) + ',00'
            }
      </script>
</body>

</html>