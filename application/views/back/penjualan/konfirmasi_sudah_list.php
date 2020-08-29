<!-- Exportable Table -->
<section class="content">
      <div class="block-header">
            <div class="row">
                  <div class="col-lg-5 col-md-5 col-sm-12">
                        <h2>Ecommerce Dashboard
                              <small>Welcome to Gulderose Bunga Flanel</small>
                        </h2>
                  </div>
                  <div class="col-lg-7 col-md-7 col-sm-12">
                        <button class="btn btn-white btn-icon btn-round hidden-sm-down float-right m-l-10" type="button">
                              <i class="zmdi zmdi-plus"></i>
                        </button>
                        <ul class="breadcrumb float-md-right">
                              <li class="breadcrumb-item"><a href="<?php echo base_url('admin_gulderose/dashboard'); ?>"><i class="zmdi zmdi-home"></i> Home</a></li>
                              <li class="breadcrumb-item"><a href="<?php echo base_url('admin_gulderose/penjualan/konfirmasi'); ?>"><?php echo $modul_k ?></a></li>
                              <li class="breadcrumb-item active">Data <?php echo $modul_k ?></li>
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
                                          <strong>Data</strong> <?php echo $modul_k ?>
                                          <small>Kumpulan Data Sudah <?php echo $modul_k ?></small>
                                    </h2>
                                    <ul class="header-dropdown">
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
                                    <a href="<?php echo base_url('admin_gulderose/penjualan/belum-konfirmasi') ?>"><button class="btn btn-info btn-round">Data Belum Konfirmasi</button></a>
                                    <div class="table-responsive">
                                          <table class="table table-bordered table-striped table-hover dataTable js-basic-example">
                                                <thead>
                                                      <tr>
                                                            <th width='10' style="text-align: center">No.</th>
                                                            <th style="text-align: center">Invoice Order</th>
                                                            <th style="text-align: center">Oleh</th>
                                                            <th style="text-align: center">Status</th>
                                                            <th style="text-align: center">Aksi</th>
                                                      </tr>
                                                </thead>
                                                <tfoot>
                                                      <tr>
                                                            <th width='10' style="text-align: center">No.</th>
                                                            <th style="text-align: center">Invoice Order</th>
                                                            <th style="text-align: center">Oleh</th>
                                                            <th style="text-align: center">Status</th>
                                                            <th style="text-align: center">Aksi</th>
                                                      </tr>
                                                </tfoot>
                                                <tbody>
                                                      <?php $no = 1;
                                                      foreach ($get_sudah_konfir as $sudah) : ?>
                                                            <tr>
                                                                  <td style="text-align: center"><?php echo $no++ ?></td>
                                                                  <td style="text-align: center"><?php echo $sudah->id_trans ?></td>
                                                                  <td style="text-align: center"><?php echo $sudah->nama ?></td>
                                                                  <td style="text-align: center"><?php if ($sudah->status == '2') {
                                                                                                            echo "Confirmation Success";
                                                                                                      } ?></td>
                                                                  <td style="text-align: center">
                                                                        <?php
                                                                        echo anchor(site_url('admin_gulderose/penjualan/detail_konfirmasi/' . $sudah->id_trans), '<button type="button" title="Detail" class="btn btn-success btn-round">Detail</button>');
                                                                        echo ' ';
                                                                        echo anchor(site_url('admin_gulderose/penjualan/update_sudah_konfirmasi/' . $sudah->id_trans), '<button type="button" title="Konfirmasi" class="btn btn-round btn-info">Konfirmasi</button>');
                                                                        echo ' ';
                                                                        echo anchor(site_url('admin_gulderose/penjualan/update_konfirmasi_dibatalkan/' . $sudah->id_trans), '<button type="button" title="Batal" class="btn btn-round btn-danger">Batal</button>');
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