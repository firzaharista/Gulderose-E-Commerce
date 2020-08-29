<?php $this->load->view('back/meta'); ?>
<?php $this->load->view('back/navbar'); ?>
<?php $this->load->view('back/left-sidebar'); ?>
<?php $this->load->view('back/right-sidebar'); ?>

<section class="content home">
      <div class="block-header">
            <div class="row">
                  <div class="col-lg-5 col-md-5 col-sm-12">
                        <h2>Ecommerce Dashboard
                              <small>Welcome to Gulderose Bunga Flanel</small>
                        </h2>
                  </div>
                  <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <button class="btn btn-white btn-icon btn-round hidden-sm-down float-right m-l-10" type="button">
                              <i class="zmdi zmdi-plus"></i>
                        </button>
                        <ul class="breadcrumb float-md-right">
                              <li class="breadcrumb-item"><a href="<?php echo base_url('admin_gulderose/dashboard'); ?>"><i class="zmdi zmdi-home"></i> Home</a></li>
                              <li class="breadcrumb-item"><a href="<?php echo base_url('admin_gulderose/auth/edit_user'); ?>"><?php echo $modul ?></a></li>
                              <li class="breadcrumb-item active">Edit <?php echo $modul ?></li>
                        </ul>
                  </div>
            </div>
      </div>
      <!-- Bagian total Penjualan dll -->
      <div class="container-fluid">
            <div class="row clearfix">
                  <div class="col-lg-12 col-md-12">
                        <div class="card">
                              <div class="header">
                                    <h2>
                                          <strong>Tambah</strong> <?php echo $modul ?>
                                          <small>Untuk mengubah data <?php echo $modul ?></small>
                                    </h2>
                                    <ul class="header-dropdown">
                                          <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                      <li><a href="<?php echo base_url('admin_gulderose/auth') ?>">Data <?php echo $modul ?></a></li>
                                                </ul>
                                          </li>
                                          <li class="remove">
                                                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                                          </li>
                                    </ul>
                              </div>
                              <div class="body">
                                    <!-- <form action='' class="form-horizontal" id="form_advanced_validation" method="POST" enctype="multipart/form-data"> -->
                                    <?php echo form_open_multipart(uri_string()) ?>
                                    <?php echo validation_errors() ?>
                                    <?php if ($this->session->flashdata('message')) {
                                          echo $this->session->flashdata('message');
                                    } ?>
                                    <div class="row clearfix">
                                          <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                                                <label for="nama_lengkap">Nama Lengkap</label>
                                          </div>
                                          <div class="col-lg-10 col-md-10 col-sm-8">
                                                <div class="form-group has-success">
                                                      <!-- <input type="text" id="nama_lengkap" class="form-control form-control-success" placeholder="Nama Lengkap" required> -->
                                                      <?php echo form_input($nama); ?>
                                                </div>
                                          </div>
                                    </div>
                                    <div class="row clearfix">
                                          <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                                                <label for="username">Username</label></label>
                                          </div>
                                          <div class="col-lg-4 col-md-4 col-sm-4">
                                                <div class="form-group has-success">
                                                      <!-- <input type="text" id="username" class="form-control form-control-success" placeholder="Username" required> -->
                                                      <?php echo form_input($username); ?>
                                                </div>
                                          </div>
                                          <div class="col-lg-1 col-md-2 col-sm-4 form-control-label">
                                                <label for="email">Email</label>
                                          </div>
                                          <div class="col-lg-5 col-md-4 col-sm-4">
                                                <div class="form-group has-success">
                                                      <?php echo form_input($email); ?>
                                                </div>
                                          </div>
                                    </div>
                                    <div class="row clearfix">
                                          <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                                                <label for="phone">No. HP</label>
                                          </div>
                                          <div class="col-lg-4 col-md-4 col-sm-4">
                                                <div class="form-group has-success">
                                                      <?php echo form_input($phone); ?>
                                                </div>
                                          </div>
                                          <div class="col-lg-1 col-md-2 col-sm-4 form-control-label">
                                                <label for="level_user">Level User</label>
                                          </div>
                                          <?php if ($this->ion_auth->is_superadmin()) : ?>
                                                <div class="col-lg-5 col-md-4 col-sm-4">
                                                      <?php echo form_dropdown('', $get_all_users_group, $user->id_group, $id_group); ?>
                                                </div>
                                          <?php endif ?>
                                    </div>
                                    <div class="row clearfix">
                                          <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                                                <label for="password">Password</label></label>
                                          </div>
                                          <div class="col-lg-4 col-md-4 col-sm-4">
                                                <div class="form-group has-success">
                                                      <?php echo form_password($password); ?>
                                                </div>
                                          </div>
                                          <div class="col-lg-1 col-md-2 col-sm-4 form-control-label">
                                                <label for="ulangi_password">Ulangi Password</label>
                                          </div>
                                          <div class="col-lg-5 col-md-4 col-sm-4">
                                                <div class="form-group has-success">
                                                      <?php echo form_password($password_confirm); ?>
                                                </div>
                                          </div>
                                    </div>
                                    <div class="row clearfix">
                                          <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                                                <label for="provinsi">Provinsi</label></label>
                                          </div>
                                          <div class="col-lg-4 col-md-4 col-sm-4">
                                                <!-- <input type="text" id="username" class="form-control form-control-success" placeholder="Username" required> -->
                                                <?php echo form_dropdown('', $ambil_provinsi, $user->id_provinsi, $provinsi_id); ?>
                                          </div>
                                          <div class="col-lg-1 col-md-2 col-sm-4 form-control-label">
                                                <label for="kota">Kota / Kabupaten</label>
                                          </div>
                                          <div class="col-lg-5 col-md-4 col-sm-4" id="kota_id">
                                                <?php echo form_dropdown('', $ambil_kota, $user->id_kota, $kota_id); ?>
                                          </div>
                                    </div>
                                    <div class="row clearfix">
                                          <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                                                <label for="alamat">Alamat</label>
                                          </div>
                                          <div class="col-lg-10">
                                                <div class="form-group has-success">
                                                      <?php echo form_textarea($address); ?>
                                                </div>
                                          </div>
                                    </div>
                                    <?php echo form_hidden('id', $user->id); ?>
                                    
                                    <div class="row clearfix">
                                          <div class="col-sm-8 offset-sm-2">
                                                <button type="submit" name='submit' class="btn btn-raised btn-info btn-round waves-effect">SIMPAN</button>
                                                <button type="reset" name='reset' class="btn btn-raised btn-info btn-round waves-effect">RESET</button>
                                          </div>
                                    </div>
                                    <?php form_close() ?>

                              </div>
                              <div class="sparkline" data-type="line" data-spot-Radius="1" data-highlight-Spot-Color="rgb(63, 81, 181)" data-highlight-Line-Color="#222" data-min-Spot-Color="rgb(233, 30, 99)" data-max-Spot-Color="rgb(63, 81, 181)" data-spot-Color="rgb(63, 81, 181, 0.7)" data-offset="90" data-width="100%" data-height="40px" data-line-Width="1" data-line-Color="rgb(63, 81, 181, 0.7)" data-fill-Color="rgba(0,0,0, 0.2)"> 1,2,3,1,4,3,6,4,4,1 </div>
                        </div>
                  </div>

            </div>

      </div>

</section>

<!-- Javascript -->
<?php $this->load->view('back/js'); ?>
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