<section class="content invoice">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Detail Sudah Konfirmasi
                    <small>Welcome to Gulderose</small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Penjualan</a></li>
                    <li class="breadcrumb-item active">Invoice</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2><strong></strong> Penjualan Gulderose Bunga Flanel</h2>
                        <ul class="header-dropdown">
                            <li class="remove">
                                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <h3 class="m-b-0">Invoice Details : <strong class="text-primary">#<?php echo $konfirmasi_detail->id_trans ?></strong></h3>
                        <?php if ($konfirmasi_detail->status == '1' && '2') {
                            echo ' '; ?>
                        <?php } else { ?>
                            <ul class="nav nav-tabs">
                                <li class="nav-item inlineblock"><a class="nav-link active" data-toggle="tab" href="#details" aria-expanded="true">Detail</a></li>
                                <li class="nav-item inlineblock"><a class="nav-link" data-toggle="tab" href="#produk" aria-expanded="false">Produk</a></li>
                                <li class="nav-item inlineblock"><a class="nav-link" data-toggle="tab" href="#notes" aria-expanded="false">Bukti Pembayaran</a></li>
                            </ul>
                        <?php } ?>
                    </div>
                </div>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane in active" id="details" aria-expanded="true">
                        <div class="card" id="details">
                            <div class="body">
                                <div class="row">
                                    <div class="col-md-7 col-sm-7">
                                        <address>
                                            <strong><?php echo $konfirmasi_detail->nama; ?></strong><br>
                                            <?php echo $konfirmasi_detail->address ?><br>
                                            <?php echo $konfirmasi_detail->nama_kota ?><br>
                                            <?php echo $konfirmasi_detail->nama_provinsi ?> <br>
                                            <abbr title="Phone"></abbr> <?php echo $konfirmasi_detail->phone ?>
                                            <?php if ($konfirmasi_detail->status == '2' || $konfirmasi_detail->status == '3' || $konfirmasi_detail->status =='4' ) { ?>
                                                <p class="m-b-0"><strong>Bank Pengirim : </strong>
                                                <?php echo $konf_data->nama_bankasal;
                                            } else {
                                                echo '';
                                            } ?> </p>
                                        </address>
                                    </div>
                                    <div class="col-md-5 col-sm-5 text-right">
                                        <p><strong>Invoice Order: </strong> #<?php echo $konfirmasi_detail->id_trans ?></p>
                                        <p class="m-b-0"><strong>Order pada: </strong> <?php echo date('d-m-Y, H:i', strtotime($konfirmasi_detail->waktu_trans)) . ' WIB' ?></p>
                                        <?php if ($konfirmasi_detail->status == '2') { ?>
                                            <p class="m-b-0"><strong>Status Order: </strong> <span class="badge bg-success"> Confirmation Success</span></p>
                                        <?php } elseif ($konfirmasi_detail->status == '3') { ?>
                                            <p class="m-b-0"><strong>Status Order: </strong> <span class="badge bg-info"> Payment Accepted and Processing</span></p>
                                        <?php } elseif ($konfirmasi_detail->status == '4') { ?>
                                            <p class="m-b-0"><strong>Status Order: </strong> <span class="badge bg-info"> Shipped to Destination Address</span></p>
                                        <?php } elseif ($konfirmasi_detail->status == '5') { ?>
                                            <p class="m-b-0"><strong>Status Order: </strong> <span class="badge bg-danger"> Cancelled</span></p>
                                        <?php } ?>
                                        <p><strong>Bank Tujuan : </strong><?php echo $konfirmasi_detail->nama_banktujuan ?></p>
                                    </div>
                                </div>
                                <div class="mt-40"></div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th width="60px">Produk</th>
                                                        <th>Nama Produk</th>
                                                        <th>Jumlah Produk</th>
                                                        <th class="hidden-sm-down">Harga Satuan</th>
                                                        <th>Total Harga</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1;
                                                    foreach ($konf_data2 as $konf) : ?>
                                                        <tr>
                                                            <td><?php echo $no++ ?></td>
                                                            <td><img src="<?php echo base_url('assets/images/produk/') . $konf->foto . $konf->foto_type; ?>" alt="Product img"></td>
                                                            <td><?php echo $konf->judul_produk ?></td>
                                                            <td align="center"><?php echo $konf->total_qty ?></td>
                                                            <td><?php echo 'Rp. ' . number_format($konf->harga, 2, ',', '.') ?></td>
                                                            <td><?php echo 'Rp. ' . number_format($konf->subtotal, 2, ',', '.') ?></td>
                                                        </tr>
                                                    <?php endforeach ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <h6>Pengiriman Via :</h6>
                                        <p><?php echo strtoupper($konf->kurir) . ' ( ' . $konf->service . ' )' ?></p>
                                        <p>Dikirim pada : <?php if ($konf->waktu_kirim == NULL) {
                                            echo "<b>Belum Dikirim</b>";
                                        } else {
                                            echo date("d-m-Y", strtotime($konf->waktu_kirim));
                                        }?></p>
                                    </div>
                                    <div class="col-md-8 text-right">
                                        <p class="m-b-0">Ongkir : <?php echo 'Rp. ' . number_format($konf->ongkir, 2, ',', '.') ?></p>
                                        <p class="m-b-0">Subtotal : <?php echo 'Rp. ' . number_format($subtotal_total_berat->subtotal, 2, ',', '.') ?></p>
                                        <h3 class="m-b-0 m-t-10">Subtotal + Ongkir : <b><?php echo 'Rp. ' . number_format($subtotal_total_berat->subtotal + $konf->ongkir, 2, ',', '.') ?></b></h3>
                                    </div>
                                </div>
                                <hr>
                                <div class="hidden-print col-md-12 text-right">
                                    <?php if ($konfirmasi_detail->status == '3') { ?>
                                        <a href="<?php echo base_url('admin_gulderose/penjualan/pembayaran-diterima-dan-diproses') ?>">
                                        <?php } elseif ($konfirmasi_detail->status == '4') { ?>
                                            <a href="<?php echo base_url('admin_gulderose/penjualan/dikirim') ?>">
                                            <?php } elseif ($konfirmasi_detail->status == '5') { ?>
                                                <a href="<?php echo base_url('admin_gulderose/penjualan/dibatalkan') ?>">
                                                <?php } ?>
                                                <button class="btn btn-warning btn-round"><i class="zmdi zmdi-rotate-left"></i> Kembali</button>
                                                </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="notes" aria-expanded="false">
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12">
                                <div class="card">
                                    <div class="header">
                                        <h2><strong>Invoice Order:</strong> #<?php echo $konfirmasi_detail->id_trans ?></h2>
                                        <small>Order pada : <?php echo date("d-m-Y, H:i", strtotime($konfirmasi_detail->waktu_trans)) . ' WIB'; ?></small> <br>
                                        <?php if (empty($get_konfirmasi->trans_id)) {
                                            echo "";
                                        } else { ?>
                                            <small>Waktu Konfirmasi ( Pembeli ) : <?php echo date("d-m-Y, H:i", strtotime($get_konfirmasi->waktu_konfirmasi)) . ' WIB' ?></small> <br><br>
                                            <small>Dikonfirmasi Oleh : <?php echo $get_konfirmasi->nama ?><?php if ($get_konfirmasi->dilakukan_oleh == '1') {
                                                                                                                echo " ( Superadmin )";
                                                                                                            } elseif ($get_konfirmasi->dilakukan_oleh == '2') {
                                                                                                                echo " ( Admin )";
                                                                                                            } ?></small> <br>
                                            <small>Pada Waktu : <?php echo date("d-m-Y, H:i", strtotime($get_konfirmasi->waktu_dikonfirmasi)) . ' WIB' ?></small>
                                        <?php } ?>
                                    </div>
                                    <div class="body">
                                        <h6>Bukti Pembayaran</h6>
                                        <?php if (!empty($konf_data->bukti_pembayaran)) { ?>
                                            <img src="<?php echo base_url('assets/images/konfirmasi/') . $konf_data->bukti_pembayaran . $konf_data->bukti_pembayaran_type; ?>" class="img-responsive" alt="bukti_konfirmasi" height='500' width="800" align="center">
                                        <?php } else {
                                            echo "- Belum melakukan konfirmasi pembayaran -";
                                        }?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="produk" aria-expanded="false">
                        <div class="row clearfix">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="body">
                                        <?php foreach ($konf_data2 as $produk) : ?>
                                            <div class="row">
                                                <div class="preview col-lg-4 col-md-12">
                                                    <div class="preview-pic tab-content">
                                                        <div class="tab-pane active" id="product_1"><img src="<?php echo base_url('assets/images/produk/') . $produk->foto . $produk->foto_type; ?>" class="img-fluid" /></div>
                                                    </div>
                                                </div>
                                                <div class="details col-lg-8 col-md-12">
                                                    <h3 class="product-title m-b-0"><?php echo $produk->judul_produk; ?></h3>
                                                    <hr>
                                                    <p class="product-description"><?php echo $produk->deskripsi ?></p>
                                                    <p class="vote"><strong>Ukuran : </strong> <?php echo strtoupper($produk->ukuran) ?></strong></p>
                                                    <h5 class="sizes">Jumlah Produk :
                                                        <span class="size" title="small"><?php echo $produk->total_qty ?></span>
                                                    </h5>
                                                </div>
                                            </div>
                                            <br>
                                            <hr>
                                        <?php endforeach; ?>
                                        <h5 class="sizes">Total Berat :
                                            <span class="size" title="small"> <?php echo $subtotal_total_berat->total_berat ?> gram ( <?php echo $subtotal_total_berat->total_berat / 1000 ?> kg )</span>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>