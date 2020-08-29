<?php $this->load->view('front/meta-mix') ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-product-detail.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-res-product-detail.css">

<!-- slick -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>slick/slick.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>slick/slick-theme.css">

</head>

<body>
      <?php $this->load->view('front/navbar-all') ?>
      <div class="container">
            <div class="menu-breadcrumb">
                  <ul class="breadcrumb">
                        <li><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li><a href="<?php echo base_url('product/all-products'); ?>">Product</a></li>
                        <li><a href="#"><?php echo $product_detail->judul_produk; ?></a></li>
                  </ul>
            </div>
      </div>
      <div class="product-detail">
            <div class="container">
                  <div class="row">
                        <div class="slider-for">
                              <div class="product-content">
                                    <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12 img-content">
                                          <?php
                                          // jika foto kosong
                                          if (empty($product_detail->foto)) {
                                                echo "<img class='img-thumbnail' src='" . base_url() . "assets/images/no_image_thumb.png' width='400' height='400'>";

                                                // jika fotonya ada
                                          } else {
                                                echo "<a href='" . base_url() . "assets/images/produk/" . $product_detail->foto . $product_detail->foto_type . "'>
                                                      <img data-action='zoom' class='img-thumbnail' src='" . base_url() . "assets/images/produk/" . $product_detail->foto . '_thumb' . $product_detail->foto_type . "' title='$product_detail->judul_produk' alt='$product_detail->judul_produk' width='400' height='400'>
                                                      </a>";
                                          }
                                          ?>
                                    </div>
                                    <div class="col-lg-7 col-md-6 col-sm-12 col-xs-12 detail">
                                          <h1><?php echo $product_detail->judul_produk; ?></h1>
                                          <?php echo $product_detail->deskripsi; ?>
                                          <p>Category :
                                                <a href="<?php echo base_url('product-category/') . $product_detail->slug_kat ?>">
                                                      <?php echo $product_detail->judul_kategori ?>
                                                </a> /
                                                <a href="<?php echo base_url('product-category/') . $product_detail->slug_kat . "/" . $product_detail->slug_subkat ?>">
                                                      <?php echo $product_detail->judul_subkategori ?>
                                                </a>
                                          </p>
                                          <div style="color:grey">
                                                Weight &nbsp;: <?php echo $product_detail->berat . ' gram' . ' ( ' . ($product_detail->berat / 1000) . ' kg' . ' )' ?>
                                          </div>
                                          <p>Stock : <font style='font-size:15px'><span class='badge badge-pill badge-success'><?php if ($product_detail->stok == "tersedia") { echo "Available";} ?></span></font>
                                          </p>

                                          <?php if ($product_detail->diskon == '0') { ?>
                                                <div><b>Price : </b></div>
                                                <div class="prince"><?php echo 'Rp. ' . number_format($product_detail->harga_diskon, 2, ',', '.') ?></div>
                                          <?php } else { ?>
                                                <div style="color:grey">Price : <s class="strike">
                                                            <?php echo 'Rp. ' . number_format($product_detail->harga_normal, 2, ',', '.') ?></s> <span class="badge badge-pill badge-info"><?php echo $product_detail->diskon . '% OFF'; ?></span>
                                                </div>
                                                <div>After Discount <b style="color:blue"><?php echo $product_detail->diskon . '%'; ?></b>: </div>
                                                <div class="prince"><?php echo 'Rp. ' . number_format($product_detail->harga_diskon, 2, ',', '.') ?></div>
                                          <?php } ?>
                                          <div style="color:grey">
                                                Keywords &nbsp;: <?php echo $product_detail->keywords ?>
                                          </div>
                                          <figure class="fi-option">
                                                <p class="option">Option</p>
                                          </figure>
                                          <div class="size col-lg-12 col-md-6 col-sm-6 col-xs-12">
                                                <span class="lb-size">
                                                      Size : <?php echo ucwords($product_detail->ukuran) ?><?php //if ($product_detail->ukuran == 's' && $product_detail->judul_kategori == 'Bouquet') {
                                                                                                            //       echo ucwords($product_detail->ukuran) . ' ( Dimensi : ± 37 x 20 cm ) ';
                                                                                                            // } elseif ($product_detail->ukuran == 'm' && $product_detail->judul_kategori == 'Bouquet') {
                                                                                                            //       echo ucwords($product_detail->ukuran) . ' ( Dimensi : ± 45 x 25-28 cm ) ';
                                                                                                            // } elseif ($product_detail->ukuran == 'big' && $product_detail->judul_kategori == 'Bouquet') {
                                                                                                            //       echo ucwords($product_detail->ukuran) . ' ( Dimensi : ± 52 x 30-35 cm ) ';
                                                                                                            // } elseif ($product_detail->ukuran == 's' && $product_detail->judul_kategori == 'Wall Decor') {
                                                                                                            //       echo ucwords($product_detail->ukuran) . ' ( Dimensi : ± 21 x 10 cm ) ';
                                                                                                            // } elseif ($product_detail->ukuran == 'm' && $product_detail->judul_kategori == 'Wall Decor') {
                                                                                                            //       echo ucwords($product_detail->ukuran) . ' ( Dimensi : ± 28 x 15 cm ) ';
                                                                                                            // } elseif ($product_detail->ukuran == 'big' && $product_detail->judul_kategori == 'Wall Decor') {
                                                                                                            //       echo ucwords($product_detail->ukuran) . ' ( Dimensi : ± 36 x 23 cm ) ';
                                                                                                            // } elseif ($product_detail->ukuran == 's' && $product_detail->judul_kategori == 'Paper Flower Backdrop') {
                                                                                                            //       echo ucwords($product_detail->ukuran) . ' ( Dimensi : ± 60 x 40 cm ) ';
                                                                                                            // } elseif ($product_detail->ukuran == 'm' && $product_detail->judul_kategori == 'Paper Flower Backdrop') {
                                                                                                            //       echo ucwords($product_detail->ukuran) . ' ( Dimensi : ± 80 x 60 cm ) ';
                                                                                                            // } elseif ($product_detail->ukuran == 'big' && $product_detail->judul_kategori == 'Paper Flower Backdrop') {
                                                                                                            //       echo ucwords($product_detail->ukuran) . ' ( Dimensi : ± 110 x 80 cm ) ';
                                                                                                            // } elseif ($product_detail->ukuran == 's' && $product_detail->judul_kategori == 'Flower Vase') {
                                                                                                            //       echo ucwords($product_detail->ukuran) . ' ( Dimensi : ± 45 x 30 cm ) ';
                                                                                                            // } elseif ($product_detail->ukuran == 'm' && $product_detail->judul_kategori == 'Flower Vase') {
                                                                                                            //       echo ucwords($product_detail->ukuran) . ' ( Dimensi : ± 45 x 30 cm ) ';
                                                                                                            // } elseif ($product_detail->ukuran == 'big' && $product_detail->judul_kategori == 'Flower Vase') {
                                                                                                            //       echo ucwords($product_detail->ukuran) . ' ( Dimensi : ± 45 x 30 cm ) ';
                                                                                                            // } elseif ($product_detail->ukuran == 's' && $product_detail->judul_kategori == 'Flower Box') {
                                                                                                            //       echo ucwords($product_detail->ukuran) . ' ( Dimensi : ± 45 x 30 cm ) ';
                                                                                                            // } elseif ($product_detail->ukuran == 'm' && $product_detail->judul_kategori == 'Flower Box') {
                                                                                                            //       echo ucwords($product_detail->ukuran) . ' ( Dimensi : ± 45 x 30 cm ) ';
                                                                                                            // } elseif ($product_detail->ukuran == 'big' && $product_detail->judul_kategori == 'Flower Box') {
                                                                                                            //       echo ucwords($product_detail->ukuran) . ' ( Dimensi : ± 45 x 30 cm ) ';
                                                                                                            // } elseif ($product_detail->ukuran == 's' && $product_detail->judul_kategori == 'Graduation Gift Box') {
                                                                                                            //       echo ucwords($product_detail->ukuran) . ' ( Dimensi : ± 45 x 30 cm ) ';
                                                                                                            // } elseif ($product_detail->ukuran == 'm' && $product_detail->judul_kategori == 'Graduation Gift Box') {
                                                                                                            //       echo ucwords($product_detail->ukuran) . ' ( Dimensi : ± 45 x 30 cm ) ';
                                                                                                            // } elseif ($product_detail->ukuran == 'big' && $product_detail->judul_kategori == 'Graduation Gift Box') {
                                                                                                            //       echo ucwords($product_detail->ukuran) . ' ( Dimensi : ± 45 x 30 cm ) ';
                                                                                                            // } else {
                                                                                                            //       echo 'Belum Tersedia kategori ukuran (kategorinya belum ada ukurannya)';
                                                                                                            // }
                                                                                                            ?>
                                                </span>
                                          </div>
                                          <br>
                                          <!-- <div class="size col-lg-12 col-md-6 col-sm-6 col-xs-12">
                                                <div class="Quality">
                                                      <div class="input-group input-number-group">
                                                            <span class="text-qua">Quanty:</span>
                                                            <div class="input-group-button">
                                                                  <span class="input-number-decrement">-</span>
                                                            </div>
                                                            <input class="input-number" type="number" name='qty' min="0" max="1000" value="01">
                                                            <div class="input-group-button">
                                                                  <span class="input-number-increment">+</span>
                                                            </div>
                                                      </div>

                                                </div>
                                          </div> -->
                                          <br><br>
                                          <div class="size col-lg-12 col-md-6 col-sm-6 col-xs-12">
                                                <div class="add-cart">
                                                      <?php if (isset($_SESSION['identity']) && $_SESSION['id_group'] == '3') { ?>
                                                            <a href="<?php echo base_url('cart/buy/') . $product_detail->id_produk; ?>" class="btn btn-danger">ADD TO CART</a>
                                                      <?php } else { ?>
                                                            <a href="<?php echo base_url('cart'); ?>" class="btn btn-danger">ADD TO CART</a>
                                                      <?php } ?>
                                                </div> <br><br>
                                          </div>

                                    </div>
                              </div>
                              <!-- ------ end content 1----- -->
                        </div>
                  </div>
            </div>
      </div>

      <?php $this->load->view('front/footer-all') ?>
      <?php $this->load->view('front/js-mix') ?>
      <!-- js file -->
      <script src="<?php echo base_url('assets/template/frontend/'); ?>zooming/build/zooming.min.js"></script>
      <script src="<?php echo base_url('assets/template/frontend/'); ?>js/function-flower.js"></script>
      <script src="<?php echo base_url('assets/template/frontend/'); ?>js/function-input-number.js"></script>

      <script src="<?php echo base_url('assets/template/frontend/'); ?>js/function-select-custom.js"></script>
      <script src="<?php echo base_url('assets/template/frontend/'); ?>js/function-back-top.js"></script>
      <script src="<?php echo base_url('assets/template/frontend/'); ?>js/function-sidebar.js"></script>
      <script src="<?php echo base_url('assets/template/frontend/'); ?>js/funtion-header-v3.js"></script>
      <script src="<?php echo base_url('assets/template/frontend/'); ?>js/function-search-v2.js"></script>


</body>

</html>