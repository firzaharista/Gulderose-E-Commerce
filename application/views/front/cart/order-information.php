<?php $this->load->view('front/meta-mix') ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-about.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-res-about.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-faq.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-checkout.css">


</head>

<body>
      <?php $this->load->view('front/navbar-all') ?>
      <div class="cart-box-container check-out">
            <div class="container container-ver2">
                  <div class="row">
                        <div class="col-md-6">
                              <h3 class="title-brand">BILLING ADDRESS</h3>
                              <form class="form-horizontal" action="<?php echo site_url('cart/order_information_action') ?>" method="POST" enctype="multipart/form-data">
                                    <div class="form-group col-md-12">
                                          <label for="inputfname" class=" control-label">Name <span class="color">*</span></label>
                                          <input type="text" placeholder="Enter your first name..." id="inputfname" class="form-control" value='<?php echo $profil->nama; ?>' disabled>
                                    </div>
                                    <div>
                                          <div class="form-group col-md-6">
                                                <label for="inputemail" class=" control-label">Email<span class="color">*</span></label>
                                                <input type="text" placeholder="Enter your email..." id="inputemail" class="form-control" value='<?php echo $profil->email; ?>' disabled>
                                          </div>
                                          <div class="form-group col-md-6">
                                                <label for="inputphone" class=" control-label">Phone<span class="color">*</span></label>
                                                <input type="text" placeholder="Enter your phone..." id="inputphone" class="form-control" value='<?php echo $profil->phone; ?>' disabled>
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          <label for="inputstreet" class=" control-label">Adress<span class="color">*</span></label>
                                          <textarea name="address" id="address" class='form-control' cols="30" rows="10" disabled><?php echo $profil->address; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                          <label for="kota" class=" control-label">CITY<span class="color">*</span></label>
                                          <?php echo form_dropdown('', $ambil_kota, $profil->id_kota, $kota_id); ?>
                                    </div>
                                    <div class="form-group">
                                          <label for="provinsi" class=" control-label">PROVINCE<span class="color">*</span></label>
                                          <?php echo form_dropdown('', $ambil_provinsi, $profil->id_provinsi, $provinsi_id); ?>
                                    </div>
                                    <div class="form-group">
                                          <label for="provinsi" class=" control-label">VIA (Shipping)<span class="color">*</span></label>
                                          <select name="kurir" class="form-control kurir" required>
                                                <option value="">- Choose Shipping -</option>
                                                <?php
                                                $kurir = array('jne', 'tiki', 'pos');
                                                foreach ($kurir as $data_kurir) {
                                                ?>
                                                      <option value="<?= $data_kurir; ?>"><?= strtoupper($data_kurir); ?></option>
                                                <?php } ?>
                                          </select>
                                    </div>
                                    <div class='form-group' id="kuririnfo" style="display: none;"><br>
                                          <label class='control-label'>
                                                Service<span class='color'>*</span>
                                          </label>
                                          <div class="col-lg-12" id="kurirserviceinfo">
                                                <p class="form-control-static kurirserviceinfo" id="kurirserviceinfo"></p>
                                          </div>
                                    </div>
                                    <input type="input" name="id_trans" value="<?php echo $customer_data->id_trans ?>">
                                    <input type="hidden" name="total" id="total" value="<?php echo $total_berat_subtotal->subtotal ?>" />
                                    <input type="hidden" name="ongkir" id="ongkir" value="0" />

                        </div>
                        <!-- End col-md-8 -->
                        <div class="col-md-6 space-30">
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
                                                      <?php foreach ($cart_data as $cart) : ?>
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
                                                      <span class="right"><?php echo 'Rp. ' . number_format($total_berat_subtotal->subtotal, 2, ',', '.') ?></span>
                                                </li>
                                                <li>
                                                      <span class="left">SHIPPING COST</span>
                                                      <span class="right" id="totalongkir"></span>
                                                </li>
                                                <li>
                                                      <span class="left">ORDER TOTAL</span>
                                                      <span class="right brand" id="grandtotal"></span>
                                                </li>
                                          </ul>
                                    </div>

                                    <!-- End info-order -->
                                    <div class="form-horizontal">
                                          <h4 class="title-brand">BANK PAYMENT</h4>
                                          <div class="form-group">
                                                <?php echo form_dropdown('', $ambil_banktujuan, '', $bank_transfer); ?>
                                          </div>
                                    </div> <br><br><br>
                                    <div align='right'>
                                          <button name="checkout" type="submit" class="btn btn-info" aria-label="Left Align" title="Checkout">
                                                <h4>PROCESS <i class='fa fa-spinner'></i></h4>
                                          </button>
                                    </div>
                                    <?php echo form_close(); ?>
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
                              var did   = $(this).val();
                              var berat = "<?php echo $total_berat_subtotal->total_berat ?>";
                              var kota  = "<?php echo $customer_data->id_kota ?>";
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