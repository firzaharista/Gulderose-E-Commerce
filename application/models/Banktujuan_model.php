<?php
      
      defined('BASEPATH') OR exit('No direct script access allowed');
      
      class Banktujuan_model extends CI_Model 
      {      
            public $table = 'bank_tujuan';
            public $id    = 'id_banktujuan';
            public $order = 'DESC';

            function count_all()
            {
                  $this->db->get($this->table);
                  return $this->db->count_all_results();
            }

            //untuk mengambil semua data dari bankasal(database)
            function get_all()
            {
                  $this->db->order_by($this->id, $this->order);
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

            function update($data, $id)
            {     
                  $this->db->where($this->id, $id);
                  return $this->db->update($this->table, $data);
            }

            function delete($id)
            {
                  $this->db->where($this->id, $id);
                  return $this->db->delete($this->table);
                  
            }

            function get_banktujuan()
            {
                  $this->db->order_by('nama_banktujuan', 'ASC');
                  $sql = $this->db->get('bank_tujuan');
                  if ($sql->num_rows() > 0) 
                  {
                        foreach ($sql->result_array() as $row) 
                        {
                              $result['']                   = '- Choose Bank -';
                              $result[$row['id_banktujuan']]  = ucwords(($row['nama_banktujuan']));
                        }
                        return $result;
                  }     
            }

      }

      
      
      /* End of file Banktujuan_model.php */
?>