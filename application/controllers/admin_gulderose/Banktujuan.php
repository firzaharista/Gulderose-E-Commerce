<?php
      
      defined('BASEPATH') OR exit('No direct script access allowed');
      
      class Banktujuan extends CI_Controller 
      {      
            public function __construct()
            {
                  parent::__construct();
                  $this->load->model('Banktujuan_model');
                  $this->data['modul'] = 'Bank Tujuan';
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
                  $this->data['title']       = 'Data'.$this->data['modul'];
                  $this->data['bank_tujuan'] = $this->Banktujuan_model->get_all();
                  $this->template->load('template','back/banktujuan/banktujuan_list',$this->data);
            }

            public function create()
            {
                  $this->data['title']         = 'Tambah Data'.$this->data['modul'];
                  $this->data['action']        = site_url('admin_gulderose/banktujuan/create_action');
                  $this->data['button_submit'] = 'SIMPAN';
                  $this->data['button_reset']  = 'RESET';

                  $this->data['id_banktujuan'] = array(
                        'name'    => 'id_banktujuan',
                        'id'      => 'id_banktujuan',
                        'type'    => 'hidden'
                  );

                  $this->data['nama_banktujuan'] = array(
                        'name'        => 'nama_banktujuan',
                        'id'          => 'nama_banktujuan',
                        'type'        => 'text',
                        'placeholder' => 'Nama Bank Tujuan Gulderose',
                        'class'       => 'form-control form-control-success'
                  );
                  
                  $this->data['no_rektujuan'] = array(
                        'name'        => 'no_rektujuan',
                        'id'          => 'no_rektujuan',
                        'type'        => 'text',
                        'placeholder' => 'No. Rekening Bank Tujuan Gulderose',
                        'class'       => 'form-control form-control-success'
                  );

                  $this->data['atas_namatujuan'] = array(
                        'name'        => 'atas_namatujuan',
                        'id'          => 'atas_namatujuan',
                        'type'        => 'text',
                        'placeholder' => 'Atas Nama Bank Tujuan Gulderose',
                        'class'       => 'form-control form-control-success'
                  );

                  $this->template->load('template','back/banktujuan/banktujuan_add',$this->data);
            }

            public function create_action()
            {
                  $this->rules();
                  
                  if ($this->form_validation->run() == FALSE) 
                  {
                        $this->create();

                  } else {
                        $data = array(
                              'id_banktujuan'   => $this->input->post('id_banktujuan'),
                              'nama_banktujuan' => $this->input->post('nama_banktujuan'),
                              'no_rektujuan'    => $this->input->post('no_rektujuan'),
                              'atas_namatujuan' => $this->input->post('atas_namatujuan')
                        );

                        //query insert
                        $this->Banktujuan_model->insert($data);
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
                        redirect(site_url('admin_gulderose/banktujuan'));
                  }
                  
            }

            public function update($id)
            {
                  $row = $this->Banktujuan_model->get_by_id($id);
                  $this->data['bank_tujuan'] = $this->Banktujuan_model->get_by_id($id);

                  if ($row) 
                  {
                        $this->data['title']          = 'Ubah Data'.$this->data['modul'];
                        $this->data['action']         = site_url('admin_gulderose/banktujuan/update_action');
                        $this->data['button_submit']  = 'SIMPAN';
                        $this->data['button_reset']   = 'RESET';

                       $this->data['id_banktujuan'] = array(
                        'name' => 'id_banktujuan',
                        'id'   => 'id_banktujuan',
                        'type' => 'hidden',
                        );
                        
                        $this->data['nama_banktujuan'] = array(
                        'name'        => 'nama_banktujuan',
                        'id'          => 'nama_banktujuan',
                        'type'        => 'text',
                        'placeholder' => 'Nama Bank Tujuan Gulderose',
                        'class'       => 'form-control form-control-success'
                        );

                        $this->data['no_rektujuan'] = array(
                        'name'        => 'no_rektujuan',
                        'id'          => 'no_rektujuan',
                        'type'        => 'text',
                        'placeholder' => 'No. Rekening Bank Tujuan Gulderose',
                        'class'       => 'form-control form-control-success'
                        );

                        $this->data['atas_namatujuan'] = array(
                        'name'        => 'atas_namatujuan',
                        'id'          => 'atas_namatujuan',
                        'type'        => 'text',
                        'placeholder' => 'Atas Nama Bank Tujuan Gulderose',
                        'class'       => 'form-control form-control-success'
                        );

                        $this->template->load('template','back/banktujuan/banktujuan_edit', $this->data);

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
                        redirect(site_url('admin_gulderose/banktujuan'));
                  }
            }

            public function update_action()
            {
                  $this->rules();
                  
                  if ($this->form_validation->run() == FALSE) 
                  {
                        $this->update($this->input->post('id_banktujuan'));

                  } else {
                        $data = array(
                              'id_banktujuan'   => $this->input->post('id_banktujuan'),
                              'nama_banktujuan' => $this->input->post('nama_banktujuan'),
                              'no_rektujuan'    => $this->input->post('no_rektujuan'),
                              'atas_namatujuan' => $this->input->post('atas_namatujuan')
                        );

                        //query update
                        $this->Banktujuan_model->update($data, $this->input->post('id_banktujuan'));
                        //jika berhasil
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
                        redirect(site_url('admin_gulderose/banktujuan'));
                  }
                  
            }

            public function delete($id)
            {
                  $row = $this->Banktujuan_model->get_by_id($id);

                  if ($row) {
                        $this->Banktujuan_model->delete($id);
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
                        redirect(site_url('admin_gulderose/banktujuan'));

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
                        redirect(site_url('admin_gulderose/banktujuan'));
                  }
            }

            public function rules()
            {
                  //rules
                  $this->form_validation->set_rules('id_banktujuan', 'id_banktujuan', 'trim');
                  $this->form_validation->set_rules('nama_banktujuan', 'Nama Bank Tujuan', 'trim|required');
                  $this->form_validation->set_rules('no_rektujuan', 'No Rekening Tujuan', 'trim|required');
                  $this->form_validation->set_rules('atas_namatujuan', 'Atas Nama Bank Tujuan', 'trim|required');

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
      
      /* End of file Banktujuan.php */
      
?>