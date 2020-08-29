<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller 
{
	
	public function __construct()
	{
		parent::__construct();
		$this->data['modul'] = 'Dashboard';
		$this->load->model('Penjualan_model');
		$this->load->model('Produk_model');
		$this->load->model('Ion_auth_model');
		$this->load->model('Produkrekomendasi_model');
		$this->load->model('Kategori_model');
		$this->load->model('Subkategori_model');
		$this->load->model('Supersubkategori_model');
		$this->load->model('Companyprofile_model');
		
		
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
		$this->data = array(
			'title'			 => 'Dashboard',
			'total_penjualan'		 => $this->Penjualan_model->total_penjualan(),
			'total_produk'		 => $this->Produk_model->total_rows(),
			'top3_produk'		 => $this->Produk_model->top3_produk(),
			'top5_transaksi'		 => $this->Penjualan_model->top5_transaksi(),
			'total_produkrekomendasi'=> $this->Produkrekomendasi_model->total_rows(),
			'total_user_customer'	 => $this->Ion_auth_model->get_customer(),
			'navbar_transaksi'	 => $this->Penjualan_model->top5_transaksi_sudah_konfirmasi()->result(),
			'navbar_transaksi_row'	 => $this->Penjualan_model->top5_transaksi_sudah_konfirmasi()->row(),
			'company_data'       	 => $this->Companyprofile_model->get_by_company()
			
		);
		$this->template->load('template', 'back/dashboard', $this->data); //pake library template jadi load viewnya gitu

	}

	
}
