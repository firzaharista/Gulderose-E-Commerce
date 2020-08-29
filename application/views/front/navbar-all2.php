<header class="container" id="header-v3">
      <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-1 col-xs-3 logo"><a href="#"><img src="<?php echo base_url('assets/template/frontend/') ?>img/logo/gulderose_watermark.png" width="90" alt="img-holiwood"></a></div>
            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 menu-mobile">
                  <div class=" collapse navbar-collapse" id="myNavbar">

                        <form class="hidden-lg hidden-md form-group form-search-mobile">
                              <input type="text" name="search" placeholder="Search here..." class="form-control">
                              <button type="submit"><img src="<?php echo base_url('assets/template/frontend/') ?>img/Search.png" alt="search" class="img-responsive"></button>
                        </form>
                        <ul class="nav navbar-nav menu-main">

                              <li class="li-home"><a href="<?php echo base_url(); ?>">Home</a>
                                    <figure id="wedding-1" class="hidden-sm hidden-xs"></figure>
                              </li>
                              <li class="shop-menu dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Product</a>
                                    <figure id="shop-1" class="hidden-sm hidden-xs"></figure>
                                    <div class="dropdown-menu">
                                          <div class="container container-menu">
                                                <ul class="row">
                                                      <li class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <ul>
                                                                  <?php
                                                                  $sql  = $this->db->query("SELECT * FROM kategori ORDER BY judul_kategori");
                                                                  $data = $sql->result();
                                                                  foreach ($data as $row) {
                                                                        $id_kat = $row->id_kategori;
                                                                        echo '<li class="col-lg-3 col-md-3 col-sm-12 col-xs-12 menu-home-lv2">
                                                                                    <ul>
                                                                                          <li><a href="' . base_url('product_category/read/') . $row->slug_kat . '">' . $row->judul_kategori . ' </a></li>';

                                                                                          $sql2   =  $this->db->query("SELECT * FROM subkategori WHERE id_kategori = '$id_kat' ORDER BY judul_subkategori "); // Memanggil subkategori/ middle kategori
                                                                                          $data2  = $sql2->result();
                                                                                          foreach ($data2 as $row2) {
                                                                                                $id_sub = $row2->id_subkategori;
                                                                                                echo '<li class="li-home"><i class="fas fa-long-arrow-alt-right hidden-sm hidden-md hidden-xs"></i>
                                                                                                            <a href="' . base_url('product_category/read/') . $row->slug_kat . '/' . $row2->slug_subkat . '">' . $row2->judul_subkategori . '</a>
                                                                                                      </li>';
                                                                                          }

                                                                                    echo '</ul>';
                                                                              echo '</li>';
                                                                        }
                                                                  ?>

                                                                  <li class="col-lg-3 col-md-3 col-sm-12 col-xs-12 menu-home-lv2">
                                                                        <ul>
                                                                              <li><a href="<?php echo base_url('product/allproducts') ?>">- ALL PRODUCTS -</a> </li>
                                                                        </ul>
                                                                  </li>
                                                            </ul>
                                                      </li>
                                                </ul>
                                          </div>
                                    </div>
                              </li>
                              <li class="contact-menu"><a href="<?php echo base_url('how-to-order'); ?>">How To Order</a>
                                    <figure id="contact-1" class="hidden-sm hidden-xs"></figure>
                              </li>
                              <li class="wedding-menu"><a href="<?php echo base_url('payment-confirmation'); ?>">Payment Confirmation</a>
                                    <figure id="wedding-1" class="hidden-sm hidden-xs"></figure>
                              </li>
                              <li class="hidden-lg hidden-md"><a href="<?php echo base_url('my-account'); ?>"><i class="far fa-user"></i> My Account</a></li>
                              <li>
                                    <figure id="btn-close-menu" class="hidden-lg hidden-md"><i class="far fa-times-circle"></i></figure>
                              </li>
                        </ul>
                  </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-10 col-xs-9">
                  <ul class="nav navbar-nav navbar-right icon-menu">


                        <li id="input-search" class="hidden-sm hidden-xs">
                              <a href="#"><img id="search-img" src="<?php echo base_url('assets/template/frontend/') ?>img/Search.png" alt="img-holiwood"></a>

                        </li>
                        <li class="icon-user hidden-sm hidden-xs"><a href="<?php echo base_url('my-account'); ?>"><i class="far fa-user"></i></a></li>
                        <li class="dropdown cart-menu">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?php echo base_url('assets/template/frontend/') ?>img/cart.png" id="img-cart" alt="img-holiwood"></a>
                              <div class="dropdown-menu">
                                    <div class="cart-1">
                                          <div class="img-cart"><img src="<?php echo base_url('assets/template/frontend/') ?>img/340x420.png" class="img-responsive" alt="img-holiwood"></div>
                                          <div class="info-cart">
                                                <h1>Pink roses</h1>
                                                <span class="number">x1</span>
                                                <span class="prince-cart">$207.2</span>
                                          </div>
                                    </div>
                                    <div class="cart-1">
                                          <div class="img-cart"><img src="<?php echo base_url('assets/template/frontend/') ?>img/340x420.png" class="img-responsive" alt="img-holiwood"></div>
                                          <div class="info-cart">
                                                <h1>Eleganr by BloomNation</h1>
                                                <span class="number">x1</span>
                                                <span class="prince-cart">$207.2</span>
                                          </div>
                                    </div>
                                    <div class="cart-1">
                                          <div class="img-cart"><img src="<?php echo base_url('assets/template/frontend/') ?>img/340x420.png" class="img-responsive" alt="img-holiwood"></div>
                                          <div class="info-cart">
                                                <h1>Queen Rose - Yellow</h1>
                                                <span class="number">x1</span>
                                                <span class="prince-cart">$207.2</span>
                                          </div>
                                    </div>
                                    <div class="total">
                                          <span>Total:</span>
                                          <span>$621.6</span>
                                    </div>
                                    <div id="div-cart-menu">
                                          <a href="#">ADD TO CART</a>
                                          <a href="#" class="check">CHECK VIEW</a>
                                    </div>
                              </div>
                        </li>
                  </ul>
            </div>
            <div class="navbar-header mobile-menu">
                  <button type="button" class="navbar-toggle btn-menu-mobile" data-toggle="collapse" data-target="#myNavbar">
                        <i class="fas fa-bars"></i>
                  </button>
            </div>
      </div>

</header>
<main>
      <div class="content-search">

            <div class="container container-100">
                  <i class="far fa-times-circle" id="close-search"></i>
                  <!-- <h3 class="text-center">what are your looking for ?</h3> -->
                  <form method="get" action="/search" role="search" style="position: relative;">
                        <input type="text" class="form-control control-search" value="" autocomplete="off" placeholder="Enter Search ..." aria-label="SEARCH" name="q">

                        <button class="button_search" type="submit">search</button>
                  </form>
            </div>

      </div>
      <!-- End container -->