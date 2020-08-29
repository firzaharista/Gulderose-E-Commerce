<?php
      
      defined('BASEPATH') OR exit('No direct script access allowed');
      
      class Tentangkami extends CI_Controller 
      {
            
            public function __construct()
            {
                  parent::__construct();
                  $this->data['modul'] = 'Tentang Kami';
                  $this->load->model('Tentangkami_model');
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

            public function update($id)
            {
                  $row = $this->Tentangkami_model->get_by_id($id);
                  $this->data['tentangkami'] = $this->Tentangkami_model->get_by_id($id);

                  if ($row) {
                        // if($this->session->userdata("company_id") != $row->)
                        // {

                        $this->data['title']          = 'Update Tentang Kami';
                        $this->data['action']         = site_url('admin_gulderose/tentangkami/update_action');
                        $this->data['button_submit']  = 'UPDATE';
                        $this->data['button_reset']   = 'RESET';

                        $this->data['id_tentangkami'] = array(
                              'id'  => 'id_tentangkami',
                              'name' => 'id_tentangkami',
                              'type' => 'hidden',
                        );

                        $this->data['isi_tentangkami'] = array(
                              'name'  => 'isi_tentangkami',
                              'id'    => 'ckeditor',
                              'class' => 'form-control form-control-success',
                        );

                        $this->load->view('back/tentangkami/tentangkami_edit', $this->data);
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
                        redirect(site_url('admin_gulderose/tentangkami/update/2'));
                  }
            }

            public function update_action()
            {
                  $this->rules();

                  if ($this->form_validation->run() == FALSE) {
                        $this->update($this->input->post('id_tentangkami'));
                        
                  } else {
                        $id['id_tentangkami'] = $this->input->post('id_tentangkami');

                        $data = array(
                              'id_tentangkami'    => $this->input->post('id_tentangkami'),
                              'isi_tentangkami'   => $this->input->post('isi_tentangkami'),
                              );

                        $this->Tentangkami_model->update($data, $this->input->post('id_tentangkami'));
                        $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">
                                                                  <div class="container">
                                                                        <div class="alert-icon">
                                                                              <i class="zmdi zmdi-thumb-up"></i>
                                                                        </div>
                                                                        <strong>WELL DONE!</strong> | Data berhasil disimpan
                                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                                    <span aria-hidden="true">
                                                                                    <i class="zmdi zmdi-close"></i>
                                                                              </span>
                                                                        </button>
                                                                  </div>
                                                                  </div>');
                        redirect(site_url('admin_gulderose/tentangkami/update/2'));
                        
                  }
            }



            //buat aturan/rule form
            public function rules()
            {
                  // validasi inputan
                  $this->form_validation->set_rules('id_tentangkami', 'id_tentangkami', 'trim');
                  $this->form_validation->set_rules('isi_tentangkami', 'Isi Tentang Kami', 'trim|required');

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
     
      
            /* End of file Tentangkami.php */
      
?>