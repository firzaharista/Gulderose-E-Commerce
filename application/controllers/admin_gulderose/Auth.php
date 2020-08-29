<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Auth
 * @property Ion_auth|Ion_auth_model $ion_auth        The ION Auth spark
 * @property CI_Form_validation      $form_validation The form validation library
 */
class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');
		$this->load->model('Companyprofile_model');
		$this->load->model('Ion_auth_model');
		$this->load->model('Penjualan_model');
		$this->load->model('Wilayah_model');
		
		$this->data['modul'] = 'Users';
		
		$this->data['navbar_transaksi'] 	= $this->Penjualan_model->top5_transaksi_sudah_konfirmasi()->result();
		$this->data['navbar_transaksi_row']	= $this->Penjualan_model->top5_transaksi_sudah_konfirmasi()->row();
		$this->data['company_data']         = $this->Companyprofile_model->get_by_company();
	}

	/**
	 * Redirect if needed, otherwise display the user list
	 */
	public function index()
	{	
		//untuk manggil $title di viewnya
		$this->data['title'] = 'Data'.$this->data['modul']; 

		//cek sudah login atau belum
		if (!$this->ion_auth->logged_in())
		{
			//untuk mendirect link ke login
			redirect('admin_gulderose/auth/login', 'refresh');
		}
		// Cek superadmin ato bukan
		elseif (!$this->ion_auth->is_superadmin()) {
			redirect('admin_gulderose/dashboard', 'refresh');
		}
		else
		{
			// men set pesan flash jika data eror
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			//list the users
			$this->data['users'] = $this->ion_auth->get_all_users()->result();

			$this->_render_page('back/auth/index_user', $this->data);
		}
	}

	//untuk menampilkan data user superadmin saja
	public function users_superadmin()
	{
		if (!$this->ion_auth->logged_in())
		{
			redirect('admin_gulderose/auth/login', 'refresh');
		}
		elseif (!$this->ion_auth->is_superadmin()) {
			redirect('admin_gulderose/dashboard', 'refresh');
		}

		// men set pesan flash jika data eror
		$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

		$this->data['users_superadmin'] = $this->Ion_auth_model->get_users_superadmin()->result();
		$this->load->view('back/auth/index_superadmin', $this->data);	
	}

	//untuk menampilkan data user admin saja
	public function users_admin()
	{
		if (!$this->ion_auth->logged_in())
		{
			redirect('admin_gulderose/auth/login', 'refresh');
		}
		elseif (!$this->ion_auth->is_superadmin()) {
			redirect('admin_gulderose/dashboard', 'refresh');
		}

		// men set pesan flash jika data eror
		$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
		
		$this->data['users_admin'] = $this->Ion_auth_model->get_users_admin()->result();
		$this->load->view('back/auth/index_admin', $this->data);
	}

	//untuk menampilkan data user buyer saja
	public function users_buyer()
	{
		if (!$this->ion_auth->logged_in())
		{
			redirect('admin_gulderose/auth/login', 'refresh');
		}
		elseif (!$this->ion_auth->is_superadmin()) {
			redirect('admin_gulderose/dashboard', 'refresh');
		}

		// men set pesan flash jika data eror
		$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

		$this->data['users_buyer'] = $this->Ion_auth_model->get_users_buyer()->result();
		$this->load->view('back/auth/index_buyer', $this->data);	
	}

	/**
	 * Log the user in
	 */
	public function login()
	{
		//untuk mengload library recaptcha
		$this->load->library('recaptcha');
		$this->data['title']		= "Login Backend Admin Gulderose";

		$this->data['captcha'] 		= $this->recaptcha->getWidget();
		$this->data['script_captcha'] = $this->recaptcha->getScriptTag();
		$this->data['title'] 		= $this->lang->line('login heading');

		$recaptcha = $this->input->post('g-recaptcha-response');
		$response  = $this->recaptcha->verifyResponse($recaptcha);
		

		// validate form input / form validasi
		$this->form_validation->set_rules('identity', str_replace(':', '', $this->lang->line('login_identity_label')), 'required');
		$this->form_validation->set_rules('password', str_replace(':', '', $this->lang->line('login_password_label')), 'required');
		$this->form_validation->set_rules('g-recaptcha-response', 'Captcha', 'required');
		$this->form_validation->set_message('required', '{field} mohon diisi');

		//perulangan jika berjalan tapi gagal
		if ($this->form_validation->run() == FALSE || !isset($response['success']) || $response['success'] <> TRUE)
		{

			// (jika gagal login dan mendirect ke halaman login)
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['identity'] = array(
				'name' 	 => 'identity',
				'id' 		 => 'identity',
				'type' 	 => 'text',
				'class' 	 => 'form-control',
				'placeholder'=> 'Username',
				'value'	 => $this->form_validation->set_value('identity')
			);
			$this->data['password'] = array(
				'name' 	  => 'password',
				'id' 		  => 'password',
				'type' 	  => 'password',
				'class' 	  => 'form-control',
				'placeholder' => 'Password',
			);

			$this->_render_page('back/auth/login', $this->data);
			
		}
		else
		{
			// cek jika user login
			// cek untuk "remember me"
			$remember = (bool) $this->input->post('remember');

			if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)) 
			{
				//if the login is successful /jika login sukses
				//redirect them back to the home page / mendirect link ke halaman dashboard
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect('admin_gulderose/dashboard', 'refresh');
			} else {
				// if the login was un-successful / jika gagal login
				// redirect them back to the login page
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('admin_gulderose/auth/login', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
			}
		}
	}

	/**
	 * Log the user out
	 */
	public function logout()
	{
		$this->data['title'] = "Logout";

		// log the user out
		$logout = $this->ion_auth->logout();

		// redirect them to the login page
		$this->session->set_flashdata('message', $this->ion_auth->messages());
		redirect('admin_gulderose/auth/login', 'refresh');
	}

	/**
	 * Change password
	 */
	public function change_password()
	{
		$this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
		$this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
		$this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');

		if (!$this->ion_auth->logged_in())
		{
			redirect('admin_gulderose/auth/login', 'refresh');
		}

		$user = $this->ion_auth->user()->row();

		if ($this->form_validation->run() === FALSE)
		{
			// display the form
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
			$this->data['old_password'] = array(
				'name' => 'old',
				'id' => 'old',
				'type' => 'password',
			);
			$this->data['new_password'] = array(
				'name' => 'new',
				'id' => 'new',
				'type' => 'password',
				'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
			);
			$this->data['new_password_confirm'] = array(
				'name' => 'new_confirm',
				'id' => 'new_confirm',
				'type' => 'password',
				'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
			);
			$this->data['user_id'] = array(
				'name' => 'user_id',
				'id' => 'user_id',
				'type' => 'hidden',
				'value' => $user->id,
			);

			// render
			$this->_render_page('back/auth/change_password', $this->data);
		}
		else
		{
			$identity = $this->session->userdata('identity');

			$change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

			if ($change)
			{
				//if the password was successfully changed
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				$this->logout();
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('admin_gulderose/auth/change_password', 'refresh');
			}
		}
	}

	/**
	 * Forgot password
	 */
	public function forgot_password()
	{
		// setting validation rules by checking whether identity is username or email
		if ($this->config->item('identity', 'ion_auth') != 'email')
		{
			$this->form_validation->set_rules('identity', $this->lang->line('forgot_password_identity_label'), 'required');
		}
		else
		{
			$this->form_validation->set_rules('identity', $this->lang->line('forgot_password_validation_email_label'), 'required|valid_email');
		}


		if ($this->form_validation->run() === FALSE)
		{
			$this->data['type'] = $this->config->item('identity', 'ion_auth');
			// setup the input
			$this->data['identity'] = array('name' => 'identity',
				'id' => 'identity',
			);

			if ($this->config->item('identity', 'ion_auth') != 'email')
			{
				$this->data['identity_label'] = $this->lang->line('forgot_password_identity_label');
			}
			else
			{
				$this->data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
			}

			// set any errors and display the form
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->_render_page('back/auth/forgot_password', $this->data);
		}
		else
		{
			$identity_column = $this->config->item('identity', 'ion_auth');
			$identity = $this->ion_auth->where($identity_column, $this->input->post('identity'))->users()->row();

			if (empty($identity))
			{

				if ($this->config->item('identity', 'ion_auth') != 'email')
				{
					$this->ion_auth->set_error('forgot_password_identity_not_found');
				}
				else
				{
					$this->ion_auth->set_error('forgot_password_email_not_found');
				}

				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("auth/forgot_password", 'refresh');
			}

			// run the forgotten password method to email an activation code to the user
			$forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

			if ($forgotten)
			{
				// if there were no errors
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("auth/login", 'refresh'); //we should display a confirmation page here instead of the login page
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("auth/forgot_password", 'refresh');
			}
		}
	}

	/**
	 * Reset password - final step for forgotten password
	 *
	 * @param string|null $code The reset code
	 */
	public function reset_password($code = NULL)
	{
		if (!$code)
		{
			show_404();
		}

		$user = $this->ion_auth->forgotten_password_check($code);

		if ($user)
		{
			// if the code is valid then display the password reset form

			$this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
			$this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

			if ($this->form_validation->run() === FALSE)
			{
				// display the form

				// set the flash data error message if there is one
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

				$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
				$this->data['new_password'] = array(
					'name' => 'new',
					'id' => 'new',
					'type' => 'password',
					'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
				);
				$this->data['new_password_confirm'] = array(
					'name' => 'new_confirm',
					'id' => 'new_confirm',
					'type' => 'password',
					'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
				);
				$this->data['user_id'] = array(
					'name' => 'user_id',
					'id' => 'user_id',
					'type' => 'hidden',
					'value' => $user->id,
				);
				$this->data['csrf'] = $this->_get_csrf_nonce();
				$this->data['code'] = $code;

				// render
				$this->_render_page('back/auth/reset_password', $this->data);
			}
			else
			{
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $user->id != $this->input->post('user_id'))
				{

					// something fishy might be up
					$this->ion_auth->clear_forgotten_password_code($code);

					show_error($this->lang->line('error_csrf'));

				}
				else
				{
					// finally change the password
					$identity = $user->{$this->config->item('identity', 'ion_auth')};

					$change = $this->ion_auth->reset_password($identity, $this->input->post('new'));

					if ($change)
					{
						// if the password was successfully changed
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						redirect("auth/login", 'refresh');
					}
					else
					{
						$this->session->set_flashdata('message', $this->ion_auth->errors());
						redirect('admin_gulderose/auth/reset_password/' . $code, 'refresh');
					}
				}
			}
		}
		else
		{
			// if the code is invalid then send them back to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("auth/forgot_password", 'refresh');
		}
	}

	/**
	 * Activate the user
	 *
	 * @param int         $id   The user ID
	 * @param string|bool $code The activation code
	 */
	public function activate($id, $code = FALSE)
	{
		if ($code !== FALSE)
		{
			$activation = $this->ion_auth->activate($id, $code);
		}
		else if ($this->ion_auth->is_superadmin())
		{
			$activation = $this->ion_auth->activate($id);
		}

		if ($activation)
		{
			// redirect them to the auth page
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect("admin_gulderose/auth/", 'refresh');
		}
		else
		{
			// redirect them to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("admin_gulderose/auth/", 'refresh');
		}
	}

	//sudah dimodifikasi
	/**
	 * Deactivate the user
	 *
	 * @param int|string|null $id The user ID
	 */
	public function deactivate($id = NULL)
	{
		$id = (int) $id;

		//mengecek level user / user group apakah superadmin ato bukan
		if ($this->ion_auth->logged_in() && $this->ion_auth->is_superadmin())
		{
			$this->ion_auth->deactivate($id);
		}
		//mengarahkan ke halaman user / data user
		$this->session->set_flashdata('message', '<div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
			<i class="ace-icon fa fa-bullhorn green"></i> Akun berhasil dinonaktifkan
		</div>');
		redirect('admin_gulderose/auth/','refresh');		
	}


	//modifikasi
	/**
	 * Create a new user
	 */
	public function create_user()
	{
		$this->data['title'] = 'Tambah Data '.$this->data['modul'];

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_superadmin())
		{
			redirect('admin_gulderose/auth', 'refresh');
		}
		
		//setting dari ion authnya (bawaan)
		$tables 				 = $this->config->item('tables', 'ion_auth');
		$identity_column 			 = $this->config->item('identity', 'ion_auth');

		$this->data['identity_column'] = $identity_column;

		// validasi form inputan
		$this->form_validation->set_rules('nama', 'Nama Lengkap', 'trim|required|is_unique[' . $tables['users'] . '.' . $identity_column . ']');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[' . $tables['users'] . '.username]');
		$this->form_validation->set_rules('address', 'Alamat','required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[' . $tables['users'] . '.email]');
		$this->form_validation->set_rules('phone', 'No. Telp', 'trim|required|is_numeric');
		$this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
		$this->form_validation->set_rules('password_confirm', 'Password Konfirmasi', 'required');
		
		// set pesan / set_message
		$this->form_validation->set_message('required', '{field} mohon diisi');
		$this->form_validation->set_message('valid_email', 'Format email salah');
		$this->form_validation->set_message('is_numeric', 'No. HP harus angka');
		$this->form_validation->set_message('matches', 'Password dan Konfirmasi harus sama');
		$this->form_validation->set_message('min_length', 'Password minimal 8 huruf');
		$this->form_validation->set_message('max_length', 'Password maksimal 20 huruf');
		$this->form_validation->set_message('is_unique', '{field} telah terpakai, silahkan ganti yang lain');

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
		

		// perulangan jika berjalan dan hasilnya benar
		if ($this->form_validation->run() === TRUE)
		{
			$email    = strtolower($this->input->post('email'));
			$identity = ($identity_column === 'email') ? $email : $this->input->post('identity');
			$password = $this->input->post('password');

			$additional_data = array(
				'nama' 	=> $this->input->post('nama'),
				'username'  => $this->input->post('username'),
				'email' 	=> strtolower($this->input->post('email')),
				'id_group'  => $this->input->post('level_user'), 
				'address'	=> $this->input->post('address'),
				'phone' 	=> $this->input->post('phone'),
				'id_provinsi'=> $this->input->post('provinsi_id'),
				'id_kota'	=> $this->input->post('kota_id')
				// 'uploader'  => $this->session->userdata('user_id'),
				
			);
			$this->ion_auth->register($identity, $password, $email, $additional_data);
			
			// check to see if we are creating the user | redirect them back to the admin page
			$this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">
                                                                  <div class="container">
                                                                        <div class="alert-icon">
                                                                              <i class="zmdi zmdi-alert-thumb-up"></i>
                                                                        </div>
                                                                        <strong>WELL DONE!</strong> | Data berhasil dibuat
                                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                                    <span aria-hidden="true">
                                                                                    <i class="zmdi zmdi-close"></i>
                                                                              </span>
                                                                        </button>
                                                                  </div>
                                                                  </div>');
			redirect('admin_gulderose/auth', 'refresh');		
		}
	
		// display the create user form
		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		$this->data['nama'] = array(
			'name'  => 'nama',
			'id'    => 'nama',
			'type'  => 'text',
			'class' => 'form-control form-control-success',
			'placeholder' => 'Nama Lengkap',
			'value' => $this->form_validation->set_value('nama'),
		);
		$this->data['username'] = array(
			'name'  => 'username',
			'id'    => 'username',
			'type'  => 'text',
			'class' => 'form-control form-control-success',
			'placeholder' => 'Username',
			'value' => $this->form_validation->set_value('username'),
		);
		$this->data['password'] = array(
			'name'  => 'password',
			'id' 	  => 'password',
			'type'  => 'text',
			'class' => 'form-control form-control-success',
			'placeholder' => 'Password anda',
			'value' => $this->form_validation->set_value('password'),
		);
		$this->data['password_confirm'] = array(
			'name'  => 'password_confirm',
			'id' 	  => 'password_confirm',
			'type'  => 'text',
			'class' => 'form-control form-control-success',
			'placeholder' => 'Ulangi password anda',
			'value' => $this->form_validation->set_value('password_confirm'),
		);
		$this->data['address'] = array(
			'name'  => 'address',
			'id' 	  => 'address',
			'class' => 'form-control no-resize',
			'cols'  => '30',
			'rows'  => '4',
			'placeholder' => 'Alamat Perusahaan',
			'value' => $this->form_validation->set_value('address'),
		);
		$this->data['email'] = array(
			'name'  => 'email',
			'id' 	  => 'email',
			'type'  => 'text',
			'class' => 'form-control form-control-success',
			'placeholder' => 'Ex : gulderose@gmail.com',
			'value' => $this->form_validation->set_value('email'),
		);
		$this->data['phone'] = array(
			'name'  => 'phone',
			'id' 	  => 'phone',
			'type'  => 'text',
			'class' => 'form-control form-control-success',
			'placeholder' => 'Nomor Handphone ex : 08154467789',
			'value' => $this->form_validation->set_value('phone'),
		);

		$this->data['provinsi_id'] = array(
			'name'        => 'provinsi_id',
			'id'          => 'provinsi_id',
			'class'       => 'form-control show-tick',
			'onChange'    => 'tampilKota()',
			'required'    => '',
		);
		$this->data['kota_id'] = array(
			'name'        => 'kota_id',
			'id'          => 'kota_id',
			'class'       => 'form-control show-tick',
			'required'    => '',
		);

		$this->data['id_group'] = array(
			'name'  	=> 'level_user',
			'id'	  	=> 'level_user',
			'class'     => 'form-control show-tick',
			'required'  => ''

		);

		$row       = $this->Ion_auth_model->profil();
		$prov_id   = $row->id_provinsi;
		$kota_id   = $row->id_kota;

		$this->data['ambil_provinsi']       = $this->Wilayah_model->get_provinsi();
		$this->data['ambil_kota']           = $this->Wilayah_model->get_kota($prov_id);

		//mengambil semua data user group
		$this->data['get_all_users_group'] = $this->Ion_auth_model->get_all_users_group2();
		
		$this->load->view('back/auth/create_user', $this->data);
	}

	function get_kota()
	{
		$this->data['kota'] = $this->Wilayah_model->get_kota($this->uri->segment(4));
		$this->load->view('front/auth/kota', $this->data);
	}

	// public function pilih_kota()
	// {
	// 	$this->data['kota'] = $this->Ion_auth_model->get_kota_admin($this->uri->segment(4));
	// 	$this->load->view('back/auth/v_kota', $this->data);
	// }

	/** modifikasi
	 * Edit a user
	 *
	 * @param int|string $id
	 */
	public function edit_user($id)
	{
		$this->data['title'] = 'Edit Data '.$this->data['modul'];
		$this->data['profil']               = $this->Ion_auth_model->profil();
		// cek hak akses login(hanya superadmin yg boleh) dan mengambil id di users
		if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_superadmin() && !($this->ion_auth->user()->row()->id == $id)))
		{
			redirect('admin_gulderose/auth', 'refresh');
		}

		$user = $this->ion_auth->user($id)->row();

		if ($user == FALSE) {
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
			 
			redirect('admin_gulderose/auth/','refresh');
		}

		// validate form input
		$this->form_validation->set_rules('nama', 'nama', 'required|trim');
		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('email','Email', 'required|valid_email');
		$this->form_validation->set_rules('phone', 'No. HP', 'trim|numeric');
		

		//set message or pesan
		$this->form_validation->set_message('required', '{field} mohon diisi');
		$this->form_validation->set_message('is_unique', '{field} telah terpakai, silahkan ganti yang lain');
		$this->form_validation->set_message('numeric', 'No. HP harus angka');
		$this->form_validation->set_message('valid_email', 'Format email salah');
		$this->form_validation->set_message('min_length', 'Password minimal 8 karakter');
		$this->form_validation->set_message('max_length', 'Password maksimal 20 karakter');
		$this->form_validation->set_message('matches', 'Password baru dan konfirmasi baru harus sama');

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


		if (isset($_POST) && !empty($_POST))
		{
			

			//  update password jika diisi
			if ($this->input->post('password'))
			{
				$this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
				$this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
			}

			if ($this->form_validation->run() === TRUE)
			{
				$data = array(
					'nama' 	=> $this->input->post('nama'),
					'username'  => $this->input->post('username'),
					'email' 	=> strtolower($this->input->post('email')),
					'id_group'  => $this->input->post('level_user'),
					'address'	=> $this->input->post('address'),
					'phone' 	=> $this->input->post('phone'),
					'id_provinsi' => $this->input->post('provinsi_id'),
					'id_kota'	=> $this->input->post('kota_id')
				);

				// jika password diisi
				if ($this->input->post('password'))
				{
					$data['password'] = $this->input->post('password');
				}

				// cek apakah sedang mengupdate data user
				if ($this->ion_auth->update($user->id, $data))
				{
					$this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">
                                                                  <div class="container">
                                                                        <div class="alert-icon">
                                                                              <i class="zmdi zmdi-alert-thumb-up"></i>
                                                                        </div>
                                                                        <strong>WELL DONE!</strong> | Update data berhasil
                                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                                    <span aria-hidden="true">
                                                                                    <i class="zmdi zmdi-close"></i>
                                                                              </span>
                                                                        </button>
                                                                  </div>
                                                                  </div>');
					redirect(site_url('admin_gulderose/auth/'));

				}
				else
				{
					$this->session->set_flashdata('message', '
 							<div class="alert alert-block alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
 								<i class="ace-icon fa fa-bullhorn green"></i> Update Data Gagal
 							</div>');
					redirect(site_url('admin_gulderose/auth/'));

				}

			}
		}

		// menampilkan form edit / update data user
		$this->data['csrf'] = $this->_get_csrf_nonce();

		// mengatur pesan eror jika ada
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		// melempar data user ke view
		$this->data['user'] = $user;

		$this->data['nama'] = array(
			'name'  => 'nama',
			'id'    => 'nama',
			'type'  => 'text',
			'class' => 'form-control form-control-success',
			'placeholder' => 'Nama Lengkap',
			'value' => $this->form_validation->set_value('nama', $user->nama),
		);
		$this->data['username'] = array(
			'name'  => 'username',
			'id'    => 'username',
			'type'  => 'text',
			'class' => 'form-control form-control-success',
			'placeholder' => 'Username',
			'value' => $this->form_validation->set_value('username', $user->username),
		);
		$this->data['password'] = array(
			'name'  => 'password',
			'id' 	  => 'password',
			'type'  => 'text',
			'class' => 'form-control form-control-success',
			'placeholder' => 'Password baru anda',
			'value' => $this->form_validation->set_value('password'),
		);
		$this->data['password_confirm'] = array(
			'name'  => 'password_confirm',
			'id' 	  => 'password_confirm',
			'type'  => 'text',
			'class' => 'form-control form-control-success',
			'placeholder' => 'Ulangi password baru anda',
			'value' => $this->form_validation->set_value('password_confirm'),
		);
		$this->data['address'] = array(
			'name'  => 'address',
			'id' 	  => 'address',
			'class' => 'form-control no-resize',
			'cols'  => '30',
			'rows'  => '4',
			'placeholder' => 'Alamat Perusahaan',
			'value' => $this->form_validation->set_value('address', $user->address),
		);
		$this->data['email'] = array(
			'name'  => 'email',
			'id' 	  => 'email',
			'type'  => 'text',
			'class' => 'form-control form-control-success',
			'placeholder' => 'Email anda',
			'value' => $this->form_validation->set_value('email', $user->email),
		);
		$this->data['phone'] = array(
			'name'  => 'phone',
			'id' 	  => 'phone',
			'type'  => 'text',
			'class' => 'form-control form-control-success',
			'placeholder' => 'Nomor Handphone ex : +628154467789',
			'value' => $this->form_validation->set_value('phone', $user->phone),
		);
		$this->data['id_group'] = array(
			'name'  => 'level_user',
			'id'    => 'level_user',
			'class'     => 'form-control show-tick',
			'required'  => ''
		);

		$this->data['provinsi_id'] = array(
			'name'        => 'provinsi_id',
			'id'          => 'provinsi_id',
			'class'       => 'form-control show-tick',
			'onChange'    => 'tampilKota()',
			'required'    => '',
		);
		$this->data['kota_id'] = array(
			'name'        => 'kota_id',
			'id'          => 'kota_id',
			'class'       => 'form-control show-tick',
			'required'    => '',
		);

		// $this->data['profil_admin']	= $this->Ion_auth_model->profil_admin($id);
		$row       = $user;
		$prov_id   = $row->id_provinsi;
		$kota_id   = $row->id_kota;

		$this->data['ambil_provinsi']       = $this->Wilayah_model->get_provinsi();
		$this->data['ambil_kota']           = $this->Wilayah_model->get_kota($prov_id);

		$this->data['get_all_users_group'] 	= $this->Ion_auth_model->get_all_users_group2();

		$this->data['record']   		= $this->Ion_auth_model->get_one($id)->row_array();

		$this->_render_page('back/auth/edit_user', $this->data);
	}

	
	// profil
	
	public function profil()
	{
		$this->data['title'] = 'Profil Saya';

		$this->data['profil'] = $this->Ion_auth_model->profil();

		$this->load->view('back/auth/profil', $this->data);
	}

	// Hapus User
	public function delete_user($id)
	{
		$id = $this->uri->segment(4);
		$delete = $this->Ion_auth_model->del_by_id($id);

		if ($delete) 
		{
			$this->Ion_auth_model->delete_user($id);
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
			redirect(site_url('admin_gulderose/auth/'));
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
			redirect(site_url('admin_gulderose/auth/'));
		}
	}

	/** belum dipake (gak dipake yg buat/update group)
	 * Create a new group
	 */
	public function create_group()
	{
		$this->data['title'] = $this->lang->line('create_group_title');

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('admin_gulderose/auth', 'refresh');
		}

		// validate form input
		$this->form_validation->set_rules('group_name', $this->lang->line('create_group_validation_name_label'), 'trim|required|alpha_dash');

		if ($this->form_validation->run() === TRUE)
		{
			$new_group_id = $this->ion_auth->create_group($this->input->post('group_name'), $this->input->post('description'));
			if ($new_group_id)
			{
				// check to see if we are creating the group
				// redirect them back to the admin page
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("auth", 'refresh');
			}
		}
		else
		{
			// display the create group form
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			$this->data['group_name'] = array(
				'name'  => 'group_name',
				'id'    => 'group_name',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('group_name'),
			);
			$this->data['description'] = array(
				'name'  => 'description',
				'id'    => 'description',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('description'),
			);

			$this->_render_page('back/auth/create_group', $this->data);
		}
	}

	/** (gak dipake karna level usernya langsung ada di sistem gak dibuat crudnya)
	 * Edit a group
	 *
	 * @param int|string $id
	 */
	public function edit_group($id)
	{
		// bail if no group id given
		if (!$id || empty($id))
		{
			redirect('admin_gulderose/auth', 'refresh');
		}

		$this->data['title'] = $this->lang->line('edit_group_title');

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('admin_gulderose/auth', 'refresh');
		}

		$group = $this->ion_auth->group($id)->row();

		// validate form input
		$this->form_validation->set_rules('group_name', $this->lang->line('edit_group_validation_name_label'), 'required|alpha_dash');

		if (isset($_POST) && !empty($_POST))
		{
			if ($this->form_validation->run() === TRUE)
			{
				$group_update = $this->ion_auth->update_group($id, $_POST['group_name'], $_POST['group_description']);

				if ($group_update)
				{
					$this->session->set_flashdata('message', $this->lang->line('edit_group_saved'));
				}
				else
				{
					$this->session->set_flashdata('message', $this->ion_auth->errors());
				}
				redirect("auth", 'refresh');
			}
		}

		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		// pass the user to the view
		$this->data['group'] = $group;

		$readonly = $this->config->item('admin_group', 'ion_auth') === $group->name ? 'readonly' : '';

		$this->data['group_name'] = array(
			'name'    => 'group_name',
			'id'      => 'group_name',
			'type'    => 'text',
			'value'   => $this->form_validation->set_value('group_name', $group->name),
			$readonly => $readonly,
		);
		$this->data['group_description'] = array(
			'name'  => 'group_description',
			'id'    => 'group_description',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('group_description', $group->description),
		);

		$this->_render_page('back/auth/edit_group', $this->data);
	}

	/**
	 * @return array A CSRF key-value pair
	 */
	public function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key   = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}

	/**
	 * @return bool Whether the posted CSRF token matches
	 */
	public function _valid_csrf_nonce()
	{
		$csrfkey = $this->input->post($this->session->flashdata('csrfkey'));
		if ($csrfkey && $csrfkey === $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 * @param string     $view
	 * @param array|null $data
	 * @param bool       $returnhtml
	 *
	 * @return mixed
	 */
	public function _render_page($view, $data = NULL, $returnhtml = FALSE)//I think this makes more sense
	{

		$this->viewdata = (empty($data)) ? $this->data : $data;

		$view_html = $this->load->view($view, $this->viewdata, $returnhtml);

		// This will return html on 3rd argument being true
		if ($returnhtml)
		{
			return $view_html;
		}
	}

}
