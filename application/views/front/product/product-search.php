<?php $this->load->view('front/meta-mix') ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-flower.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-res-flower.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-shop.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-res-shop.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/frontend/'); ?>css/style-404.css">


</head>

<body>
      <?php $this->load->view('front/navbar-all') ?>
      <div class="container banner">
            <figure id="banner-figure"><a href="#"><img src="<?php echo base_url('assets/template/frontend/') ?>img/gul6.jpg" class="img-responsive" alt="img-holiwood"></a></figure>
            <div class="text-banner">
                  <h1>Product<br>Collection</h1>
                  <p>SALE UP TO 10% OFF</p>
                  <a href="<?php echo base_url('product/all-products'); ?>">Shop now</a>
            </div>
      </div>
      <div class="container content">
            <div class="menu-breadcrumb">
                  <ul class="breadcrumb">
                        <li><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li><a href="<?php echo base_url('product/all-products'); ?>">Product</a></li>
                  </ul>
            </div>
            <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="col-lg-8 col-md-6 col-sm-6 col-xs-6 show-side">
                              <button id="btn-list"><i class="fas fa-list"></i></button>
                              <button id="btn-grid"><i class="fas fa-th"></i></button>
                        </div>
                        <h4 align='left'>Search Results : </h4>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 content-flower">

                        <?php if ($hasil_pencarian == NULL) { ?><br><br>
                              <div class="page-404">
                                    <!-- End images -->
                                    <div class="text center">
                                          <h3>PRODUCT NOT FOUND</h3>
                                          <p>Please try one of the following pages <a href="<?php echo base_url(); ?>" title="link">home page <i class="fa fa-angle-double-right"></i></a></p>
                                    </div> <?php } else { ?>
                                    <?php foreach ($hasil_pencarian as $hasil_pencarian) : ?>
                                          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 product-flower">
                                                <div class="product-image-flower">
                                                      <figure class="sale">
                                                            <a href="<?php echo base_url("product/$hasil_pencarian->slug_produk "); ?>">
                                                                  <?php
                                                                  if (empty($hasil_pencarian->foto)) {
                                                                        echo "<img class='img-responsive' src='" . base_url() . "assets/images/no_image_thumb.png'>";
                                                                  } else {
                                                                        echo " <img class='img-responsive' src='" . base_url() . "assets/images/produk/" . $hasil_pencarian->foto . '_thumb' . $hasil_pencarian->foto_type . "'> ";
                                                                  }
                                                                  ?>
                                                            </a>
                                                      </figure>
                                                      <div class="product-icon-flower">
                                                            <a href="<?php echo base_url("product/$hasil_pencarian->slug_produk"); ?>"><i class="far fa-eye"></i></a>
                                                            <?php if (isset($_SESSION['identity']) && $_SESSION['id_group'] == '3') { ?>
                                                                  <a href="<?php echo base_url('cart/buy/') . $hasil_pencarian->id_produk; ?>"><i class="fas fa-shopping-basket"></i></a>
                                                            <?php } else { ?>
                                                                  <a href="<?php echo base_url('cart') ?>"> <i class="fas fa-shopping-basket"></i>
                                                                  <?php } ?>
                                                      </div>
                                                </div>
                                                <div class="product-title-flower">
                                                      <h5><a href="<?php echo base_url("product/$hasil_pencarian->slug_produk "); ?>"><?php echo $hasil_pencarian->judul_produk; ?></a></h5>
                                                      <?php if ($hasil_pencarian->diskon == '0') { ?>
                                                            <div class="prince">
                                                                  <?php echo 'Rp. ' . number_format($hasil_pencarian->harga_normal, 2, ',', '.') ?>
                                                            </div>
                                                      <?php } else { ?>
                                                            <div class="prince">
                                                                  <s class="strike"><?php echo 'Rp. ' . number_format($hasil_pencarian->harga_normal, 2, ',', '.') ?></s> <span class="badge badge-pill badge-info"> <?php echo $hasil_pencarian->diskon . '% OFF'; ?></span>
                                                            </div>
                                                            <div>After Discount <b style="color:blue"><?php echo $hasil_pencarian->diskon . '%'; ?></b>: </div>
                                                            <div class="prince"><?php echo 'Rp. ' . number_format($hasil_pencarian->harga_diskon, 2, ',', '.') ?></div>
                                                      <?php } ?>
                                                </div>
                                          </div>

                                    <?php endforeach; ?>
                              <?php } ?>
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