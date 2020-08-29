<?php
      
      defined('BASEPATH') OR exit('No direct script access allowed');
      
      class Ketentuanpembelian extends CI_Controller 
      {
      
            public function __construct()
            {
                  parent::__construct();
                  $this->data['modul'] = 'Ketentuan Pembelian';
                  $this->load->model('Ketentuanpembelian_model');
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
                  // $this->template->load('template','back/ketentuanpembelian/ketentuanpembelian_edit',$this->data);
                  $this->load->view('back/ketentuanpembelian/ketentuanpembelian_edit',$this->data);
            }

            public function update($id)
            {
                  $id  = $this->uri->segment(4);
                  $row = $this->Ketentuanpembelian_model->get_by_id($id);
                  

                  if ($row) 
                  {     
                        //buat nanti dipanggil
                        $this->data['action']         = site_url('admin_gulderose/ketentuan/update_action/1');
                        $this->data['button_submit']  = 'Simpan';
                        $this->data['button_reset']   = 'Reset';
                        $this->data['ketentuan'] = $this->Ketentuanpembelian_model->get_by_id($id);

                        $this->data['id_ketentuan'] = array(
                              'name'      => 'id_ketentuan',
                              'id'        => 'id_ketentuan',
                              'type'      => 'hidden'
                        );

                        $this->data['isi_ketentuan'] = array(
                        'name'            => 'isi_ketentuan',
                        'id'              => 'ckeditor'
                  );
                  $this->load->view('back/ketentuanpembelian/ketentuanpembelian_edit', $this->data);
                  
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
                        redirect(site_url('admin_gulderose/ketentuanpembelian'));
                  }
            }

            public function update_action()
            {

                  $id = $this->uri->segment(4);
                  // $id = 1;
                  
                  $this->rules();

                  //jika berjalan tapi salah
                  if ($this->form_validation->run() == FALSE ) 
                  {
                        $this->update($this->input->post('id_ketentuan'));

                  //      $this->data['ketentuan'] = $this->ketentuanpembelian_model->get_by_id($id);
                       
                  //      $this->load->view('back/ketentuanpembelian/ketentuanpembelian_edit', $this->data);
                       
                       
                  } else 
                  {
                        $data = array(
                              'isi_ketentuan' => $this->input->post('id_ketentuan')
                        );

                        $this->Ketentuanpembelian_model->update($this->input->post('id_ketentuan'), $data);
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
                        redirect(site_url('admin_gulderose/ketentuan'));
                  }
                  
                  
            }

            // buat aturan di form validation
            public function rules()
            {
                  // validasi inputan
                  $this->form_validation->set_rules('id_ketentuan', 'Id Ketentuan', 'trim');
                  $this->form_validation->set_rules('isi_ketentuan', 'Isi Ketentuan', 'trim|required');

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
      
      /* End of file Ketentuanpembeliadn.php */
      
?>
