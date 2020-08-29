<?php
      
      defined('BASEPATH') OR exit('No direct script access allowed');
      
      class Search extends CI_Controller {
      
            
            public function __construct()
            {
                  parent::__construct();
                  $this->load->model('Produk_model');
                  $this->data['modul'] = 'Produk';
                  $this->load->model('Penjualan_model');
                  $this->load->model('Companyprofile_model');
                  
                  $this->data['company_data']         = $this->Companyprofile_model->get_by_company();

                  $this->data['navbar_transaksi']       = $this->Penjualan_model->top5_transaksi_sudah_konfirmasi()->result();
                  $this->data['navbar_transaksi_row']   = $this->Penjualan_model->top5_transaksi_sudah_konfirmasi()->row();
                  
            }
            
            public function index()
            {
                  $this->data['title'] = 'Hasil Pencarian Anda';
                  $this->data['hasil_pencarian'] = $this->Produk_model->get_search_product();

                  $this->template->load('template', 'back/produk/produk_search', $this->data);
                  // $this->load->view('back/produk/produk_search', $this->data);
            }
      
      }
      
      /* End of file Search.php */
      
?>