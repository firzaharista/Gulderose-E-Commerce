<?php
      
      defined('BASEPATH') OR exit('No direct script access allowed');
      
      class Supersubkategori extends CI_Controller {
            
            public function __construct()
            {
                  parent::__construct();
                  $this->data['modul'] = 'SuperSubKategori';
                  $this->load->model('Supersubkategori_model');
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
                  $this->data['title']       = 'Data'.$this->data['modul'];
                  $this->data['supersubkat'] = $this->Supersubkategori_model->get_all();

                  $this->template->load('template', 'back/supersubkategori/supersubkategori_list', $this->data );
            }

            public function create()
            {

                  $this->data['title']          = 'Tambah Data '.$this->data['modul'];
                  $this->data['action']         = site_url('admin_gulderose/supersubkategori/create_action');
                  $this->data['button_submit']  = 'SIMPAN';
                  $this->data['button_reset']   = 'RESET';

                  $this->data['kat_id'] = array(
                        'name'      => 'kat_id',
                        'id'        => 'kat_id',
                        'class'     => 'form-control show-tick',
                        'required'  => '',
                        'onChange' => 'tampilSubkat()'
                        
                  );

                  $this->data['subkat_id'] = array(
                        'name'      => 'subkat_id',
                        'id'        => 'subkat_id',
                        'class'     => 'form-control show-tick',
                        'required'  => ''
                  );

                  $this->data['judul_supersubkategori'] = array(
                        'name'      => 'judul_supersubkategori',
                        'id'        => 'judul_supersubkategori',
                        'type'      => 'text',
                        'placeholder'=> 'Judul Subkategori',
                        'class'     => 'form-control form-control-success',
                        'value'     => $this->form_validation->set_value('judul_supersubkategori')
                  );

                  $this->data['ambil_kategori'] = $this->Kategori_model->ambil_kategori();

                  // $this->template->load('template','back/supersubkategori/supersubkategori_add', $this->data);
                  $this->load->view('back/supersubkategori/supersubkategori_add', $this->data);
                  
            }

            public function create_action()
            {
                  $this->rules();
                  
                  if ($this->form_validation->run() == FALSE) 
                  {
                       $this->create();
                        
                  } else {
                        $data = array(
                              'id_kategori'            => $this->input->post('kat_id'),
                              'id_subkategori'         => $this->input->post('subkat_id'),
                              'judul_supersubkategori' => $this->input->post('judul_supersubkategori'),
                              'slug_supersubkategori'  => strtolower(url_title($this->input->post('judul_supersubkategori')))
                        );

                        //query insert
                        $this->Supersubkategori_model->insert($data);
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
                        redirect(site_url('admin_gulderose/supersubkategori'));
                  }
                  
            }

            public function update($id)
            {
                  $row                          = $this->Supersubkategori_model->get_by_id($id);
                  $this->data['supersubkat']    = $this->Supersubkategori_model->get_by_id($id);

                  if ($row) {

                        $this->data['title']          = 'Tambah Data ' . $this->data['modul'];
                        $this->data['action']         = site_url('admin_gulderose/supersubkategori/update_action');
                        $this->data['button_submit']  = 'SIMPAN';
                        $this->data['button_reset']   = 'RESET';

                        $this->data['id_supersubkategori'] = array(
                              'name' => 'id_supersubkategori',
                              'id'   => 'id_supersubkategori',
                              'type' => 'hidden'
                        );

                        $this->data['subkat_id'] = array(
                        'name'      => 'subkat_id',
                        'id'        => 'subkat_id',
                        'class'     => 'form-control show-tick',
                        'required'  => ''
                        );

                        $this->data['kat_id'] = array(
                        'name'      => 'kat_id',
                        'id'        => 'kat_id',
                        'class'     => 'form-control show-tick',
                        'required'  => '',
                        'onClick' => 'tampilSubkat()'
                        );

                        $this->data['judul_supersubkategori'] = array(
                        'name'      => 'judul_supersubkategori',
                        'id'        => 'judul_supersubkategori',
                        'type'      => 'text',
                        'placeholder' => 'Judul SUperSubkategori',
                        'class'     => 'form-control form-control-success',
                        'value'     => $this->form_validation->set_value('judul_supersubkategori')
                        );

                        $kat_id    = $row->id_kategori;
                        $subkat_id = $row->id_subkategori;

                        $this->data['ambil_kategori']  = $this->Kategori_model->ambil_kategori();
                        $this->data['ambil_subkat']    = $this->Kategori_model->ambil_subkat($kat_id);

                        $this->template->load('template','back/supersubkategori/supersubkategori_edit',$this->data);

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
                        redirect(site_url('admin_gulderose/supersubkategori'));
                  }
                  
            }

            public function delete($id)
            {
                  $row  = $this->Supersubkategori_model->get_by_id($id);
                  
                  if ($row) {
                        
                        $this->Supersubkategori_model->delete($id);
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
                        redirect('admin_gulderose/supersubkategori','refresh');

                  //jika data tidak ada/kosong      
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
                        redirect('admin_gulderose/supersubkategori','refresh');
                  }
            }

            //jalan ketika kategori sudah diklik
            public function pilih_subkategori()
            {
                  $this->data['subkategori'] = $this->Kategori_model->ambil_subkategori($this->uri->segment(4));
                  $this->load->view('back/produk/v_subkat', $this->data);
            }
            
            public function rules()
            {
                  //set rules
                  $this->form_validation->set_rules('id_supersubkategori', 'Id SuperSubKategori', 'trim');
                  $this->form_validation->set_rules('id_subkategori', 'Id SubKategori', 'trim');
                  $this->form_validation->set_rules('kat_id', 'Id Kategori', 'trim');
                  $this->form_validation->set_rules('judul_supersubkategori', 'Judul SuperSubKategori', 'trim|required');

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
            
      /* End of file SuperSubKategori.php */
      
?>