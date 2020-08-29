<?php 
      
      defined('BASEPATH') OR exit('No direct script access allowed');
      
      class Product extends CI_Controller 
      {
            
            public function __construct()
            {
                  parent::__construct();
                  $this->data['modul'] = 'Product';
                  
                  $this->load->model('Kategori_model');
                  $this->load->model('Produk_model');
                  $this->load->model('Produkrekomendasi_model');
                  $this->load->model('Companyprofile_model');
                  $this->load->model('Cart_model');
                  

                  $this->data['company_data']         = $this->Companyprofile_model->get_by_company();
                  $this->data['category_data']        = $this->Kategori_model->get_all();
                  $this->data['product_recomend']     = $this->Produkrekomendasi_model->get_all_front(); 
                  // ambil data keranjang
                  $this->data['cart_data']               = $this->Cart_model->get_cart_per_customer();
                  $this->data['total_berat_subtotal'] = $this->Cart_model->get_total_berat_dan_subtotal();
                  $this->data['total_cart_navbar']    = $this->Cart_model->total_cart_navbar();
            }

            public function allproducts()
            {
                  $this->data['title']    = $this->data['modul'];

                  // memanggil library pagination (membuat halaman)
                  $this->load->library('pagination');

                  //jumlah total data produk
                  $limit_per_page   = 9;
                  $jumlah           = $this->Produk_model->total_rows();
                  $page             = ($this->uri->segment(3)) ? ($this->uri->segment(3) - 1) : 0;

                  $config['base_url']                 = base_url('product/all-products/') ;
                  $config['total_rows']               = $jumlah;
                  $config['uri_segment']              = 3;
                  $config['per_page']                 = $limit_per_page;
                  $config['use_page_numbers']         = TRUE;
                  $config['reuse_query_string']       = TRUE;
                  // $config['query_string_segment']     = 'page';
                  // $config['page_query_string']        = TRUE;
                  // tag pagination bootstrap  / CSS nya

                        $config['full_tag_open'] 		= '<nav><ul class="pagination">';
                        $config['full_tag_close'] 	      = '</ul></nav>';
                        $config['num_tag_open'] 		= '<li class="page-item"><span class="page-link">';
                        $config['num_tag_close'] 		= '</span></li>';
                        $config['cur_tag_open'] 		= '<li class="page-item active"><span class="page-link">';
                        $config['cur_tag_close'] 		= '<span class="sr-only">(current)</span></span></li>';
                        $config['next_link']                = "Next";
                        $config['next_tag_open'] 		= '<li class="page-item"><span class="page-link">';
                        $config['next_tagl_close'] 	      = '<span aria-hidden="true">&raquo;</span></span></li>';
                        $config['prev_link']                = "Previous";
                        $config['prev_tag_open'] 		= '<li class="page-item"><span class="page-link">';
                        $config['prev_tagl_close'] 	      = '</span></li>';
                        $config['first_link']               = "First";
                        $config['first_tag_open'] 	      = '<li class="page-item"><span class="page-link">';
                        $config['first_tagl_close']         = '</span></li>';
                        $config['last_link']                = 'Last';
                        $config['last_tag_open'] 		= '<li class="page-item"><span class="page-link">';
                        $config['last_tagl_close'] 	      = '</span></li>';

                  /* eksekusi library pagination ke model penampilan data */
                  $this->data['product_data']   = $this->Produk_model->get_all_product($limit_per_page, $page*$limit_per_page);
                  // $this->data['product_row']    = $this->Produk_model->get_all_product_notif($limit_per_page, $page * $limit_per_page);

                  $this->pagination->initialize($config);

                  /* memanggil view yang telah disiapkan dan passing data dari model ke view*/
                  $this->load->view('front/product/product-body', $this->data);
            }

            //product detailnya (nampilin)
            public function read ($id)
            {
                  //mengambil data berdasarkan idnya
                  $row = $this->Produk_model->get_by_id_detail_front($id);

                  // jika data ada
                  if ($row) 
                  {
                        $this->data['product_detail'] = $this->Produk_model->get_by_id_detail_front($id);
                        $this->data['other_product']  = $this->Produk_model->get_random();
                        $this->data['title']          = $row->judul_produk;

                        //ngeview tampilan product detail
                        $this->load->view('front/product/product-detail', $this->data);
                        
                  } 
            }
      
      }
     
      
      /* End of file Product.php */
      
?>