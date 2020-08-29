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
                              <li class="breadcrumb-item"><a href="<?php echo base_url('admin_gulderose/banktujuan'); ?>"><?php echo $modul ?></a></li>
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
                                          <a href="<?php echo base_url('admin_gulderose/banktujuan/create') ?>"><button class="btn btn-info btn-round">Tambah</button></a>
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
                                                            <th style="text-align: center">Nama <?php echo $modul ?></th>
                                                            <th style="text-align: center"> No. Rekening</th>
                                                            <th style="text-align: center">Atas Nama</th>
                                                            <th style="text-align: center">Aksi</th>
                                                      </tr>
                                                </thead>
                                                <tfoot>
                                                      <tr>
                                                            <th style="text-align: center">No.</th>
                                                            <th style="text-align: center">Nama <?php echo $modul ?></th>
                                                            <th style="text-align: center"> No. Rekening</th>
                                                            <th style="text-align: center">Atas Nama</th>
                                                            <th style="text-align: center">Aksi</th>
                                                      </tr>
                                                </tfoot>
                                                <tbody>
                                                      <?php
                                                      $start = 0;
                                                      foreach ($bank_tujuan as $bank) : ?>
                                                            <tr>
                                                                  <td style="text-align:center"><?php echo ++$start ?></td>
                                                                  <td style="text-align:center"><?php echo $bank->nama_banktujuan ?></td>
                                                                  <td style="text-align:center"><?php echo $bank->no_rektujuan ?></td>
                                                                  <td style="text-align:center"><?php echo $bank->atas_namatujuan ?></td>
                                                                  <!-- pake fungsi anchor -->
                                                                  <td style="text-align:center">
                                                                        <?php
                                                                        echo anchor(site_url('admin_gulderose/banktujuan/update/' . $bank->id_banktujuan), '<button type="button" title="Edit" class="btn btn-icon btn-icon-mini btn-round btn-info"><i class="zmdi zmdi-edit"></i></button>');
                                                                        echo ' ';
                                                                        echo anchor(site_url('admin_gulderose/banktujuan/delete/' . $bank->id_banktujuan), '<button type="button" title="Hapus" class="btn btn-icon btn-icon-mini btn-round btn-danger"><i class="zmdi zmdi-delete"></i></button>');
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