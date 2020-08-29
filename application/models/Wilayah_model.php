<?php
      
      defined('BASEPATH') OR exit('No direct script access allowed');
      
      class Wilayah_model extends CI_Model 
      {
      
            public $table     = 'kota';
            public $table2    = 'provinsi';
            public $id        = 'id_kota';
            public $id2       = 'id_provinsi';

            
            function get_provinsi()
            {
                  $this->db->order_by('nama_provinsi', 'ASC');
                  $sql = $this->db->get('provinsi');
                  if ($sql->num_rows() > 0) 
                  {
                        foreach ($sql->result_array() as $row) 
                        {
                              $result['']                   = '- Choose Province -';
                              $result[$row['id_provinsi']]  = ucwords(strtolower($row['nama_provinsi']));
                        }
                        return $result;
                  }
                  
                  
            }

            function get_kota($prov_id)
            {
                  $this->db->where('id_provinsi', $prov_id);
                  $this->db->order_by('nama_kota', 'ASC');
                  $sql = $this->db->get('kota');
                  if ($sql->num_rows() > 0) 
                  {
                        foreach ($sql->result_array() as $row) 
                        {
                              $result[''] = '- Pilih Kota -';
                              $result[$row['id_kota']] = ucwords(strtolower($row['nama_kota']));
                        }
                        return $result;
                  }
            }

            function get_kota_admin($provinsi_id)
            {
                  $this->db->where('id_provinsi', $provinsi_id);
                  $this->db->order_by('nam_kota', 'ASC');
                  $sql = $this->db->get('kota');
                  if ($sql->num_rows() > 0) 
                  {
                        foreach ($sql->result_array() as $row) 
                        {
                              $result[''] = '- Pilih Kota -';
                              $result[$row['id_kota']] = ucwords(strtolower($row['nama_kota']));
                        }      
                  } else {
                        $result['']= '- Belum Ada SubKategori -';
                  }
                  return $result;
                  
            }

           
            function get_kota2($id_prov)
            {
                  $this->db->join('provinsi', 'provinsi.id_provinsi = users.id_provinsi', 'left');
                  $this->db->join('kota', 'kota.id_kota = users.id_kota', 'left');
                  $this->db->order_by('nama_kota', 'ASC');
                  $this->db->where('id_provinsi', $id_prov);
                  return $this->db->get('users')->result();
            }

            
      
      }
      
      /* End of file Wilayah_model.php */
      
?>