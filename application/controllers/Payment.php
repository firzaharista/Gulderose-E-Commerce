<?php
      
      defined('BASEPATH') OR exit('No direct script access allowed');
      
      class Payment extends CI_Controller 
      {
            
            public function __construct()
            {
                  parent::__construct();
                  $this->load->model('Companyprofile_model');
                  $this->load->model('Cart_model');
                  $this->load->model('Payment_model');
                  $this->load->model('Bankasal_model');
                  $this->load->model('Banktujuan_model');
                  

                  $this->data['company_data']               = $this->Companyprofile_model->get_by_company();
                  $this->data['cart_data']                  = $this->Cart_model->get_cart_per_customer();
                  // ambil data keranjang
                  $this->data['total_berat_subtotal']       = $this->Cart_model->get_total_berat_dan_subtotal();
                  $this->data['total_cart_navbar']          = $this->Cart_model->total_cart_navbar();
                  $this->data['bank_tujuan_percustomer']    = $this->Cart_model->get_bank_customer();
            }
            
            //sudah diroute (jadi link hrefnya udah beda, cek di config route)
            public function payment_confirmation()
            {
                  $this->data['title'] = 'Data Payment';

                  $this->data['payment_data']         = $this->Payment_model->payment_confirmation();
                  $this->data['total_berat_subtotal'] = $this->Payment_model->get_total_berat_dan_subtotal();

                  $this->load->view('front/payment/payment-confirmation-data', $this->data);
            }

            public function payment_confirmation_form($id)
            {
                  // cek hak akses login apakah buyer ato bukan
                  if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_buyer())) {
                        redirect(base_url());
                  }
                  
                  $this->data['payment_confirmation_form'] = 'Payment Confirmation Form';

                  $this->data['payment_data']               = $this->Payment_model->payment_confirmation();
                  $this->data['ambil_data_order']           = $this->Payment_model->get_order_by_id($id)->row();
                  $this->data['total_berat_dan_subtotal']   = $this->Payment_model->total_berat_dan_subtotal($id);

                  $row = $this->Payment_model->get_order_by_id($id)->row();

                  if ($row) {
                        $this->data['trans_id'] = array(
                              'name'        => 'trans_id',
                              'id'          => 'trans_id',
                              'class'       => 'form-control',
                              'type'        => 'hidden',
                              'required'    => '',
                        );
                        $this->data['bankasal_id'] = array(
                              'name'        => 'bankasal_id',
                              'id'          => 'bankasal_id',
                              'class'       => 'form-control',
                              'required'    => '',
                        );
                        $this->data['banktujuan_id'] = array(
                              'name'        => 'banktujuan_id',
                              'id'          => 'banktujuan_id',
                              'class'       => 'form-control',
                              'required'    => '',
                              'disabled'    => "",
                        );

                        $this->data['ambil_bankasal']       = $this->Bankasal_model->get_bankasal();
                        $this->data['ambil_banktujuan']     = $this->Banktujuan_model->get_banktujuan();

                  }

                  $this->load->view('front/payment/payment-confirmation-form', $this->data);
            }

            public function send_payment_confirmation()
            {

                  //4 menyatakan tidak ada file
			if ($_FILES['foto']['error'] <> 4) {
				$nmfile = strtolower(url_title($this->input->post('trans_id'))).$this->input->post('nama'). date('dmYHis');

				//ambil dri library ci
				$config['upload_path']      = './assets/images/konfirmasi/';
				$config['allowed_types']    = 'jpg|jpeg|png|gif';
				$config['max_size']         = '5048'; // 5 MB
				$config['file_name']        = $nmfile; //nama yang terupload nantinya

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('foto')) {
					//file gagal diupload -> kembali ke form tambah
					$error = array('error' => $this->upload->display_errors());
					$this->session->set_flashdata('message', '<div class="alert alert-danger alert">' . $error['error'] . '</div>');

					redirect(site_url('payment-confirmation'));
				}
				//file berhasil diupload -> lanjutkan ke query INSERT
				else {
					$foto 			  = $this->upload->data();
					$thumbnail                = $config['file_name'];
					// library yang disediakan codeigniter
					$config['image_library']  = 'gd2';
					// gambar yang akan dibuat thumbnail
					$config['source_image']   = './assets/images/produk/' . $foto['file_name'] . '';
					// rasio resolusi
					$config['maintain_ratio'] = FALSE;

					$this->load->library('image_lib', $config);

                              $id_trans = $this->input->post('trans_id');
                              
					$data = array(
						'bukti_pembayaran'	=> $nmfile,
                                    'bukti_pembayaran_type'	=> $foto['file_ext'],
                                    'jumlah'	   		=> $this->input->post('jumlah'),
                                    'waktu_konfirmasi'      => date('Y-m-d H:i:s'),
                                    'bankasal_id'	      => $this->input->post('bankasal_id'),
                                    'trans_id'	            => $this->input->post('trans_id'),
						'user_id'    		=> $this->session->userdata('user_id')
                              );
                              
                              $data2 = array(
                                    'id_trans' => $this->input->post('trans_id'),
                                    'status' => '2',
                              );

					// eksekusi query INSERT dan UPDATE Status di transaksi
                              $this->Payment_model->insert($this->input->post('trans_id'), $data);
                              $this->Payment_model->update_status($this->input->post('trans_id'), $data2);

                              $this->data['payment_done']	    		= $this->Cart_model->get_payment_per_customer_finished($id_trans);
                              $this->data['bank_destination']           = $this->Cart_model->get_data_bank_customer_payment_finished($id_trans);
                              $this->data['total_berat_dan_subtotal']   = $this->Cart_model->get_total_berat_dan_subtotal_finished($id_trans);

                              // redirect(site_url('payment-confirmation'));
                              $this->load->view('front/payment/payment-done', $this->data);
                              
				}
				
			}
            }

            public function rules()
            {
                  //rules
                  $this->form_validation->set_rules('id_konfirmasi', 'id_konfirmasi', 'trim');
                  $this->form_validation->set_rules('bankasal_id', '', 'trim|required');

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
      
      /* End of file Payment.php */
      
?>