<?php
      
      defined('BASEPATH') OR exit('No direct script access allowed');
      
      class Panduanpembelian_model extends CI_Model 
      {      
            public $table = 'panduan';
            public $id    = 'id_panduan';
            public $order = 'DESC';

            //ambil semua data dan order berdasarkan idnya DESC
            function get_all()
            {
                  $this->db->order_by('id_panduan', 'ASC');
                  return $this->db->get($this->table)->result();
            }

            function get_by_id($id)
            {
                  $this->db->where($this->id, $id);
                  return $this->db->get($this->table)->row();     
            }

            //get total barisnya
            function total_rows()
            {
                  return $this->db->get($this->table)->num_rows();
            }

            function count_all()
            {
                  $this->db->from($this->table);
                  return $this->db->count_all_results();
            }

            function insert($data)
            {
                  $this->db->insert($this->table, $data);
            }

            function update($data, $id)
            {
                  $this->db->where('id_panduan', $id);
                  return $this->db->update($this->table, $data);
            }

            function delete($id)
            {
                  $this->db->where($this->id, $id);
                  return $this->db->delete($this->table);
            }

            // ----- TAMPILAN USER PEMBELI - PENGUNJUNG -----
            function get_all_front()
            {
                  return $this->db->get($this->table)->result();
            }
      }
      
      /* End of file Panduanpembelian_model.php */
