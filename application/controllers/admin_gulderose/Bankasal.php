<?php
      
      defined('BASEPATH') OR exit('No direct script access allowed');
      
      class Bankasal extends CI_Controller 
      {
            
            public function __construct()
            {
                  parent::__construct();
                  $this->data['modul'] = 'Bank Asal';
                  $this->load->model('Bankasal_model');
                  $this->load->model('Penjualan_model');
                  $this->load->model('Companyprofile_model');
                  

                  $this->data['navbar_transaksi']           = $this->Penjualan_model->top5_transaksi_sudah_konfirmasi()->result();
                  $this->data['navbar_transaksi_row']       = $this->Penjualan_model->top5_transaksi_sudah_konfirmasi()->row();
                  $this->data['company_data']               = $this->Companyprofile_model->get_by_company();

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
                  $this->data['bankasal'] = $this->Bankasal_model->get_all();
                  $this->template->load('template','back/bankasal/bankasal_list',$this->data);
            }

            public function create()
            {
                  $this->data['title']         = 'Tambah Data'.$this->data['modul'];
                  $this->data['action']        = site_url('admin_gulderose/bankasal/create_action');
                  $this->data['button_submit'] = 'SIMPAN';
                  $this->data['button_reset']  = 'RESET';

                  $this->data['id_bankasal'] = array(
                        'name'    => 'id_bankasal',
                        'id'      => 'id_bankasal',
                        'type'    => 'hidden'
                  );

                  $this->data['nama_bankasal'] = array(
                        'name'        => 'nama_bankasal',
                        'id'          => 'nama_bankasal',
                        'type'        => 'text',
                        'placeholder' => 'Nama Bank Asal Pengguna',
                        'class'       => 'form-control form-control-success'
                  );

                  $this->template->load('template','back/bankasal/bankasal_add',$this->data);
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
                              'id_bankasal'     => $this->input->post('id_bankasal'),
                              'nama_bankasal'   => $this->input->post('nama_bankasal')
                        );

                        //query insert
                        $this->Bankasal_model->insert($data);
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
                        redirect('admin_gulderose/bankasal','refresh');
                  }
                  
            }     

            public function update($id)
            {
                  $row = $this->Bankasal_model->get_by_id($id);
                  $this->data['bank_asal'] = $this->Bankasal_model->get_by_id($id);

                  if ($row) 
                  {
                        $this->data['title']          = 'Ubah Data'.$this->data['modul'];
                        $this->data['action']         = site_url('admin_gulderose/bankasal/update_action');
                        $this->data['button_submit']  = 'SIMPAN';
                        $this->data['button_reset']   = 'RESET';

                       $this->data['id_bankasal'] = array(
                        'name' => 'id_bankasal',
                        'id'   => 'id_bankasal',
                        'type' => 'hidden',
                        );
                        $this->data['nama_bankasal'] = array(
                        'name'        => 'nama_bankasal',
                        'id'          => 'nama_bankasal',
                        'type'        => 'text',
                        'placeholder' => 'Nama Bank Asal Pengguna',
                        'class'       => 'form-control form-control-success'
                        );
                        
                        $this->template->load('template','back/bankasal/bankasal_edit',$this->data);
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
                        redirect(site_url('admin_gulderose/bankasal'));
                  }
            }

            public function update_action()
            {
                  $this->rules();
                  
                  if ($this->form_validation->run() == FALSE) 
                  {
                        $this->update($this->input->post('id_bankasal'));

                  } else {
                        $data = array(
                              'id_bankasal'     => $this->input->post('id_bankasal'),
                              'nama_bankasal'   => $this->input->post('nama_bankasal')
                        );    

                        //update
                        $this->Bankasal_model->update($data, $this->input->post('id_bankasal'));
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
                        redirect(site_url('admin_gulderose/bankasal'));

                  }
                  
            }

            public function delete($id)
            {
                  $row = $this->Bankasal_model->get_by_id($id);

                  if ($row) 
                  {
                        $this->Bankasal_model->delete($id);
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
                        redirect(site_url('admin_gulderose/bankasal'));
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
                        redirect(site_url('admin_gulderose/bankasal'));
                  }
            }

            public function rules()
            {
                  //rules
                  $this->form_validation->set_rules('id_bankasal', 'id_bankasal', 'trim');
                  $this->form_validation->set_rules('nama_bankasal', 'Nama Bank Asal', 'trim|required');

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
      
      /* End of file Bankasal.php */
      
?>