<section class="content invoice">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Detail Belum Konfirmasi
                    <small>Welcome to Gulderose</small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Penjualan</a></li>
                    <li class="breadcrumb-item active">Detail Konfirmasi</li>
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
                                        </address>
                                    </div>
                                    <div class="col-md-5 col-sm-5 text-right">
                                        <p><strong>Invoice Order: </strong> #<?php echo $konfirmasi_detail->id_trans ?></p>
                                        <p class="m-b-0"><strong>Order pada: </strong> <?php echo date('d-m-Y, H:i', strtotime($konfirmasi_detail->waktu_trans)) . ' WIB' ?></p>
                                        <?php if ($konfirmasi_detail->status == '2') { ?>
                                            <p class="m-b-0"><strong>Status Order: </strong> <span class="badge bg-success"> Confirmation Success</span></p>
                                        <?php } elseif ($konfirmasi_detail->status == '3') { ?>
                                            <p class="m-b-0"><strong>Status Order: </strong> <span class="badge bg-primary"> Payment Accepted and Processing</span></p>
                                        <?php } elseif ($konfirmasi_detail->status == '4') { ?>
                                            <p class="m-b-0"><strong>Status Order: </strong> <span class="badge bg-info"> Shipped to Destination Address</span></p>
                                        <?php } elseif ($konfirmasi_detail->status == '5') { ?>
                                            <p class="m-b-0"><strong>Status Order: </strong> <span class="badge bg-danger"> Cancelled</span></p>
                                        <?php } elseif ($konfirmasi_detail->status == '1') { ?>
                                            <p class="m-b-0"><strong>Status Order: </strong> <span class="badge bg-warning"> Waiting for Payment</span></p>
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
                                                        <th class="hidden-sm-down">Ukuran</th>
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
                                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo strtoupper($konf->ukuran)?></td>
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
                                        <p><?php echo strtoupper($konfirmasi_detail->kurir) . ' ( ' . $konfirmasi_detail->service . ' )' ?></p>
                                    </div>
                                    <div class="col-md-8 text-right">
                                        <p class="m-b-0">Ongkir : <?php echo 'Rp. ' . number_format($konf->ongkir, 2, ',', '.') ?></p>
                                        <p class="m-b-0">Subtotal : <?php echo 'Rp. ' . number_format($subtotal_total_berat->subtotal, 2, ',', '.') ?></p>
                                        <h3 class="m-b-0 m-t-10">Subtotal + Ongkir : <b><?php echo 'Rp. ' . number_format($subtotal_total_berat->subtotal + $konf->ongkir, 2, ',', '.') ?></b></h3>
                                    </div>
                                </div>
                                <hr>
                                <div class="hidden-print col-md-12 text-right">
                                    <a href="<?php echo base_url('admin_gulderose/penjualan/belum-konfirmasi') ?>"><button class="btn btn-warning btn-round"><i class="zmdi zmdi-rotate-left"></i> Kembali</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="notes" aria-expanded="false">
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12">
                                <div class="card">
                                    <div class="header">
                                        <h2><strong>Invoice Order:</strong> <?php echo $konfirmasi_detail->id_trans ?></h2>
                                        <small>Order pada : <?php echo date("d-m-Y, H:i", strtotime($konfirmasi_detail->waktu_trans)) . ' WIB'; ?></small>
                                    </div>
                                    <div class="body">
                                        <h6>Bukti Pembayaran</h6>
                                        <img src="<?php echo base_url('assets/images/konfirmasi/') . $konf_data->bukti_pembayaran . $konf_data->bukti_pembayaran_type; ?>" class="img-responsive" alt="bukti_konfirmasi" height='500' width="800" align="center">
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