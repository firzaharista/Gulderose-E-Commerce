<?php
      
      defined('BASEPATH') OR exit('No direct script access allowed');
      
      class Cart_model extends CI_Model 
      {
            public $table     = 'transaksi';
            public $table2    = 'transaksi_detail';
            public $id        = 'id_trans';
            public $id2       = 'id_transdet';

            // BACKEND ADMIN
            function get_all()
            {
                  $this->db->join('users', 'transaksi.user_id = users.id');
                  return $this->db->get($this->table)->result();
            }

            function top3_transaksi()
            {
                  $this->db->limit(3);
                  $this->db->join('users', 'transaksi.user_id = users.id');
                  $this->db->order_by('transaksi.id_trans', 'DESC');
                  return $this->db->get($this->table)->result();
            }

            // ----- TAMPILAN USER PEMBELI - PENGUNJUNG / BUYER ----- //

            function get_by_id($id)
            {
                  $this->db->where($this->id, $id);
                  return $this->db->get($this->table)->row();
            }

            function total_rows()
            {
                  return $this->db->get($this->table)->num_rows();
            }

            // tambah data
            function insert($data)
            {
                  $this->db->insert($this->table, $data);
            }

            function insert_detail($data2)
            {
                  $this->db->insert($this->table2, $data2);
            }

            // update data
            function update($id, $data)
            {
                  $this->db->where($this->id, $id);
                  $this->db->update($this->table, $data);
            }

            function update_transdet($id, $data)
            {
                  $this->db->where('produk_id', $id);
                  $this->db->where('user', $this->session->userdata('user_id'));
                  $this->db->update($this->table2, $data);     
            }

            // delete data
            function delete($id, $id_trans)
            {
                  $this->db->where('produk_id', $id);
                  $this->db->where('trans_id', $id_trans);
                  $this->db->delete($this->table2);
            }

            function kosongkan_keranjang($id_trans)
            {
                  $this->db->where('trans_id', $id_trans);
                  $this->db->delete($this->table2);
            }

            function total_cart_navbar()
            {
                  $this->db->join('transaksi', 'transaksi_detail.trans_id = transaksi.id_trans');
                  $this->db->where('transaksi_detail.user', $this->session->userdata('user_id'));
                  $this->db->where('status', 0);
                  return $this->db->get($this->table2)->num_rows();
                  
            }

            // cek transaksi per customer yg login
            function cek_transaksi()
            {
                  $this->db->where('user_id', $this->session->userdata('user_id'));
                  $this->db->where('status', '0');
                  return $this->db->get($this->table)->row();
            }

            // ambil data yg ada di trans_detail 
            function get_notransdet($id)
            {
                  $this->db->join('transaksi_detail', 'transaksi.id_trans = transaksi_detail.trans_id');
                  $this->db->where('produk_id', $id);
                  $this->db->where('user_id', $this->session->userdata('user_id'));
                  // $this->db->where('transaksi.id_users', $this->session->userdata('user_id'));
                  $this->db->where('status', '0');
                  return $this->db->get($this->table)->row();
            }

            function get_cart_per_customer()
            {
                  $this->db->join('produk', 'transaksi_detail.produk_id = produk.id_produk');
                  $this->db->join('users', 'transaksi_detail.user = users.id');
                  $this->db->join('transaksi', 'transaksi_detail.trans_id = transaksi.id_trans');
                  $this->db->where('user', $this->session->userdata('user_id'));
                  $this->db->where('status', '0');
                  $this->db->order_by('id_transdet', 'ASC');
                  
                  return $this->db->get($this->table2)->result();
            }

            // ambil data jika sudah selesai belanja (buat invoicenya)
            function get_cart_per_customer_finished($id_trans)
            {
                  $this->db->join('produk', 'transaksi_detail.produk_id = produk.id_produk');
                  $this->db->join('users', 'transaksi_detail.user = users.id');
                  $this->db->join('transaksi', 'transaksi_detail.trans_id = transaksi.id_trans');
                  $this->db->where('transaksi.id_trans', $id_trans);
                  $this->db->where('transaksi_detail.user', $this->session->userdata('user_id'));
                  // $this->db->where('status', '1');
                  return $this->db->get($this->table2)->result();
                  
            }

            function get_payment_per_customer_finished($id_trans)
            {
                  $this->db->join('produk', 'transaksi_detail.produk_id = produk.id_produk');
                  $this->db->join('users', 'transaksi_detail.user = users.id');
                  $this->db->join('transaksi', 'transaksi_detail.trans_id = transaksi.id_trans');
                  $this->db->where('transaksi.id_trans', $id_trans);
                  $this->db->where('transaksi_detail.user', $this->session->userdata('user_id'));
                  // $this->db->where('status', '1');
                  return $this->db->get($this->table2)->row();
                  
            }

            function get_total_berat_dan_subtotal_finished($invoice)
            {
                  $this->db->select_sum('total_berat');
                  $this->db->select_sum('subtotal');
                  $this->db->join('transaksi', 'transaksi_detail.trans_id = transaksi.id_trans');
                  $this->db->where('user', $this->session->userdata('user_id'));
                  // $this->db->where('status', '1');
                  $this->db->where('transaksi.id_trans', $invoice);
                  return $this->db->get($this->table2)->row();
            }

            function get_bank_customer()
            {
                  $this->db->join('bank_tujuan', 'bank_tujuan.id_banktujuan = transaksi.banktujuan_id');
                  $this->db->where('user_id', $this->session->userdata('user_id'));
                  return $this->db->get('transaksi')->row();
            }

            // ambil data pribadi bank per customer login setelah checkout finished
            function get_data_bank_customer($id_trans)
            {
                  $this->db->join('bank_tujuan', 'bank_tujuan.id_banktujuan = transaksi.banktujuan_id');
                  $this->db->join('transaksi_detail', 'transaksi_detail.trans_id = transaksi.id_trans');
                  $this->db->where('id_trans', $id_trans);
                  $this->db->where('user_id', $this->session->userdata('user_id'));
                  return $this->db->get('transaksi')->row();
            }

            function get_data_bank_customer_payment_finished($id_trans)
            {
                  $this->db->limit(1);
                  $this->db->join('bank_tujuan', 'bank_tujuan.id_banktujuan = transaksi.banktujuan_id');
                  $this->db->join('transaksi_detail', 'transaksi_detail.trans_id = transaksi.id_trans');
                  $this->db->where('trans_id', $id_trans);
                  $this->db->where('user_id', $this->session->userdata('user_id'));
                  return $this->db->get('transaksi')->row();
            }

            // ambil data pribadi per customer login
            function get_data_customer()
            {
                  $this->db->limit(1);
                  $this->db->join('provinsi', 'provinsi.id_provinsi = users.id_provinsi');
                  $this->db->join('kota', 'kota.id_kota = users.id_kota');
                  $this->db->join('transaksi', 'transaksi.user_id = users.id');
                  $this->db->order_by('transaksi.id_trans', 'desc');
                  $this->db->where('user_id', $this->session->userdata('user_id'));
                  return $this->db->get('users')->row();
            }

            function get_data_customer_invoice($id_trans)
            {
                  $this->db->limit(1);
                  $this->db->join('provinsi', 'provinsi.id_provinsi = users.id_provinsi');
                  $this->db->join('kota', 'kota.id_kota = users.id_kota');
                  $this->db->join('transaksi', 'transaksi.user_id = users.id');
                  $this->db->order_by('transaksi.id_trans', 'desc');
                  $this->db->where('transaksi.id_trans', $id_trans);
                  $this->db->where('user_id', $this->session->userdata('user_id'));
                  return $this->db->get('users')->row();
            }


            // ambil total_berat dan subtotal per transaksi customer login
            function get_total_berat_dan_subtotal()
            {     
                  $this->db->select_sum('total_berat');
                  $this->db->select_sum('subtotal');
                  $this->db->join('transaksi', 'transaksi_detail.trans_id = transaksi.id_trans');
                  $this->db->where('user', $this->session->userdata('user_id'));
                  $this->db->where('status', '0');
                  return $this->db->get($this->table2)->row();
            }

            // order information
            function order_process($id, $data)
            {
                  $this->db->where($this->id, $id);
                  $this->db->where('user_id', $this->session->userdata('user_id'));
                  $this->db->where('status', '0');
                  $this->db->update($this->table, $data);
            }

            // checkout
            function checkout($id, $data)
            {
                  $this->db->where($this->id, $id);
                  $this->db->where('user_id', $this->session->userdata('user_id'));
                  $this->db->where('status', '0');
                  $this->db->update($this->table, $data);
                  
            }

            // ---------- BAGIAN MY ACCOUNT --------- //
            function order_history()
            {
                  $this->db->where('user_id', $this->session->userdata('user_id'));
                  $this->db->where_not_in('status', '0');
                  return $this->db->get($this->table);
            }

            function order_history_detail($id)
            {     
                  $this->db->join('produk', 'produk.id_produk = transaksi_detail.produk_id');
                  $this->db->join('users', 'users.id = transaksi_detail.user');
                  $this->db->join('transaksi', 'transaksi.id_trans = transaksi_detail.trans_id');
                  $this->db->where($this->id, $id);
                  $this->db->where('user_id', $this->session->userdata('user_id'));
                  return $this->db->get($this->table2);
            }

            function order($id)
            {
                  $this->db->join('transaksi_detail', 'transaksi_detail.trans_id = transaksi.id_trans');
                  $this->db->join('bank_tujuan', 'bank_tujuan.id_banktujuan = transaksi.banktujuan_id');
                  $this->db->where('id_trans', $id);
                  $this->db->where('user_id', $this->session->userdata('user_id'));
                  return $this->db->get($this->table);
            }

            function order_history_total_berat($id)
            {
                  $this->db->select_sum('total_berat');
                  $this->db->join('transaksi', 'transaksi.id_trans = transaksi_detail.trans_id');
                  $this->db->where('trans_id', $id);
                  $this->db->where('user_id', $this->session->userdata('user_id'));
                  return $this->db->get($this->table2)->row();
            }

            function order_history_subtotal($id)
            {
                  $this->db->select_sum('subtotal');
                  $this->db->join('transaksi', 'transaksi.id_trans = transaksi_detail.trans_id');
                  $this->db->where($this->id, $id);
                  $this->db->where('user', $this->session->userdata('user_id'));
                  return $this->db->get($this->table2)->row();
            }

            function get_bulan()
            {
                  $this->db->select('judul_produk, transaksi.waktu_trans as tanggal');
                  $this->db->select_sum('total_qty');
                  $this->db->join('transaksi_detail', 'transaksi.id_trans = transaksi_detail.trans_id');
                  $this->db->join('produk', 'transaksi_detail.produk_id = produk.id_produk');
                  $this->db->where('month(transaksi.waktu_trans)', date('m'));
                  $this->db->group_by('produk_id');
                  $this->db->order_by('tanggal', 'DESC');
                  $this->db->limit(5);
                  return $this->db->get($this->table)->result();
            }

            function total_penjualan()
            {
                  $this->db->select_sum('subtotal');
                  $this->db->join('transaksi', 'transaksi.id_trans = transaksi_detail.trans_id');
                  $this->db->where('status', '4');
                  return $this->db->get($this->table2)->row();
            }

            function total_penjualan_periode()
            {
                  $tgl_awal       = $this->input->post('tgl_awal'); //getting from post value
                  $tgl_akhir      = $this->input->post('tgl_akhir'); //getting from post value

                  $this->db->select_sum('subtotal');
                  $this->db->join('transaksi', 'transaksi.id_trans = transaksi_detail.trans_id');
                  $this->db->join('users', 'transaksi_detail.user = users.id');
                  $this->db->where('waktu_trans >=', $tgl_awal . ' 00:00:00');
                  $this->db->where('waktu_trans <=', $tgl_akhir . ' 23:59:59');
                  $this->db->join('produk', 'produk.id_produk = transaksi_detail.produk_id');
                  $this->db->where('status', '4');
                  return $this->db->get($this->table2)->row();
            }

            function total_penjualan_dikirim()
            {
                  $this->db->select_sum('subtotal');
                  $this->db->join('transaksi', 'transaksi.id_trans = transaksi_detail.trans_id');
                  $this->db->where('status', '4');
                  return $this->db->get($this->table2)->row();
            }

            function total_penjualan_per_produk()
            {
                  $judul_produk = $this->input->post('judul_produk');

                  $this->db->select_sum('subtotal');
                  $this->db->join('produk', 'produk.id_produk = transaksi_detail.produk_id');
                  $this->db->join('transaksi', 'transaksi.id_trans = transaksi_detail.trans_id');
                  $this->db->where('status', '4');
                  $this->db->where('produk.judul_produk', $judul_produk);
                  return $this->db->get($this->table2)->row();
            }

            // Laporan
            function get_all_laporan()
            {
                  $this->db->join('users', 'transaksi_detail.user = users.id');
                  $this->db->join('produk', 'produk.id_produk = transaksi_detail.produk_id');
                  $this->db->join('transaksi', 'transaksi.id_trans = transaksi_detail.trans_id');
                  $this->db->where_not_in('status', '0');
                  // $this->db->group_by('id_trans');
                  return $this->db->get('transaksi_detail')->result();
            }

            function get_data_penjualan_periode()
            {
                  $tgl_awal       = $this->input->post('tgl_awal'); //getting from post value
                  $tgl_akhir      = $this->input->post('tgl_akhir'); //getting from post value

                  $this->db->join('users', 'transaksi_detail.user = users.id');
                  $this->db->where('waktu_trans >=', $tgl_awal . ' 00:00:00');
                  $this->db->where('waktu_trans <=', $tgl_akhir . ' 23:59:59');
                  $this->db->where_not_in('status', '0');
                  $this->db->order_by('waktu_trans', 'ASC');
                  $this->db->join('produk', 'produk.id_produk = transaksi_detail.produk_id');
                  $this->db->join('transaksi', 'transaksi.id_trans = transaksi_detail.trans_id');
                  return $this->db->get('transaksi_detail')->result();
            }

            function get_data_per_produk()
            {
                  $judul_produk = $this->input->post('judul_produk');
                  
                  $this->db->join('produk', 'produk.id_produk = transaksi_detail.produk_id');
                  $this->db->join('transaksi', 'transaksi.id_trans = transaksi_detail.trans_id');
                  $this->db->join('users', 'transaksi_detail.user = users.id');
                  $this->db->order_by('waktu_trans', 'ASC');
                  $this->db->where('produk.judul_produk', $judul_produk);
                  $this->db->where_not_in('status', '0');
                  return $this->db->get('transaksi_detail')->result();
            }

            function get_all_dikirim()
            {
                  $this->db->join('transaksi', 'transaksi.user_id = users.id');
                  $this->db->join('provinsi', 'provinsi.id_provinsi = users.id_provinsi');
                  $this->db->join('kota', 'kota.id_kota = users.id_kota');
                  $this->db->order_by('waktu_kirim', 'ASC');
                  $this->db->where('status', '4');
                  return $this->db->get('users')->result();
            }

            function batas_view()
            {
                  return $this->db->get('transaksi')->row();
            }

            // function total_rows_laporan()
            // {
            //       $this->db->where('id_trans', '');
                  
            //       return $this->db->get('transaksi')->num_rows();
                  
            // }
      
      }
      
      /* End of file Cart_model.php */
      
?>