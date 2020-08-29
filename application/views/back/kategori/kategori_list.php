<!-- Exportable Table -->
<section class="content">
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
                              <li class="breadcrumb-item"><a href="<?php echo base_url('admin_gulderose/kategori'); ?>">Kategori</a></li>
                              <li class="breadcrumb-item active">Data Kategori</li>
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
                                          <a href="<?php echo base_url('admin_gulderose/kategori/create') ?>"><button class="btn btn-info btn-round">Tambah</button></a>
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
                                    <div class="table-responsive">
                                          <table class="table table-bordered table-striped table-hover dataTable js-basic-example">
                                                <thead>
                                                      <tr>
                                                            <th style="text-align: center">No.</th>
                                                            <th style="text-align: center">Judul Kategori</th>
                                                            <th style="text-align: center">Aksi</th>
                                                      </tr>
                                                </thead>
                                                <tfoot>
                                                      <tr>
                                                            <th style="text-align: center">No.</th>
                                                            <th style="text-align: center">Judul Kategori</th>
                                                            <th style="text-align: center">Aksi</th>
                                                      </tr>
                                                </tfoot>
                                                <tbody>
                                                      <?php
                                                      $start = 0;
                                                      foreach ($kat as $k) : ?>
                                                            <tr>
                                                                  <td style="text-align:center"><?php echo ++$start ?></td>
                                                                  <td style="text-align:center"><?php echo $k->judul_kategori ?></td>
                                                                  <!-- pake fungsi anchor -->
                                                                  <td style="text-align:center">
                                                                        <?php
                                                                        echo anchor(site_url('admin_gulderose/kategori/update/' . $k->id_kategori), '<button type="button" title="Edit" class="btn btn-icon btn-icon-mini btn-round btn-info"><i class="zmdi zmdi-edit"></i></button>');
                                                                        echo ' ';
                                                                        echo anchor(site_url('admin_gulderose/kategori/delete/' . $k->id_kategori), '<button type="button" title="Hapus" class="btn btn-icon btn-icon-mini btn-round btn-danger"><i class="zmdi zmdi-delete"></i></button>');
                                                                        ?>
                                                                  </td>
                                                            </tr>
                                                      <?php endforeach; ?>
                                                </tbody>
                                          </table>
                                    </div>
                              </div>

                        </div>
                  </div>

            </div>

</section>