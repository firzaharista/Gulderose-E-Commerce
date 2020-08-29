<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar">
      <ul class="nav nav-tabs">
            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#dashboard"><i class="zmdi zmdi-home m-r-5"></i>Home</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#user"><i class="zmdi zmdi-account m-r-5"></i>User</a></li>
      </ul>
      <div class="tab-content">
            <div class="tab-pane stretchRight active" id="dashboard">
                  <div class="menu">
                        <ul class="list">
                              <li>
                                    <div class="user-info">
                                          <div class="image"><a href="profile.html"><img src="<?php echo base_url('assets/images/') ?>gulderose.png" alt="User"></a></div>
                                          <div class="detail">
                                                <h4><?php echo $this->session->userdata('nama');?></h4>
                                                <small>Admin Gulderose Bunga Flanel</small>
                                          </div>
                                          <a title="facebook" href="https://www.facebook.com/gulderose.co" target="_blank"><i class="zmdi zmdi-facebook"></i></a>
                                          <a title="instagram" href="https://www.instagram.com/gulderose.co/?hl=id" target="_blank"><i class="zmdi zmdi-instagram"></i></a>
                                    </div>
                              </li>
                              <li class="header">MENU UTAMA</li>
                              <li <?php if ($this->uri->segment(2) == "dashboard") { echo "class='active'";} ?>>
                                    <a href="<?php echo base_url('admin_gulderose/dashboard'); ?>"><i class="zmdi zmdi-home"></i><span>Dashboard</span></a>
                              </li>
                              <li <?php if ($this->uri->segment(2) == "penjualan" ) { echo "class='active'";} ?>>
                                    <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-shopping-cart"></i><span>Penjualan</span> </a>
                                    <ul class="ml-menu">
                                          <li <?php if ($this->uri->segment(2) == "penjualan" && $this->uri->segment(3) == "belum-konfirmasi" || $this->uri->segment(3) == "sudah-konfirmasi") { echo "class='active'";}?>><a href="<?php echo base_url('admin_gulderose/penjualan/belum-konfirmasi') ?>">Data Konfirmasi</a></li>
                                          <li <?php if ($this->uri->segment(2) == "penjualan" && $this->uri->segment(3) == "pembayaran-diterima-dan-diproses" || $this->uri->segment(3) == "dikirim" || $this->uri->segment(3) == "dibatalkan") { echo "class='active'";}?>><a href="<?php echo base_url('admin_gulderose/penjualan/pembayaran-diterima-dan-diproses') ?>">Data Penjualan</a></li>
                                          
                                    </ul>
                              </li>
                              <li <?php if ($this->uri->segment(2) == "produk" || $this->uri->segment(2) == "search") { echo "class='active'";} ?>>
                                    <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-card-travel"></i><span>Produk</span> </a>
                                    <ul class="ml-menu">
                                          <li <?php if ($this->uri->segment(2) == "produk" && $this->uri->segment(3) == "create") { echo "class='active'";}?>><a href="<?php echo base_url('admin_gulderose/produk/create') ?>">Tambah Produk</a></li>
                                          <li <?php if ($this->uri->segment(2) == "produk" && $this->uri->segment(3) == "") { echo "class='active'";}?>><a href="<?php echo base_url('admin_gulderose/produk') ?>">Data Produk</a></li>
                                    </ul>
                              </li>
                              <li <?php if ($this->uri->segment(2) == "produkrekomendasi") { echo "class='active'";} ?>>
                                    <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-card-travel"></i><span>Produk Rekomend</span> </a>
                                    <ul class="ml-menu">
                                          <li <?php if ($this->uri->segment(2) == "produkrekomendasi" && $this->uri->segment(3) == "create") { echo "class='active'";}?>><a href="<?php echo base_url('admin_gulderose/produkrekomendasi/create') ?>">Tambah Produk Rekomendasi</a></li>
                                          <li <?php if ($this->uri->segment(2) == "produkrekomendasi" && $this->uri->segment(3) == "") { echo "class='active'";}?>><a href="<?php echo base_url('admin_gulderose/produkrekomendasi') ?>">Data Produk Rekomendasi</a></li>
                                    </ul>
                              </li>
                              <li <?php if ($this->uri->segment(2) == "laporan") { echo "class='active'";} ?>>
                                    <a href="<?php echo base_url('admin_gulderose/laporan') ?>"><i class="zmdi zmdi-file-text"></i><span>Laporan</span> </a>
                              </li>
                              <li class="header">BANK</li>
                              <li <?php if ($this->uri->segment(2) == "bankasal") { echo "class='active'";} ?>>
                                    <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-balance"></i><span>Bank Asal</span> </a>
                                    <ul class="ml-menu">
                                          <li <?php if ($this->uri->segment(2) == "bankasal" && $this->uri->segment(3) == "create") { echo "class='active'";}?>><a href="<?php echo base_url('admin_gulderose/bankasal/create') ?>">Tambah Bank Asal</a></li>
                                          <li <?php if ($this->uri->segment(2) == "bankasal" && $this->uri->segment(3) == "") { echo "class='active'";}?>><a href="<?php echo base_url('admin_gulderose/bankasal') ?>">Data Bank Asal</a></li>
                                    </ul>
                              </li>
                              <li <?php if ($this->uri->segment(2) == "banktujuan") { echo "class='active'";} ?>>
                                    <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-balance"></i><span>Bank Tujuan</span> </a>
                                    <ul class="ml-menu">
                                          <li <?php if ($this->uri->segment(2) == "banktujuan" && $this->uri->segment(3) == "create") { echo "class='active'";}?>><a href="<?php echo base_url('admin_gulderose/banktujuan/create') ?>">Tambah Bank Tujuan</a></li>
                                          <li <?php if ($this->uri->segment(2) == "banktujuan" && $this->uri->segment(3) == "") { echo "class='active'";}?>><a href="<?php echo base_url('admin_gulderose/banktujuan') ?>">Data Bank Tujuan</a></li>
                                    </ul>
                              </li>

                              <li class="header">KATEGORI PRODUK</li>
                              <li <?php if ($this->uri->segment(2) == "kategori") { echo "class='active'";} ?>>
                                    <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-label"></i><span>Kategori</span> </a>
                                    <ul class="ml-menu">
                                          <li <?php if ($this->uri->segment(2) == "kategori" && $this->uri->segment(3) == "create") { echo "class='active'";}?>><a href="<?php echo base_url('admin_gulderose/kategori/create'); ?>">Tambah Kategori</a></li>
                                          <li <?php if ($this->uri->segment(2) == "kategori" && $this->uri->segment(3) == "") { echo "class='active'";}?>><a href="<?php echo base_url('admin_gulderose/kategori'); ?>">Data Kategori</a></li>
                                    </ul>
                              </li>
                              <li <?php if ($this->uri->segment(2) == "subkategori") { echo "class='active'";} ?>>
                                    <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-label"></i><span>SubKategori</span> </a>
                                    <ul class="ml-menu">
                                          <li <?php if ($this->uri->segment(2) == "subkategori" && $this->uri->segment(3) == "create") { echo "class='active'";}?>><a href="<?php echo base_url('admin_gulderose/subkategori/create') ?>">Tambah SubKategori</a></li>
                                          <li <?php if ($this->uri->segment(2) == "subkategori" && $this->uri->segment(3) == "") { echo "class='active'";}?>><a href="<?php echo base_url('admin_gulderose/subkategori') ?>">Data SubKategori</a></li>
                                    </ul>
                              </li>
                              <li class="header">LAINNYA</li>
                              <li <?php if ($this->uri->segment(2) == "slider") { echo "class='active'";} ?>>
                                    <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-image-o"></i><span>Slider</span> </a>
                                    <ul class="ml-menu">
                                          <li <?php if ($this->uri->segment(2) == "slider" && $this->uri->segment(3) == "create") { echo "class='active'";}?>><a href="<?php echo base_url('admin_gulderose/slider/create'); ?>">Tambah Slider</a></li>
                                          <li <?php if ($this->uri->segment(2) == "slider" && $this->uri->segment(3) == "") { echo "class='active'";}?>><a href="<?php echo base_url('admin_gulderose/slider'); ?>">Data Slider</a></li>
                                    </ul>
                              </li>
                              <li <?php if ($this->uri->segment(2) == "terms_of_service") { echo "class='active'";} ?>>
                                    <a href="<?php echo base_url('admin_gulderose/terms_of_service') ?>"><i class="zmdi zmdi-assignment"></i><span>Terms of Service</span> </a>
                              </li>
                              <li <?php if ($this->uri->segment(2) == "panduanpembelian") { echo "class='active'";} ?>>
                                    <a href="<?php echo base_url('admin_gulderose/panduanpembelian') ?>"><i class="zmdi zmdi-assignment"></i><span>Panduan Pembelian</span> </a>
                              </li>
                              <li class="header">PENGATURAN</li>
                              <li <?php if ($this->uri->segment(2) == "companyprofile") { echo "class='active'";} ?>>
                                    <a href="<?php echo base_url('admin_gulderose/companyprofile/update/2') ?>"><i class="zmdi zmdi-collection-text"></i><span>Company Profile</span> </a>
                              </li>
                              <?php if ($this->ion_auth->is_superadmin()): ?>
                              <li <?php if ($this->uri->segment(2) == "auth") { echo "class='active'";} ?>>
                                    <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-accounts"></i><span>User</span> </a>
                                    <ul class="ml-menu">
                                          <li <?php if ($this->uri->segment(2) == "auth" && $this->uri->segment(3) == "create_user") { echo "class='active'";}?>><a href="<?php echo base_url('admin_gulderose/auth/create_user'); ?>">Tambah User</a></li>
                                          <li <?php if ($this->uri->segment(2) == "auth" && $this->uri->segment(3) == "") { echo "class='active'";}?>><a href="<?php echo base_url('admin_gulderose/auth'); ?>">Data User</a></li>
                                    </ul>
                              </li>
                              <?php endif ?>
                              <li>
                                    <a href="<?php echo base_url('admin_gulderose/auth/logout') ?>"><i class="zmdi zmdi-rotate-left"></i><span>Log Out</span> </a>
                              </li>
                        </ul>
                  </div>
            </div>
            <div class="tab-pane stretchLeft" id="user">
                  <div class="menu">
                        <ul class="list">
                              <li>
                                    <div class="user-info m-b-20 p-b-15">
                                          <div class="image"><a href="<?php echo base_url('admin_gulderose/dashboard'); ?>"><img src="<?php echo base_url('assets/images/') ?>gulderose.png" alt="User"></a></div>
                                          <div class="detail">
                                                <h4><?php echo $this->session->userdata('nama');?></h4>
                                                <small>Gulderose Bunga Flanel</small>
                                          </div>
                                    </div>
                              </li>
                              <li>
                                    <small class="text-muted">Email address: </small>
                                    <p><?php echo $this->session->userdata('email'); ?></p>
                                    <hr>
                              </li>
                        </ul>
                  </div>
            </div>
      </div>
</aside>