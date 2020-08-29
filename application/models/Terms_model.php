<?php
      
      defined('BASEPATH') OR exit('No direct script access allowed');
      
      class Terms_model extends CI_Model 
      {
            public $table = 'terms_of_service';
            public $id    = 'id_terms';
            public $order = 'DESC';
            
            function get_all()
            {
                  $this->db->order_by($this->id, 'ASC');
                  return $this->db->get($this->table)->result();
            }

            function insert($data)
            {
                  $this->db->insert($this->table, $data);     
            }
            
            function update($data, $id)
            {
                  $this->db->where('id_terms', $id);
                  return $this->db->update($this->table, $data);
            }

            function delete($id)
            {
                  $this->db->where($this->id, $id);
                  return $this->db->delete($this->table);
            }
            
            // get data by id
            function get_by_id($id)
            {
                  $this->db->where('id_terms', $id);
                  return $this->db->get($this->table)->row();
            }

            function get_by_tentangkami()
            {
                  $this->db->where('id_terms', '2');
                  return $this->db->get($this->table)->row();     
            }

            function total_rows()
            {
                  return $this->db->get($this->table)->num_rows();
                  
            }

            // ----- TAMPILAN USER PEMBELI - PENGUNJUNG -----
            function get_all_terms()
            {     
                  $this->db->order_by($this->id, 'ASC');
                  return $this->db->get($this->table)->result();
            }
      
      }
      
      /* End of file Terms_model.php */
