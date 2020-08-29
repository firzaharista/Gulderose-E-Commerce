<?php
      
      defined('BASEPATH') OR exit('No direct script access allowed');
      
      class Laporan extends CI_Controller {
            
            public function __construct()
            {
                  parent::__construct();
                  $this->load->model('Laporan_model');
                  $this->load->model('Ion_auth_model');
                  $this->load->model('Companyprofile_model');
                  $this->load->model('Cart_model');
                  $this->load->model('Produk_model');
                  $this->load->model('Penjualan_model');

                  $this->data['navbar_transaksi']       = $this->Penjualan_model->top5_transaksi_sudah_konfirmasi()->result();
                  $this->data['navbar_transaksi_row']   = $this->Penjualan_model->top5_transaksi_sudah_konfirmasi()->row();
                  
                  $this->load->helper('tgl_indo');

                  $this->data['company_data']         = $this->Companyprofile_model->get_by_company();
                  $this->data['get_perproduk']        = $this->Produk_model->get_all_laporan();   
                  
                  
                  $this->data['modul'] = 'Laporan';

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
                  $this->data['title'] = 'Laporan Penjualan';
                  $this->template->load('template', 'back/laporan/laporan_list', $this->data);
            }

            // untuk mengeksport semua laporan penjualan
            public function export_all()
            {
                  $this->data['title']    = 'produk semua';
                  $this->data['get_all']  = $this->Cart_model->get_all_laporan();
                  $this->data['total_penjualan'] = $this->Cart_model->total_penjualan();
                  
                  $this->load->view('back/laporan/print_all', $this->data);
                  
            }

            //per periode laporannya
            public function export_periode()
            {
                  $this->data['get_periode']  = $this->Cart_model->get_data_penjualan_periode();
                  $this->data['total_penjualan_periode'] = $this->Cart_model->total_penjualan_periode();
                  $this->load->view('back/laporan/print_periode', $this->data);
            }

            public function export_produk()
            {
                  $this->data['get_produk']                 = $this->Cart_model->get_data_per_produk();
                  $this->data['total_penjualan_per_produk'] = $this->Cart_model->total_penjualan_per_produk();
                  $this->load->view('back/laporan/print_produk', $this->data);
            }

            public function export_dikirim()
            {
                  $this->data['get_dikirim']                = $this->Cart_model->get_all_dikirim();
                  $this->data['total_penjualan_dikirim']    = $this->Cart_model->total_penjualan_dikirim();
                  $this->load->view('back/laporan/print_dikirim', $this->data);
            }
      
      }
      
      /* End of file Laporan.php */
      
?>