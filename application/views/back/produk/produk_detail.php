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
                              <li class="breadcrumb-item"><a href="<?php echo base_url('admin_gulderose/produk'); ?>"><?php echo $modul ?></a></li>
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
                                          <strong>Detail</strong> <?php echo $modul ?>
                                          <small>Detail data <?php echo $modul ?></small>
                                    </h2>
                                    <ul class="header-dropdown">
                                          <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                      <li><a href="<?php echo base_url('admin_gulderose/produk') ?>">Data <?php echo $modul ?></a></li>
                                                </ul>
                                          </li>
                                          <li class="remove">
                                                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                                          </li>
                                    </ul>
                              </div>
                              <div class="body">
                                    <div class="row">
                                          <div class="preview col-lg-4 col-md-12">
                                                <div class="preview-pic tab-content">
                                                      <div class="tab-pane active" id="product_1"><img src="<?php echo base_url('assets/images/produk/' . $produk_detail->foto . '_thumb' . $produk_detail->foto_type) ?>" class="img-fluid" /></div>
                                                </div>
                                          </div>
                                          <div class="details col-lg-8 col-md-12">
                                                <h3 class="product-title m-b-0"><?php echo $produk_detail->judul_produk; ?></h3>
                                                <p class="product-description m-b-0">Deskripsi : <?php echo $produk_detail->deskripsi; ?></p>
                                                Harga Normal : <li class="text-info"><b><?php echo 'Rp. ' . number_format($produk_detail->harga_normal, 2, ',', '.') ?></b></li>
                                                Setelah Diskon : <?php echo $produk_detail->diskon . '%' ?>
                                                <li class="text-info"><b><?php echo 'Rp. ' . number_format($produk_detail->harga_diskon, 2, ',', '.') ?></b></li>
                                                <br>
                                                <p class="colors m-b-0">Stok :
                                                      <span class="size"><b><?php if ($produk_detail->stok == 'kosong') { ?>
                                                                        <span class="badge badge-danger"><?php echo $produk_detail->stok; ?></span>
                                                                  <?php } else { ?>
                                                                        <span class="badge badge-success"><?php echo $produk_detail->stok; ?></span>
                                                                  <?php } ?></b></span>
                                                </p>
                                                <p class="colors m-b-0">Berat :
                                                      <span class="size"><?php echo $produk_detail->berat . ' gram'; ?><?php echo ' ( ' . ($produk_detail->berat / 1000) . ' kg' . ' )'; ?></span>
                                                </p>
                                                <p class="colors m-b-0">Ukuran :
                                                      <span class="size"> <?php echo strtoupper($produk_detail->ukuran) ?>
                                                            <?php //if ($produk_detail->ukuran == 's' && $produk_detail->judul_kategori == 'Bouquet') {
                                                            // echo ucwords($produk_detail->ukuran) . ' ( Dimensi : ± 37 x 20 cm ) ';
                                                            // } elseif ($produk_detail->ukuran == 'm' && $produk_detail->judul_kategori == 'Bouquet') {
                                                            //       echo ucwords($produk_detail->ukuran) . ' ( Dimensi : ± 45 x 25-28 cm ) ';
                                                            // } elseif ($produk_detail->ukuran == 'big' && $produk_detail->judul_kategori == 'Bouquet') {
                                                            //       echo ucwords($produk_detail->ukuran) . ' ( Dimensi : ± 52 x 30-35 cm ) ';
                                                            // } elseif ($produk_detail->ukuran == 's' && $produk_detail->judul_kategori == 'Wall Decor') {
                                                            //       echo ucwords($produk_detail->ukuran) . ' ( Dimensi : ± 21 x 10 cm ) atau 10 x 21 ';
                                                            // } elseif ($produk_detail->ukuran == 'm' && $produk_detail->judul_kategori == 'Wall Decor') {
                                                            //       echo ucwords($produk_detail->ukuran) . ' ( Dimensi : ± 28 x 15 cm ) / 15 x 28';
                                                            // } elseif ($produk_detail->ukuran == 'big' && $produk_detail->judul_kategori == 'Wall Decor') {
                                                            //       echo ucwords($produk_detail->ukuran) . ' ( Dimensi : ± 36 x 23 cm ) ';
                                                            // } elseif ($produk_detail->ukuran == 's' && $produk_detail->judul_kategori == 'Flower Vase') {
                                                            //       echo ucwords($produk_detail->ukuran) . ' ( Dimensi : ± 45 x 30 cm ) ';
                                                            // } elseif ($produk_detail->ukuran == 'm' && $produk_detail->judul_kategori == 'Flower Vase') {
                                                            //       echo ucwords($produk_detail->ukuran) . ' ( Dimensi : ± 45 x 30 cm ) ';
                                                            // } elseif ($produk_detail->ukuran == 'big' && $produk_detail->judul_kategori == 'Flower Vase') {
                                                            //       echo ucwords($produk_detail->ukuran) . ' ( Dimensi : ± 45 x 30 cm ) ';
                                                            // } elseif ($produk_detail->ukuran == 's' && $produk_detail->judul_kategori == 'Flower Box') {
                                                            // echo ucwords($produk_detail->ukuran) . ' ( Dimensi : ± 15 x 15 cm ) ';
                                                            // } elseif ($produk_detail->ukuran == 'm' && $produk_detail->judul_kategori == 'Flower Box') {
                                                            // echo ucwords($produk_detail->ukuran) . ' ( Dimensi : ± 25 x 25 cm ) ';
                                                            // } elseif ($produk_detail->ukuran == 'big' && $produk_detail->judul_kategori == 'Flower Box') {
                                                            // echo ucwords($produk_detail->ukuran) . ' ( Dimensi : ± 35 x 35 cm ) ';
                                                            // } elseif ($produk_detail->ukuran == 's' && $produk_detail->judul_kategori == 'Paper Flower Backdrop') {
                                                            // echo ucwords($produk_detail->ukuran) . ' ( Dimensi : ± 60 x 40 cm ) ';
                                                            // } elseif ($produk_detail->ukuran == 'm' && $produk_detail->judul_kategori == 'Paper Flower Backdrop') {
                                                            // echo ucwords($produk_detail->ukuran) . ' ( Dimensi : ± 80 x 60 cm ) ';
                                                            // } elseif ($produk_detail->ukuran == 'big' && $produk_detail->judul_kategori == 'Paper Flower Backdrop') {
                                                            // echo ucwords($produk_detail->ukuran) . ' ( Dimensi : ± 110 x 80 cm ) ';
                                                            // } else {
                                                            // echo 'Belum Tersedia kategori ukuran (kategorinya belum ada ukurannya)';
                                                            // }
                                                            ?>
                                                      </span>
                                                </p>

                                                <br>
                                                <p class="colors m-b-0">Kategori :
                                                      <span class="size"><?php echo $produk_detail->judul_kategori; ?></span>
                                                </p>
                                                <p class="colors m-b-1">Subkategori :
                                                      <span class="size"><?php echo $produk_detail->judul_subkategori; ?></span>
                                                </p>
                                                <p class="colors m-b-0">Keywords :
                                                      <span class="size"><?php echo $produk_detail->keywords; ?></span>
                                                </p>

                                                <?php
                                                if (is_array($lihat)) {
                                                      echo $lihat["namaLengkap"];
                                                } else {
                                                      echo "data berbentuk object maka gunakan ";
                                                }
                                                ?>
                                                <hr>
                                                <div class="action">
                                                      <a href="<?php echo base_url('admin_gulderose/produk') ?>"><button class="btn btn-primary btn-round waves-effect" type="button">Kembali</button></a>
                                                      <a href="<?php echo base_url('admin_gulderose/produk/update/' . $produk_detail->id_produk) ?>" class="btn btn-primary btn-round waves-effect"><i class="zmdi zmdi-edit"></i></a>
                                                      <a href="<?php echo base_url('admin_gulderose/produk/delete/' . $produk_detail->id_produk) ?>" class="btn btn-primary btn-round waves-effect"><i class="zmdi zmdi-delete"></i></a>
                                                </div>
                                          </div>
                                    </div>
                              </div>
                        </div>
                  </div>

            </div>

      </div>

</section>