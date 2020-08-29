<?php
      
      defined('BASEPATH') OR exit('No direct script access allowed');
      
      class Companyprofile_model extends CI_Model 
      {
            public $table = 'company';
            public $id    = 'id_company';
            public $order = 'DESC';

            function count_all()
            {
                  $this->db->from($this->table);
                  return $this->db->count_all_results();
            }
            
            //ambil semua data
            function get_all()
            {
                  return $this->db->get($this->table)->result();
            }
            
            //ambil id
            function get_by_id($id)
            {
                  $this->db->where($this->id, $id);
                  return $this->db->get($this->table)->row();
            }

            function total_rows()
            {
                  return $this->db->get($this->table)->num_rows();
            }

            function update($id, $data)
            {     
                  $this->db->where($this->id, $id);
                  return $this->db->update($this->table, $data);
            }

            //delete
            function delete($id)
            {
                  $this->db->where($this->id, $id);
                  return $this->db->delete($this->table);
            }

            function delete_userfile($id)
            {
                  $this->db->select('foto, foto_type');
                  $this->db->where($this->id, $id);
                  return $this->db->get($this->table)->row();
            }

            function del_by_id($id)
            {
                  $this->db->select('foto, foto_type');
                  $this->db->where($this->id, $id);
                  return $this->db->get($this->table)->row();
            }

            // ----- TAMPILAN USER PEMBELI - PENGUNJUNG -----
             function get_by_company()
            {
                  $this->db->where($this->id, '2');
                  return $this->db->get($this->table)->row();
            }
      
      }
      
      /* End of file Companyprofile_model.php */
      
?>