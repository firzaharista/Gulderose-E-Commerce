<?php
      
      defined('BASEPATH') OR exit('No direct script access allowed');
      
      class Subkategori extends CI_Controller {
            
            public function __construct()
            {
                  parent::__construct();
                  $this->data['modul'] = 'SubKategori';
                  $this->load->model('Subkategori_model');
                  $this->load->model('Kategori_model');
                  $this->load->model('Penjualan_model');
                  $this->load->model('Companyprofile_model');
                  
                  $this->data['company_data']         = $this->Companyprofile_model->get_by_company();

                  $this->data['navbar_transaksi']       = $this->Penjualan_model->top5_transaksi_sudah_konfirmasi()->result();
                  $this->data['navbar_transaksi_row']      = $this->Penjualan_model->top5_transaksi_sudah_konfirmasi()->row();

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
                  $this->data['title'] = 'Data'. $this->data['modul'];
                  $this->data['subkategori'] = $this->Subkategori_model->get_all();
                  $this->template->load('template', 'back/subkategori/subkategori_list', $this->data );
            }

            public function create()
            {
                  $this->data['title']          = 'Tambah Data '.$this->data['modul'];
                  $this->data['action']         = site_url('admin_gulderose/subkategori/create_action');
                  $this->data['button_submit']  = 'SIMPAN';
                  $this->data['button_reset']   = 'RESET';

                  $this->data['id_subkategori'] = array(
                        'name'      => 'id_subkategori',
                        'id'        => 'id_subkategori',
                        'type'      => 'hidden'
                  );

                  // $this->data['kat_id'] = array(
                  //       'name'      => 'kat_id',
                  //       'id'        => 'kat_id',
                  //       'class'     => 'form-control show-tick',
                  //       'required'  => ''
                  // );

                  $this->data['judul_subkategori'] = array(
                        'name'      => 'judul_subkategori',
                        'id'        => 'judul_subkategori',
                        'type'      => 'text',
                        'placeholder'=> 'Judul Subkategori',
                        'class'     => 'form-control form-control-success',
                        'value'     => $this->form_validation->set_value('judul_subkategori')
                  );

                  // $this->data['ambil_kategori'] = $this->Kategori_model->ambil_kategori();

                  $this->data['kategori'] = $this->Kategori_model->fetch_kategori();
                  
                  // $this->data['ambil_kategori'] = $this->Kategori_model->ambil_kategori()->result();

                  $this->template->load('template','back/subkategori/subkategori_add', $this->data);
            }

            public function create_action()
            {
                  $this->rules();

                  if ($this->form_validation->run() == FALSE) 
                  {
                        $this->create();

                  } else {
                        
                        $data = array(
                              'id_kategori'       => $this->input->post('kat_id'),
                              'judul_subkategori' => ucwords($this->input->post('judul_subkategori')),
                              'slug_subkat'       => strtolower(url_title($this->input->post('judul_subkategori')))
                        );

                        //query insert
                        $this->Subkategori_model->insert($data);

                        //jika berhasil
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
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
                        redirect(site_url('admin_gulderose/subkategori'));
                  }
                  
            }

            public function update($id)
            {
                  $row                       = $this->Subkategori_model->get_by_id($id);
                  $this->data['subkategori'] = $this->Subkategori_model->get_by_id($id);

                  if ($row) {

                        $this->data['title']          = 'Tambah Data ' . $this->data['modul'];
                        $this->data['action']         = site_url('admin_gulderose/subkategori/update_action');
                        $this->data['button_submit']  = 'SIMPAN';
                        $this->data['button_reset']   = 'RESET';

                        $this->data['id_subkategori'] = array(
                        'name'      => 'id_subkategori',
                        'id'        => 'id_subkategori',
                        'type'      => 'hidden'
                        );

                        $this->data['kat_id'] = array(
                        'name'      => 'kat_id',
                        'id'        => 'kat_id',
                        'class'     => 'form-control show-tick',
                        'required'  => ''
                        );

                        $this->data['judul_subkategori'] = array(
                        'name'      => 'judul_subkategori',
                        'id'        => 'judul_subkategori',
                        'type'      => 'text',
                        'placeholder'=> 'Judul Subkategori',
                        'class'     => 'form-control form-control-success'
                        );

                        $this->data['ambil_kategori'] = $this->Kategori_model->ambil_kategori();

                        $this->template->load('template','back/subkategori/subkategori_edit',$this->data);

                  } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">
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
                        redirect(site_url('admin_gulderose/subkategori'));
                  }
            }

            public function update_action()
            {
                  $this->rules();
                  
                  if ($this->form_validation->run() == FALSE) 
                  {
                        $this->update($this->input->post('id_subkategori'));

                  } else {
                        
                        $data = array(
                              'id_kategori'       => $this->input->post('kat_id'),
                              'judul_subkategori' => ucwords($this->input->post('judul_subkategori')),
                              'slug_subkat'       => strtolower(url_title($this->input->post('judul_subkategori')))
                        );

                        $this->Subkategori_model->update($this->input->post('id_subkategori'), $data);

                        $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">
                                                                  <div class="container">
                                                                        <div class="alert-icon">
                                                                              <i class="zmdi zmdi-thumb-up"></i>
                                                                        </div>
                                                                        <strong>WELL DONE!</strong> | Edit Data berhasil
                                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                                    <span aria-hidden="true">
                                                                                    <i class="zmdi zmdi-close"></i>
                                                                              </span>
                                                                        </button>
                                                                  </div>
                                                                  </div>');
                        redirect('admin_gulderose/subkategori','refresh');
                  }
            }

            public function delete($id)
            {
                  $row = $this->Subkategori_model->get_by_id($id);

                  if ($row) {
                        
                        $this->Subkategori_model->delete($id);
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
                        redirect('admin_gulderose/subkategori','refresh');

                  //jika data tidak ada
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
                        redirect('admin_gulderose/subkategori','refresh');
                  }

            }

            public function rules()
            {
                  //set rules
                  $this->form_validation->set_rules('id_subkategori', 'Id SubKategori', 'trim');
                  $this->form_validation->set_rules('kat_id', 'Id Kategori', 'trim');
                  $this->form_validation->set_rules('judul_subkategori', 'Judul SubKategori', 'trim|required');

                  //set message
                  $this->form_validation->set_message('required','{field} Mohon Diisi');
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
            
      /* End of file subKategori.php */
      
?>