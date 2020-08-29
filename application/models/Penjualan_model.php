<?php
      
      defined('BASEPATH') OR exit('No direct script access allowed');
      
      class Penjualan_model extends CI_Model 
      {
            public $table     = 'transaksi';
            public $table2    = 'transaksi_detail';

            public $id        = 'id_trans';
            public $id2       = 'id_transdet';

            // ---------- BUAT BAGIAN ADMIN (BAGIAN MENU PENJUALAN) ---------- //
            function total_penjualan()
            {
                  $this->db->where('status', 4);
                  return $this->db->get('transaksi')->num_rows();
            }

            function get_belum_konfirmasi()
            {
                  $this->db->join('users', 'users.id = transaksi.user_id');
                  $this->db->where('status', '1');
                  $this->db->order_by('transaksi.waktu_trans', 'desc');
                  return $this->db->get($this->table)->result();
            }

            function get_sudah_konfirmasi()
            {
                  $this->db->join('users', 'users.id = transaksi.user_id');
                  $this->db->where('status', '2');
                  $this->db->order_by('transaksi.waktu', 'desc');
                  return $this->db->get($this->table)->result();
            }


            function get_payment_accepted_dan_processing()
            {
                  $this->db->join('users', 'users.id = transaksi.user_id');
                  $this->db->where('status', '3');
                  $this->db->order_by('transaksi.waktu', 'desc');
                  return $this->db->get($this->table)->result();
            }

            function get_dikirim()
            {
                  $this->db->join('users', 'users.id = transaksi.user_id');
                  $this->db->where('status', '4');
                  $this->db->order_by('transaksi.waktu', 'desc');
                  return $this->db->get($this->table)->result();
            }

            function get_dibatalkan()
            {
                  $this->db->join('users', 'users.id = transaksi.user_id');
                  $this->db->where('status', '5');
                  $this->db->order_by('transaksi.waktu', 'desc');
                  return $this->db->get($this->table)->result();
            }

            // ------- BAGIAN UBAH DATA STATUS ORDERAN----- //
            function get_by_id($id)
            {     
                  $this->db->where($this->id, $id);
                  return $this->db->get($this->table)->row();
            }

            function get_by_id_detail_konfirmasi($id)
            {
                  $this->db->join('transaksi_detail', 'transaksi_detail.user = users.id');
                  $this->db->join('transaksi', 'transaksi.user_id = users.id');
                  $this->db->join('kota', 'kota.id_kota = users.id_kota');
                  $this->db->join('provinsi', 'provinsi.id_provinsi = users.id_provinsi');
                  $this->db->join('bank_tujuan', 'bank_tujuan.id_banktujuan = transaksi.banktujuan_id');
                  $this->db->where('transaksi.id_trans', $id);
                  return $this->db->get('users')->row();
            }

            function get_data_konfirmasi($id)
            {
                  $this->db->join('transaksi', 'transaksi.id_trans = konfirmasi.trans_id');
                  $this->db->join('users', 'users.id = konfirmasi.dilakukan_oleh');
                  $this->db->where('trans_id', $id);
                  return $this->db->get('konfirmasi')->row();
            }

            function get_by_id2($id)
            {
                  $this->db->join('bank_asal', 'bank_asal.id_bankasal = konfirmasi.bankasal_id');
                  $this->db->where('trans_id', $id);
                  return $this->db->get('konfirmasi')->row();
            }

            function get_by_id3($id)
            {
                  $this->db->join('transaksi', 'transaksi.id_trans = transaksi_detail.trans_id');
                  $this->db->join('produk', 'produk.id_produk = transaksi_detail.produk_id');
                  $this->db->where('transaksi_detail.trans_id', $id);
                  return $this->db->get('transaksi_detail')->result();
            }

            function order_subtotal_dan_berat($id)
            {
                  $this->db->select_sum('subtotal');
                  $this->db->select_sum('total_berat');
                  $this->db->join('transaksi', 'transaksi.id_trans = transaksi_detail.trans_id');
                  $this->db->where('transaksi_detail.trans_id', $id);
                  return $this->db->get('transaksi_detail')->row();
            }

            function update_data($id, $data)
            {
                  $this->db->where('id_trans', $id);
                  $this->db->update('transaksi', $data);
            }

            function update_dilakukan_oleh($id2, $data2)
            {
                  $this->db->join('transaksi', 'transaksi.id_trans = konfirmasi.trans_id');
                  $this->db->where('trans_id', $id2);
                  $this->db->update('konfirmasi', $data2);
            }

            function top5_transaksi()
            {
                  $this->db->limit(5);
                  $this->db->join('users', 'users.id = transaksi.user_id');
                  $this->db->order_by('id_trans', 'desc');
                  return $this->db->get('transaksi')->result();
            }

            function top5_transaksi_sudah_konfirmasi()
            {
                  $this->db->limit(5);
                  $this->db->join('transaksi_detail', 'transaksi_detail.trans_id = transaksi.id_trans');
                  $this->db->join('users', 'users.id = transaksi.user_id');
                  $this->db->where('status', '2'); //yg sudah konfirmasi
                  $this->db->order_by('id_trans', 'desc');
                  return $this->db->get('transaksi');
            }
           

      }
      
      /* End of file Penjualan_model.php */
      
?>
