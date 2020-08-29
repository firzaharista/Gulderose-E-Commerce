<?php
$tgl_awal   = tgl_indo($this->input->post('tgl_awal'));
$tgl_akhir  = tgl_indo($this->input->post('tgl_akhir'));

header("Content-Type: application/force-download");
header("Cache-Control: no-cache, must-revalidate");
header("content-disposition: attachment;filename=Laporan_Penjualan_Periode_" . $tgl_awal . "-" . $tgl_akhir . ".xls");
?>

<div align="center">
      <h3><?php echo $company_data->nama_company ?></h3>
</div>
<div align="center"><?php echo $company_data->alamat_company ?></div>
<hr>
<hr>
<center>LAPORAN PENJUALAN PERIODE <?php echo "$tgl_awal - $tgl_akhir" ?></center>

<br>

<table border="1">
      <thead>
            <tr>
                  <td style="text-align: center; background: #DCDCDC;"><b>No.</b></td>
                  <td style="text-align: center; background: #DCDCDC;"><b>Invoice Order</b></td>
                  <td style="text-align: center; background: #DCDCDC;"><b>Nama Produk</b></td>
                  <td style="text-align: center; background: #DCDCDC;"><b>Qty</b></td>
                  <td style="text-align: center; background: #DCDCDC;"><b>Harga Satuan</b></td>
                  <td style="text-align: center; background: #DCDCDC;"><b>Total Harga</b></td>
                  <td style="text-align: center; background: #DCDCDC;"><b>Oleh</b></td>
                  <td style="text-align: center; background: #DCDCDC;"><b>Status</b></td>
                  <td style="text-align: center; background: #DCDCDC;"><b>Pengiriman</b></td>
                  <td style="text-align: center; background: #DCDCDC;"><b>Resi</b></td>
                  <td style="text-align: center; background: #DCDCDC;"><b>Waktu Transaksi</b></td>
                  <td style="text-align: center; background: #DCDCDC;"><b>Waktu Dikirim (Input Resi)</b></td>
            </tr>
      </thead>
      <tbody>
            <?php
            $start = 1;
            $last_id = NULL;

            foreach ($get_periode as $export) {
                  if ($export->id_trans != $last_id) {
                        $nom = $start++;
                        $id_trans   = $export->id_trans;
                        $nama       = $export->nama;
                        $status     = $export->status;
                        $kurir      = $export->kurir;
                        $service    = $export->service;
                        $pengiriman = strtoupper($kurir) . ' ' . '( ' . $service . ' )';
                        $ongkir     = 'Rp. ' . number_format($export->ongkir, 2, ',', '.');
                        $resi       = $export->resi;
                        $waktu_trans = date('d-m-Y, H:i', strtotime($export->waktu_trans)) . ' WIB';
                        $waktu_kirim = date('d-m-Y, H:i', strtotime($export->waktu_kirim)) . ' WIB';
                  } else {
                        $nom = '';
                        $id_trans   = '';
                        $nama       = '';
                        $status     = '';
                        $pengiriman = '';
                        $ongkir     = '';
                        $resi       = '';
                        $waktu_trans = '';
                        $waktu_kirim = '';
                  }
            ?>
                  <tr>
                        <td style="text-align: center;vertical-align: middle"><?php echo $nom; ?></td>
                        <td style="text-align: center;vertical-align: middle"><?php echo $id_trans; ?></td>
                        <td style="text-align: center;vertical-align: middle"><?php echo $export->judul_produk; ?></td>
                        <td style="text-align: center;vertical-align: middle"><?php echo $export->total_qty; ?></td>
                        <td style="text-align: center;vertical-align: middle"><?php echo 'Rp. ' . number_format($export->harga, 2, ',', '.') ?></td>
                        <td style="text-align: center;vertical-align: middle"><?php echo 'Rp. ' . number_format($export->subtotal, 2, ',', '.') ?></td>
                        <td style="text-align: center;vertical-align: middle"><?php echo $nama; ?></td>
                        <td style="text-align: center;vertical-align: middle">
                              <?php
                              if ($status == '1') {
                                    echo 'Waiting for Payment';
                              } elseif ($status == '2') {
                                    echo 'Confirmation Success';
                              } elseif ($status == '3') {
                                    echo 'Payment Accepted and Processing';
                              } elseif ($status == '4') {
                                    echo 'Shipped to destination address';
                              } elseif ($status == '5') {
                                    echo 'Cancelled';
                              }
                              ?>
                        </td>
                        <td style="text-align: center;vertical-align: middle"><?php echo $pengiriman; ?></td>
                        <td style="text-align: center;vertical-align: middle"><?php echo $resi; ?></td>
                        <td style="text-align: center;vertical-align: middle"><?php echo $waktu_trans; ?></td>
                        <td style="text-align: center;vertical-align: middle">
                              <?php if ($resi == NULL) {
                                    echo ' ';
                              } else {
                                    echo date('d-m-Y, H:i', strtotime($waktu_kirim)) . ' WIB';
                              } ?>
                        </td>
                  </tr>
            <?php 
            $last_id = $export->id_trans;
      } ?>
      </tbody>
</table>
<div class="row">
      <div class="col-lg-12">
            <table class="table table-hover table-bordered table-striped table-responsive">
                  <tbody>
                        <tr>
                              <th scope="row">
                                    <h4><b>Total Penjualan :</b></h4>
                              </th>
                              <th scope="row">
                                    <h4><b><?php echo 'Rp. ' . number_format($total_penjualan_periode->subtotal, 2, ',', '.'); ?></b></h4>
                              </th>
                        </tr>
                  </tbody>
            </table>
            <div align="left">
                  <p>Catatan : total penjualan = jumlah dari total harga penjualan produk yang telah dikirim dan tidak termasuk biaya pengiriman (ongkir)</p>
            </div>
      </div>
</div>