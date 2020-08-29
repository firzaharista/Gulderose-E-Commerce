<?php
      
      defined('BASEPATH') OR exit('No direct script access allowed');
      
      class Kategori extends CI_Controller 
      {
            
            public function __construct()
            {
                  parent::__construct();
                  $this->data['modul'] = 'Kategori';
                  $this->load->model('Kategori_model');
                  $this->load->model('Penjualan_model');
                  $this->load->model('Companyprofile_model');
                  
                  $this->data['company_data']         = $this->Companyprofile_model->get_by_company();
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
                  $this->data['title']    = 'Data'. $this->data['modul'];
                  $this->data['kat'] = $this->Kategori_model->get_all();
                  $this->template->load('template', 'back/kategori/kategori_list', $this->data );
            }

            public function create()
            {
                  $this->data['title']         = 'Tambah Data'.$this->data['modul'];
                  $this->data['action']        = site_url('admin_gulderose/kategori/create_action');
                  $this->data['button_submit'] = 'SIMPAN';
                  $this->data['button_reset']  = 'RESET';

                  $this->data['id_kategori'] = array(
                        'name'    => 'id_kategori',
                        'id'      => 'id_kategori',
                        'type'    => 'hidden'
                  );

                  $this->data['judul_kategori'] = array(
                        'name'        => 'judul_kategori',
                        'id'          => 'judul_kategori',
                        'type'        => 'text',
                        'placeholder' => 'Judul Kategori',
                        'class'       => 'form-control form-control-success'
                  );

                  $this->template->load('template','back/kategori/kategori_add', $this->data);
            }

            public function create_action()
            {     
                  $this->rules();

                  
                  if ($this->form_validation->run() == FALSE) 
                  {
                        $this->create();

                  } else {

                        $data = array(
                              'id_kategori'     => $this->input->post('id_kategori'),
                              'judul_kategori'  => ucwords($this->input->post('judul_kategori')),
                              'slug_kat'        => strtolower(url_title($this->input->post('judul_kategori')))
                        );
                         //update
                        $this->Kategori_model->insert($data);
                        //jika berhasil
                        $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">
                                                                  <div class="container">
                                                                        <div class="alert-icon">
                                                                              <i class="zmdi zmdi-thumb-up"></i>
                                                                        </div>
                                                                        <strong>WELL DONE!</strong> | Data berhasil dibuat
                                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                                    <span aria-hidden="true">
                                                                                    <i class="zmdi zmdi-close"></i>
                                                                              </span>
                                                                        </button>
                                                                  </div>
                                                                  </div>');
                        redirect(site_url('admin_gulderose/kategori'));
                  }
                  
            }

            public function update($id)
            {
                  $row = $this->Kategori_model->get_by_id($id);
                  $this->data['kategori'] = $this->Kategori_model->get_by_id($id);

                  if ($row) {

                        $this->data['title']         = 'Ubah Data'.$this->data['modul'];
                        $this->data['action']        = site_url('admin_gulderose/kategori/update_action');
                        $this->data['button_submit'] = 'SIMPAN';
                        $this->data['button_reset']  = 'RESET';

                        $this->data['id_kategori'] = array(
                        'name'    => 'id_kategori',
                        'id'      => 'id_kategori',
                        'type'    => 'hidden'
                        );

                        $this->data['judul_kategori'] = array(
                        'name'        => 'judul_kategori',
                        'id'          => 'judul_kategori',
                        'type'        => 'text',
                        'placeholder' => 'Judul Kategori',
                        'class'       => 'form-control form-control-success'
                        );

                        $this->template->load('template','back/kategori/kategori_edit',$this->data);

                  } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
                                                                  <div class="container">
                                                                        <div class="alert-icon">
                                                                              <i class="zmdi zmdi-alert-circle-o"></i>
                                                                        </div>
                                                                        <strong>WARNING!</strong> | Data tidak ditemukan
                                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                                    <span aria-hidden="true">
                                                                                    <i class="zmdi zmdi-close"></i>
                                                                              </span>
                                                                        </button>
                                                                  </div>
                                                                  </div>');
                        redirect(site_url('admin_gulderose/kategori'));
                  }

                  
            }

            public function update_action()
            {
                  $this->rules();
                  
                  if ($this->form_validation->run() == FALSE) 
                  {
                        $this->update($this->input->post('id_kategori'));       
                  } 
                  else 
                  {
                        $data = array(
                              'id_kategori'     => $this->input->post('id_kategori'),
                              'judul_kategori'  => ucwords($this->input->post('judul_kategori')),
                              'slug_kat'        => strtolower(url_title($this->input->post('judul_kategori')))
                        );

                        //eksekusi query update
                        $this->Kategori_model->update($data, $this->input->post('id_kategori'));
                        $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">
                                                                  <div class="container">
                                                                        <div class="alert-icon">
                                                                              <i class="zmdi zmdi-thumb-up"></i>
                                                                        </div>
                                                                        <strong>WELL DONE!</strong> | Edit data berhasil
                                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                                    <span aria-hidden="true">
                                                                                    <i class="zmdi zmdi-close"></i>
                                                                              </span>
                                                                        </button>
                                                                  </div>
                                                                  </div>');
                        redirect(site_url('admin_gulderose/kategori'));
                  }
                  
            }

            public function delete($id)
            {
                  $row = $this->Kategori_model->get_by_id($id);

                  if ($row) 
                  {
                        $this->Kategori_model->delete($id);
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                                                                  <div class="container">
                                                                        <div class="alert-icon">
                                                                              <i class="zmdi zmdi-thumb-up"></i>
                                                                        </div>
                                                                        <strong>WELL DONE!</strong> | Data berhasil dihapus
                                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                                    <span aria-hidden="true">
                                                                                    <i class="zmdi zmdi-close"></i>
                                                                              </span>
                                                                        </button>
                                                                  </div>
                                                                  </div>');
                        redirect(site_url('admin_gulderose/kategori'));

                  } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
                                                                  <div class="container">
                                                                        <div class="alert-icon">
                                                                              <i class="zmdi zmdi-alert-circle-o"></i>
                                                                        </div>
                                                                        <strong>WARNING!</strong> | Data tidak ditemukan
                                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                                    <span aria-hidden="true">
                                                                                    <i class="zmdi zmdi-close"></i>
                                                                              </span>
                                                                        </button>
                                                                  </div>
                                                                  </div>');
                        redirect(site_url('admin_gulderose/kategori'));
                  }
            }

            public function rules()
            {
                  //rules
                  $this->form_validation->set_rules('id_kategori', 'id_kategori', 'trim');
                  $this->form_validation->set_rules('judul_kategori', 'Judul Kategori', 'trim|required');

                  //set pesan
                  $this->form_validation->set_message('required', '{field} Mohon Diisi');
                  $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">
                                                                  <div class="container">
                                                                        <div class="alert-icon">
                                                                              <i class="zmdi zmdi-alert-circle-o"></i>
                                                                        </div>
                                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                                    <span aria-hidden="true">
                                                                                    <i class="zmdi zmdi-close"></i>
                                                                              </span>
                                                                        </button>
                                                                  </div>', '</div>');
                  
            }
      
      }
            
      /* End of file Kategori.php */
      
?>