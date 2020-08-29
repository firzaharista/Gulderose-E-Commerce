<section class="content home">
  <div class="block-header">
    <div class="row">
      <div class="col-lg-5 col-md-5 col-sm-12">
        <h2>Ecommerce Dashboard
          <small>Welcome to Gulderose Bunga Flanel</small>
        </h2>
      </div>
      <div class="col-lg-7 col-md-7 col-sm-12 text-right">
        <div class="inlineblock text-center m-r-15 m-l-15 hidden-md-down">
          <div class="sparkline" data-type="bar" data-width="97%" data-height="25px" data-bar-Width="2" data-bar-Spacing="5" data-bar-Color="#fff">3,2,6,5,9,8,7,9,5,1,3,5,7,4,6</div>
          <small class="col-white">Gulderose</small>
        </div>
        <div class="inlineblock text-center m-r-15 m-l-15 hidden-md-down">
          <div class="sparkline" data-type="bar" data-width="97%" data-height="25px" data-bar-Width="2" data-bar-Spacing="5" data-bar-Color="#fff">1,3,5,7,4,6,3,2,6,5,9,8,7,9,5</div>
          <small class="col-white">Ecommerce</small>
        </div>
        <button class="btn btn-white btn-icon btn-round hidden-sm-down float-right m-l-10" type="button">
          <i class="zmdi zmdi-plus"></i>
        </button>
        <ul class="breadcrumb float-md-right">
          <li class="breadcrumb-item"><a href="<?php echo base_url('admin_gulderose/dashboard'); ?>"><i class="zmdi zmdi-home"></i> Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ul>
      </div>
    </div>
  </div>
  <!-- Bagian total Penjualan dll -->
  <div class="container-fluid">
    <div class="row clearfix">
      <div class="col-lg-4 col-md-12">
        <div class="card">
          <div class="header">
            <h2><strong>Total</strong> Penjualan</h2>
          </div>
          <div class="body">
            <h2 class="number count-to m-t-0 m-b-5" data-from="0" data-to="<?php echo $total_penjualan?>" data-speed="1000" data-fresh-interval="700">10</h2>
            <small class="displayblock">Penjualan <i class="zmdi zmdi-trending-up"></i></small>
          </div>
          <div class="sparkline" data-type="line" data-spot-Radius="1" data-highlight-Spot-Color="rgb(63, 81, 181)" data-highlight-Line-Color="#222" data-min-Spot-Color="rgb(233, 30, 99)" data-max-Spot-Color="rgb(63, 81, 181)" data-spot-Color="rgb(63, 81, 181, 0.7)" data-offset="90" data-width="100%" data-height="40px" data-line-Width="1" data-line-Color="rgb(63, 81, 181, 0.7)" data-fill-Color="rgba(0,0,0, 0.2)"> 1,2,3,1,4,3,6,4,4,1 </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-12">
        <div class="card">
          <div class="header">
            <h2><strong>Total</strong> Produk</h2>
          </div>
          <div class="body">
            <h2 class="number count-to m-t-0 m-b-5" data-from="0" data-to="<?php echo $total_produk; ?>" data-speed="1000" data-fresh-interval="700">24</h2>
            <small class="displayblock">Produk <i class="zmdi zmdi-trending-up"></i></small>
          </div>
          <div class="sparkline" data-type="line" data-spot-Radius="1" data-highlight-Spot-Color="rgb(63, 81, 181)" data-highlight-Line-Color="#222" data-min-Spot-Color="rgb(233, 30, 99)" data-max-Spot-Color="rgb(120, 184, 62)" data-spot-Color="rgb(63, 81, 181, 0.7)" data-offset="90" data-width="100%" data-height="40px" data-line-Width="1" data-line-Color="rgb(63, 81, 181, 0.7)" data-fill-Color="rgba(0,0,0, 0.2)"> 4,5,2,8,4,8,7,4,8,5</div>
        </div>
      </div>
      <div class="col-lg-4 col-md-12">
        <div class="card">
          <div class="header">
            <h2><strong>Total</strong> User Customer</h2>
          </div>
          <div class="body">
            <h2 class="number count-to m-t-0 m-b-5" data-from="0" data-to="<?php echo $total_user_customer ?>" data-speed="1000" data-fresh-interval="700"><?php echo $total_user_customer ?></h2>
            <small class="displayblock">User Customer <i class="zmdi zmdi-trending-up"></i></small>
          </div>
          <div class="sparkline" data-type="line" data-spot-Radius="1" data-highlight-Spot-Color="rgb(63, 81, 181)" data-highlight-Line-Color="#222" data-min-Spot-Color="rgb(233, 30, 99)" data-max-Spot-Color="rgb(120, 184, 62)" data-spot-Color="rgb(63, 81, 181, 0.7)" data-offset="90" data-width="100%" data-height="40px" data-line-Width="1" data-line-Color="rgb(63, 81, 181, 0.7)" data-fill-Color="rgba(0,0,0, 0.2)">1,5,9,3,5,7,8,5,2,3,5,7</div>
        </div>
      </div>
    </div>
    <div class="row clearfix">
      <div class="col-lg-8 col-md-12">
        <div class="card product_item_list">
          <div class="header">
            <h2>
              <strong>Produk</strong> Terbaru <small>Produk terbaru dari Gulderose Bunga Flanel</small>
            </h2>
          </div>
          <div class="body table-responsive">
            <table class="table table-hover m-b-0">
              <thead>
                <tr>
                  <th style="text-align:center">Foto</th>
                  <th style="text-align:center">Nama Produk</th>
                  <th style="text-align:center" data-breakpoints="xs">Harga Normal</th>
                  <th style="text-align:center" data-breakpoints="xs md">Stok</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($top3_produk as $top3) : ?>
                  <tr>
                    <td style="text-align:center"><img src="<?php echo base_url('assets/images/produk/' . $top3->foto . $top3->foto_type); ?>" width="48" alt="Product img"></td>
                    <td style="text-align:center">
                      <p><?php echo character_limiter($top3->judul_produk, 32) ?></p>
                    </td>
                    <td style="text-align:center"><?php echo 'Rp. ' . number_format($top3->harga_normal, 2, ',', '.') ?></td>
                    <td style="text-align:center"><b><span class="col-blue"><?php echo $top3->stok ?></span></b></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-12">
        <div class="card tasks_report">
          <div class="header">
            <h2><strong>Produk</strong> Rekomendasi</h2>
            <ul class="header-dropdown">
              <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                <ul class="dropdown-menu dropdown-menu-right slideUp float-right">
                  <li><a href="<?php echo base_url('admin_gulderose/produkrekomendasi') ?>">Data Produk Rekomendasi</a></li>
                </ul>
              </li>
            </ul>
          </div>
          <div class="body text-center">
            <h4 class="m-t-0">Total Produk</h4>
            <p class="m-b-20">Produk Rekomendasi dari Gulderose</p>
            <input type="text" class="knob dial1" value="<?php echo $total_produkrekomendasi ?>" data-width="140" data-height="140" data-thickness="0.1" data-fgColor="#000" readonly>
            <h6 class="m-t-25">Produk Rekomendasi</h6>
          </div>
        </div>
      </div>
    </div>
    <div class="row clearfix">
      <div class="col-sm-12">
        <div class="card">
          <div class="header">
            <h2>
              <strong>Transaksi</strong> Terbaru
              <small>Transaksi terbaru dari penjualan</small>
            </h2>
          </div>
          <div class="body">
            <div class="table-responsive social_media_table">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th style="text-align : center">No.</th>
                    <th style="text-align : center">Invoice Order</th>
                    <th style="text-align : center">Nama</th>
                    <th style="text-align : center">Via</th>
                    <th style="text-align : center">Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1;
                  foreach ($top5_transaksi as $top5) : ?>
                    <tr align='center'>
                      <td>
                        <?php echo $no++ ?>
                      </td>
                      <td>
                        <span class="text"><?php echo $top5->id_trans ?></span>
                      </td>
                      <td><?php echo $top5->nama ?></td>
                      <td><?php echo strtoupper($top5->kurir) ?></td>
                      <td>
                        <?php if ($top5->status == '1') { ?>
                          <span class="badge badge-warning">Waiting for Payment</span>
                        <?php } elseif ($top5->status == '2') { ?>
                          <span class="badge badge-success">Confirmation Success</span>
                        <?php } elseif ($top5->status == '3') { ?>
                          <span class="badge badge-info">Payment Accepted and Processing</span>
                        <?php } elseif ($top5->status == '4') { ?>
                          <span class="badge badge-info">Shipped to Destination Address</span>
                        <?php } elseif ($top5->status == '5') { ?>
                          <span class="badge badge-danger">Cancelled</span>
                        <?php } elseif ($top5->status == '0') { ?>
                          <span class="badge badge-warning">Still in the Cart</span>
                        <?php } ?>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>