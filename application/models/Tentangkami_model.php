<?php
      
      defined('BASEPATH') OR exit('No direct script access allowed');
      
      class Tentangkami_model extends CI_Model 
      {
            public $table = 'tentangkami';
            public $id    = 'id_tentangkami';
            public $order = 'DESC';
            
            function update($data, $id)
            {
                  $this->db->where('id_tentangkami', $id);
                  return $this->db->update($this->table, $data);
            }
            
            // get data by id
            function get_by_id($id)
            {
                  $this->db->where('id_tentangkami', $id);
                  return $this->db->get($this->table)->row();
            }

            function get_by_tentangkami()
            {
                  $this->db->where('id_tentangkami', '2');
                  return $this->db->get($this->table)->row();     
            }

            function total_rows()
            {
                  return $this->db->get($this->table)->num_rows();
                  
            }
      
      }
      
      /* End of file Tentangkami_model.php */
      
?>