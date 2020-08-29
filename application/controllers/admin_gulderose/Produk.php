<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {
	 
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Produk_model');
		$this->load->model('Kategori_model');
		$this->load->model('Subkategori_model');
		$this->load->model('Supersubkategori_model');
		$this->load->model('Penjualan_model');
		$this->load->model('Companyprofile_model');

		$this->data['company_data']           = $this->Companyprofile_model->get_by_company();
		$this->data['navbar_transaksi']       = $this->Penjualan_model->top5_transaksi_sudah_konfirmasi()->result();
		$this->data['navbar_transaksi_row']   = $this->Penjualan_model->top5_transaksi_sudah_konfirmasi()->row();
		
		$this->data['modul'] = 'Produk';

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
		$this->data['title']  = 'Data '. $this->data['modul'];
		$this->data['produk'] = $this->Produk_model->get_all();
		$this->template->load('template', 'back/produk/produk_list', $this->data);
	}

	public function kat_produk()
	{
		$this->data['title']		= 'Kategori Produk';
		$this->data['kat_produk']	= $this->Produk_model->kat_produk();
		$this->template->load('template', 'back/produk/kat_produk', $this->data);
	}

	public function stok_kosong()
	{
		$this->data['title']  		= 'Data Stok Kosong';
		$this->data['produk_kosong'] 	= $this->Produk_model->get_all_kosong();
		$this->template->load('template', 'back/produk/produk_kosong', $this->data);
	}

	public function detail($id)
	{
		$this->data['produk_detail'] = $this->Produk_model->get_by_id_detail($id);
		$this->template->load('template', 'back/produk/produk_detail', $this->data);
	}

	public function create()
	{
		$this->data['title'] 		= 'Data'. $this->data['modul'];
		$this->data['action']		= site_url('admin_gulderose/produk/create_action');
		$this->data['button_submit']	= 'SIMPAN';
		$this->data['button_reset']	= 'RESET';

		$this->data['produk_created'] = array(
			'name'	 => 'produk_created',
			'id'		 => 'produk_created',
			'type'	 => 'text',
			'placeholder'=> 'Nama Produk (Nama Harus Beda)',
			'class'       => 'form-control form-control-success',
			'required'	 => '',
		);

		$this->data['keywords'] = array(
			'name'       => 'keywords',
			'id'         => 'keywords',
			'type'       => 'text',
			'placeholder' => 'ex : buket, wall decor dll',
			'class'      => 'form-control form-control-success'
		);

		$this->data['deskripsi'] = array(
			'name'      => 'deskripsi',
			'id' 	      => 'deskripsi',
			'class'     => 'form-control no-resize',
			'cols'      => '30',
			'rows'      => '4',
			'placeholder' => 'Deskripsi Produk',
		);

		$this->data['harga_normal'] = array(
			'name'       => 'harga_normal',
			'id'         => 'harga_normal',
			'type'       => 'text',
			'placeholder' => 'Isikan angka saja',
			'onkeyup'	 => 'hitung();',
			'class'      => 'form-control form-control-success'
		);
		
		$this->data['diskon'] = array(
			'name'       => 'diskon',
			'id'         => 'diskon',
			'type'       => 'text',
			'placeholder' => 'Isikan angka saja ( jika tidak diskon diisi 0 )',
			'onkeyup'	 => 'hitung();',
			'class'      => 'form-control form-control-success'
		);

		$this->data['harga_diskon'] = array(
			'name'       => 'harga_diskon',
			'id'         => 'harga_diskon',
			'type'       => 'text',
			'placeholder' => 'Isikan angka saja',
			'onkeyup'	 => 'hitung();',
			'class'      => 'form-control form-control-success'
		);

		$this->data['berat'] = array(
			'name'       => 'berat',
			'id'         => 'berat',
			'type'       => 'text',
			'placeholder' => 'Isikan angka saja',
			'class'      => 'form-control form-control-success'
		);

		$this->data['kat_id'] = array(
			'name'        => 'kat_id',
			'id'          => 'kat_id',
			'class'       => 'form-control show-tick',
			'onChange'    => 'tampilSubkat()',
			'required'    => '',
		);
		$this->data['subkat_id'] = array(
			'name'        => 'subkat_id',
			'id'          => 'subkat_id',
			'class'       => 'form-control show-tick',
			'onChange'    => 'tampilSuperSubkat()',
		);

		$this->data['ambil_kategori']	= $this->Kategori_model->ambil_kategori();
		$this->load->view('back/produk/produk_add', $this->data);
		
	}

	public function create_action()
	{
		$this->rules();

		if ($this->form_validation->run() == FALSE) 
		{
			$this->create();

		} else {
			//4 menyatakan tidak ada file
			if ($_FILES['foto']['error'] <> 4) {
				$nmfile = strtolower(url_title($this->input->post('produk_created'))) . date('YmdHis');

				//ambil dri library ci
				$config['upload_path']      = './assets/images/produk/';
				$config['allowed_types']    = 'jpg|jpeg|png|gif';
				$config['max_size']         = '5000'; // 5 MB
				$config['file_name']        = $nmfile; //nama yang terupload nantinya

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('foto')) {
					//file gagal diupload -> kembali ke form tambah
					$error = array('error' => $this->upload->display_errors());
					$this->session->set_flashdata('message', '<div class="alert alert-danger alert">' . $error['error'] . '</div>');

					$this->create();
				}
				//file berhasil diupload -> lanjut INSERT
				else {
					$foto 			  = $this->upload->data();
					$thumbnail                = $config['file_name'];
					// library yang disediakan codeigniter
					$config['image_library']  = 'gd2';
					// gambar yang akan dibuat thumbnail
					$config['source_image']   = './assets/images/produk/' . $foto['file_name'] . '';
					// membuat thumbnail
					$config['create_thumb']   = TRUE;
					// rasio resolusi
					$config['maintain_ratio'] = FALSE;
					// lebar
					$config['width']          = 500;
					// tinggi
					$config['height']         = 500;

					$this->load->library('image_lib', $config);
					$this->image_lib->resize();

					$data = array(
						'judul_produk'  		=> ucwords($this->input->post('produk_created')),
						'slug_produk'   		=> strtolower(url_title($this->input->post('produk_created'))),
						'keywords'      		=> strtolower($this->input->post('keywords')),
						'deskripsi'	    		=> $this->input->post('deskripsi'),
						'berat'	    		=> $this->input->post('berat'),
						'ukuran'			=> $this->input->post('ukuran'),
						'id_kategori'   		=> $this->input->post('kat_id'),
						'id_subkategori'		=> $this->input->post('subkat_id'),
						'harga_normal'  		=> $this->input->post('harga_normal'),
						'diskon'	    		=> $this->input->post('diskon'),
						'harga_diskon'  		=> $this->input->post('harga_diskon'),
						'stok'	    		=> $this->input->post('stok'),
						'foto'	    		=> $nmfile,
						'foto_type'     		=> $foto['file_ext'],
					);

					// eksekusi query INSERT
					$this->Produk_model->insert($data);
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
					redirect(site_url('admin_gulderose/produk'));
				}
				//jika file upload kosong
			} else {
				$data = array(
					'judul_produk'  		=> ucwords($this->input->post('produk_created')),
					'slug_produk'   		=> strtolower(url_title($this->input->post('produk_created'))),
					'keywords'      		=> strtolower($this->input->post('keywords')),
					'deskripsi'	    		=> $this->input->post('deskripsi'),
					'berat'	    		=> $this->input->post('berat'),
					'ukuran'			=> $this->input->post('ukuran'),
					'id_kategori'   		=> $this->input->post('kat_id'),
					'id_subkategori'		=> $this->input->post('subkat_id'),
					'harga_normal'  		=> $this->input->post('harga_normal'),
					'diskon'	    		=> $this->input->post('diskon'),
					'harga_diskon'  		=> $this->input->post('harga_diskon'),
					'stok'	    		=> $this->input->post('stok'),
				);

				//query insert
				$this->Produk_model->insert($data);
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
				redirect(site_url('admin_gulderose/produk'));
			}
		}
	}

	public function update($id)
	{
		$row = $this->Produk_model->get_by_id($id);
		$this->data['produk'] = $this->Produk_model->get_by_id($id);

		if ($row) {
			$this->data['title'] 		= 'Data' . $this->data['modul'];
			$this->data['action']		= site_url('admin_gulderose/produk/update_action');
			$this->data['button_submit']	= 'SIMPAN';
			$this->data['button_reset']	= 'RESET';

			$this->data['id_produk'] = array(
				'name'	 => 'id_produk',
				'id'		 => 'id_produk',
				'type'	 => 'hidden'
			);

			$this->data['produk_upd'] = array(
				'name'	 => 'produk_upd',
				'id'		 => 'produk_upd',
				'type'	 => 'text',
				'placeholder'=> 'Nama Produk',
				'class'      => 'form-control form-control-success',
				'required'	 => ''
			);

			$this->data['keywords'] = array(
				'name'       => 'keywords',
				'id'         => 'keywords',
				'type'       => 'text',
				'placeholder' => 'ex : buket, wall decor dll',
				'class'      => 'form-control form-control-success'
			);

			$this->data['deskripsi'] = array(
				'name'      => 'deskripsi',
				'id' 	      => 'deskripsi',
				'class'     => 'form-control no-resize',
				'cols'      => '30',
				'rows'      => '4',
				'placeholder' => 'Deskripsi Produk',
			);

			$this->data['harga_normal'] = array(
				'name'       => 'harga_normal',
				'id'         => 'harga_normal',
				'type'       => 'text',
				'placeholder'=> 'Isikan angka saja',
				'onkeyup'	 => 'hitung();',
				'class'      => 'form-control form-control-success'
			);

			$this->data['diskon'] = array(
				'name'       => 'diskon',
				'id'         => 'diskon',
				'type'       => 'text',
				'placeholder' => 'Isikan angka saja',
				'onkeyup'	 => 'hitung();',
				'class'      => 'form-control form-control-success'
			);

			$this->data['harga_diskon'] = array(
				'name'       => 'harga_diskon',
				'id'         => 'harga_diskon',
				'type'       => 'text',
				'placeholder' => 'Isikan angka saja',
				'onkeyup'	 => 'hitung();',
				'class'      => 'form-control form-control-success'
			);

			$this->data['stok'] = array(
				'name'        => 'stok',
				'id'          => 'stok',
				'class'       => 'form-control show-tick',
				'required'    => '',
			);

			$this->data['berat'] = array(
				'name'       => 'berat',
				'id'         => 'berat',
				'type'       => 'text',
				'placeholder' => 'Isikan angka saja',
				'class'      => 'form-control form-control-success'
			);

			$this->data['kat_id'] = array(
				'name'        => 'kat_id',
				'id'          => 'kat_id',
				'class'       => 'form-control show-tick',
				'onChange'    => 'tampilSubkat()',
				'required'    => '',
			);
			$this->data['subkat_id'] = array(
				'name'        => 'subkat_id',
				'id'          => 'subkat_id',
				'class'       => 'form-control show-tick',
				'onChange'    => 'tampilSuperSubkat()',
			);


			$kat = $row->id_kategori; //ambil dr databasenya
			// $subkat = $row->id_subkategori;

			$this->data['ambil_stok']	   = $this->Produk_model->ambil_stok();
			$this->data['ambil_kategori']    = $this->Kategori_model->ambil_kategori();
			$this->data['ambil_subkat']      = $this->Kategori_model->ambil_subkategori($kat);
			// $this->data['ambil_supersubkat'] = $this->Kategori_model->ambil_supersubkat($subkat);

			$this->load->view('back/produk/produk_edit', $this->data);

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
			redirect(site_url('admin_gulderose/produk'));
		}

	}

	public function update_action()
	{
		$this->rules();
		
		if ($this->form_validation->run() == FALSE) 
		{
			$this->update($this->input->post('id_produk'));

		//jika file upload diisi
		} else {
			$nmfile = strtolower(url_title($this->input->post('produk_upd'))) . date('YmdHis');
			$id['id_produk'] = $this->input->post('id_produk');

			if ($_FILES['foto']['error'] <> 4) 
			{
				$nmfile = strtolower(url_title($this->input->post('produk_upd'))) . date('YmdHis');

				//ambil library ci
				$config['upload_path']      = './assets/images/produk/';
				$config['allowed_types']    = 'jpg|jpeg|png|gif';
				$config['max_size']         = '5000'; // 5 MB
				$config['file_name']        = $nmfile; //nama yang terupload nantinya

				$this->load->library('upload', $config);

				//jika file gagal diupload -> kembali ke halaman update produk
				if (!$this->upload->do_upload('foto')) {
					//file gagal diupload -> kembali ke form update
					$error = array('error' => $this->upload->display_errors());
					$this->session->set_flashdata('message', '<div class="alert alert-danger alert">' . $error['error'] . '</div>');

					$this->update($this->input->post('id_produk'));
				}
				//jika berhasil upload ->lanjut ke query insert
				else {
					$delete = $this->Produk_model->del_by_id($this->input->post('id_produk'));

					$dir        = "assets/images/produk/" . $delete->foto . $delete->foto_type;
					$dir_thumb  = "assets/images/produk/" . $delete->foto . '_thumb' . $delete->foto_type;

					if (file_exists($dir)) {
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
					$config['source_image'] = './assets/images/produk/' . $foto['file_name'] . '';
					// membuat thumbnail
					$config['create_thumb']   = TRUE;
					//rasio
					$config['maintain_ratio'] = FALSE;
					//lebar
					$config['width']         = 500;
					//tinggi
					$config['height']       = 500;

					$this->load->library('image_lib', $config);

					$this->image_lib->resize();

					$data = array(
						'judul_produk'  		=> ucwords($this->input->post('produk_upd')),
						'slug_produk'   		=> strtolower(url_title($this->input->post('produk_upd'))),
						'keywords'      		=> strtolower($this->input->post('keywords')),
						'deskripsi'	    		=> $this->input->post('deskripsi'),
						'berat'	    		=> $this->input->post('berat'),
						'ukuran'			=> $this->input->post('ukuran'),
						'id_kategori'   		=> $this->input->post('kat_id'),
						'id_subkategori'		=> $this->input->post('subkat_id'),
						'harga_normal'  		=> $this->input->post('harga_normal'),
						'diskon'	    		=> $this->input->post('diskon'),
						'harga_diskon'  		=> $this->input->post('harga_diskon'),
						'stok'	    		=> $this->input->post('stok'),
						'foto'	    		=> $nmfile,
						'foto_type'     		=> $foto['file_ext'],
					);

					$this->Produk_model->update($this->input->post('id_produk'), $data);
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
					redirect(site_url('admin_gulderose/produk'));
				}

				// jika file upload kosong    
			} else {
				$data = array(
					'judul_produk'  		=> ucwords($this->input->post('produk_upd')),
					'slug_produk'   		=> strtolower(url_title($this->input->post('produk_upd'))),
					'keywords'      		=> strtolower($this->input->post('keywords')),
					'deskripsi'	    		=> $this->input->post('deskripsi'),
					'berat'	    		=> $this->input->post('berat'),
					'ukuran'			=> $this->input->post('ukuran'),
					'id_kategori'   		=> $this->input->post('kat_id'),
					'id_subkategori'		=> $this->input->post('subkat_id'),
					'harga_normal'  		=> $this->input->post('harga_normal'),
					'diskon'	    		=> $this->input->post('diskon'),
					'harga_diskon'  		=> $this->input->post('harga_diskon'),
					'stok'	    		=> $this->input->post('stok'),
				);

				$this->Produk_model->update($this->input->post('id_produk'), $data);
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
				redirect(site_url('admin_gulderose/produk'));
			}

		}
		
	}

	public function delete($id)
	{
		$delete = $this->Produk_model->del_by_id($id);

		//menyimpan lokasi gambar dlm variable
		$dir        = "assets/images/produk/" . $delete->foto . $delete->foto_type;
		$dir_thumb  = "assets/images/produk/" . $delete->foto . '_thumb' . $delete->foto_type;

		//hapus foto
		unlink($dir);
		unlink($dir_thumb);

		// Jika data ditemukan, maka hapus foto dan record nya
		if ($delete) {
			$this->Produk_model->delete($id);
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
			redirect(site_url('admin_gulderose/produk'));

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
			redirect(site_url('admin_gulderose/produk'));
		}


	}

	public function pilih_subkategori()
	{
		$this->data['subkategori'] = $this->Kategori_model->ambil_subkategori($this->uri->segment(4));
		$this->load->view('back/produk/v_subkat', $this->data);
	}

	// public function pilih_supersubkategori()
	// {
	// 	$this->data['supersubkategori'] = $this->Kategori_model->ambil_supersubkategori($this->uri->segment(4));
	// 	$this->load->view('back/produk/v_supersubkat', $this->data);
	// }
	
	public function cari_produk()
	{
		$this->data['title'] = 'Cari Produk';
		$this->template->load('template','back/produk/produk_cari', $this->data);
	}

	public function rules()
	{
		//set rules
		$this->form_validation->set_rules('id_produk', 'Id Produk', 'trim');
		$this->form_validation->set_rules('produk_created', 'Nama Produk', 'trim|is_unique[produk.judul_produk]');
		$this->form_validation->set_rules('produk_upd', 'Nama Produk', 'trim');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');
		$this->form_validation->set_rules('harga_normal', 'Harga Normal', 'trim|required');
		$this->form_validation->set_rules('diskon', 'Diskon', 'trim|required');
		$this->form_validation->set_rules('harga_diskon', 'Harga Diskon', 'trim|required');
		$this->form_validation->set_rules('berat', 'Berat', 'trim|required');
		
		//set pesan
		$this->form_validation->set_message('required', '{field} wajib diisi');
		$this->form_validation->set_message('is_unique', '{field} nama produk sudah ada, silahkan ganti yang lain');

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
