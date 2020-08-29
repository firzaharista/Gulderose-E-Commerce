<?php
      
      defined('BASEPATH') OR exit('No direct script access allowed');
      
      class Select extends CI_Controller {

            
            public function __construct()
            {
                  parent::__construct();
                  $this->load->model('Select_model');
                  
            }
            
      
            public function index()
            {
                  $this->data['kategori'] = $this->Select_model->fetch_kategori();
                  
                  $this->data['action']        = site_url('admin_gulderose/kategori/create_action');
                  $this->data['button_submit'] = 'SIMPAN';
                  $this->data['button_reset']  = 'RESET';



                  $this->template->load('template','back/select/select_add', $this->data);
            }

            function fetch_subkategori()
            {
                  if ($this->input->post('id_kategori')) 
                  {
                        echo $this->Select_model->fetch_subkategori($this->input->post('id_kategori'));
                  }
            }
      
      }
      
      /* End of file Select.php */
      
?>