  <!-- Page Loader -->
  <div class="page-loader-wrapper">
        <div class="loader">
              <div class="m-t-30"><img class="zmdi-hc-spin" src="<?php echo base_url('assets/images/') ?>logo.svg" width="48" height="48" alt="Oreo"></div>
              <p>Please wait...</p>
        </div>
  </div>
  <!-- Overlay For Sidebars -->
  <div class="overlay"></div>

  <!-- Top Bar -->
  <nav class="navbar p-l-5 p-r-5">
        <ul class="nav navbar-nav navbar-left">
              <li>
                    <div class="navbar-header">
                          <a href="javascript:void(0);" class="bars"></a>
                          <a class="navbar-brand" href="<?php echo base_url('admin_gulderose/dashboard') ?>"><img src="<?php echo base_url('assets/images/') ?>logo.svg" width="30" alt="Gulderose"><span class="m-l-10">Gulderose</span></a>
                    </div>
              </li>
              <li><a href="javascript:void(0);" class="ls-toggle-btn" data-close="true"><i class="zmdi zmdi-swap"></i></a></li>
              <li class="hidden-md-down"><a href="<?php echo base_url('admin_gulderose/penjualan/pembayaran-diterima-dan-diproses') ?>" title="Penjualan"><i class="zmdi zmdi-shopping-cart"></i></a></li>
              <li class="hidden-md-down"><a href="<?php echo base_url('admin_gulderose/laporan') ?>" title="Laporan"><i class="zmdi zmdi-file-text"></i></a></li>
              <li><a href="<?php echo base_url('admin_gulderose/auth') ?>" title="User List"><i class="zmdi zmdi-account"></i></a></li>
              <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="zmdi zmdi-notifications"></i>
                          <?php if ($navbar_transaksi_row->status != '2') { ?>
                              <div class="notify"><span class="heartbit"></span><span class="point"></span></div>
                                <?php } else { ?>
                                <div class="notify"><span class="heartbit"></span><span class="point"></span></div>
                          <?php } ?>
                    </a>
                    <ul class="dropdown-menu pullDown">
                          <?php if ($navbar_transaksi_row->status != '2') {
                                    echo 'Tidak ada konfirmasi pembayaran terbaru';
                              } else { ?>
                                <li class="body">
                                      <ul class="menu list-unstyled">
                                            <?php foreach ($navbar_transaksi as $trans) : ?>
                                                  <li>
                                                        <a href="<?php echo base_url('admin_gulderose/penjualan/detail_konfirmasi/') . $trans->id_trans ?>">
                                                              <div class="media">
                                                                    <img class="media-object" src="<?php echo base_url('assets/images/') ?>gulderose.png" alt="gulderose" width='45'>
                                                                    <div class="media-body">
                                                                          <span class="name"><?php echo $trans->nama ?></span>
                                                                          <span class="time"><?php ?></span>
                                                                          <span class="message">Invoice Order : <?php echo $trans->id_trans ?></span>
                                                                          <span class="message"><span class="badge badge-success"><?php if ($trans->status == '2') {
                                                                                                                                          echo 'Confirmation Success';
                                                                                                                                    } ?></span></span>
                                                                    </div>
                                                              </div>
                                                        </a>
                                                  </li>
                                            <?php endforeach; ?>
                                      </ul>
                                </li>

                                <li class="footer"> <a href="<?php echo base_url('admin_gulderose/penjualan/sudah-konfirmasi') ?>">View All</a> </li>
                          <?php } ?>
                    </ul>
              </li>
              <?php if ($this->uri->segment(2) == "produk" || $this->uri->segment(3) == "create" || $this->uri->segment(3) == "update" || $this->uri->segment(3) == "detail" || $this->uri->segment(2) == "search") { ?>
                    <li class="hidden-sm-down">
                          <form action="<?php echo base_url('admin_gulderose/search') ?>" method="get">
                                <div class="input-group">
                                      <input type="text" class="form-control" placeholder="Pencarian Produk . . ." name="product">
                                      <span class="input-group-addon">
                                            <i class="zmdi zmdi-search"></i>
                                      </span>
                                </div>
                          </form>
                    </li>
              <?php } else {
                        echo "";
                  } ?>
              <li class="float-right">
                    <a href="<?php echo base_url('admin_gulderose/auth/logout'); ?>" class="mega-menu" data-close="true"><i class="zmdi zmdi-power"></i></a>
                    <a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="zmdi zmdi-settings zmdi-hc-spin"></i></a>
              </li>
        </ul>
  </nav>