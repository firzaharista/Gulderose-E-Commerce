<?php
      
      defined('BASEPATH') OR exit('No direct script access allowed');
      
      class Kategori_model extends CI_Model 
      {      
            public $table = 'kategori';
            public $id    = 'id_kategori';
            public $order = 'DESC';

            function count_all()
            {
                  $this->db->from($this->table);
                  return $this->db->count_all_results();
            }

            function get_all()
            {
                  // $this->db->order_by('id_kategori', 'ASC');
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
            
            // buat ngambil data kategori
            function ambil_kategori()
            {
                  $query = $this->db->get('kategori');
                  if ($query->num_rows() > 0) {
                        foreach ($query->result_array() as $row) {
                              $result[''] = '- Pilih Kategori -';
                              $result[$row['id_kategori']] = ucwords(strtolower($row['judul_kategori']));
                        }
                        return $result;
                  }
            }

            function ambil_subkat($kat_id)
            {
                  $this->db->where('id_kategori', $kat_id);
                  
                  $query = $this->db->get('subkategori');
                  if ($query->num_rows() > 0) {
                        foreach ($query->result_array() as $row) {
                              $result[''] = '- Pilih Kategori -';
                              $result[$row['id_subkategori']] = ucwords(strtolower($row['judul_subkategori']));
                        }
                        return $result;
                  }
            }

            function ambil_subkategori($kat_id)
            {
                  $this->db->where('id_kategori', $kat_id);
                  $this->db->order_by('judul_subkategori', 'ASC');
                  $sql = $this->db->get('subkategori');
                  if ($sql->num_rows() > 0) 
                  {
                        foreach ($sql->result_array() as $row) 
                        {
                              $result[$row['id_subkategori']] = ucwords(strtolower($row['judul_subkategori']));
                        }      
                  } else {
                        $result['']= '- Belum Ada SubKategori -';
                  }
                  return $result;
                  
            }
            
            function ambil_supersubkat($subkat_id)
            {
                  $this->db->where('id_subkategori', $subkat_id);
                  
                  $query = $this->db->get('supersubkategori');
                  if ($query->num_rows() > 0) {
                        foreach ($query->result_array() as $row) {
                              // $result[''] = '- Pilih Kategori -';
                              $result[$row['id_supersubkategori']] = ucwords(strtolower($row['judul_supersubkategori']));
                        }
                        return $result;
                  }
            }

            function ambil_supersubkategori($subkat_id)
            {
                  $this->db->where('id_subkategori', $subkat_id);

                  $query = $this->db->get('supersubkategori');
                  if ($query->num_rows() > 0) {
                        foreach ($query->result_array() as $row) 
                        {
                              // $result[''] = '- Pilih Kategori -';
                              $result[$row['id_supersubkategori']] = ucwords(strtolower($row['judul_supersubkategori']));
                        }     
                  } else {
                        $result['-']= '- Belum Ada SuperSubKategori -';
                  }
                  return $result;
            }

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
                  $output = '<option value="">Pilih Subkategori</option>';
                  foreach ($query->result() as $row) {
                        $output .= '<option value="' . $row->id_subkategori . '">' . $row->judul_subkategori . '</option>';
                  }
                  return $output;
            }

            // ----- TAMPILAN USER PEMBELI - PENGUNJUNG ----- //

            // BAGIAN NAVBAR PRODUCT CATEGORY
            function get_list_by_kategori($slug, $limit=null, $offset=null)
            {
                  $this->db->limit($limit, $offset);
                  $this->db->order_by('produk.id_produk', $this->order);
                  $this->db->join('kategori', 'produk.id_kategori = kategori.id_kategori');
                  $this->db->where('kategori.slug_kat', $slug);
                  $this->db->where('stok', 'tersedia');

                  return $this->db->get('produk');
            }

            // total rows/data kategori (num_rows)
            function get_by_kategori_nr($slug)
            {
                  $this->db->join('kategori', 'produk.id_kategori = kategori.id_kategori');
                  $this->db->where('kategori.slug_kat', $slug);
                  $this->db->where('stok', 'tersedia');

                  return $this->db->get('produk')->num_rows();
            }

            function get_list_by_subkategori($slug, $limit=null, $offset=null)
            {
                  $this->db->limit($limit, $offset);
                  $this->db->order_by('id_produk', 'desc');
                  $this->db->join('subkategori', 'produk.id_subkategori = subkategori.id_subkategori');
                  $this->db->where('subkategori.slug_subkat', $slug);
                  $this->db->where('stok', 'tersedia');

                  return $this->db->get('produk');
            }

            // total data subkategori (num_rows)
            function get_by_subkategori_nr($slug)
            {
                  $this->db->join('subkategori', 'produk.id_subkategori = subkategori.id_subkategori');
                  $this->db->where('subkategori.slug_subkat', $slug);
                  $this->db->where('stok', 'tersedia');

                  return $this->db->get('produk')->num_rows();
            }

            
            

            
      }

      
      /* End of file Kategori.php */
      
?>