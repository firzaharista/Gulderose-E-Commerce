<?php
      
      defined('BASEPATH') OR exit('No direct script access allowed');
      
      class Home extends CI_Controller 
      {
            
            public function __construct()
            {
                  parent::__construct();
                  $this->load->model('Produk_model');
                  $this->load->model('Slider_model');
                  $this->load->model('Produkrekomendasi_model');
                  $this->load->model('Companyprofile_model');
                  $this->load->model('Cart_model');
                  $this->load->model('Payment_model');
                  // $this->load->model('Kategori_model');

                  $this->data['company_data']         = $this->Companyprofile_model->get_by_company();
                  $this->data['cart_data']            = $this->Cart_model->get_cart_per_customer();
                  $this->data['total_berat_subtotal'] = $this->Cart_model->get_total_berat_dan_subtotal();
                  $this->data['total_cart_navbar']    = $this->Cart_model->total_cart_navbar();
                  
            }
            
            public function index()
            {
                  $this->data['title']    = 'Home';
                  $this->data['title2']   = 'Product Recomendation';

                  $this->data['slider_data']      = $this->Slider_model->get_all_home();
                  $this->data['product_new']      = $this->Produk_model->get_all_new_product();
                  $this->data['product_bouquet']  = $this->Produk_model->get_all_new_bouquet();
                  $this->data['product_recomend'] = $this->Produkrekomendasi_model->get_all_home();
                  $this->template->load('template_front', 'front/home/home_body', $this->data);
                  // $this->load->view('front/home/body', $this->data);
                  
            }
      
      }
      
      /* End of file Home.php */
      
?>