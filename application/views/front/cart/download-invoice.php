<html xmlns="http://www.w3.org/1999/xhtml">

<head>
      <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
      <title>Gulderose Bunga Flanel</title>
      <meta name="author" content="Firza Affan Harista">
      <meta name="owner" content="Gulderose Bunga Flanel Kendal">
      <meta name="url" content="https://www.gulderose.com/">
      <link rel="icon" href="<?php echo base_url('assets/template/frontend/') . $company_data->foto . $company_data->foto_type; ?>" type="image/x-icon" />

</head>

<body>
      <table align="center">
            <tr>
                  <th rowspan="3"></th>
                  <td align="center">
                        <img src="<?php echo base_url('assets/images/company/') . $company_data->foto . $company_data->foto_type; ?>" width='60' alt="Gulderose_product"> <br>
                        <font style="font-size: 18px"><b><?php echo $company_data->nama_company; ?></b></font>
                        <br><?php echo $company_data->alamat_company; ?>
                        <br>Phone : <?php echo $company_data->no_hp; ?> | Telp: <?php echo $company_data->no_hp; ?> | Email: <?php echo $company_data->email_company; ?>
                  </td>
            </tr>
      </table>
      <hr />
      <div align="center"><b>INVOICE ORDER #<?php echo $this->uri->segment('2'); ?></b> <br>
            <?php if ($order_history_detail_row->status == '1') { ?>
                  <strong style="color: orange">( Waiting for Payment ! )</strong>
            <?php } elseif ($order_history_detail_row->status == '2') { ?>
                  <strong style="color: green">( Confirmation Success )</strong>
            <?php } elseif ($order_history_detail_row->status == '3') { ?>
                  <strong style="color: blue">( Payment Accepted and Processing )</strong>
            <?php } elseif ($order_history_detail_row->status == '4') { ?>
                  <strong style="color: blue">( Shipped to Destination Address )</strong>
            <?php } elseif ($order_history_detail_row->status == '5') { ?>
                  <strong style="color: red">( Cancelled )</strong>
            <?php } ?>
      </div>
      <?php if ($this->session->userdata('user_id') != NULL) { ?>
            <table>
                  <thead>
                        <tr>
                              <th style="text-align: center; background: #ddd; width: 30px">No.</th>
                              <th style="text-align: center; background: #ddd; width: 50px">Product</th>
                              <th style="text-align: center; background: #ddd; width: 205px">Product Name</th>
                              <th style="text-align: center; background: #ddd; width: 30px">Size</th>
                              <th style="text-align: center; background: #ddd; width: 120px">Price</th>
                              <th style="text-align: center; background: #ddd; width: 70px">Weight</th>
                              <th style="text-align: center; background: #ddd; width: 30px">Qty</th>
                              <th style="text-align: center; background: #ddd; width: 130px">Total</th>
                        </tr>
                  </thead>
                  <tbody>
                        <?php $no = 1;
                        foreach ($cart_finished as $cart) { ?>
                              <tr>
                                    <td style="text-align:center;width: 30px"><?php echo $no++ ?></td>
                                    <td style="text-align:center;width: 30px"><img src="<?php echo base_url('assets/images/produk/') . $cart->foto . $cart->foto_type; ?>" width='60' alt="Gulderose_product"></td>
                                    <td style="text-align:center;width: 205px"><?php echo $cart->judul_produk ?></td>
                                    <td style="text-align:center;width: 30px"><?php echo strtoupper($cart->ukuran) ?></td>
                                    <td style="text-align:center;width: 120px"><?php echo 'Rp. ' . number_format($cart->harga_diskon, 2, ',', '.') ?></td>
                                    <td style="text-align:center;width: 30px"><?php echo $cart->berat ?> </td>
                                    <td style="text-align:center;width: 30px"><?php echo $cart->total_qty ?></td>
                                    <td style="text-align:center;width: 130px"><?php echo 'Rp. ' . number_format($cart->subtotal, 2, ',', '.') ?></td>
                              </tr>
                        <?php } ?>
                  </tbody>
            </table>
            <table align="right">
                  <tbody>
                        <tr>
                              <th>Amount of Weight</th>
                              <td colspan="2" align="right"><?php echo $total_berat_dan_subtotal->total_berat ?> (gram) / <?php echo ($total_berat_dan_subtotal->total_berat / 1000) ?> (kg)</td>
                        </tr>
                        <tr>
                              <th>SubTotal</th>
                              <td></td>
                              <td align="right"><?php echo 'Rp. ' . number_format($total_berat_dan_subtotal->subtotal, 2, ',', '.') ?></td>
                        </tr>
                        <tr>
                              <th>Shipping Cost</th>
                              <td align="right">Via: <?php echo strtoupper($customer_data_invoice->kurir) . ' ' . $customer_data_invoice->service ?></td>
                              <td align="right"><?php echo 'Rp. ' . number_format($customer_data_invoice->ongkir, 2, ',', '.') ?></td>
                        </tr>
                        <tr>
                              <h4>
                                    <th scope="row">Grand Total</th>
                                    <td align="right"></td>
                                    <td align="right"><b><?php echo 'Rp. ' . number_format($customer_data_invoice->ongkir + $total_berat_dan_subtotal->subtotal, 2, ',', '.') ?></b></td>
                              </h4>
                        </tr>
                        <tr>
                              <h4>
                                    <th scope="row"></th>
                                    <td align="right"></td>
                                    <td align="right"><?php if ($order_history_detail_row->status == '2' || $order_history_detail_row->status == '3' || $order_history_detail_row->status == '4') { ?>
                                                <img src="<?php echo base_url('assets/images/lunas.png') ?>" alt="lunas" width='140' height="45">
                                          <?php } else {
                                                            echo "";
                                                      } ?>
                                    </td>
                              </h4>
                        </tr>
                  </tbody>
            </table>
            <div><?php if ($order_history_detail_row->resi == NULL) {
                        echo ' ';
                  } else {
                        echo '<b>RESI :</b> ' . $order_history_detail_row->resi;
                  } ?></div>
            <div><b>BANK TRANSFER DESTINATION : </b> <?php echo $bank_destination->nama_banktujuan ?> </div>
            <table border="1">
                  <tr>
                        <td width='345'>
                              <div><b>BILLING ADDRESS</b></div>
                              <?php echo $customer_data_invoice->nama ?><br>
                              <?php echo $customer_data_invoice->phone ?><br>
                              <?php echo $customer_data_invoice->address . ', ' . $customer_data_invoice->nama_kota . ', ' . $customer_data_invoice->nama_provinsi ?><br>
                        </td>
                        <td width='345'>
                              <div><b>DESTINATION ADDRESS</b></div>
                              <?php echo $customer_data_invoice->nama ?><br>
                              <?php echo $customer_data_invoice->phone ?><br>
                              <?php echo $customer_data_invoice->address . ', ' . $customer_data_invoice->nama_kota . ', ' . $customer_data_invoice->nama_provinsi ?><br>
                        </td>
                  </tr>
            </table>

            <?php if ($order_history_detail_row->status == '1') { ?>
                  <b>ATTENTION</b>
                  <ul>
                        <li>Please confirm payment on the website or contact us directly to the customer service provided and attach a photo of proof of payment.</li>
                        <li>We will immediately process your order after getting confirmation of payment as soon as possible.</li>
                        <li>Products will be sent H+7 after payment is verified</li>
                  </ul>
                  <div>
                        <p align="center">Thank you for shopping with us.</p>
                  </div>
            <?php } elseif ($order_history_detail_row->status == '2' || $order_history_detail_row->status == '3' || $order_history_detail_row->status == '4') { ?>
                  <div>
                        <p align="center">Thank you for shopping with us.</p>
                  </div>
            <?php } ?>
      <?php } ?>
</body>

</html><!-- Akhir halaman HTML yang akan di konvert -->