<?php
      
      defined('BASEPATH') OR exit('No direct script access allowed');
      
      class Supersubkategori_model extends CI_Model 
      {      
            public $table = 'supersubkategori';
            public $id    = 'id_supersubkategori';
            public $order = 'DESC';

            function count_all()
            {
                  $this->db->from($this->table);
                  return $this->db->count_all_results();
            }

            function get_all()
            {
                  $this->db->join('kategori', 'supersubkategori.id_kategori = kategori.id_kategori');
                  $this->db->join('subkategori', 'supersubkategori.id_subkategori = subkategori.id_subkategori');
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

            function insert($data)
            {
                  $this->db->insert($this->table, $data);
            }

            function update($id, $data)
            {     
                  $this->db->where($this->id, $id);
                  return $this->db->update($this->table, $data);
            }

            function delete($id)
            {
                  $this->db->where($this->id, $id);
                  return $this->db->delete($this->table);     
            }

            
      }
      
      /* End of file Supersubkategori.php */
      
?>