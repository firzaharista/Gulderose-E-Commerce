<?php
      
      defined('BASEPATH') OR exit('No direct script access allowed');
      
      class Companyprofile extends CI_Controller {
            
            public function __construct()
            {
                  parent::__construct();
                  $this->data['modul'] = 'Company Profile';
                  $this->load->model('Companyprofile_model');
                  $this->load->model('Penjualan_model');
                  
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
                  $this->load->view('back/companyprofile/companyprofile_edit',$this->data);
            }

            public function update($id)
            {
                  $row                   = $this->Companyprofile_model->get_by_id($id);
                  $this->data['company'] = $this->Companyprofile_model->get_by_id($id);

                  if ($row) {
                       $this->data['title']           = 'Ubah Data'.$this->data['modul'];
                       $this->data['action']          = site_url('admin_gulderose/companyprofile/update_action');
                       $this->data['button_submit']   = 'UPDATE';
                       $this->data['button_reset']    = 'RESET';

                       $this->data['id_company'] = array(
                             'name'       => 'id_company',
                             'id'         => 'id_company',
                             'type'       => 'hidden'
                       );

                       $this->data['nama_company'] = array(
                             'name'       => 'nama_company',
                             'id'         => 'nama_company',
                             'type'       => 'text',
                             'placeholder'=> 'Nama Perusahaan Anda',
                             'class'      => 'form-control form-control-success'
                       );

                       $this->data['judul_website'] = array(
                             'name'       => 'judul_website',
                             'id'         => 'judul_website',
                             'type'       => 'text',
                             'placeholder'=> 'Judul Website Gulderose',
                             'class'      => 'form-control form-control-success'
                       );

                       $this->data['email_company'] = array(
                             'name'       => 'email_company',
                             'id'         => 'email_company',
                             'type'       => 'text',
                             'placeholder'=> 'Ex : gulderose@gmail.com',
                             'class'      => 'form-control form-control-success'
                       );

                       $this->data['no_hp'] = array(
                             'name'       => 'no_hp',
                             'id'         => 'no_hp',
                             'type'       => 'text',
                             'placeholder'=> 'Ex : +6281901765133',
                             'class'      => 'form-control form-control-success'
                       );

                       $this->data['telp_company'] = array(
                             'name'       => 'telp_company',
                             'id'         => 'telp_company',
                             'type'       => 'text',
                             'placeholder'=> 'Ex : 0291-222-4412',
                             'class'      => 'form-control form-control-success'
                       );

                       $this->data['des_company'] = array(
                              'name'      => 'des_company',
                              'id' 	      => 'des_company',
                              'class'     => 'form-control no-resize',
                              'cols'      => '30',
                              'rows'      => '4',
                              'placeholder' => 'Deskripsi Perusahaan',
                        );
                       $this->data['alamat_company'] = array(
                             'name'       => 'alamat_company',
                             'id'         => 'alamat_company',
                             'class'      => 'form-control no-resize',
                              'cols'      => '30',
                              'rows'      => '4',
                              'placeholder' => 'Alamat Perusahaan',
                       );

                       $this->data['link_ig'] = array(
                              'name'      => 'link_ig',
                              'id'        => 'link_ig',
                              'type'      => 'text',
                              'placeholder'=> 'Ex : https://www.instagram.com/',
                              'class'      => 'form-control form-control-success'   
                       );

                       $this->data['link_fb'] = array(
                              'name'      => 'link_fb',
                              'id'        => 'link_fb',
                              'type'      => 'text',
                              'placeholder'=> 'Ex : https://www.facebook.com/',
                              'class'      => 'form-control form-control-success' 
                       );

                       $this->data['footer'] = array(
                             'name'       => 'footer',
                             'id'         => 'footer',
                             'type'       => 'text',
                             'placeholder'=> 'Footer Website',
                             'class'      => 'form-control form-control-success'
                       );

                       $this->load->view('back/companyprofile/companyprofile_edit', $this->data);

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
                        redirect(site_url('admin_gulderose/companyprofle/update/1'));
                  }
            }

            public function update_action()
            {
                  $this->rules();
                  
                  if ($this->form_validation->run() == FALSE) 
                  {
                        $this->update($this->input->post('id_company'));

                  } else {
                        $id['id_company'] = $this->input->post('id_company');
                        
                        //jika file upload diisi dan 4 menyatakan tidak ada file yg diupload
                        if ($_FILES['foto']['error'] <> 4) {
                              $nmfile = strtolower(url_title($this->input->post('nama_company'))).date('YmdHis');

                              $config['upload_path']      = './assets/images/company/';
                              $config['allowed_types']    = 'jpg|jpeg|png|gif';
                              $config['max_size']         = '5048'; // 5 MB
                              $config['file_name']        = $nmfile; //nama yang terupload nantinya

                              $this->load->library('upload', $config);

                              //jika file gagal diupload -> kembali ke halaman update company
                              if (!$this->upload->do_upload('foto')) {
                                    //file gagal diupload -> kembali ke form update
                                    $error = array('error' => $this->upload->display_errors());
                                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert">'.$error['error'].'</div>');

                                    $this->update($this->input->post('id_company'));
                              }
                              //jika berhasil upload ->lanjut ke query insert (hapus foto trs diupdate fotonya)
                              else {
                                    $delete = $this->Companyprofile_model->del_by_id($this->input->post('id_company'));

                                    $dir        = "assets/images/company/".$delete->foto.$delete->foto_type;
                                    $dir_thumb  = "assets/images/company/".$delete->foto.'_thumb'.$delete->foto_type;

                                    if (file_exists($dir)) 
                                    {
                                          //hapus foto dan thumbnail
                                          unlink($dir);
                                          unlink($dir_thumb);
                                    }

                                    $foto = $this->upload->data();
                                    //library yg dari CI
                                    $thumbnail  = $config['file_name'];
                                    //nama yg teruplod nantinya
                                    $config['image_library'] = 'gd2';
                                    //sumber gambarnya (buat thumbnailnya)
                                    $config['source_image'] = './assets/images/'.$foto['file_name'].'';
                                    //membuat thumbnail
                                    $config['create_thumb'] = TRUE;
                                    //rasio
                                    $config['maintain_ratio'] = FALSE;
                                    //lebar
                                    $config['width']         = 400;
                                    //tinggi
                                    $config['height']       = 400;

                                    $this->load->library('image_lib', $config);

                                    $this->image_lib->resize();

                                    $data = array(
                                          'nama_company'    => $this->input->post('nama_company'),
                                          'judul_website'   => $this->input->post('judul_website'),
                                          'des_company'     => $this->input->post('des_company'),
                                          'alamat_company'  => $this->input->post('alamat_company'),
                                          'no_hp'           => $this->input->post('no_hp'),
                                          'telp_company'    => $this->input->post('telp_company'),
                                          'email_company'   => $this->input->post('email_company'),
                                          'link_ig'         => $this->input->post('link_ig'),
                                          'link_fb'         => $this->input->post('link_fb'),
                                          'footer'          => $this->input->post('footer'),
                                          'footer'          => $this->input->post('footer'),
                                          'foto'            => $nmfile,
                                          'foto_type'       => $foto['file_ext'],

                                    );

                                    $this->Companyprofile_model->update($this->input->post('id_company'),$data);
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
                                    redirect(site_url('admin_gulderose/companyprofile/update/2'));
                              }
                              
                        } else {

                              $data = array(
                                          'nama_company'    => $this->input->post('nama_company'),
                                          'judul_website'   => $this->input->post('judul_website'),
                                          'des_company'     => $this->input->post('des_company'),
                                          'alamat_company'  => $this->input->post('alamat_company'),
                                          'no_hp'           => $this->input->post('no_hp'),
                                          'telp_company'    => $this->input->post('telp_company'),
                                          'email_company'   => $this->input->post('email_company'),
                                          'link_ig'         => $this->input->post('link_ig'),
                                          'link_fb'         => $this->input->post('link_fb'),
                                          'footer'          => $this->input->post('footer'),

                                    );
                                    $this->Companyprofile_model->update($this->input->post('id_company'),$data);
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
                                    redirect(site_url('admin_gulderose/companyprofile/update/2'));
                        }
                  }
                  
            }

            public function rules()
            {
                  //set rules
                  $this->form_validation->set_rules('id_company', 'id_company', 'trim');
                  $this->form_validation->set_rules('nama_company', 'Nama Company', 'trim|required');
                  $this->form_validation->set_rules('judul_website', 'Judul Website', 'trim|required');
                  $this->form_validation->set_rules('email_company', 'Email', 'required|valid_email');
                  $this->form_validation->set_rules('no_hp', 'No. HP', 'trim|required');
                  $this->form_validation->set_rules('telp_company', 'Telepon', 'trim|required');
                  $this->form_validation->set_rules('des_company', 'Deskripsi Company', 'trim|required');
                  $this->form_validation->set_rules('alamat_company', 'Alamat Company', 'trim|required');
                  $this->form_validation->set_rules('link_ig', 'Link IG', 'trim|required');
                  $this->form_validation->set_rules('link_fb', 'Link FB', 'trim|required');
                  $this->form_validation->set_rules('footer', 'Footer', 'trim|required');

                  //set pesan
                  $this->form_validation->set_message('required', '{field} Mohon Diisi');
                  $this->form_validation->set_message('valid_email', '{field} wajib diisi');

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
      
      /* End of file Companyprofile.php */
      
?>