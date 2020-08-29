<?php
      
      defined('BASEPATH') OR exit('No direct script access allowed');
      
      class Cart extends CI_Controller 
      {
            
            public function __construct()
            {
                  parent::__construct();
                  $this->load->model('Bankasal_model');
                  $this->load->model('Banktujuan_model');
                  $this->load->model('Companyprofile_model');
                  $this->load->model('Produk_model');
                  $this->load->model('Cart_model');
                  $this->load->model('Ion_auth_model');
                  $this->load->model('Wilayah_model');
                  

                  $this->data['company_data']               = $this->Companyprofile_model->get_by_company();
                  $this->data['total_cart_navbar']          = $this->Cart_model->total_cart_navbar();
                  $this->data['cart_data']                  = $this->Cart_model->get_cart_per_customer();
                  $this->data['total_berat_subtotal']       = $this->Cart_model->get_total_berat_dan_subtotal();
                  $this->data['profil']                     = $this->Ion_auth_model->profil();
                  $this->data['customer_data']              = $this->Cart_model->get_data_customer();
                  $this->data['bank_tujuan']                = $this->Banktujuan_model->get_all();
                  $this->data['bank_tujuan_percustomer']    = $this->Cart_model->get_bank_customer();
            }
            
      
            public function index()
            {
                  $this->data['title']                   = 'Shipping Information';
                  // $this->data['total_berat_dan_subtoal'] =$this->Cart_model->get_total_berat_dan_subtotal();
                  $this->load->view('front/cart/cart', $this->data);
                  
            }

            public function buy($id)
            {
                  $row = $this->Produk_model->get_by_id($id);

                  if ($row) {

                        // cek transaksi per user (yg login)
                        $cek_transaksi = $this->Cart_model->cek_transaksi();
                        // $id_trans      = $cek_transaksi->id_trans;

                        // cek data barang yang dibeli dan masuk ke tabel transaksi_detail (ambil data trans_detail)
                        $notransdet = $this->Cart_model->get_notransdet($id);
                        

                        //jika transaksi sudah ada
                        if ($cek_transaksi) 
                        {
                              // jika produk yg dibeli sudah ada di cart == update
                              if ($notransdet) 
                              {
                                    $jmllama          = $notransdet->total_qty;
                                    $qty_new        	= $jmllama + 1;
                                    $subtotaltambah   = $qty_new * $row->harga_diskon;

                                    $jmlberatlama     = $row->berat;
                                    $jmlberattambah   = $jmlberatlama * $qty_new;
                                    
                                    $data = array(
                                          'total_qty'    => $qty_new,
                                          'total_berat'  => $jmlberattambah,
                                          'subtotal'     => $subtotaltambah   
                                    );

                                    // update transaksi
                                    $this->Cart_model->update_transdet($id, $data);
                                    $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">
                                                                        <div class="container">
                                                                              <div class="alert-icon">
                                                                                    <i class="zmdi zmdi-alert-thumb-up"></i>
                                                                              </div>
                                                                              <strong align="center" >WELL DONE!</strong> | Product added successfully
                                                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                                          <span aria-hidden="true">
                                                                                          <i class="zmdi zmdi-close"></i>
                                                                                    </span>
                                                                              </button>
                                                                        </div>
                                                                        </div>');
                                    redirect(site_url('cart'), 'refresh');

                              } else {
                                    // jika produk yg dibeli belum ada di cart == tambahkan
                                    $data2 = array(
                                          'trans_id'        => $cek_transaksi->id_trans,
                                          'user'            => $this->session->userdata('user_id'),
                                          'produk_id'       => $id,
                                          'harga'           => $row->harga_diskon,
                                          'berat'           => $row->berat,
                                          'total_qty'       => '1',
                                          'total_berat'     => $row->berat,
                                          'subtotal'        => $row->harga_diskon
                                    );

                                    $this->Cart_model->insert_detail($data2);
                                    $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">
                                                                        <div class="container">
                                                                              <div class="alert-icon">
                                                                                    <i class="zmdi zmdi-alert-thumb-up"></i>
                                                                              </div>
                                                                              <strong align="center" >WELL DONE!</strong> | Product added successfully
                                                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                                          <span aria-hidden="true">
                                                                                          <i class="zmdi zmdi-close"></i>
                                                                                    </span>
                                                                              </button>
                                                                        </div>
                                                                        </div>');
                                    redirect(site_url('cart'), 'refresh');
                              }     

                        } else {
                              // jika belum ada transaksi
                              $data = array(
                                    'user_id'  => $this->session->userdata('user_id')
                              );

                              $this->Cart_model->insert($data);
                              $cek_transaksi = $this->Cart_model->cek_transaksi();

                              $data2 = array(
                                    'trans_id'        => $cek_transaksi->id_trans,
                                    'user'            => $this->session->userdata('user_id'),
                                    'produk_id'       => $id,
                                    'harga'           => $row->harga_diskon,
                                    'berat'           => $row->berat,
                                    'total_qty'       => '1',
                                    'total_berat'     => $row->berat,
                                    'subtotal'        => $row->harga_diskon
                              );

                              $this->Cart_model->insert_detail($data2);
                              $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">
                                                                        <div class="container">
                                                                              <div class="alert-icon">
                                                                                    <i class="zmdi zmdi-alert-thumb-up"></i>
                                                                              </div>
                                                                              <strong align="center" >WELL DONE!</strong> | Product added successfully
                                                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                                          <span aria-hidden="true">
                                                                                          <i class="zmdi zmdi-close"></i>
                                                                                    </span>
                                                                              </button>
                                                                        </div>
                                                                        </div>');
                              redirect(site_url('cart'), 'refresh');

                        }

                  } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
                                                                        <div class="container">
                                                                              <div class="alert-icon">
                                                                                    <i class="zmdi zmdi-alert-thumb-up"></i>
                                                                              </div>
                                                                              <strong align="center" >Data not found
                                                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                                          <span aria-hidden="true">
                                                                                          <i class="zmdi zmdi-close"></i>
                                                                                    </span>
                                                                              </button>
                                                                        </div>
                                                                        </div>');
                        redirect(site_url('cart'), 'refresh');
                  }
            }

            public function update($id)
            {
                  $id   = $this->input->post('produk_id');
                  $row  = $this->Produk_model->get_by_id($id);

                  if (isset($_POST['update'])) 
                  {
                        $qty_new          = $this->input->post('qty');
                        $subtotaltambah   = $qty_new * $row->harga_diskon;

                        $jmlberatlama     = $row->berat;
                        $jmlberattambah   = $jmlberatlama * $qty_new;      

                        $data =array(
                              'total_qty'       => $this->input->post('qty'),
                              'total_berat'     => $jmlberattambah,
                              'subtotal'        => $subtotaltambah
                        );

                        $this->Cart_model->update_transdet($id, $data);
                        $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">
                                                                        <div class="container">
                                                                              <div class="alert-icon">
                                                                                    <i class="zmdi zmdi-alert-thumb-up"></i>
                                                                              </div>
                                                                              <strong align="center" >WELL DONE!</strong> | The cart was updated successfully
                                                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                                          <span aria-hidden="true">
                                                                                          <i class="zmdi zmdi-close"></i>
                                                                                    </span>
                                                                              </button>
                                                                        </div>
                                                                        </div>');
                        redirect(site_url('cart'), 'refresh');

                  } elseif(isset($_POST['delete'])) {

                        if ($row) 
                        {
                              $cek_transaksi    = $this->Cart_model->cek_transaksi();
                              $id_trans         = $cek_transaksi->id_trans;

                              $this->Cart_model->delete($id, $id_trans);
                              $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                                                                        <div class="container">
                                                                              <div class="alert-icon">
                                                                                    <i class="zmdi zmdi-alert-thumb-up"></i>
                                                                              </div>
                                                                              <strong align="center" >WELL DONE!</strong> | The cart was deleted successfully
                                                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                                          <span aria-hidden="true">
                                                                                          <i class="zmdi zmdi-close"></i>
                                                                                    </span>
                                                                              </button>
                                                                        </div>
                                                                        </div>');
                              redirect(site_url('cart'), 'refresh');

                        } else {
                              // jika produk tidak ada
                              $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
                                                                        <div class="container">
                                                                              <div class="alert-icon">
                                                                                    <i class="zmdi zmdi-alert-thumb-up"></i>
                                                                              </div>
                                                                              <strong align="center" >Transaction not found
                                                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                                          <span aria-hidden="true">
                                                                                          <i class="zmdi zmdi-close"></i>
                                                                                    </span>
                                                                              </button>
                                                                        </div>
                                                                        </div>');
                              redirect(site_url('cart'), 'refresh');
                        }
                  }

                  
            }

            public function delete_cart($id, $id_trans)
            {
                  $cek_transaksi    = $this->Cart_model->cek_transaksi();
                  $id_trans         = $cek_transaksi->id_trans;
                  $row = $this->Cart_model->get_by_id($id, $id_trans);

                  if ($row) 
                  {
                        $this->Cart_model->delete($id);
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                                                                  <div class="container">
                                                                        <div class="alert-icon">
                                                                              <i class="zmdi zmdi-thumb-up"></i>
                                                                        </div>
                                                                        <strong>WELL DONE!</strong> | Transaction deleted successfully
                                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                                    <span aria-hidden="true">
                                                                                    <i class="zmdi zmdi-close"></i>
                                                                              </span>
                                                                        </button>
                                                                  </div>
                                                                  </div>');
                        redirect(site_url('cart'));
                  }
                  else {
                        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
                                                                  <div class="container">
                                                                        <div class="alert-icon">
                                                                              <i class="zmdi zmdi-alert-circle-o"></i>
                                                                        </div>
                                                                        <strong>WARNING!</strong> | Tramsaction not found
                                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                                    <span aria-hidden="true">
                                                                                    <i class="zmdi zmdi-close"></i>
                                                                              </span>
                                                                        </button>
                                                                  </div>
                                                                  </div>');
                        redirect(site_url('cart'));
                  }
            }

            public function empty_cart($id_trans)
            {
                  $id_transdet = $this->uri->segment(3);
                  $this->Cart_model->kosongkan_keranjang($id_trans);

                  $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                                                                        <div class="container">
                                                                              <div class="alert-icon">
                                                                                    <i class="zmdi zmdi-alert-thumb-up"></i>
                                                                              </div>
                                                                              <strong align="center" >WELL DONE!</strong> | Your cart has been empty
                                                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                                          <span aria-hidden="true">
                                                                                          <i class="zmdi zmdi-close"></i>
                                                                                    </span>
                                                                              </button>
                                                                        </div>
                                                                        </div>');
                  redirect(site_url('cart'));


            }

            public function order_details()
            {
                  $this->data['order-details'] = 'Order Details';
                  $this->load->view('front/auth/order-details', $this->data);
            }

            public function order_information()
            {
                  // cek hak akses login apakah buyer ato bukan
                  if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_buyer())) {
                        redirect(base_url());
                  }

                  $this->data['title']  = 'Order Information';

                  $row       = $this->Ion_auth_model->profil();
                  $prov_id   = $row->id_provinsi;
                  $kota_id   = $row->id_kota;

                  if ($row) {
                        $this->data['provinsi_id'] = array(
                              'name'        => 'provinsi_id',
                              'id'          => 'provinsi_id',
                              'class'       => 'form-control',
                              'onChange'    => 'tampilKota()',
                              'required'    => '',
                              'disabled'    => ''
                        );
                        $this->data['kota_id'] = array(
                              'name'        => 'kota_id',
                              'id'          => 'kota_id',
                              'class'       => 'form-control',
                              'required'    => '',
                              'disabled'    => ''
                        );

                        $this->data['bank_transfer'] = array(
                              'name'        => 'bank_transfer',
                              'id'          => 'bank_transfer',
                              'class'       => 'form-control',
                              'required'    => '',
                        );

                        $this->data['ambil_provinsi']       = $this->Wilayah_model->get_provinsi();
                        $this->data['ambil_kota']           = $this->Wilayah_model->get_kota($prov_id);
                        $this->data['ambil_banktujuan']     = $this->Banktujuan_model->get_banktujuan();

                        $this->load->view('front/cart/order-information', $this->data);

                  }
            }

            public function order_information_action()
            {
                  $this->data['title']    = 'Order Information Process';

                  $data = array(
                        'kurir'           => $this->input->post('kurir'),
                        'ongkir'          => $this->input->post('ongkir'),
                        'service'         => $this->input->post('service'),
                        'banktujuan_id'   => $this->input->post('bank_transfer'),
                        'status'          => '0'
                  );

                  $this->Cart_model->order_process($this->input->post('id_trans'), $data);
                  $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">
                                                                  <div class="container">
                                                                        <div class="alert-icon">
                                                                              <i class="zmdi zmdi-thumb-up"></i>
                                                                        </div>
                                                                        <strong>WELL DONE!</strong> | Order Success
                                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                                    <span aria-hidden="true">
                                                                                    <i class="zmdi zmdi-close"></i>
                                                                              </span>
                                                                        </button>
                                                                  </div>
                                                                  </div>');
                  redirect(site_url('checkout/process'));
            }

            public function checkout_process()
            {
                  $this->data['checkout'] = 'Checkout';
                  
                  $this->load->view('front/cart/checkout_process', $this->data);
            }

            // setelah diklik PLACE ORDER
            public function checkout_finished()
            {
                  $this->data['title'] = 'Checkout Selesai';
                  $data = array(
                        'status'          => '1',
                        'waktu_trans'     => date("Y-m-d H:i:s")
                  );
                  $id_trans = $this->input->post('id_trans');
                  
                  $this->Cart_model->checkout($id_trans, $data);

                  $this->data['cart_finished']	    		= $this->Cart_model->get_cart_per_customer_finished($id_trans);
                  $this->data['customer_data'] 			= $this->Cart_model->get_data_customer_invoice($id_trans);
                  $this->data['total_berat_dan_subtotal']   = $this->Cart_model->get_total_berat_dan_subtotal_finished($id_trans);
                  $this->data['bank_destination']           = $this->Cart_model->get_data_bank_customer($id_trans);

                  $this->load->view('front/cart/checkout_finished', $this->data);
                  
                  // redirect(site_url('checkout/finished'));
            }

            public function download_invoice($id)
            {
                  $row       = $this->Cart_model->get_by_id($id);

                  if ($row) {
                        ob_start();

                        $this->data['cart_finished']               = $this->Cart_model->get_cart_per_customer_finished($id);
                        $this->data['total_berat_dan_subtotal']    = $this->Cart_model->get_total_berat_dan_subtotal_finished($id);
                        $this->data['customer_data_invoice']       = $this->Cart_model->get_data_customer_invoice($id);
                        $this->data['order_history_detail_row']    = $this->Cart_model->order_history_detail($id)->row();
                        $this->data['bank_destination']            = $this->Cart_model->get_data_bank_customer($id);

                        $this->load->view('front/cart/download-invoice', $this->data);

                        $html = ob_get_contents();
                        $html = '<title style="font-family: freeserif">' . nl2br($html) . '</title>';
                        ob_end_clean();

                        require_once('application/libraries/html2pdf/html2pdf.class.php');
                        $pdf = new HTML2PDF('P', 'A4', 'en', true, 'UTF-8', array(10, 0, 10, 0));
                        $pdf->setDefaultFont('Arial');
                        $pdf->setTestTdInOnePage(false);
                        $pdf->WriteHTML($html);
                        $pdf->Output('invoice-gulderose.pdf');
                  } else {
                        $this->session->set_flashdata('message', "<script>alert('Data tidak ditemukan');</script>");
                        redirect(site_url());
                  }
            }


            public function kurirdata()
            {
                  $this->load->library('rajaongkir');
                  $tujuan     = $this->input->get('kota');
                  $dari       = '181';
                  $berat      = $this->input->get('berat');
                  $kurir      = $this->input->get('kurir');
                  $dc         = $this->rajaongkir->cost($dari, $tujuan, $berat, $kurir);
                  $data       = json_decode($dc, TRUE);
                  $o          = '';

                  if (!empty($data['rajaongkir']['results'])) 
                  {
                        $data['data'] = $data['rajaongkir']['results'][0]['costs'];
                        $this->load->view('front/cart/datakurir', $data);
                  }
            }
            
      }
      
      /* End of file Cart.php */
      
?>