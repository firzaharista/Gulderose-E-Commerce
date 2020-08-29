<section class="content ecommerce-page">
      <div class="block-header">
            <div class="row">
                  <div class="col-lg-4 col-md-4 col-sm-12">
                        <h2>Ecommerce Dashboard
                              <small>Welcome to Gulderose Bunga Flanel</small>
                        </h2>
                  </div>
                  <div class="col-lg-8 col-md-8 col-sm-12">
                        <button class="btn btn-white btn-icon btn-round hidden-sm-down float-right m-l-10" type="button">
                              <i class="zmdi zmdi-plus"></i>
                        </button>
                        <ul class="breadcrumb float-md-right">
                              <li class="breadcrumb-item"><a href="<?php echo base_url('admin_gulderose/dashboard'); ?>"><i class="zmdi zmdi-home"></i> Home</a></li>
                              <li class="breadcrumb-item"><a href="<?php echo base_url('admin_gulderose/produkrekomendasi'); ?>"><?php echo $modul ?></a></li>
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
                                          <a href="<?php echo base_url('admin_gulderose/produkrekomendasi/create') ?>"><button class="btn btn-info btn-round">Tambah</button></a>
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
                  <?php foreach ($produk_rekomendasi as $p_rekomen) : ?>
                        <div class="col-lg-3 col-md-4 col-sm-12">
                              <div class="card product_item">
                                    <div class="body">
                                          <div class="cp_img">
                                                <img src="<?php echo base_url('assets/images/produk/' . $p_rekomen->foto . '_thumb'. $p_rekomen->foto_type) ?>" alt="Product" class="img-fluid" />
                                                <div class="hover">
                                                      <a href="<?php echo base_url('admin_gulderose/produkrekomendasi/update/' . $p_rekomen->id_produkrekomendasi) ?>" class="btn btn-primary waves-effect"><i class="zmdi zmdi-edit"></i></a>
                                                      <a href="<?php echo base_url('admin_gulderose/produkrekomendasi/delete/' . $p_rekomen->id_produkrekomendasi) ?>" class="btn btn-primary waves-effect"><i class="zmdi zmdi-delete"></i></a>
                                                </div>
                                          </div>
                                          <div class="product_details">
                                                <h5><a href="ec-product-detail.html"><?php echo character_limiter($p_rekomen->judul_produk, 32) ?></a></h5>
                                                <ul class="product_price list-unstyled">
                                                      Normal :<li class="old_price"><?php echo 'Rp. ' . number_format($p_rekomen->harga_normal, 2, ',', '.') ?></li> <br>
                                                      Setelah Diskon <?php echo $p_rekomen->diskon . '%' ?><li class="text-info"><b> <?php echo 'Rp. ' . number_format($p_rekomen->harga_diskon, 2, ',', '.') ?></b></li>
                                                </ul>
                                          </div>
                                    </div>
                              </div>
                        </div>
                  <?php endforeach; ?>
            </div>
      </div>

</section>