<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produkrekomendasi extends CI_Controller
{

      public function __construct()
      {
            parent::__construct();
            $this->load->model('Produkrekomendasi_model');
            $this->load->model('Produk_model');
            $this->load->model('Kategori_model');
            $this->load->model('Penjualan_model');
            $this->load->model('Companyprofile_model');

            $this->data['company_data']         = $this->Companyprofile_model->get_by_company();
            $this->data['navbar_transaksi']       = $this->Penjualan_model->top5_transaksi_sudah_konfirmasi()->result();
            $this->data['navbar_transaksi_row']      = $this->Penjualan_model->top5_transaksi_sudah_konfirmasi()->row();

            $this->data['modul'] = 'Produk Rekomendasi';

            if (!$this->ion_auth->logged_in()) //buat dicek sudah login ato belum
            {
                  redirect('admin_gulderose/auth/login', 'refresh');
            }

            // cek apakah yg login superadmin, admin ato bukan
            elseif (!$this->ion_auth->is_superadmin() && !$this->ion_auth->is_admin()) {
                  redirect('admin_gulderose/auth/login', 'refresh');
            }
      }

      public function index()
      {
            $this->data['title']          = 'Data ' . $this->data['modul'];
            $this->data['produk_rekomendasi'] = $this->Produkrekomendasi_model->get_all();
            $this->template->load('template', 'back/produkrekomendasi/produkrekomendasi_list', $this->data);

      }

      public function create()
      {
            $this->data['title']          = 'Data '.$this->data['modul'];
            $this->data['action']         = site_url('admin_gulderose/produkrekomendasi/create_action');
            $this->data['button_submit']  = 'SIMPAN';
            $this->data['button_reset']   = 'RESET';

            $this->data['produk_id'] = array(
                  'name'      => 'produk_id',
                  'id'        => 'produk_id',
                  'class'     => 'form-control show-tick',
                  'required'  => ''
            );

            $this->data['get_combo_produk'] = $this->Produk_model->get_combo_produk();

            $this->load->view('back/produkrekomendasi/produkrekomendasi_add', $this->data);
            
      }

      public function create_action()
      { 
            $this->rules();
            
            if ($this->form_validation->run() == FALSE) 
            {
                  $this->create();

            } else {
                  $data = array(
                        'id_produk' => $this->input->post('produk_id'),
                  );

                  $this->Produkrekomendasi_model->insert($data);

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
                  redirect(site_url('admin_gulderose/produkrekomendasi'));


            }
            
      }

      public function update($id)
      {
            $row = $this->Produkrekomendasi_model->get_by_id($id);
            $this->data['produk_rekomendasi'] = $this->Produkrekomendasi_model->get_by_id($id);

            if ($row) {
                  $this->data['title']          = 'Data' . $this->data['modul'];
                  $this->data['action']         = site_url('admin_gulderose/produkrekomendasi/update_action');
                  $this->data['button_submit']  = 'SIMPAN';
                  $this->data['button_reset']   = 'RESET';

                  $this->data['id_produkrekomendasi'] = array(
                        'name'      => 'id_produkrekomendasi',
                        'id'        => 'produk_id',
                        'type'      => 'hidden',
                        'class'     => 'form-control show-tick',
                        'required'  => ''
                  );

                  $this->data['produk_id'] = array(
                        'name'      => 'produk_id',
                        'id'        => 'produk_id',
                        'class'     => 'form-control show-tick',
                        'required'  => ''
                  );

                  $this->data['get_combo_produk'] = $this->Produk_model->get_combo_produk();

                  $this->load->view('back/produkrekomendasi/produkrekomendasi_edit', $this->data);

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
                  redirect(site_url('admin_gulderose/produkrekomendasi'));
            }
            
      }

      public function update_action()
      {
            $this->rules();

            if ($this->form_validation->run() == FALSE) 
            {
                  $this->update($this->input->post('id_produkrekomendasi'));     

            } else {
                  $data = array(
                        'id_produk' => $this->input->post('produk_id'),
                  );

                  $this->Produkrekomendasi_model->update($this->input->post('id_produkrekomendasi'), $data);

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
                  redirect(site_url('admin_gulderose/produkrekomendasi'));
            }
            
      }


      public function delete($id)
      {
            $row = $this->Produkrekomendasi_model->get_by_id($id);

            if ($row) {
                  $this->Produkrekomendasi_model->delete($id);
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
                  redirect(site_url('admin_gulderose/produkrekomendasi'));

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
                  redirect(site_url('admin_gulderose/produkrekomendasi'));
            }
      }

      public function rules()
      {     
            $this->form_validation->set_rules('produk_id', 'Id Produk', 'trim');

            // $this->form_validation->set_message('');

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
