<?php
      
      defined('BASEPATH') OR exit('No direct script access allowed');
      
      class Page extends CI_Controller 
      {
      
            
            public function __construct()
            {
                  parent::__construct();
                  $this->load->model('Companyprofile_model');
                  $this->load->model('Produkrekomendasi_model');
                  $this->load->model('Panduanpembelian_model');
                  $this->load->model('Terms_model');
                  $this->load->model('Kategori_model');
                  // $this->load->view('Produk_model');
                  $this->load->model('Cart_model');

                  $this->data['company_data']         = $this->Companyprofile_model->get_by_company();
                  // ambil data keranjang
                  $this->data['cart_data']            = $this->Cart_model->get_cart_per_customer();
                  $this->data['total_berat_subtotal'] = $this->Cart_model->get_total_berat_dan_subtotal();
                  $this->data['total_cart_navbar']    = $this->Cart_model->total_cart_navbar();
                  
            }
            
            //sudah diroute (cek bagian config route)
            public function how_to_order()
            {
                  $this->data['title']        = 'How to Order';
                  $this->data['how_to_order'] = $this->Panduanpembelian_model->get_all_front();
                  $this->load->view('front/page/how-to-order', $this->data);
                  
            }

            //sudah diroute (cek bagian config route)
            public function terms_of_service()
            {
                  $this->data['title'] = 'Terms of Service';
                  $this->data['terms'] = $this->Terms_model->get_all_terms();
                  $this->load->view('front/page/terms-of-service', $this->data);
                  
            }

            //sudah diroute (cek bagian config route)
            public function about_us()
            {
                  $this->data['title'] = 'About Us';
                  $this->data['about'] = $this->Companyprofile_model->get_by_company();
                  $this->load->view('front/page/about-us', $this->data);
                  
            }

            public function contact_us()
            {
                  $this->data['title'] = 'Contact Us';
                  $this->data['contact'] = $this->Companyprofile_model->get_by_company();
                  $this->load->view('front/page/contact-us', $this->data);
                  
            }
      
      }
      
      /* End of file Page.php */
      
?>