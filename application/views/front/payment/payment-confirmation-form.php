<?php $this->load->view('front/meta-mix') ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-about.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-res-about.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-faq.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-login.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-shopping.css">

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-res-product-detail.css">

</head>

<body>
      <?php $this->load->view('front/navbar-all') ?>
      <div class="container content">
            <div class="menu-breadcrumb">
                  <ul class="breadcrumb">
                        <li><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li><a href="<?php echo base_url('payment-confirmation-form'); ?>">Payment Confirmation</a></li>
                  </ul>
            </div>
      </div>
      <div class="container container-ver2">
            <div class="page-login box space-50">
                  <div class="row">
                        <div class="container container-ver2">
                              <div class="page-login box space-50">
                                    <div class="row">
                                          <div class="col-md-6 col-md-offset-3 sign-in space-30">
                                                <h2>Payment Confirmation</h2> <br>
                                                <!-- <p>Konfirmasi transaksi pembayaran</p> -->
                                                <?php echo validation_errors() ?>
                                                <?php if ($this->session->flashdata('message')) {
                                                      echo $this->session->flashdata('message');
                                                } ?>
                                                <form class="form" action="<?php echo base_url('payment-confirmation/payment-done') ?>" method="POST" enctype="multipart/form-data">
                                                      <div class="group box space-20">
                                                            <label class="control-label" for="inputemail">Order Number (Invoice)*</label>
                                                            <input class="form-control" type="text" placeholder="Order Number" name="trans_id" value="<?php echo $ambil_data_order->id_trans ?>" readonly>
                                                      </div>
                                                      <div class="group box space-20">
                                                            <label class="control-label" for="inputemail">Name *</label>
                                                            <input class="form-control" type="text" placeholder="Name" value="<?php echo $ambil_data_order->nama ?>" readonly>
                                                      </div>
                                                      <div class="group box space-20">
                                                            <label class="control-label" for="inputemail">Email *</label>
                                                            <input class="form-control" type="text" placeholder="Your Email" value="<?php echo $ambil_data_order->email ?>" readonly>
                                                      </div>
                                                      <div class="group box space-20">
                                                            <label class="control-label" for="inputemail">Bank Transfer Origin *</label>
                                                            <!-- <input class="form-control" type="text" placeholder="Bank Asal"> -->
                                                            <?php echo form_dropdown('', $ambil_bankasal, '', $bankasal_id); ?>
                                                      </div>
                                                      <div class="group box space-20">
                                                            <label class="control-label" for="inputemail">Bank Transfer Destination *</label>
                                                            <?php echo form_dropdown('', $ambil_banktujuan, $ambil_data_order->banktujuan_id, $banktujuan_id); ?>
                                                      </div>
                                                      <div class="group box space-20">
                                                            <label class="control-label" for="inputemail">Transfer Amount *</label>
                                                            <!-- ini buat yg diviewnya -->
                                                            <input class="form-control" type="text" name="jumlah_view" placeholder="Transfer Amount (Jumlah Transfer)" required="" value="<?php echo 'Rp. ' . number_format(($ambil_data_order->ongkir + $total_berat_dan_subtotal->subtotal), 2, ',', '.') ?>" readonly>
                                                            <!-- yg bawah buat masuk yg didatabasenya -->
                                                            <input class="form-control" type="hidden" name="jumlah" placeholder="Transfer Amount (Jumlah Transfer)" required="" value="<?php echo ($ambil_data_order->ongkir + $total_berat_dan_subtotal->subtotal) ?>" readonly>
                                                      </div>
                                                      <div class="group box space-20">
                                                            <label class="control-label" for="inputemail">Upload Payment Receipt *</label>
                                                            <small>Size Max. 5 MB</small>
                                                            <input class="form-control" type="file" name="foto" required="required">
                                                      </div>
                                                      <?php echo form_input($trans_id, $ambil_data_order->trans_id) ?>
                                                      <button type="submit" name="submit" class="btn btn-danger">SEND PAYMENT CONFIRMATION</button>
                                                </form>
                                                <!-- End form -->
                                          </div>
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
      </div>
      <?php $this->load->view('front/footer-all') ?>
      <?php $this->load->view('front/js-mix') ?>
      <!-- js file -->
      <script src="<?php echo base_url('assets/template/frontend/'); ?>js/function-back-top.js"></script>
      <script src="<?php echo base_url('assets/template/frontend/'); ?>js/function-sidebar.js"></script>
      <script src="<?php echo base_url('assets/template/frontend/'); ?>js/funtion-header-v3.js"></script>
      <script src="<?php echo base_url('assets/template/frontend/'); ?>js/function-search-v2.js"></script>

      <script type="text/javascript">
            var rupiah = document.getElementById("jumlah");
            rupiah.addEventListener("keyup", function(e) {
                  // tambahkan 'Rp.' pada saat form di ketik
                  // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                  rupiah.value = formatRupiah(this.value, "Rp. ");
            });

            /* Fungsi formatRupiah */
            function formatRupiah(angka, prefix) {
                  var number_string = angka.replace(/[^,\d]/g, "").toString(),
                        split = number_string.split(","),
                        sisa = split[0].length % 3,
                        rupiah = split[0].substr(0, sisa),
                        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                  // tambahkan titik jika yang di input sudah menjadi angka ribuan
                  if (ribuan) {
                        separator = sisa ? "." : "";
                        rupiah += separator + ribuan.join(".");
                  }

                  rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
                  return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
            }
      </script>
</body>

</html>