<?php
      
      defined('BASEPATH') OR exit('No direct script access allowed');
      
      class Category extends CI_Controller 
      {
            
            public function __construct()
            {
                  parent::__construct();
                  $this->load->model('Cart_model');
                  $this->load->model('Companyprofile_model');
                  $this->load->model('Produkrekomendasi_model');
                  $this->load->model('Kategori_model');
                  $this->load->model('Produk_model');

                  $this->data['company_data']         = $this->Companyprofile_model->get_by_company();
                  $this->data['category_data']        = $this->Kategori_model->get_all();
                  $this->data['product_recomend']     = $this->Produkrekomendasi_model->get_all_front();
            }
            
            public function index()
            {
                  
            }
      
      }
      
      /* End of file Category.php */
      
?>