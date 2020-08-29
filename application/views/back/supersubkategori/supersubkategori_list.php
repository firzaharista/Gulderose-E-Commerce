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
                              <li class="breadcrumb-item"><a href="<?php echo base_url('admin_gulderose/supersubkategori'); ?>"><?php echo $modul ?></a></li>
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
                                          <a href="<?php echo base_url('admin_gulderose/supersubkategori/create') ?>"><button class="btn btn-info btn-round">Tambah</button></a>
                                          <li class="remove">
                                                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                                          </li>
                                    </ul>
                              </div>

                              <div class="body">
                                    <div class="table-responsive">
                                          <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                                <thead>
                                                      <tr>
                                                            <th width='10'>No.</th>
                                                            <th>Judul <?php echo $modul ?></th>
                                                            <th>Aksi</th>
                                                      </tr>
                                                </thead>
                                                <tfoot>
                                                      <tr>
                                                            <th width='10'>No.</th>
                                                            <th>Judul <?php echo $modul ?></th>
                                                            <th>Aksi</th>
                                                      </tr>
                                                </tfoot>
                                                <tbody>

                                                      <tr>
                                                            <td>1</td>
                                                            <td>Buket Bunga</td>
                                                            <td>Edit Hapus</td>
                                                      </tr>
                                                      <tr>
                                                            <td>2</td>
                                                            <td>Wall Decor</td>
                                                            <td>Edit Hapus</td>

                                                      </tr>

                                                </tbody>
                                          </table>
                                    </div>
                              </div>

                        </div>
                  </div>

            </div>

</section>