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
      <div class="container">
            <div class="menu-breadcrumb">
                  <ul class="breadcrumb">
                        <li><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li><a href="<?php echo base_url('my-account'); ?>">My Account</a></li>
                        <li><a href="<?php echo base_url('my-account/edit-account/') . $this->session->userdata('user_id'); ?>">Edit Account</a></li>
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
                                                <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                                                <h2><b>ACCOUNT DETAILS</b></h2>
                                                <?php echo $message ?>
                                                <?php echo form_open_multipart(uri_string()); ?>
                                                <div class="group box space-20">
                                                      <label class="control-label" for="username">Username *</label>
                                                      <?php echo form_input($username); ?>
                                                </div>
                                                <div class="group box space-20">
                                                      <label class="control-label" for="name">Name *</label>
                                                      <!-- <input class="form-control" type="text" name='name' placeholder="Full Name ( Nama Lengkap )"> -->
                                                      <?php echo form_input($nama); ?>
                                                </div>
                                                <div class="group box space-20">
                                                      <label class="control-label" for="email">Email *</label>
                                                      <?php echo form_input($email); ?>
                                                </div>
                                                <div class="group box space-20">
                                                      <label class="control-label" for="phone">Phone *</label>
                                                      <?php echo form_input($phone); ?>
                                                </div>
                                                <div class="group box space-20">
                                                      <label class="control-label" for="Provinsi">Province *</label>
                                                      <?php echo form_dropdown('', $ambil_provinsi, $user->id_provinsi, $provinsi_id); ?>
                                                </div>
                                                <div class="group box space-20">
                                                      <label class="control-label" for="kota">CITY *</label>
                                                      <?php echo form_dropdown('', $ambil_kota, $user->id_kota, $kota_id); ?>
                                                </div>
                                                <div class="group box space-20">
                                                      <label class="control-label" for="address">Address *</label>
                                                      <?php echo form_textarea($address); ?>
                                                </div>
                                                <div class="group box space-20">
                                                      <label class="control-label" for="password">Password *</label>
                                                      <?php echo form_input($password); ?>
                                                </div>
                                                <div class="group box space-20">
                                                      <label class="control-label" for="repeat_password">Repeat Password *</label>
                                                      <?php echo form_input($password_confirm); ?>
                                                </div>
                                                <?php echo form_hidden('id', $user->id); ?>

                                                <input type="submit" name='submit' class="btn btn-info" value='UPDATE ACCOUNT'>
                                                <input type="reset" name='reset' class="btn btn-warning" value='RESET'>
                                                <?php form_close(); ?>
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
            function tampilKota() {
                  provinsi_id = document.getElementById("provinsi_id").value;
                  $.ajax({
                        url: "<?php echo base_url(); ?>auth/get_kota/" + provinsi_id + "",
                        success: function(response) {
                              $("#kota_id").html(response);
                        },
                        dataType: "html"
                  });
                  return false;
            }
      </script>
</body>

</html>