<?php
      
      defined('BASEPATH') OR exit('No direct script access allowed');
      
      class Panduanpembelian extends CI_Controller 
      {
      
            public function __construct()
            {
                  parent::__construct();
                  $this->data['modul'] = 'Panduan Pembelian';
                  $this->load->model('Panduanpembelian_model');
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
                  $this->data['title'] = 'Data'.$this->data['modul'];
                  $this->data['panduan'] = $this->Panduanpembelian_model->get_all();
                  $this->template->load('template', 'back/panduanpembelian/panduanpembelian_list', $this->data);
                  // $this->template->load('template','back/panduanpembelian/panduanpembelian_edit',$this->data);
            }

            public function create()
            {
                  $this->data['title']          = 'Tambah Data '.$this->data['modul'];
                  $this->data['action']         = site_url('admin_gulderose/panduanpembelian/create_action');
                  $this->data['button_submit']  = 'SIMPAN';
                  $this->data['button_reset']   = 'RESET';

                  $this->data['id_panduan'] = array(
                        'name' => 'id_panduan',
                        'id'   => 'id_panduan',
                        'type' => 'hidden',
                  );
                  $this->data['judul_panduan'] = array(
                        'name'        => 'judul_panduan',
                        'id'          => 'judul_panduan',
                        'type'        => 'text',
                        'placeholder' => 'Judul Panduan Pembelian',
                        'class'       => 'form-control form-control-success'
                  );
                  $this->data['keterangan'] = array(
                        'name'      => 'keterangan',
                        'id'        => 'ckeditor',
                        'class'     => 'form-control form-control-success'
                  );

                  $this->load->view('back/panduanpembelian/panduanpembelian_add', $this->data);
            }

            public function create_action()
            {
                  $this->rules();
                  
                  if ($this->form_validation->run() == FALSE) 
                  {
                        $this->create();
                  } else 
                  {
                        $data = array(
                              'judul_panduan' => $this->input->post('judul_panduan'),
                              'keterangan'    => $this->input->post('keterangan'),
                              'slug_panduan'  => strtolower(url_title($this->input->post('judul_panduan')))
                        );

                        //eksekusi query insert
                        $this->Panduanpembelian_model->insert($data);
                        //pesan jika berhasil
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
                        redirect('admin_gulderose/panduanpembelian','refresh');

                  }
                  
            }

            public function update($id)
            {
                  $row = $this->Panduanpembelian_model->get_by_id($id);
                  $this->data['panduan'] = $this->Panduanpembelian_model->get_by_id($id);

                  if ($row) 
                  {
                        $this->data['title']          = 'Ubah Data'.$this->data['modul'];
                        $this->data['action']         = site_url('admin_gulderose/panduanpembelian/update_action');
                        $this->data['button_submit']  = 'SIMPAN';
                        $this->data['button_reset']   = 'RESET';

                       $this->data['id_panduan'] = array(
                        'name' => 'id_panduan',
                        'id'   => 'id_panduan',
                        'type' => 'hidden',
                        );
                        $this->data['judul_panduan'] = array(
                        'name'        => 'judul_panduan',
                        'id'          => 'judul_panduan',
                        'type'        => 'text',
                        'placeholder' => 'Judul Panduan Pembelian',
                        'class'       => 'form-control form-control-success'
                        );
                        $this->data['keterangan'] = array(
                        'name'      => 'keterangan',
                        'id'        => 'ckeditor',
                        'class'     => 'form-control form-control-success'
                        );

                        $this->load->view('back/panduanpembelian/panduanpembelian_edit', $this->data);

                  }
                  else
                  {
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
                        redirect(site_url('admin_gulderose/panduanpembelian'));
                  }
            }

            public function update_action()
            {
                  $this->rules();
                  
                  if ($this->form_validation->run() == FALSE) 
                  {
                        $this->update($this->input->post('id_panduan'));       
                  } 
                  else 
                  {
                        $data = array(
                              'judul_panduan' => $this->input->post('judul_panduan'),
                              'keterangan'    => $this->input->post('keterangan'),
                              'slug_panduan'  => strtolower(url_title($this->input->post('judul_panduan')))
                        );

                        //eksekusi query update
                        $this->Panduanpembelian_model->update($data, $this->input->post('id_panduan'));
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
                        redirect(site_url('admin_gulderose/panduanpembelian'));
                  }
                  
            }

            public function delete($id)
            {
                  $row = $this->Panduanpembelian_model->get_by_id($id);

                  if ($row) 
                  {
                        $this->Panduanpembelian_model->delete($id);
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
                        redirect(site_url('admin_gulderose/panduanpembelian'));
                  }
                  else 
                  {
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
                        redirect(site_url('admin_gulderose/panduanpembelian'));
                  }
            }

            public function rules()
            {
                  //aturan
                  $this->form_validation->set_rules('id_panduan', 'id_panduan', 'trim');
                  $this->form_validation->set_rules('judul_panduan', 'Judul Panduan', 'trim|required');
                  $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');

                  //message
                  $this->form_validation->set_message('required','{field} harus diisi');
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
      
      /* End of file Panduanpembeliadn.php */
      
?>
