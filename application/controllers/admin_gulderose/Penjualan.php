<?php
      
      defined('BASEPATH') OR exit('No direct script access allowed');
      
      class Penjualan extends CI_Controller 
      {
            
            public function __construct()
            {
                  parent::__construct();
                  $this->data['modul']   = 'Penjualan';
                  $this->data['modul_k'] = 'Konfirmasi';

                  $this->load->model('Penjualan_model');
                  $this->load->model('Companyprofile_model');
                  $this->load->model('Cart_model');
                  $this->load->model('Payment_model');
                  $this->load->model('Produk_model');
                  $this->load->model('Penjualan_model');
                  
                  $this->data['company_data']           = $this->Companyprofile_model->get_by_company();
                  $this->data['navbar_transaksi']       = $this->Penjualan_model->top5_transaksi_sudah_konfirmasi()->result();
                  $this->data['navbar_transaksi_row']   = $this->Penjualan_model->top5_transaksi_sudah_konfirmasi()->row();


                  if (!$this->ion_auth->logged_in()) //buat dicek sudah login ato belum
                  {
                        redirect('admin_gulderose/auth/login', 'refresh');
                  }

                  // cek apakah yg login superadmin, admin ato bukan
                  elseif (!$this->ion_auth->is_superadmin() && !$this->ion_auth->is_admin()) 
                  {
                        redirect('admin_gulderose/auth/login', 'refresh');
                  }
            }
            
            public function index()
            {
                  $this->data['title'] = 'Data Penjualan';
                  $this->template->load('template','back/penjualan/penjualan_list',$this->data);
            }

            public function belum_konfirmasi()
            {
                  $this->data['title']                = 'Data Belum Konfirmasi';
                  $this->data['get_belum_konfir']     = $this->Penjualan_model->get_belum_konfirmasi();

                  $this->template->load('template', 'back/penjualan/konfirmasi_belum_list',$this->data);
            }

            public function detail_belum_konfirmasi($id)
            {
                  $this->data['konfirmasi_detail']    = $this->Penjualan_model->get_by_id_detail_konfirmasi($id);
                  $this->data['konf_data']            = $this->Penjualan_model->get_by_id2($id);
                  $this->data['konf_data2']           = $this->Penjualan_model->get_by_id3($id);
                  $this->data['subtotal_total_berat'] = $this->Penjualan_model->order_subtotal_dan_berat($id);
                  $this->template->load('template', 'back/penjualan/konfirmasi_belum_detail', $this->data);
            }

            public function sudah_konfirmasi()
            {
                  $this->data['title']                = 'Data Sudah Konfirmasi';
                  $this->data['get_sudah_konfir']     = $this->Penjualan_model->get_sudah_konfirmasi();

                  $this->template->load('template', 'back/penjualan/konfirmasi_sudah_list',$this->data);
            }

            public function detail_konfirmasi($id)
            {     
                  $this->data['konfirmasi_detail']    = $this->Penjualan_model->get_by_id_detail_konfirmasi($id);
                  $this->data['konf_data']            = $this->Penjualan_model->get_by_id2($id);
                  $this->data['konf_data2']           = $this->Penjualan_model->get_by_id3($id);
                  $this->data['subtotal_total_berat'] = $this->Penjualan_model->order_subtotal_dan_berat($id);
                  $this->template->load('template', 'back/penjualan/konfirmasi_detail', $this->data);
            }

            public function pembayaran_diterima_dan_diproses()
            {
                  $this->data['title']          = 'Data Transaksi Diproses';
                  $this->data['get_processing'] = $this->Penjualan_model->get_payment_accepted_dan_processing();

                  $this->template->load('template', 'back/penjualan/penjualan_diproses_list',$this->data);
            }

            public function input_resi($id)
            {
                  $this->data['title']          = 'Input Resi';
                  $this->data['input_resi']     = $this->Penjualan_model->get_by_id($id);
                  $row = $this->Penjualan_model->get_by_id($id);

                  if ($row) {
                        $this->template->load('template', 'back/penjualan/input_resi', $this->data);      
                  }
                  
            }

            public function input_resi_action()
            {
                  $this->data['title'] = 'Update Resi';
                  
                  $data = array(
                        'status'    => '4',
                        'resi'      => $this->input->post('resi')
                  );

                  $this->Penjualan_model->update_data($this->input->post('id_trans'), $data);
                  $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">
                                                            <div class="container">
                                                                  <div class="alert-icon">
                                                                        <i class="zmdi zmdi-thumb-up"></i>
                                                                  </div>
                                                                  <strong>WELL DONE!</strong> | Input resi berhasil dan orderan telah dikirim
                                                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                              <span aria-hidden="true">
                                                                              <i class="zmdi zmdi-close"></i>
                                                                        </span>
                                                                  </button>
                                                            </div>
                                                            </div>');
                  redirect(site_url('admin_gulderose/penjualan/pembayaran-diterima-dan-diproses'));
                  

            }

            public function detail_pembayaran_diterima_dan_diproses($id)
            {
                  $this->data['konfirmasi_detail']    = $this->Penjualan_model->get_by_id_detail_konfirmasi($id);
                  $this->data['konf_data']            = $this->Penjualan_model->get_by_id2($id);
                  $this->data['konf_data2']           = $this->Penjualan_model->get_by_id3($id);
                  $this->data['subtotal_total_berat'] = $this->Penjualan_model->order_subtotal_dan_berat($id);
                  $this->data['get_konfirmasi']       = $this->Penjualan_model->get_data_konfirmasi($id);
                  $this->template->load('template', 'back/penjualan/penjualan_detail', $this->data);
            }

            public function batal_pembayaran_diterima_dan_diproses($id)
            {
                  $this->data['title']    = 'Update Dibatalkan';

                  $row = $this->Penjualan_model->get_by_id($id);
                  if ($row) 
                  {
                        $data = array(
                              'status'    => '5',
                        );

                        $this->Penjualan_model->update_data($id, $data);
                        $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">
                                                                  <div class="container">
                                                                        <div class="alert-icon">
                                                                              <i class="zmdi zmdi-thumb-up"></i>
                                                                        </div>
                                                                        <strong>WELL DONE!</strong> | Orderan telah dibatalkan
                                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                                    <span aria-hidden="true">
                                                                                    <i class="zmdi zmdi-close"></i>
                                                                              </span>
                                                                        </button>
                                                                  </div>
                                                                  </div>');
                        redirect(site_url('admin_gulderose/penjualan/pembayaran-diterima-dan-diproses'));
                  }
            }

            public function orderan_dikirim()
            {
                  $this->data['title']          = 'Orderan Dibatalkan';
                  $this->data['get_dikirim']    = $this->Penjualan_model->get_dikirim();

                  $this->template->load('template', 'back/penjualan/penjualan_dikirim_list',$this->data);
            }

            public function detail_orderan_dikirim($id)
            {
                  $this->data['konfirmasi_detail']    = $this->Penjualan_model->get_by_id_detail_konfirmasi($id);
                  $this->data['konf_data']            = $this->Penjualan_model->get_by_id2($id);
                  $this->data['konf_data2']           = $this->Penjualan_model->get_by_id3($id);
                  $this->data['subtotal_total_berat'] = $this->Penjualan_model->order_subtotal_dan_berat($id);
                  $this->data['get_konfirmasi']       = $this->Penjualan_model->get_data_konfirmasi($id);
                  $this->template->load('template', 'back/penjualan/penjualan_detail', $this->data);
            }

            public function orderan_dibatalkan()
            {
                  $this->data['title']          = 'Orderan Dibatalkan';
                  $this->data['get_batal']      = $this->Penjualan_model->get_dibatalkan();

                  $this->template->load('template', 'back/penjualan/penjualan_dibatalkan_list',$this->data);
            }

            public function detail_dibatalkan($id)
            {
                  $this->data['konfirmasi_detail']    = $this->Penjualan_model->get_by_id_detail_konfirmasi($id);
                  $this->data['konf_data']            = $this->Penjualan_model->get_by_id2($id);
                  $this->data['konf_data2']           = $this->Penjualan_model->get_by_id3($id);
                  $this->data['subtotal_total_berat'] = $this->Penjualan_model->order_subtotal_dan_berat($id);
                  $this->data['produk_detail']        = $this->Produk_model->get_by_id_detail($id);
                  $this->data['get_konfirmasi']       = $this->Penjualan_model->get_data_konfirmasi($id);
                  
                  $this->template->load('template', 'back/penjualan/penjualan_detail', $this->data);
            }

            
            // ---- PROSES UPDATE STATUS TRANSAKSI ---- //
            public function update_dibatalkan($id)
            {
                  $this->data['title']    = 'Update Dibatalkan';

                  $row = $this->Penjualan_model->get_by_id($id);
                  if ($row) 
                  {
                        $data = array(
                              'status'    => '5',
                        );

                        $this->Penjualan_model->update_data($id, $data);
                        $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">
                                                                  <div class="container">
                                                                        <div class="alert-icon">
                                                                              <i class="zmdi zmdi-thumb-up"></i>
                                                                        </div>
                                                                        <strong>WELL DONE!</strong> | Orderan telah dibatalkan
                                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                                    <span aria-hidden="true">
                                                                                    <i class="zmdi zmdi-close"></i>
                                                                              </span>
                                                                        </button>
                                                                  </div>
                                                                  </div>');
                        redirect(site_url('admin_gulderose/penjualan/belum-konfirmasi'));

                  }
            }

            public function update_konfirmasi_dibatalkan($id)
            {
                  $this->data['title']    = 'Update Dibatalkan';

                  $row = $this->Penjualan_model->get_by_id($id);
                  if ($row) 
                  {
                        $data = array(
                              'status'    => '5',
                        );

                        $this->Penjualan_model->update_data($id, $data);
                        $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">
                                                                  <div class="container">
                                                                        <div class="alert-icon">
                                                                              <i class="zmdi zmdi-thumb-up"></i>
                                                                        </div>
                                                                        <strong>WELL DONE!</strong> | Orderan telah dibatalkan
                                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                                    <span aria-hidden="true">
                                                                                    <i class="zmdi zmdi-close"></i>
                                                                              </span>
                                                                        </button>
                                                                  </div>
                                                                  </div>');
                        redirect(site_url('admin_gulderose/penjualan/sudah-konfirmasi'));

                  }
            }
            
            public function update_sudah_konfirmasi($id)
            {
                  $this->data['title']    = 'Update Status Pembayaran telah Diterima';
                  
                  $row         = $this->Penjualan_model->get_by_id($id);
                  $id2         = $this->uri->segment(4);

                  if ($row) 
                  {
                        $data = array(
                              'status'          => '3',
                              'waktu_kirim'     => date("Y-m-d H:i:s", strtotime('+7 days'))
                        );

                        $data2 = array(
                              'dilakukan_oleh'     => $this->session->userdata('user_id'),
                              'waktu_dikonfirmasi' => date("Y-m-d H:i:s")
                        );

                        $this->Penjualan_model->update_data($id, $data);
                        $this->Penjualan_model->update_dilakukan_oleh($id2, $data2);                        
                        $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">
                                                                  <div class="container">
                                                                        <div class="alert-icon">
                                                                              <i class="zmdi zmdi-thumb-up"></i>
                                                                        </div>
                                                                        <strong>WELL DONE!</strong> | Pembayaran telah diterima dan diproses
                                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                                    <span aria-hidden="true">
                                                                                    <i class="zmdi zmdi-close"></i>
                                                                              </span>
                                                                        </button>
                                                                  </div>
                                                                  </div>');
                        redirect(site_url('admin_gulderose/penjualan/sudah-konfirmasi'));
                  }
            }

            
            
      }
      
      /* End of file Penjualan.php */
      
?>
