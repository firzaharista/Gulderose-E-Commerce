<?php $this->load->view('back/meta'); ?>
<?php $this->load->view('back/navbar'); ?>
<?php $this->load->view('back/left-sidebar'); ?>
<?php $this->load->view('back/right-sidebar'); ?>
<?php $this->load->view('back/chat'); ?>
<section class="content file_manager">
      <div class="block-header">
            <div class="row">
                  <div class="col-lg-7 col-md-5 col-sm-12">
                        <h2>Ecommerce Dashboard
                              <small>Welcome to Gulderose Bunga Flanel</small>
                        </h2>
                  </div>
                  <div class="col-lg-5 col-md-7 col-sm-12">
                        <button class="btn btn-white btn-icon btn-round hidden-sm-down float-right m-l-10" type="button">
                              <i class="zmdi zmdi-plus"></i>
                        </button>
                        <ul class="breadcrumb float-md-right">
                              <li class="breadcrumb-item"><a href="<?php echo base_url('admin_gulderose/dashboard'); ?>"><i class="zmdi zmdi-home"></i> Home</a></li>
                              <li class="breadcrumb-item"><a href="<?php echo base_url('admin_gulderose/laporan'); ?>"><?php echo $modul ?></a></li>
                              <li class="breadcrumb-item active">Data <?php echo $modul ?></li>
                        </ul>
                  </div>
            </div>
      </div>
      <div class="container-fluid">
            <div class="row clearfix">
                  <div class="col-lg-6">
                        <div class="card">
                              <div class="header">
                                    <h2>
                                          <strong>Data</strong> <?php echo $modul ?> Per Periode
                                          <small>Kumpulan <?php echo $modul ?></small>
                                    </h2>
                                    <ul class="header-dropdown">
                                          <li class="remove">
                                                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                                          </li>
                                    </ul>
                              </div>
                              <div class="body">
                                    <div class="demo-masked-input">
                                          <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                                          <?php echo form_open('admin_gulderose/laporan/export_periode') ?>
                                          <div class="row clearfix">
                                                <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                                                      <label for="tgl_mulai">Tanggal Mulai</label>
                                                </div>

                                                <div class="col-lg-10 col-md-10 col-sm-8">
                                                      <div class="input-group">
                                                            <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i> </span>
                                                            <input type="text" id='tgl_awal' name='tgl_awal' class="form-control" placeholder="Ex: 2016-02-15">
                                                      </div>
                                                </div>
                                          </div>
                                          <div class="row clearfix">
                                                <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                                                      <label for="tglakhir">Tanggal Akhir</label>
                                                </div>

                                                <div class="col-lg-10 col-md-10 col-sm-8">
                                                      <div class="input-group">
                                                            <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i> </span>
                                                            <input type="text" id='tgl_akhir' name='tgl_akhir' class="form-control" placeholder="Ex: 2016-03-15">
                                                      </div>
                                                </div>
                                          </div>
                                          <div class="row clearfix">
                                                <div class="col-sm-8 offset-sm-2">
                                                      <button type='submit' name='submit' class="btn btn-info btn-round">DOWNLOAD</button>
                                                      <button type="reset" type='reset' name='reset' class="btn btn-raised btn-info btn-round waves-effect">RESET</button>
                                                </div>
                                          </div>
                                          <?php echo form_close() ?>
                                    </div>
                              </div>
                        </div>
                  </div>
                  <div class="col-lg-6">
                        <div class="card">
                              <div class="header">
                                    <h2>
                                          <strong>Data</strong> <?php echo $modul ?> Per Produk
                                          <small>Kumpulan <?php echo $modul ?></small>
                                    </h2>
                                    <ul class="header-dropdown">
                                          <li class="remove">
                                                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                                          </li>
                                    </ul>
                              </div>
                              <div class="body">
                                    <div class="demo-masked-input">
                                          <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                                          <?php echo form_open('admin_gulderose/laporan/export_produk') ?>
                                          <div class="row clearfix">
                                                <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                                                      <label for="judul_produk">Nama Produk</label>
                                                </div>

                                                <div class="col-lg-10 col-md-10 col-sm-8">
                                                      <div class="input-group">
                                                            <input type="text" id='judul_produk' name='judul_produk' class="form-control" placeholder="Buket Bunga Gulderose">
                                                      </div>
                                                </div>
                                          </div>

                                          <div class="row clearfix">
                                                <div class="col-sm-8 offset-sm-2">
                                                      <button type='submit' name='submit' class="btn btn-info btn-round">DOWNLOAD</button>
                                                      <button type="reset" type='reset' name='reset' class="btn btn-raised btn-info btn-round waves-effect">RESET</button>
                                                </div>
                                          </div>
                                          <?php echo form_close() ?>
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
            <div class="row clearfix">
                  <div class="col-lg-6">
                        <div class="card">
                              <div class="header">
                                    <h2>
                                          <strong>Data</strong> <?php echo $modul ?> Keseluruhan
                                          <small>Kumpulan <?php echo $modul ?></small>
                                    </h2>
                                    <ul class="header-dropdown">
                                          <li class="remove">
                                                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                                          </li>
                                    </ul> <br>
                                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                                    <?php echo form_open('admin_gulderose/laporan/export_all') ?>
                                    <button type='submit' name='submit' class="btn btn-info btn-round">DOWNLOAD</button>
                                    <?php echo form_close() ?>
                              </div>
                        </div>
                  </div>
                  <div class="col-lg-6">
                        <div class="card">
                              <div class="header">
                                    <h2>
                                          <strong>Data</strong> <?php echo $modul ?> Keseluruhan (Sudah Dikirim)
                                          <small>Kumpulan <?php echo $modul ?></small>
                                    </h2>
                                    <ul class="header-dropdown">
                                          <li class="remove">
                                                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                                          </li>
                                    </ul> <br>
                                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                                    <?php echo form_open('admin_gulderose/laporan/export_dikirim') ?>
                                    <button type='submit' name='submit' class="btn btn-info btn-round">DOWNLOAD</button>
                                    <?php echo form_close() ?>
                              </div>
                        </div>
                  </div>
            </div>
      </div>
</section>
<!-- Javascript -->
<?php $this->load->view('back/js-laporan'); ?>
<script type="text/javascript">
      $(function() {
            $('#tgl_awal')({
                  format: 'yyyy-mm-dd'
            }),
            $('#tgl_akhir')({
                  format: 'yyyy-mm-dd'
            })
      });
</script>
</body>

</html>