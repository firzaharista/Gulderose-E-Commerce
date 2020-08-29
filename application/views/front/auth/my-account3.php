<?php $this->load->view('front/meta-mix') ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-about.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-res-about.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-faq.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-login.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-shopping.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-404.css">

</head>

<body>
      <?php $this->load->view('front/navbar-all') ?>
      <div class="container">
            <div class="menu-breadcrumb">
                  <ul class="breadcrumb">
                        <li><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li><a href="<?php echo base_url('my-account'); ?>">My Account</a></li>
                  </ul>
            </div>
            <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?></li>
      </div>
      <div class="container container-ver2">
            <div class="page-login box space-50">
                  <div class="row">
                        <div class="col-md-10 sign-in space-30">
                              <div class="box">
                                    <?php
                                          $id = $this->session->userdata('user_id');
                                          $sql  = $this->db->query("SELECT * FROM users,kota,provinsi WHERE provinsi.id_provinsi = users.id_provinsi AND kota.id_kota = users.id_kota AND id = '$id'");
                                          $data = $sql->row_array();
                                    ?>
                                    <h2><b>MY ACCOUNT</b></h2>
                                    <p>Welcome Back, <?php echo $data['nama']; ?></p>
                                    <!-- End social -->
                                    <form class="form-horizontal" method="POST">
                                          <div class="group box space-5">
                                                <label class="control-label" for="inputemail">Account *</label>
                                                <p> <i class="far fa-user"></i> <?php echo $data['nama']; ?>
                                                      <br> <i class="far fa-envelope"></i> Email : <?php echo $data['email']; ?>
                                                      <br> <i class="fa fa-phone"></i> Phone : <?php if ($data['phone'] == '') {
                                                                                                            echo '<b>Belum di isi</b>';
                                                                                                      } else {
                                                                                                            echo $data['phone'];
                                                                                                      } ?>
                                                      <br> <i class="fa fa-map-marker "></i> Alamat : <?php if ($data['address'] == '') {
                                                                                                            echo '<b>Belum di isi</b>';
                                                                                                      } else {
                                                                                                            echo $data['address'] . ', ' . $data['nama_kota'] . ', ' . $data['nama_provinsi'];
                                                                                                      } ?>
                                                      <br>
                                                      <br> Last Login : <?php if (!empty($data->last_login)) {
                                                                                                            echo date("d-m-Y H:i:s", $data['last_login']) . ' WIB';
                                                                                                      } else {
                                                                                                            echo "Belum melakukan login";
                                                                                                      } ?>
                                                </p>

                                          </div>
                                    </form>
                                    <!-- End form -->
                                    <a href="<?php echo base_url('my-account/edit-account/') . $this->session->userdata('user_id'); ?>">
                                          <input type="submit" name="" class="btn btn-info" value="Edit Account">
                                    </a>
                                    <a href="<?php echo base_url('log-out'); ?>">
                                          <input type="submit" name="" class="btn btn-danger" value="Logout">
                                    </a>
                              </div>
                        </div>
                        <!-- End col-md-6 -->
                  </div>
                  <div class="row">
                        <div class="col-md-12 space-30">
                              <div class="box">
                                    <h2> <b>ORDER HISTORY</b> </h2>
                                    <div class="row">
                                          <div class="col-lg-12">
                                                <div class="box-body table-responsive padding">
                                                      <?php if (empty($cek_order_history->id_trans)) {
                                                                                                            echo ' <br><br>
                                                                  <div class="page-404">
                                                                        <!-- End images -->
                                                                        <div class="text center">
                                                                              <h3>EMPTY ORDER HISTORY</h3>
                                                                              ' ?>
                                                            <p>Please try one of the following pages <a href="<?php echo base_url('product/all-products'); ?>" title="link">product <i class="fa fa-angle-double-right"></i></a></p>
                                                </div>
                                                <!-- End text -->
                                          </div>
                                          <!-- End page404 -->';

                                    <?php } else { ?>
                                          <table id="datatable" class="table table-hover table-bordered table-striped table-responsive">
                                                <thead>
                                                      <tr>
                                                            <th style="text-align: center">No.</th>
                                                            <th style="text-align: center">Invoice Order</th>
                                                            <th style="text-align: center">Date of Order</th>
                                                            <th style="text-align: center">Shipping</th>
                                                            <th style="text-align: center">Status</th>
                                                            <th style="text-align: center">Resi</th>
                                                            <th style="text-align: center">Action</th>
                                                      </tr>
                                                </thead>
                                                <tbody>
                                                      <?php $start = 1;
                                                            foreach ($order_history as $history) : ?>
                                                            <tr>
                                                                  <td style="text-align:center"><?php echo $start++ ?></td>
                                                                  <td style="text-align:center"><?php echo $history->id_trans ?></td>
                                                                  <td style="text-align:center"><?php echo date("d-m-Y, H:i", strtotime($history->created)) . ' WIB'; ?></td>
                                                                  <td style="text-align:center"><?php echo strtoupper($history->kurir).' ( '.$history->service.' )' ?></td>
                                                                  <td style="text-align:center">
                                                                        <?php if ($history->status == '1') { ?>
                                                                              <button type="button" name="status" class="btn btn-warning">Waiting for Payment</button>
                                                                        <?php } elseif ($history->status == '2') { ?>
                                                                              <button type="button" name="status" class="btn btn-success">Payment Accepted and Processing</button>
                                                                        <?php } elseif ($history->status == '3') { ?>
                                                                              <button type="button" name="status" class="btn btn-info">Shipped to Destination Address</button>
                                                                        <?php } elseif ($history->status == '4') { ?>
                                                                              <button type="button" name="status" class="btn btn-danger">Cancelled</button>
                                                                        <?php } ?>
                                                                  </td>
                                                                  <td style="text-align:center">
                                                                        <?php if ($history->resi != NULL) {
                                                                        echo $history->id_trans; } else { echo "Not Available"; } ?>
                                                                  </td>
                                                                  <td style="text-align:center">
                                                                        <a href="<?php echo base_url('order-details/').$history->id_trans; ?>"><input type="submit" name="submit" class="btn btn-info" value="Details"> </a>
                                                                  </td>
                                                            </tr>
                                                      <?php endforeach; ?>
                                                </tbody>
                                          </table>
                                    <?php } ?>
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
      </div>
      <!-- End row -->

      </div>
      </div>
      <?php $this->load->view('front/footer-all') ?>
      <?php $this->load->view('front/js-mix') ?>
      <!-- js file -->
      <script src="<?php echo base_url('assets/template/frontend/'); ?>js/function-back-top.js"></script>
      <script src="<?php echo base_url('assets/template/frontend/'); ?>js/function-sidebar.js"></script>
      <script src="<?php echo base_url('assets/template/frontend/'); ?>js/funtion-header-v3.js"></script>
      <script src="<?php echo base_url('assets/template/frontend/'); ?>js/function-search-v2.js"></script>
</body>

</html>