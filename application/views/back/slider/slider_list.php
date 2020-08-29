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
                              <li class="breadcrumb-item"><a href="<?php echo base_url('admin_gulderose/slider'); ?>"><?php echo $modul ?></a></li>
                              <li class="breadcrumb-item active">Data <?php echo $modul ?></li>
                        </ul>
                  </div>
            </div>
      </div>
      <div class="container-fluid">
            <div class="row clearfix">
                  <div class="col-lg-12">
                        <div class="card">
                              <div class="header">
                                    <h2>
                                          <strong>Data</strong> <?php echo $modul ?>
                                          <small>Kumpulan <?php echo $modul ?></small>
                                    </h2>
                                    <ul class="header-dropdown">
                                          <a href="<?php echo base_url('admin_gulderose/slider/create') ?>"><button class="btn btn-info btn-round">Tambah</button></a>
                                          <li class="remove">
                                                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                                          </li>
                                    </ul>
                              </div>
                        </div>
                  </div>
            </div>
      </div>
      <div class="container-fluid">
            <?php echo validation_errors() ?>
            <?php if ($this->session->flashdata('message')) {
                  echo $this->session->flashdata('message');
            } ?>

            <div class="row clearfix">
                  <?php
                  foreach ($slider as $s) : ?>
                        <div class="col-lg-4 col-md-12">
                              <div class="card project_widget">
                                    <div class="pw_img">
                                          <img class="img-fluid" src="<?php echo base_url('assets/images/slider/' . $s->foto . $s->foto_type) ?>" alt=" About the image">
                                    </div>

                                    <div class="pw_content">
                                          <div align='right'>
                                                <a href="<?php echo base_url('admin_gulderose/slider/create') ?>"><button type="button" class="btn btn-icon btn-icon-mini btn-round btn-info">
                                                      <i class="zmdi zmdi-plus"></i>
                                                </button> </a>
                                                <a href="<?php echo base_url('admin_gulderose/slider/update/' . $s->id_slider) ?>"><button type="button" class="btn btn-icon btn-icon-mini btn-round btn-info">
                                                      <i class="zmdi zmdi-edit"></i>
                                                </button></a>
                                                <a href="<?php echo base_url('admin_gulderose/slider/delete/'. $s->id_slider) ?>"><button type="button" class="btn btn-icon btn-icon-mini btn-round btn-info">
                                                      <i class="zmdi zmdi-delete"></i>
                                                </button></a>
                                          </div>
                                          <div class="pw_header">
                                                <?php 
                                                      $tgl     = date("d-m-Y", strtotime($s->created)); 
                                                      $tgl_upd = date("d-m-Y", strtotime($s->modified));
                                                ?>
                                                <h6><?php echo $s->judul_slider ?></h6>
                                                
                                          </div>

                                          <div class="pw_meta">
                                                <span>Waktu</span>
                                                <small class="text-muted">Ditambahkan pada : <?php echo $tgl ?></small>
                                                <small class="text-info">Diupdate pada : <?php if ($s->modified != '') {
                                                      echo $tgl_upd;
                                                } else {
                                                      echo '-- Belum diupdate --';
                                                }
                                                ?></small>
                                          </div>
                                    </div>
                              </div>
                        </div>
                  <?php endforeach; ?>
            </div>

      </div>
</section>