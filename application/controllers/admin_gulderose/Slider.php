<?php
      
      defined('BASEPATH') OR exit('No direct script access allowed');
      
      class Slider extends CI_Controller 
      {
            
            public function __construct()
            {
                  parent::__construct();
                  $this->load->model('Slider_model');
                  $this->load->model('Penjualan_model');
                  $this->load->model('Companyprofile_model');
                  
                  $this->data['company_data']         = $this->Companyprofile_model->get_by_company();

                  $this->data['navbar_transaksi']       = $this->Penjualan_model->top5_transaksi_sudah_konfirmasi()->result();
                  $this->data['navbar_transaksi_row']      = $this->Penjualan_model->top5_transaksi_sudah_konfirmasi()->row();
                  
                  $this->data['modul'] = 'Slider'; 

                  if (!$this->ion_auth->logged_in()) //buat dicek sudah login ato belum
                  {
                        redirect('admin_gulderose/auth/login','refresh');
                  }
                  // cek apakah yg login superadmin, admin ato bukan
                  elseif (!$this->ion_auth->is_superadmin() && !$this->ion_auth->is_admin()) 
                  {
                        redirect('admin_gulderose/auth/login', 'refresh');
                  }
            }
            
            public function index()
            {
                  $this->data['title'] = 'Data' . $this->data['modul'];
                  $this->data['slider'] = $this->Slider_model->get_all();
                  // $this->load->view('back/slider/slider_list', $this->data);
                  $this->template->load('template', 'back/slider/slider_list', $this->data);

            }

            public function create()
            {
                  $this->data['title']          = 'Tambah Data'.$this->data['modul'];
                  $this->data['action']         = site_url('admin_gulderose/slider/create_action');
                  $this->data['button_submit']  = 'SIMPAN';
                  $this->data['button_reset']   = 'RESET';

                  $this->data['judul_slider'] = array(
                        'name'        => 'judul_slider',
                        'id'          => 'judul_slider',
                        'type'        => 'text',
                        'placeholder' => 'Judul Slider',
                        'class'       => 'form-control form-control-success'
                  );

                  // $this->data['link'] = array(
                  //       'name'        => 'link',
                  //       'id'          => 'link',
                  //       'type'        => 'text',
                  //       'placeholder' => 'Ex : https://www.google.com/',
                  //       'class'       => 'form-control form-control-success'
                  // );

                  //menampilkan tampilan slider_add
                  $this->template->load('template', 'back/slider/slider_add', $this->data );
            }

            public function create_action()
            {
                  $this->rules();
                  
                  if ($this->form_validation->run() == FALSE) 
                  {
                        $this->create();

                  } else {
                        //4 menyatakan tidak ada file
                        if ($_FILES['foto']['error'] <> 4) 
                        {
                              $nmfile = strtolower(url_title($this->input->post('judul_slider'))) . date('YmdHis');

                              //ambil dri library ci
                              $config['upload_path']      = './assets/images/slider/';
                              $config['allowed_types']    = 'jpg|jpeg|png|gif';
                              $config['max_size']         = '5048'; // 5 MB
                              $config['file_name']        = $nmfile; //nama yang terupload nantinya

                              $this->load->library('upload', $config);

                              if (!$this->upload->do_upload('foto')) {
                                    //file gagal diupload -> kembali ke form tambah
                                    $error = array('error' => $this->upload->display_errors());
                                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert">' . $error['error'] . '</div>');

                                    $this->create();
                              }
                              //file berhasil diupload -> lanjutkan ke query INSERT
                              else {
                                    $foto = $this->upload->data();
                                    $thumbnail                = $config['file_name'];
                                    // library yang disediakan codeigniter
                                    $config['image_library']  = 'gd2';
                                    // gambar yang akan dibuat thumbnail
                                    $config['source_image']   = './assets/images/slider/' . $foto['file_name'] . '';
                                    // rasio resolusi
                                    $config['maintain_ratio'] = FALSE;
                                    // lebar
                                    $config['width']          = 1200;
                                    // tinggi
                                    $config['height']         = 650;

                                    $this->load->library('image_lib', $config);
                                    $this->image_lib->resize();

                                    $data = array(
                                          'judul_slider'  => $this->input->post('judul_slider'),
                                          'foto'          => $nmfile,
                                          'foto_type'     => $foto['file_ext'],
                                    );

                                    // eksekusi query INSERT
                                    $this->Slider_model->insert($data);
                                    // set pesan data berhasil dibuat
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
                                    redirect(site_url('admin_gulderose/slider'));
                              }
                        //jika file upload kosong
                        } else {
                              $data = array(
                                    'judul_slider'    => $this->input->post('judul_slider'),
                              );

                              //query insert
                              $this->Slider_model->insert($data);
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
                              redirect(site_url('admin_gulderose/slider'));

                        }
                  }
            }

            public function update($id)
            {     
                  // $id   =$this->uri->segment(4);
                  $row                  = $this->Slider_model->get_by_id($id);
                  $this->data['slider'] = $this->Slider_model->get_by_id($id);

                  if ($row) {
                        $this->data['title']          = 'Data'.$this->data['modul'];
                        $this->data['action']         = site_url('admin_gulderose/slider/update_action');
                        $this->data['button_submit']  = 'SIMPAN';
                        $this->data['button_reset']   = 'RESET';

                        $this->data['id_slider'] = array(
                              'name'      => 'id_slider',
                              'id'        => 'id_slider',
                              'type'      => 'hidden'
                        );

                        $this->data['judul_slider'] = array(
                              'name'        => 'judul_slider',
                              'id'          => 'judul_slider',
                              'type'        => 'text',
                              'placeholder' => 'Judul Slider',
                              'class'       => 'form-control form-control-success'
                        );

                        // $this->data['link'] = array(
                        //       'name'        => 'link',
                        //       'id'          => 'link',
                        //       'type'        => 'text',
                        //       'placeholder' => 'Ex : https://www.google.com/',
                        //       'class'       => 'form-control form-control-success'
                        // );

                        $this->template->load('template', 'back/slider/slider_edit', $this->data);

                  } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
                                                                  <div class="container">
                                                                        <div class="alert-icon">
                                                                              <i class="zmdi zmdi-notifications"></i>
                                                                        </div>
                                                                        <strong>WARNING!</strong> | Data tidak ditemukan
                                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                                    <span aria-hidden="true">
                                                                                    <i class="zmdi zmdi-close"></i>
                                                                              </span>
                                                                        </button>
                                                                  </div>
                                                                  </div>');
                        redirect(site_url('admin_gulderose/slider'));
                  }
            }

            public function update_action()
            {
                  $this->rules();

                  if ($this->form_validation->run() == FALSE) 
                  {
                        $this->update($this->input->post('id_slider'));

                  } else {
                        $nmfile = strtolower(url_title($this->input->post('judul_slider'))).date('YmdHis');
                        $id['id_slider'] = $this->input->post('id_slider');
                        
                        if ($_FILES['foto']['error'] <> 4) {
                              $nmfile = strtolower(url_title($this->input->post('judul_slider'))).date('YmdHis');

                              //ambil library ci
                              $config['upload_path']      = './assets/images/slider/';
                              $config['allowed_types']    = 'jpg|jpeg|png|gif';
                              $config['max_size']         = '5048'; // 2 MB
                              $config['file_name']        = $nmfile; //nama yang terupload nantinya

                              $this->load->library('upload', $config);

                              //jika file gagal diupload -> kembali ke halaman update
                              if (!$this->upload->do_upload('foto')) 
                              {
                                    //file gagal diupload -> kembali ke form update
                                    $error = array('error' => $this->upload->display_errors());
                                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert">'.$error['error'].'</div>');

                                    $this->update($this->input->post('id_slider'));
                              }
                              //jika berhasil upload ->lanjut ke query insert
                              else {
                                    $delete = $this->Slider_model->del_by_id($this->input->post('id_slider'));

                                    $dir        = "assets/images/slider/".$delete->foto.$delete->foto_type;
                                    $dir_thumb  = "assets/images/slider/".$delete->foto.'_thumb'.$delete->foto_type;

                                    if (file_exists($dir)) 
                                    {
                                          //hapus foto dan thumbnail
                                          unlink($dir);
                                          unlink($dir_thumb);
                                    }

                                    $foto = $this->upload->data();
                                    //library yg dari CI
                                    $thumbnail        = $config['file_name'];
                                    //nama yg teruplod nantinya
                                    $config['image_library'] = 'gd2';
                                    //sumber gambarnya (buat thumbnailnya)
                                    $config['source_image'] = './assets/images/slider/'.$foto['file_name'].'';
                                    //rasio
                                    $config['maintain_ratio'] = FALSE;
                                    //lebar
                                    $config['width']         = 1200;
                                    //tinggi
                                    $config['height']       = 650;

                                    $this->load->library('image_lib', $config);

                                    $this->image_lib->resize();

                                    $data = array(
                                          'judul_slider'  => $this->input->post('judul_slider'),
                                          'foto'          => $nmfile,
                                          'foto_type'     => $foto['file_ext'],
                                    );

                                    $this->Slider_model->update($this->input->post('id_slider'),$data);
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
                                    redirect(site_url('admin_gulderose/slider'));
                                    
                              }

                        // jika file upload kosong    
                        } else {
                              $data = array(
                                    'judul_slider'    => $this->input->post('judul_slider'),
                              );

                              $this->Slider_model->update($this->input->post('id_slider'), $data);
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
                              redirect(site_url('admin_gulderose/slider'));

                        }
                  }
                  
            }

            public function delete($id)
            {
                  $delete = $this->Slider_model->del_by_id($id);
                  
                  //menyimpan lokasi gambar dlm variable
                  $dir        = "assets/images/slider/".$delete->foto.$delete->foto_type;
                  $dir_thumb  = "assets/images/slider/".$delete->foto.'_thumb'.$delete->foto_type;

                  //hapus foto
                  unlink($dir);
                  unlink($dir_thumb);

                  // Jika data ditemukan, maka hapus foto dan record nya
                  if ($delete) {
                        $this->Slider_model->delete($id);
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
                        redirect(site_url('admin_gulderose/slider'));
                  
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
                        redirect(site_url('admin_gulderose/slider'));
                  }

            }

            public function rules()
            {
                  //set rules
                  $this->form_validation->set_rules('id_slider', 'id_slider', 'trim');
                  $this->form_validation->set_rules('judul_slider', 'Judul Slider', 'trim|required');
                  //set message
                  $this->form_validation->set_message('required','{field} wajib diisi');

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
      
      /* End of file Controllername.php */
      
?>