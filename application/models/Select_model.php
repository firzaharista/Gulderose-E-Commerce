<?php
      
      defined('BASEPATH') OR exit('No direct script access allowed');
      
      class Select_model extends CI_Model 
      {

            function fetch_kategori()
            {
                  $this->db->order_by("judul_kategori", "ASC");
                  $query = $this->db->get("kategori");
                  return $query->result();
            }

            function fetch_subkategori($id_kategori)
            {
                  $this->db->where('id_kategori', $id_kategori);
                  $this->db->order_by('judul_subkategori', 'ASC');
                  $query = $this->db->get('subkategori');
                  $output = '<option value="">Select Kategori</option>';
                  foreach ($query->result() as $row) {
                        $output .= '<option value="' . $row->id_subkategori . '">' . $row->judul_subkategori . '</option>';
                  }
                  return $output;
            }
            
      
      }
      
      /* End of file Select_model.php */
      

?>