<?php
      
      defined('BASEPATH') OR exit('No direct script access allowed');
      
      class Subkategori_model extends CI_Model 
      {      
            public $table = 'subkategori';
            public $id    = 'id_subkategori';
            public $order = 'DESC';

            function count_all()
            {
                  $this->db->from($this->table);
                  return $this->db->count_all_results();
            }

            function get_all()
            {
                  $this->db->join('kategori', 'subkategori.id_kategori = kategori.id_kategori');
                  $this->db->order_by('judul_kategori', 'ASC');
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

            function ambil_subkat($kat)
            {
                  $this->db->where('id_kategori', $kat);
                  
                  $query = $this->db->get('kategori');
                  if ($query->num_rows() > 0) {
                        foreach ($query->result_array() as $row) {
                              $result[''] = '- Pilih Kategori -';
                              $result[$row['id_kategori']] = ucwords(strtolower($row['judul_kategori']));
                        }
                        return $result;
                  }
            }

            
      }
      
      /* End of file Subkategori_model.php */
      
?>