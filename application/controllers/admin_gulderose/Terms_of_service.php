<?php
      
      defined('BASEPATH') OR exit('No direct script access allowed');
      
      class Terms_of_service extends CI_Controller 
      {
            
            public function __construct()
            {
                  parent::__construct();
                  $this->data['modul'] = 'Terms of Service';
                  $this->load->model('Terms_model');
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
                  $this->data['title']    = 'Data'. $this->data['modul'];
                  $this->data['terms'] = $this->Terms_model->get_all();
                  $this->template->load('template','back/terms_of_service/terms_list', $this->data);
            }

            public function create()
            {
                  $this->data['title']         = 'Tambah Data'.$this->data['modul'];
                  $this->data['action']        = site_url('admin_gulderose/terms_of_service/create_action');
                  $this->data['button_submit'] = 'SIMPAN';
                  $this->data['button_reset']  = 'RESET';

                  $this->data['judul_terms'] = array(
                        'name'        => 'judul_terms',
                        'id'          => 'judul_terms',
                        'type'        => 'text',
                        'placeholder' => 'Nama Terms of Service (Kebijakan Layanan)',
                        'class'       => 'form-control form-control-success'
                  );

                  $this->data['isi_terms'] = array(
                              'name'  => 'isi_terms',
                              'id'    => 'ckeditor',
                              'class' => 'form-control form-control-success',
                  );

                  $this->load->view('back/terms_of_service/terms_add', $this->data);

            }

            public function create_action()
            {
                  $this->rules();

                  if ($this->form_validation->run() == FALSE) 
                  {
                        $this->create();      
                  }
                  else 
                  {
                        $data = array(
                              'judul_terms'   => $this->input->post('judul_terms'),
                              'isi_terms'     => $this->input->post('isi_terms')
                        );

                        //query insert
                        $this->Terms_model->insert($data);
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
                        redirect('admin_gulderose/terms_of_service','refresh');
                  }
                  
            }     


            public function update($id)
            {
                  $row = $this->Terms_model->get_by_id($id);
                  $this->data['terms'] = $this->Terms_model->get_by_id($id);

                  if ($row) {

                        $this->data['title']          = 'Update Terms of Service';
                        $this->data['action']         = site_url('admin_gulderose/terms_of_service/update_action');
                        $this->data['button_submit']  = 'SIMPAN';
                        $this->data['button_reset']   = 'RESET';

                        $this->data['id_terms'] = array(
                              'name'  => 'id_terms',
                              'id'    => 'id_terms',
                              'type'  => 'hidden'
                        );

                        $this->data['judul_terms'] = array(
                        'name'        => 'judul_terms',
                        'id'          => 'judul_terms',
                        'type'        => 'text',
                        'placeholder' => 'Nama Terms of Service (Kebijakan Layanan)',
                        'class'       => 'form-control form-control-success'
                        );

                        $this->data['isi_terms'] = array(
                              'name'  => 'isi_terms',
                              'id'    => 'ckeditor',
                              'class' => 'form-control form-control-success',
                        );

                        $this->load->view('back/terms_of_service/terms_edit', $this->data);

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
                        redirect(site_url('admin_gulderose/terms_of_service'));
                  }
            }

            public function update_action()
            {
                  $this->rules();

                  if ($this->form_validation->run() == FALSE) 
                  {
                        $this->update($this->input->post('id_term'));
                        
                  } else {
                        $id['id_term'] = $this->input->post('id_term');

                        $data = array(
                              'id_terms'    => $this->input->post('id_terms'),
                              'judul_terms'   => $this->input->post('judul_terms'),
                              'isi_terms'     => $this->input->post('isi_terms')
                              );

                        $this->Terms_model->update($data, $this->input->post('id_terms'));
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
                        redirect(site_url('admin_gulderose/terms_of_service'));
                        
                  }
            }

            public function delete($id)
            {
                  $row = $this->Terms_model->get_by_id($id);

                  if ($row) 
                  {
                        $this->Terms_model->delete($id);
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
                        redirect(site_url('admin_gulderose/terms_of_service'));
                  }
                  else {
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
                        redirect(site_url('admin_gulderose/terms_of_service'));
                  }
            }



            //buat aturan/rule form
            public function rules()
            {
                  // validasi inputan
                  $this->form_validation->set_rules('id_terms', 'id_terms', 'trim');
                  $this->form_validation->set_rules('judul_terms', 'Judul Terms of Service', 'trim|required');
                  $this->form_validation->set_rules('isi_terms', 'Isi Terms of Service', 'trim|required');

                  // set pesan
                  $this->form_validation->set_message('required', '{field} wajib diisi');

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
     
      
            /* End of file Terms-of-service.php */
