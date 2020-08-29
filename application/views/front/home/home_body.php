<main>
      <div class="content-search">
            <div class="container container-100">
                  <i class="far fa-times-circle" id="close-search"></i>
                  <form action="<?php echo base_url('search') ?>" role="search" style="position: relative;" method="get">
                        <input type="text" class="form-control control-search" value="" autocomplete="off" placeholder="Enter Search ..." aria-label="SEARCH" name="product">
                        <button class="button_search" type="submit">search</button>
                  </form>
            </div>

      </div>
      <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                  <li data-target="#myCarousel" data-slide-to="1"></li>
                  <li data-target="#myCarousel" data-slide-to="2"></li>
                  <li data-target="#myCarousel" data-slide-to="3"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                  <div class="item active slide-1">
                        <img src="<?php echo base_url('assets/template/frontend/'); ?>img/gul6.jpg" class="img-responsive" alt="img-holiwood">
                        <div class="carousel-caption">
                              <h3>EXPLORE THE</h3>
                              <h1>New Product</h1>
                              <!-- <p>It is a long established fact that a reader will be distracted by the readable -->
                                    <!-- content of a page when looking at its layout</p> -->
                              <br>
                              <a href="<?php echo base_url('product/all-products') ?>">Shop now</a>
                        </div>

                  </div>
                  <?php foreach ($slider_data as $slider) : ?>
                        <div class="item slide-2">
                              <img src="<?php echo base_url('assets/images/slider/') . $slider->foto.$slider->foto_type; ?>" alt="<?php echo $slider->judul_slider ?>">
                              <div class="carousel-caption">
                                    <h3>A Ferfect</h3>
                                    <h1>Bouquet</h1>
                                    <div class="line"></div>
                                    <!-- <p>It is a long established fact that a reader will be distracted by the redable -->
                                          <!-- content of a page when looking at its latout</p> -->
                                    <a href="<?php echo base_url('product/all-products') ?>">Shop now</a>
                              </div>
                        </div>
                  <?php endforeach ?>
            </div>
      </div>

      <div class="container collection" id="showcase-2">
            <h1>New Product</h1>
            <h2>- All Category of Gulderose Bunga Flanel -</h2>
            <div class="gallery clearfix">
                  <figure>
                        <div class="row">
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 banner-collec">
                                    <img src="<?php echo base_url('assets/template/frontend/'); ?>img/product/1.jpg" class="img-responsive" alt="img-holiwood">
                                    <br><br><br><br><br><br><br><br><br><br><br>
                                    <h1></h1>
                                    <h3></h3>
                                    <a href="<?php echo base_url('product/all-products') ?>">Shop now</a>
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <?php foreach ($product_new as $product) : ?>
                                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 product-collection">
                                                <div class="product-image-collec">
                                                      <figure class="new">
                                                            <a href="<?php echo base_url("product/$product->slug_produk"); ?>"><img src="<?php echo base_url('assets/images/produk/') . $product->foto . '_thumb'. $product->foto_type; ?>" class="img-responsive" alt="img-holiwood"></a>
                                                      </figure>
                                                      <div class="product-icon-collec">
                                                            <a href="<?php echo base_url("product/$product->slug_produk"); ?>"><i class="far fa-eye"></i></a>
                                                            <?php if (isset($_SESSION['identity']) && $_SESSION['id_group'] == '3') { ?>
                                                                  <a href="<?php echo base_url('cart/buy/') . $product->id_produk; ?>"><i class="fas fa-shopping-basket"></i></a>
                                                            <?php } else { ?>
                                                                  <a href="<?php echo base_url('cart') ?>"> <i class="fas fa-shopping-basket"></i>
                                                                  <?php } ?>
                                                      </div>
                                                </div>
                                                <div class="product-title-collec">
                                                      <h5><a href="<?php echo base_url("product/$product->slug_produk"); ?>"> <?php echo $product->judul_produk; ?></a></h5>
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
                              </div>
                        </div>
                  </figure>
            </div>
      </div>
      <div class=" wedding" id="showcase-3">
            <h1>Bouquet</h1>
            <h2>- Bouquet of<span class="hidden-xs"> Gulderose Bunga Flanel</span> -</h2>
            <div class="gallery clearfix">
                  <figure>
                        <div class="container wedding-content">
                              <div class="row">
                                    <?php foreach ($product_bouquet as $bouquet) : ?>
                                          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 product-wedding">
                                                <div class="product-image-wedding">
                                                      <figure class="sale">
                                                            <a href="<?php echo base_url("product/$bouquet->slug_produk"); ?>"><img src="<?php echo base_url('assets/images/produk/') . $bouquet->foto . '_thumb'. $bouquet->foto_type; ?>" class="img-responsive" alt="img-holiwood"></a>
                                                      </figure>
                                                      <div class="product-icon-wedding">
                                                            <a href="<?php echo base_url("product/$bouquet->slug_produk"); ?>"><i class="far fa-eye"></i></a>
                                                            <?php if (isset($_SESSION['identity']) && $_SESSION['id_group'] == '3') { ?>
                                                                  <a href="<?php echo base_url('cart/buy/') . $bouquet->id_produk; ?>"><i class="fas fa-shopping-basket"></i></a>
                                                            <?php } else { ?>
                                                                  <a href="<?php echo base_url('cart') ?>"> <i class="fas fa-shopping-basket"></i>
                                                                  <?php } ?>
                                                      </div>
                                                </div>
                                                <div class="product-title-wedding">
                                                      <h5><a href="<?php echo base_url("product/$bouquet->slug_produk"); ?>"><?php echo $bouquet->judul_produk; ?></a></h5>
                                                      <?php if ($bouquet->diskon == '0') { ?>
                                                            <div class="prince">
                                                                  <?php echo 'Rp. ' . number_format($bouquet->harga_normal, 2, ',', '.') ?>
                                                            </div>
                                                      <?php } else { ?>
                                                            <div class="prince">
                                                                  <s class="strike"><?php echo 'Rp. ' . number_format($bouquet->harga_normal, 2, ',', '.') ?></s> <span class="badge badge-pill badge-info"> <?php echo $bouquet->diskon . '% OFF'; ?></span>
                                                            </div>
                                                            <div>After Discount <b style="color:blue"><?php echo $bouquet->diskon . '%'; ?></b>: </div>
                                                            <div class="prince"><?php echo 'Rp. ' . number_format($bouquet->harga_diskon, 2, ',', '.') ?></div>
                                                      <?php } ?>
                                                </div>
                                          </div>
                                    <?php endforeach; ?>
                              </div>

                        </div>

                  </figure>
            </div>
      </div>
      <div class=" wedding" id="showcase-3">
            <h1>Product Recomendation</h1>
            <h2>- Product Recomendation<span class="hidden-xs"> Gulderose Bunga Flanel</span> -</h2>
            <div class="gallery clearfix">
                  <figure>
                        <div class="container wedding-content">
                              <div class="row">
                                    <?php foreach ($product_recomend as $recomend) : ?>
                                          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 product-wedding">
                                                <div class="product-image-wedding">
                                                      <figure class="sale">
                                                            <a href="<?php echo base_url("product/$recomend->slug_produk"); ?>"><img src="<?php echo base_url('assets/images/produk/') . $recomend->foto . '_thumb'. $recomend->foto_type; ?>" class="img-responsive" alt="img-holiwood"></a>
                                                      </figure>
                                                      <div class="product-icon-wedding">
                                                            <a href="<?php echo base_url("product/$recomend->slug_produk"); ?>"><i class="far fa-eye"></i></a>
                                                            <?php if (isset($_SESSION['identity']) && $_SESSION['id_group'] == '3') { ?>
                                                                  <a href="<?php echo base_url('cart/buy/') . $recomend->id_produk; ?>"><i class="fas fa-shopping-basket"></i></a>
                                                            <?php } else { ?>
                                                                  <a href="<?php echo base_url('cart') ?>"> <i class="fas fa-shopping-basket"></i>
                                                                  <?php } ?>
                                                      </div>
                                                </div>
                                                <div class="product-title-wedding">
                                                      <h5><a href="<?php echo base_url("product/$recomend->slug_produk"); ?>"><?php echo $recomend->judul_produk; ?></a></h5>
                                                      <?php if ($recomend->diskon == '0') { ?>
                                                            <div class="prince">
                                                                  <?php echo 'Rp. ' . number_format($recomend->harga_normal, 2, ',', '.') ?>
                                                            </div>
                                                      <?php } else { ?>
                                                            <div class="prince">
                                                                  <s class="strike"><?php echo 'Rp. ' . number_format($recomend->harga_normal, 2, ',', '.') ?></s> <span class="badge badge-pill badge-info"><?php echo $product->diskon . '% OFF'; ?></span>
                                                            </div>
                                                            <div>After Discount <b style="color:blue"><?php echo $recomend->diskon . '%'; ?></b>: </div>
                                                            <div class="prince"><?php echo 'Rp. ' . number_format($recomend->harga_diskon, 2, ',', '.') ?></div>
                                                      <?php } ?>
                                                </div>
                                          </div>
                                    <?php endforeach; ?>
                              </div>

                        </div>

                  </figure>
            </div>
      </div>

</main>