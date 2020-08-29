<?php
      
      defined('BASEPATH') OR exit('No direct script access allowed');
      
      class Product_category extends CI_Controller 
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
                  // ambil data keranjang
                  $this->data['cart_data']               = $this->Cart_model->get_cart_per_customer();
                  $this->data['total_berat_subtotal'] = $this->Cart_model->get_total_berat_dan_subtotal();
                  $this->data['total_cart_navbar']    = $this->Cart_model->total_cart_navbar();
                  
            }

            private $limit = 9;

            public function read($id)
            {
                  $this->load->helper(array('clean'));
                  $this->data['segment'] = count($this->uri->segment_array());
                  
                  $segment  = count($this->uri->segment_array());
                  $segments = $this->uri->segment_array();

                  $offset = 0;
                  
                  if ($segment == 2 || ($segment == 3 && is_numeric($segments[3]))) 
                  {
                        $this->data['title']  = ucwords(clean2($this->uri->segment(2)));
                        $this->data['title2'] = ucwords(clean2($this->uri->segment(3)));
                        $page = ($this->uri->segment(3)) ? ($this->uri->segment(3) - 1) : 0;
                        
                        if ($segment == 3) 
                        $offset = $page;
                        

                        $this->data['product_row']    = $this->Kategori_model->get_list_by_kategori($segments[2], $this->limit, $offset * $this->limit)->row();
                        $this->data['product']        = $this->Kategori_model->get_list_by_kategori($segments[2], $this->limit, $offset * $this->limit);
                        $this->data['pagination']     = $this->generate_paging($this->Kategori_model->get_by_kategori_nr($segments[2]), base_url(). 'product-category/'. $segments[2], 3);

                  } elseif ($segment == 3 || ($segment == 4 && is_numeric($segments[4]))) 
                  {
                        $this->data['title']  = ucwords(clean2($this->uri->segment(2)));
                        $this->data['title2'] = ucwords(clean2($this->uri->segment(3)));
                        $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;

                        if ($segment == 4) 
                        $offset = $page;

                        $this->data['product_row']    = $this->Kategori_model->get_list_by_subkategori($segments[3], $this->limit, $offset * $this->limit)->row();
                        $this->data['product']        = $this->Kategori_model->get_list_by_subkategori($segments[3], $this->limit, $offset * $this->limit);
                        $this->data['pagination']     = $this->generate_paging($this->Kategori_model->get_by_subkategori_nr($segments[3]), base_url(). 'product-category/'. $segments[2] . '/'. $segments[3], 4);
                  }

                  $this->load->view('front/product-category/product-category', $this->data);
                  
            }

            function generate_paging($numRows, $url, $uriSegment, $suffix = '')
            {
                  $this->load->library('pagination');

                  $config['full_tag_open']      = '<nav><ul class="pagination">';
                  $config['full_tag_close']     = '</ul></nav>';
                  $config['num_tag_open']       = '<li class="page-item"><span class="page-link">';
                  $config['num_tag_close']      = '</span></li>';
                  $config['cur_tag_open']       = '<li class="page-item active"><span class="page-link">';
                  $config['cur_tag_close']      = '<span class="sr-only">(current)</span></span></li>';
                  $config['next_link']          = "Next";
                  $config['next_tag_open']      = '<li class="page-item"><span class="page-link">';
                  $config['next_tagl_close']    = '<span aria-hidden="true">&raquo;</span></span></li>';
                  $config['prev_link']          = "Previous";
                  $config['prev_tag_open']      = '<li class="page-item"><span class="page-link">';
                  $config['prev_tagl_close']    = '</span></li>';
                  $config['first_link']         = "First";
                  $config['first_tag_open']     = '<li class="page-item"><span class="page-link">';
                  $config['first_tagl_close']   = '</span></li>';
                  $config['last_link']          = 'Last';
                  $config['last_tag_open']      = '<li class="page-item"><span class="page-link">';
                  $config['last_tagl_close']    = '</span></li>';

                  $config['base_url']     = $url;
                  $config['total_rows']   = $numRows;
                  $config['per_page']     = $this->limit;
                  $config['uri_segment']  = $uriSegment;
                  $config['suffix']       = $suffix;
                  $config['first_url']    = $config['base_url'] . $config['suffix'];
                  $config['use_page_numbers']         = TRUE;
                  $config['reuse_query_string']       = TRUE;
                  // $config['use_page_numbers'] = TRUE;

                  $this->pagination->initialize($config);
                  
                  return $this->pagination->create_links();
                  
            }
            
      
      
      }
      
      /* End of file Product_category.php */
      
?>
