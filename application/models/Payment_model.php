<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_model extends CI_Model
{
      public $table     = 'konfirmasi';
      public $id        = 'id_konfirmasi';

      // -------- BUAT YG BAGIAN FRONT END USER (BUYER)------- //
      function payment_confirmation()
      {
            $this->db->join('users', 'users.id = transaksi.user_id');
            $this->db->where('transaksi.user_id', $this->session->userdata('user_id'));
            $this->db->where('status', '1');
            $this->db->order_by('id_trans', 'ASC');
            return $this->db->get('transaksi')->result();
      }

      function total_berat_dan_subtotal($id)
      {
            $this->db->select_sum('total_berat');
            $this->db->select_sum('subtotal');
            $this->db->join('transaksi', 'transaksi.id_trans = transaksi_detail.trans_id');
            $this->db->where('trans_id', $id);
            $this->db->where('user_id', $this->session->userdata('user_id'));
            $this->db->where('status', '1');
            return $this->db->get('transaksi_detail')->row();
      }

      // ambil total_berat dan subtotal per transaksi customer login
      function get_total_berat_dan_subtotal()
      {
            $this->db->select_sum('total_berat');
            $this->db->select_sum('subtotal');
            $this->db->join('transaksi', 'transaksi_detail.trans_id = transaksi.id_trans');
            $this->db->where('user', $this->session->userdata('user_id'));
            $this->db->where('status', '1');
            return $this->db->get('transaksi_detail')->row();
      }

      function get_order_by_id($id)
      {
            $this->db->join('users', 'users.id = transaksi_detail.user');
            $this->db->join('transaksi', 'transaksi.id_trans = transaksi_detail.trans_id');
            $this->db->where('id_trans', $id);
            $this->db->where('user_id', $this->session->userdata('user_id'));
            return $this->db->get('transaksi_detail');
      }

      function get_by_id($id)
      {     
            $this->db->where($this->id, $id);
            return $this->db->get($this->table)->row();
      }

      function insert($id, $data)
      {
            $this->db->where('trans_id', $id);
            $this->db->insert($this->table, $data);
      }

      function update_status($id, $data2)
      {
            $this->db->where('id_trans', $id);
            $this->db->update('transaksi', $data2);
      }

}

/* End of file Payment_model.php */
?>