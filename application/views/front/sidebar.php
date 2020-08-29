<!-- sidebar -->
<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 sidebar" style="clear: left;">
      <div class="collapse navbar-collapse" id="mysidebar">
            <ul class="list-group list-1">
                  <li class="list-group-item">CATEGORIES</li>
                  <li class="list-group-item"><a href="<?php echo base_url('product/all-products'); ?>">All Products</a></li>

                  <?php
                  $sql  = $this->db->query("SELECT * FROM kategori ORDER BY judul_kategori");
                  $data = $sql->result();
                  foreach ($data as $row) {
                        $id_kat = $row->id_kategori;
                  ?>
                        <li class="list-group-item">
                              <a href="<?php echo base_url("product-category/$row->slug_kat"); ?>"><?php echo $row->judul_kategori; ?></a><button class="accordion"></button>
                              <ul class="panel">
                                    <?php
                                    $sql2   =  $this->db->query("SELECT * FROM subkategori WHERE id_kategori = '$id_kat' ORDER BY judul_subkategori "); // Memanggil subkategori/ middle kategori
                                    $data2  = $sql2->result();
                                    foreach ($data2 as $row2) {
                                          $id_sub = $row2->id_subkategori;
                                    ?>
                                          <li><a href="<?php echo base_url("product-category/$row->slug_kat/$row2->slug_subkat"); ?>"><?php echo $row2->judul_subkategori; ?></a></li>

                                    <?php } ?>
                              </ul>
                        </li>
                  <?php } ?>
            </ul>
      </div>
      <div class="collapse navbar-collapse">
            <ul class="list-group list-2">
                  <li class="list-group-item">PRODUCT RECOMMENDATION</li>
                  <?php foreach ($product_recomend as $product_rec) : ?>
                        <li class="list-group-item list-item-2">
                              <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                    <a href="<?php echo base_url('product/') . $product_rec->slug_produk; ?>"><img src="<?php echo base_url('assets/images/produk/') . $product_rec->foto . $product_rec->foto_type ?>" class="img-responsive" alt="img-holiwood"></a>
                              </div>
                              <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 title-post">
                                    <a href="#">
                                          <h1><a href="<?php echo base_url('product/') . $product_rec->slug_produk ?>"><?php echo character_limiter($product_rec->judul_produk, '25') ?></a></h1>
                                    </a>
                                    <?php if ($product_rec->diskon == '0') { ?>
                                          <b style="color: black;"><?php echo 'Rp. ' . number_format($product_rec->harga_normal, 2, ',', '.') ?></b>
                                    <?php } else { ?>
                                          <strike><b><?php echo 'Rp. ' . number_format($product_rec->harga_normal, 2, ',', '.') ?></b></strike><br>
                                          <b style="color:black"><?php echo 'Rp. ' . number_format($product_rec->harga_diskon, 2, ',', '.') ?></b>
                                          <font>
                                                <span class="badge badge-pill badge-success"><?php echo $product_rec->diskon ?>% OFF</span>
                                          </font>
                                    <?php } ?>
                              </div>
                        </li>
                  <?php endforeach; ?>
            </ul>
      </div>
</div>
<!-- End Sidebar -->