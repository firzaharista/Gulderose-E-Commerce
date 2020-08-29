<?php $this->load->view('back/meta'); ?>
<?php $this->load->view('back/navbar'); ?>
<?php $this->load->view('back/left-sidebar'); ?>
<?php $this->load->view('back/right-sidebar'); ?>
<section class="content home">
      <div class="block-header">
            <div class="row">
                  <div class="col-lg-4 col-md-4 col-sm-12">
                        <h2>Ecommerce Dashboard
                              <small>Welcome to Gulderose Bunga Flanel</small>
                        </h2>
                  </div>
                  <div class="col-lg-8 col-md-8 col-sm-12 text-right">
                        <button class="btn btn-white btn-icon btn-round hidden-sm-down float-right m-l-10" type="button">
                              <i class="zmdi zmdi-plus"></i>
                        </button>
                        <ul class="breadcrumb float-md-right">
                              <li class="breadcrumb-item"><a href="<?php echo base_url('admin_gulderose/dashboard'); ?>"><i class="zmdi zmdi-home"></i> Home</a></li>
                              <li class="breadcrumb-item"><a href="<?php echo base_url('admin_gulderose/produkrekomendasi'); ?>"><?php echo $modul ?></a></li>
                              <li class="breadcrumb-item active">Tambah <?php echo $modul ?></li>
                        </ul>
                  </div>
            </div>
      </div>
      <!-- Bagian produk add dll -->
      <div class="container-fluid">
            <div class="row clearfix">
                  <div class="col-lg-12 col-md-12">
                        <div class="card">
                              <div class="header">
                                    <h2>
                                          <strong>Tambah</strong> <?php echo $modul ?>
                                          <small>Untuk menambah data <?php echo $modul ?></small>
                                    </h2>
                                    <ul class="header-dropdown">
                                          <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                      <li><a href="<?php echo base_url('admin_gulderose/produkrekomendasi') ?>">Data <?php echo $modul ?></a></li>
                                                </ul>
                                          </li>
                                          <li class="remove">
                                                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                                          </li>
                                    </ul>
                              </div>
                              <div class="body">
                                    <?php echo validation_errors() ?>
                                    <?php if ($this->session->flashdata('message')) {
                                          echo $this->session->flashdata('message');
                                    } ?>
                                    <?php echo form_open_multipart($action) ?>

                                    <div class="row clearfix">
                                          <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                                                <label for="nama_produk">Nama Produk</label>
                                          </div>
                                          <div class="col-lg-10">
                                                <?php echo form_dropdown('', $get_combo_produk, '', $produk_id); ?>
                                          </div>
                                    </div>
                                    <br>
                                    <div class="row clearfix">
                                          <div class="col-sm-8 offset-sm-2">
                                                <button type=" submit" name='submit' class="btn btn-raised btn-info btn-round waves-effect"><?php echo $button_submit ?></button>
                                                <button type="reset" name='reset' class="btn btn-raised btn-info btn-round waves-effect"><?php echo $button_reset ?></button>
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
<?php $this->load->view('back/js'); ?>
<!-- Basic FORM -->
<script src="<?php echo base_url('assets/template/backend/'); ?>assets/plugins/momentjs/moment.js"></script> <!-- Moment Plugin Js -->

</body>

</html>