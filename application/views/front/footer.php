<!-- FOOTER -->
<footer>
      <div class="container">
            <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 info-footer">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                              <h3>Quick Link</h3>
                              <ul>
                                    <li><i class="fas fa-long-arrow-alt-right"></i><a href="<?php echo base_url(); ?>">Home</a>
                                    </li>
                                    <li><i class="fas fa-long-arrow-alt-right"></i><a href="<?php echo base_url('product/all-products'); ?>">Products</a>
                                    </li>
                              </ul>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                              <h3>My Account</h3>
                              <ul>
                                    <li><i class="fas fa-long-arrow-alt-right"></i><a href="<?php echo base_url('cart') ?>">My Cart</a>
                                    </li>
                                    <li><i class="fas fa-long-arrow-alt-right"></i><a href="<?php echo base_url('my-account'); ?>">My Personal Info</a>
                                    </li>
                              </ul>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                              <h3>Information</h3>
                              <ul>
                                    <li><i class="fas fa-long-arrow-alt-right"></i><a href="<?php echo base_url('about-us'); ?>">About Us</a>
                                    </li>
                                    <li><i class="fas fa-long-arrow-alt-right"></i><a href="<?php echo base_url('contact-us'); ?>">Contact Us</a>
                                    </li>
                                    <li><i class="fas fa-long-arrow-alt-right"></i><a href="<?php echo base_url('how-to-order'); ?>">How To Order</a>
                                    </li>
                                    <li><i class="fas fa-long-arrow-alt-right"></i><a href="<?php echo base_url('terms-of-service'); ?>">Terms of Service</a>
                                    </li>
                              </ul>
                        </div>
                        <div class="social-text"><span id="text-connect">CONNECT WITH US:</span>
                              <span class="social">
                                    <a href="<?php echo $company_data->link_ig ?>" id="instar" target="_blank"></a>
                                    <a href="<?php echo $company_data->link_fb ?>" id="fb" target="_blank"></a>
                              </span>
                        </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 new-letter">
                        <div class="form-new">
                              <h1>Product</h1>
                              <p>Product to get lastest updates and offers</p>

                        </div>
                  </div>
            </div>
      </div>
      <div class="footer-logo">
            <div class="row footer-row">
                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"> <span> <i class="fab fa-whatsapp"></i>Whatsapp :
                              <?php echo $company_data->no_hp; ?></span>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 copy"><span><?php echo $company_data->footer; ?></span>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"> <span id="gmail-footer"> <i class="far fa-envelope"></i>Email :
                              <?php echo $company_data->email_company; ?></span>
                  </div>
            </div>
      </div>
      <div class="hidden-lg hidden-md back-to-top fade"><i class="fas fa-caret-up"></i>
      </div>
      <div class="BG-menu"></div>

</footer>