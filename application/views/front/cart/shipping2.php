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
                              <form class="form-horizontal">
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
                                          <label for="inputcountry1" class=" control-label">PROVINCE<span class="color">*</span></label>
                                          <select id="inputcountry1" name="inputcountry1" class="country form-control">

                                          </select>
                                    </div>
                                    <div class="form-group">
                                          <label for="inputcountry1" class=" control-label">CITY<span class="color">*</span></label>
                                          <select id="inputcountry1" name="inputcountry1" class="country form-control">

                                          </select>
                                    </div>
                                    <div class="form-group">
                                          <label for="formGroupExampleInput">Provinsi Asal</label>
                                          <select onChange="get_kota('asal')" id="provinsi_asal" class="form-control provinsi" name='provinsi_asal'>

                                          </select>
                                    </div>
                                    <div class="form-group">
                                          <label for="formGroupExampleInput">Kota Asal</label>
                                          <select id="kota_asal" class="form-control" name='kota_asal'>

                                          </select>
                                    </div>

                                    <div class="form-group">
                                          <label for="formGroupExampleInput">Provinsi Tujuan</label>
                                          <select id="provinsi_tujuan" onChange="get_kota('tujuan')" class="form-control provinsi" name='provinsi_tujuan'>

                                          </select>
                                    </div>
                                    <div class="form-group">
                                          <label for="formGroupExampleInput">Kota Tujuan</label>
                                          <select id="kota_tujuan" class="form-control" name='kota_tujuan'>

                                          </select>
                                    </div>

                                    <div class="form-group">
                                          <label for="berat">Berat (bulatkan ke dalam kg)</label>
                                          <input type="number" name="berat" id="berat" class="form-control">
                                    </div>
                                    <div class="form-group">
                                          <label for="kurir">SHIPPING</label>
                                          <select onChange="get_ongkir()" name="kurir" id="kurir" class="form-control">
                                                <option value="jne">JNE</option>
                                                <option value="pos">POS</option>
                                                <option value="tiki">TIKI</option>
                                          </select>
                                    </div>

                                    <div class="form-group">
                                          <label for="service">SERVICE</label>
                                          <select name="service" id="service" class="form-control">

                                          </select>
                                    </div>

                              </form>


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
                                                            <span class="total"><b>SUB TOTAL</b></span>
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
                                    <div class="payment-order box float-left">
                                          <h3 class="title-brand">PAYMENT MENTHOD</h3>
                                          <ul class="tabs">
                                                <li>
                                                      <i class="icon"></i>
                                                      <h4>Direct Bank Transfer</h4>
                                                      <p>Make your payment directly info our bank account. Please use your order ID as the
                                                            payment reference. You product won't be shipped untill payment confiimation. </p>
                                                </li>
                                                <li>
                                                      <i class="icon"></i>
                                                      <h4>Cheque Payment</h4>

                                                </li>
                                                <li>
                                                      <i class="icon"></i>
                                                      <h4>PayPal</h4>
                                                </li>
                                                <li>
                                                      <i class="icon"></i>
                                                      <h4>I've raed and accept the </h4><a href="#" title="Temr & conditions">Temr & conditions</a>
                                                </li>
                                          </ul>
                                    </div>
                                    <a class="link-v1 box lh-50 rt full" href="#" title="PLACE ORDER">PROCESS</a>
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
            $(function() {
                  $.get("<?= site_url('ongkir/get_provinsi') ?>", {}, (response) => {
                        let output = '';
                        let provinsi = response.rajaongkir.results
                        console.log(response)

                        provinsi.map((val, i) => {
                              output += `<option value="${val.province_id}" >${val.province}
		
				</option>`
                        })
                        $('.provinsi').html(output)

                  })
            });

            function get_kota(type) {
                  let id_provinsi = $(`#provinsi_${type}`).val();
                  $.get("<?= site_url('ongkir/get_kota/') ?>" + id_provinsi, {}, (response) => {
                        let output = '';
                        let kota = response.rajaongkir.results
                        console.log(response)

                        kota.map((val, i) => {
                              output += `<option value="${val.city_id}" >${val.city_name}
				
					</option>`
                        })
                        $(`#kota_${type}`).html(output)

                  })
            }

            function get_ongkir() {
                  let berat = $('#berat').val();
                  let asal = $('#kota_asal').val();
                  let tujuan = $('#kota_tujuan').val();
                  let kurir = $('#kurir').val();
                  let output = '';

                  $.get("<?= site_url('ongkir/get_biaya/') ?>" + `${asal}/${tujuan}/${berat}/${kurir}`, {}, (response) => {
                        console.log(response);
                        let biaya = response.rajaongkir.results

                        console.log(biaya)

                        biaya.map((val, i) => {
                              for (var i = 0; i < val.costs.length; i++) {
                                    let jenis_layanan = val.costs[i].service
                                    val.costs[i].cost.map((val, i) => {
                                          output += `<option value="${val.value}" >${jenis_layanan} - Rp.${val.value} ${val.etd} Hari  </option>`
                                    })
                              }
                        })
                        $(`#service`).html(output)

                  })
            }
      </script>
</body>

</html>