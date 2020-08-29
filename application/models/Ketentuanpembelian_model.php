<?php
      
      defined('BASEPATH') OR exit('No direct script access allowed');
      
      class Ketentuanpembelian_model extends CI_Model 
      {      
            public $table = 'ketentuan';
            public $id    = 'id_ketentuan';
            public $order = 'DESC';

            function count_all()
            {
                  $this->db->from($this->table);
                  return $this->db->count_all_results();
            }

            function get_all()
            {
                  return $this->db->get($this->table)->result();
            }

            function total_rows()
            {
                  return $this->db->get($this->table)->num_rows();
            }

            function update($id, $data)
            {
                  $this->db->where($this->id, $id);
                  $this->db->get($this->table, $data);
            }

            //ambil per id nya
            function get_by_id($id)
            {
                  $this->db->where($this->id, $id);
                  return $this->db->get($this->table)->row();
                  
                  
            }

      }
      
      /* End of file ketentuanpembelian_model.php */
