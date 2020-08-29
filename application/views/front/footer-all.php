<div class="info-footer">
      <div class="container">
            <div class="row">
                  <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                              <h3>Quick Link</h3>
                              <ul>
                                    <li><i class="fas fa-long-arrow-alt-right"></i><a href="<?php echo base_url(); ?>">Home</a></li>
                                    <li><i class="fas fa-long-arrow-alt-right"></i><a href="<?php echo base_url('product/all-products'); ?>">Products</a></li>
                              </ul>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                              <h3>My Account</h3>
                              <ul>
                                    <li><i class="fas fa-long-arrow-alt-right"></i><a href="<?php echo base_url('cart'); ?>">My Cart</a></li>
                                    <li><i class="fas fa-long-arrow-alt-right"></i><a href="<?php echo base_url('my-account'); ?>">My Personal Info</a></li>
                                    <!-- <li><i class="fas fa-long-arrow-alt-right"></i><a href="#">Checkout</a></li> -->
                              </ul>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                              <h3>Information</h3>
                              <ul>
                                    <li><i class="fas fa-long-arrow-alt-right"></i><a href="<?php echo base_url('about-us'); ?>">About Us</a></li>
                                    <li><i class="fas fa-long-arrow-alt-right"></i><a href="<?php echo base_url('contact-us'); ?>">Contact Us</a></li>
                                    <li><i class="fas fa-long-arrow-alt-right"></i><a href="<?php echo base_url('how-to-order'); ?>">How To Order</a></li>
                                    <li><i class="fas fa-long-arrow-alt-right"></i><a href="<?php echo base_url('terms-of-service'); ?>">Terms of Service</a></li>
                              </ul>
                        </div>

                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 social">
                        <p>CONNECT WITH US:</p>
                        <a href="<?php echo $company_data->link_ig ?>" id="link-insta" target="_blank"></a>
                        <a href="<?php echo $company_data->link_fb ?>" id="link-fb" target="_blank"></a>
                  </div>
            </div>
      </div>
      <div class="navbar-header mobile-sidebar">
            <button type="button" class="navbar-toggle btn-mobile-sidebar" data-toggle="collapse" data-target="#mysidebar">
                  <i class="fas fa-angle-left" id="icon-sidebar"></i>
            </button>
      </div>
</div>
</main>
<footer>
      <div class="container">
            <div class="row">
                  <div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"> <span> <i class="fab fa-whatsapp"></i>Whatsapp :
                                    <?php echo $company_data->no_hp; ?></span>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 copy"><span><?php echo $company_data->footer; ?></span>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 gmail-footer">
                              <span id="gmail-footer"><a href="#"> <i class="far fa-envelope"></i> Email : <?php echo $company_data->email_company; ?></a></span>
                        </div>
                  </div>

            </div>
            <div class="hidden-lg hidden-md back-to-top fade"><i class="fas fa-caret-up"></i></div>
            <div class="BG-Footer"></div>
</footer>