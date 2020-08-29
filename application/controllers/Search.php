<?php 
      
      defined('BASEPATH') OR exit('No direct script access allowed');
      
      class Search extends CI_Controller {

            
            public function __construct()
            {
                  parent::__construct();
                  $this->load->model('Produk_model');
                  $this->load->model('Kategori_model');
                  $this->load->model('Produkrekomendasi_model');
                  $this->load->model('Companyprofile_model');
                  $this->load->model('Cart_model');
                  
                  $this->data['company_data']         = $this->Companyprofile_model->get_by_company();
                  $this->data['category_data']        = $this->Kategori_model->get_all();
                  $this->data['product_recomend']     = $this->Produkrekomendasi_model->get_all_front(); 
                  $this->data['total_cart_navbar']    = $this->Cart_model->total_cart_navbar();
            }
            
      
            public function index()
            {
                  $this->data['title'] = 'Hasil Pencarian Anda';
                  $this->data['hasil_pencarian'] = $this->Produk_model->get_search_product();

                  $this->load->view('front/product/product-search', $this->data);
            }
      
      }
      
      /* End of file Search.php */
      
?>