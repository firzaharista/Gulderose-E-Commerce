<?php $this->load->view('front/meta-mix') ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-flower.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-res-flower.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-shop.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-res-shop.css">


</head>

<body>
      <?php $this->load->view('front/navbar-all') ?>
      <div class="container banner">
            <figure id="banner-figure"><a href="#"><img src="<?php echo base_url('assets/template/frontend/') ?>img/gul6.jpg" class="img-responsive" alt="img-holiwood"></a></figure>
            <div class="text-banner">
                  <h1>Products<br>Collection</h1>
                  <p>SALE UP TO 10% OFF</p>
                  <a href="<?php echo base_url('product/all-products'); ?>">Shop now</a>
            </div>
      </div>
      <div class="container content">
            <div class="menu-breadcrumb">
                  <ul class="breadcrumb">
                        <li><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li><a href="<?php echo base_url('product/all-products'); ?>">Product</a></li>
                        <li><a href="<?php echo base_url('product/all-products'); ?>">All Products</a></li>
                  </ul>
            </div>
            <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="col-lg-8 col-md-6 col-sm-6 col-xs-6 show-side">
                              <button class="sp1 hidden-sm hidden-xs">Show Sidebar</button>
                              <button class="btn-hide hidden-sm hidden-xs">Hide Sidebar</button>
                              <button id="btn-list"><i class="fas fa-list"></i></button>
                              <button id="btn-grid"><i class="fas fa-th"></i></button>

                        </div>
                  </div>

                  <?php $this->load->view('front/sidebar'); ?>

                  <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 content-flower">
                        <?php foreach ($product_data as $product) : ?>
                              <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 product-flower">
                                    <div class="product-image-flower">
                                          <figure class="sale">
                                                <a href="<?php echo base_url("product/$product->slug_produk "); ?>">
                                                      <?php
                                                      if (empty($product->foto)) {
                                                            echo "<img class='img-responsive' src='" . base_url() . "assets/images/no_image_thumb.png'>";
                                                      } else {
                                                            echo " <img class='img-responsive' src='" . base_url() . "assets/images/produk/" . $product->foto . '_thumb' . $product->foto_type . "'> ";
                                                      }
                                                      ?>
                                                </a>
                                          </figure>
                                          <div class="product-icon-flower">
                                                <a href="<?php echo base_url("product/$product->slug_produk"); ?>"><i class="far fa-eye"></i></a>
                                                <?php if (isset($_SESSION['identity']) && $_SESSION['id_group'] == '3') { ?>
                                                      <a href="<?php echo base_url('cart/buy/') . $product->id_produk; ?>"><i class="fas fa-shopping-basket"></i></a>
                                                <?php } else { ?>
                                                      <a href="<?php echo base_url('cart') ?>"> <i class="fas fa-shopping-basket"></i>
                                                      <?php } ?>
                                          </div>
                                    </div>
                                    <div class="product-title-flower">
                                          <h5><a href="<?php echo base_url("product/$product->slug_produk "); ?>"><?php echo $product->judul_produk; ?></a></h5>
                                          <?php if ($product->diskon == '0') { ?>
                                                <div class="prince">
                                                      <?php echo 'Rp. ' . number_format($product->harga_normal, 2, ',', '.') ?>
                                                </div>
                                          <?php } else { ?>
                                                <div class="prince">
                                                      <s class="strike"><?php echo 'Rp. ' . number_format($product->harga_normal, 2, ',', '.') ?></s> <span class="badge badge-pill badge-info"> <?php echo $product->diskon . '% OFF'; ?></span>
                                                </div>
                                                <div>After Discount <b style="color:blue"><?php echo $product->diskon . '%'; ?></b>: </div>
                                                <div class="prince"><?php echo 'Rp. ' . number_format($product->harga_diskon, 2, ',', '.') ?></div>
                                          <?php } ?>
                                    </div>
                              </div>
                        <?php endforeach; ?>
                        <!--  -->
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                              <?php echo $this->pagination->create_links() ?>
                        </div>
                  </div>

            </div>
      </div>

      <?php $this->load->view('front/footer-all') ?>
      <?php $this->load->view('front/js-mix') ?>
      <!-- jquery ui -->
      <script src="<?php echo base_url('assets/template/frontend/'); ?>js/jquery-1.10.2.710.js"></script>
      <script src="<?php echo base_url('assets/template/frontend/'); ?>js/jquery-ui_c2.js"></script>

      <!-- js file -->
      <script src="<?php echo base_url('assets/template/frontend/'); ?>js/function-flower.js"></script>
      <script src="<?php echo base_url('assets/template/frontend/'); ?>js/function-show-sidebar.js"></script>

      <script src="<?php echo base_url('assets/template/frontend/'); ?>js/function-shop.js"></script>
      <script src="<?php echo base_url('assets/template/frontend/'); ?>js/function-range.js"></script>
      <script src="<?php echo base_url('assets/template/frontend/'); ?>js/function-select-custom.js"></script>
      <script src="<?php echo base_url('assets/template/frontend/'); ?>js/function-back-top.js"></script>
      <script src="<?php echo base_url('assets/template/frontend/'); ?>js/function-sidebar.js"></script>
      <script src="<?php echo base_url('assets/template/frontend/'); ?>js/funtion-header-v3.js"></script>
      <script src="<?php echo base_url('assets/template/frontend/'); ?>js/function-search-v2.js"></script>


</body>

</html>