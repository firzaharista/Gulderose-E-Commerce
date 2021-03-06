<!-- HEADER | NAVBAR -->
<header class="navbar-fixed-top pos-header" id="header-v1">
      <nav class="hidden-xs">
            <div class="container">
                  <ul class="nav navbar-nav nav-help">
                        <li><span>
                                    <i class="fab fa-whatsapp"></i> Whatsapp :
                              </span><?php echo $company_data->no_hp; ?>
                        </li>
                        <li><span>
                                    <i class="far fa-envelope"></i> Email :
                              </span><?php echo $company_data->email_company; ?>
                        </li>
                        <li class="col-md-3"><?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?></li>
                  </ul>

            </div>
      </nav>
      <div class="container">
            <div class="row">
                  <div class="navbar-header mobile-menu">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar"> <i class="fas fa-bars"></i>
                        </button>
                  </div>
                  <div class="collapse navbar-collapse col-lg-6 col-md-6 col-sm-12 col-xs-12" id="myNavbar">
                        <form class="hidden-lg hidden-md form-group form-search-mobile" action="<?php echo base_url('product/search_product') ?>">
                              <input type="text" name="search" placeholder="Search here..." class="form-control">
                        </form>
                        <ul class="nav navbar-nav menu-main">
                              <li>
                                    <figure id="btn-close-menu" class="hidden-lg hidden-md"><i class="far fa-times-circle"></i>
                                    </figure>
                              </li>
                              <li class="li-home">
                                    <a href="<?php echo base_url(); ?>">Home</a>
                              </li>
                              <li class="shop-menu dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Product</a>
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
                                                                  ?>
                                                                        <li class="col-lg-3 col-md-3 col-sm-12 col-xs-12 menu-home-lv2">
                                                                              <ul>
                                                                                    <li><a href="<?php echo base_url("product-category/$row->slug_kat"); ?>"><?php echo $row->judul_kategori; ?></a></li>

                                                                                    <?php
                                                                                    $sql2   =  $this->db->query("SELECT * FROM subkategori WHERE id_kategori = '$id_kat' ORDER BY judul_subkategori "); // Memanggil subkategori/ middle kategori
                                                                                    $data2  = $sql2->result();
                                                                                    foreach ($data2 as $row2) {
                                                                                          $id_sub = $row2->id_subkategori;
                                                                                    ?>
                                                                                          <li class="li-home"><i class="fas fa-long-arrow-alt-right hidden-sm hidden-md hidden-xs"></i>
                                                                                                <a href="<?php echo base_url("product-category/$row->slug_kat/$row2->slug_subkat"); ?>"><?php echo $row2->judul_subkategori; ?></a>
                                                                                          </li>
                                                                                    <?php } ?>

                                                                                    <?php echo '</ul>' ?>
                                                                                    <?php echo '</li>' ?>
                                                                              <?php } ?>

                                                                              <li class="col-lg-3 col-md-3 col-sm-12 col-xs-12 menu-home-lv2">
                                                                                    <ul>
                                                                                          <li><a href="<?php echo base_url('product/all-products') ?>">- ALL PRODUCTS -</a> </li>
                                                                                    </ul>
                                                                              </li>
                                                                              </ul>
                                                                        </li>
                                                            </ul>
                                          </div>
                                    </div>
                              </li>
                              <li class="contact-menu">
                                    <a href="<?php echo base_url('payment-confirmation') ?>">Payment Confirmation</a>
                              </li>
                              <li class="contact-menu">
                                    <a href="<?php echo base_url('cart') ?>"> <i class="fa fa-shopping-cart"></i>
                                          <?php if (isset($_SESSION['identity']) && $_SESSION['id_group'] == '3') { ?> Cart (<?php echo $total_cart_navbar ?>)
                                          <?php } else { ?> Cart </a>
                              <?php } ?>
                              </li>
                              <?php if (isset($_SESSION['identity']) && $_SESSION['id_group'] == '3') { ?>
                                    <li class="hidden-lg hidden-md">
                                          <a href="<?php echo base_url('my-account'); ?>"><i class="far fa-user" title="My Account"></i></a>
                                    </li>
                              <?php } else { ?>
                                    <li class="hidden-lg hidden-md">
                                          <a href="<?php echo base_url('user-login'); ?>"><i class="far fa-user" title="My Account"></i></a>
                                    </li>
                              <?php } ?>

                              <li class="hidden-lg hidden-md hidden-sm phone-mobile"><strong>Phone :</strong>800 123
                                    654 78</li>
                              <li class="hidden-lg hidden-md hidden-sm phone-mobile">
                                    <strong> <i class="far fa-envelope"></i> Email :</strong>gulderose@gmail.com</li>
                        </ul>

                  </div>
                  <ul class="logo col-lg-1 col-md-2 col-sm-7 col-xs-7">
                        <li>
                              <a href="#">
                                    <img src="<?php echo base_url('assets/template/frontend/'); ?>img/logo/gulderose_watermark.png" class="img-responsive" alt="img-holiwood">
                              </a>
                        </li>
                  </ul>

                  <ul class="nav navbar-nav navbar-right icon-menu col-lg-4 col-md-4 col-sm-5 col-xs-5">
                        <?php if (isset($_SESSION['identity']) && $_SESSION['id_group'] == '3') { ?>
                              <li class="icon-user hidden-sm hidden-xs">
                                    <a href="<?php echo base_url('my-account'); ?>"><i class="far fa-user" title="My Account"></i></a>
                              </li>
                        <?php } else { ?>
                              <li class="icon-user hidden-sm hidden-xs">
                                    <a href="<?php echo base_url('user-login'); ?>"><i class="far fa-user" title="My Account"></i></a>
                              </li>
                        <?php } ?>

                        <li class="dropdown cart-menu">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?php echo base_url('assets/template/frontend/'); ?>img/cart.png" id="img-cart" alt="img-holiwood" title="Shopping Cart">
                              </a>
                              <div class="dropdown-menu">
                                    <?php if (isset($_SESSION['identity']) && $_SESSION['id_group'] == '3') { ?>
                                          <?php if ($cart_data == NULL) {
                                                echo '<div class="page-404">
                                          <!-- End images -->
                                          <div class="text center">
                                                <h4><b><i class="fas fa-shopping-cart"></i> EMPTY SHOPPING CART</b></h4>
                                                ' ?>
                              </div>
                              <!-- End text -->
            </div>
            <!-- End page404 -->
      <?php } else { ?>
            <?php foreach ($cart_data as $cart) : ?>
                  <div class="cart-1">
                        <div class="img-cart">
                              <img src="<?php echo base_url('assets/images/produk/') . $cart->foto . $cart->foto_type; ?>" class="img-responsive" alt="img-holiwood">
                        </div>
                        <div class="info-cart">
                              <h1><?php echo character_limiter($cart->judul_produk, 20); ?></h1>
                              <span class="number">x<?php echo $cart->total_qty; ?></span>
                              <span class="prince-cart"><?php echo 'Rp. ' . number_format($cart->subtotal, 2, ',', '.') ?></span>
                        </div>
                  </div>
            <?php endforeach; ?>
            <div class="total"> <span>Total:</span>
                  <span><?php echo 'Rp. ' . number_format($total_berat_subtotal->subtotal, 2, ',', '.') ?></span>
            </div>
            <div id="div-cart-menu">
                  <a href="<?php echo base_url('cart'); ?>">VIEW CART</a>
                  <a href="<?php echo base_url('checkout/order-information'); ?>" class="check">CHECKOUT</a>
            </div>
      <?php } ?>
<?php } else {
                                          echo '<div class="page-404">
                                                <!-- End images -->
                                                <div class="text center">
                                                      <p><b><i class="fas fa-shopping-cart"></i> Please Login,</b> if you will check your cart</p>
                                                      ' ?>
      </div>
      <!-- End text -->
      </div>
      <!-- End page404 -->
<?php } ?>
<li id="input-search" class="hidden-sm hidden-xs">
      <a href="#"><img src="<?php echo base_url('assets/images/')?>Search.png" alt="img-holiwood" title="Search"></a>
</li>
</div>

</header>