<?php
      
      defined('BASEPATH') OR exit('No direct script access allowed');
      
      class Produk_model extends CI_Model 
      {
            public $table = 'produk';
            public $id    = 'id_produk';
            public $order = 'DESC';

            function count_all()
            {
                  $this->db->from($this->table);
                  return $this->db->count_all_results();
            }

            function kat_produk()
            {
                  $this->db->join('kategori', 'kategori.id_kategori = produk.id_kategori');
                  return $this->db->get('produk')->result();
            }
           
            //ambil semua data
            function get_all()
            {
                  $this->db->join('kategori', 'produk.id_kategori = kategori.id_kategori', 'left');
                  $this->db->join('subkategori', 'produk.id_subkategori = subkategori.id_subkategori', 'left');
                  $this->db->order_by($this->id, $this->order);
                  $this->db->where('stok', 'tersedia');
                  return $this->db->get($this->table)->result();
            }

            function get_all_kosong()
            {
                  $this->db->join('kategori', 'produk.id_kategori = kategori.id_kategori', 'left');
                  $this->db->join('subkategori', 'produk.id_subkategori = subkategori.id_subkategori', 'left');
                  $this->db->where('stok', 'kosong');
                  $this->db->order_by($this->id, $this->order);
                  return $this->db->get($this->table)->result();
            }

            function get_all_laporan()
            {
                  $this->db->join('kategori', 'produk.id_kategori = kategori.id_kategori', 'left');
                  $this->db->join('subkategori', 'produk.id_subkategori = subkategori.id_subkategori', 'left');
                  $this->db->order_by('judul_produk', 'ASC');
                  return $this->db->get($this->table)->result();
            }

            //ambil data berdasarkan id
            function get_by_id($id)
            {
                  $this->db->where($this->id, $id);
                  return $this->db->get($this->table)->row();
            }

            function get_by_id_detail($id)
            {
                  $this->db->join('kategori', 'produk.id_kategori = kategori.id_kategori', 'left');
                  $this->db->join('subkategori', 'produk.id_subkategori = subkategori.id_subkategori', 'left');
                  $this->db->where($this->id, $id);
                  return $this->db->get($this->table)->row();
            }

            //jumlah data
            function total_rows()
            {
                  return $this->db->get($this->table)->num_rows();
            }

            function insert($data)
            {
                  $this->db->insert($this->table, $data);
            }

            function insert_komentar($data)
            {
                  $this->db->insert('komentar', $data);
            }

            function update($id, $data)
            {
                  $this->db->where($this->id, $id);
                  $this->db->update($this->table, $data);
            }

            function delete($id)
            {
                  $this->db->where($this->id, $id);
                  $this->db->delete($this->table);
            }

            function del_by_id($id)
            {
                  $this->db->select('foto, foto_type');
                  $this->db->where($this->id, $id);
                  return $this->db->get($this->table)->row();
            }

            //untuk ambil data produk 
            function get_combo_produk()
            {
                  $this->db->order_by('judul_produk', 'ASC');
                  $this->db->where('stok', 'tersedia');
                  $data = $this->db->get($this->table);
                  if ($data->num_rows() > 0) 
                  {
                        foreach ($data->result_array() as $row) 
                        {
                              $result[''] = '- Pilih Produk -';
                              $result[$row['id_produk']] = ucwords(strtolower($row['judul_produk']));
                        }
                        return $result;
                  }
                  
                  
            }

            function top3_produk()
            {
                  $this->db->limit(3);    
                  $this->db->order_by($this->id, $this->order);
                  return $this->db->get($this->table)->result();
            }

            function ambil_stok()
            {
                  $query = $this->db->get('produk');
                  if ($query->num_rows() > 0) {
                        foreach ($query->result_array() as $row) {
                              $result[''] = '- Pilih Stok -';
                              $result[$row['stok']] = ucwords(strtolower($row['stok']));
                        }
                        return $result;
                  }
            }

            // ----- TAMPILAN USER PEMBELI - PENGUNJUNG -----

            // BAGIAN MENU HOME
            function get_all_new_product()
            {
                  $this->db->limit(4);
                  $this->db->order_by($this->id, $this->order);
                  $this->db->where('stok', 'tersedia');
                  return $this->db->get($this->table)->result();
            }

            function get_all_new_bouquet()
            {
                  $this->db->limit(8);
                  $this->db->join('kategori', 'produk.id_kategori = kategori.id_kategori');
                  $this->db->where('kategori.judul_kategori', 'Bouquet');
                  $this->db->where('stok', 'tersedia');
                  $this->db->order_by($this->id, $this->order);
                  return $this->db->get($this->table)->result();
            }

            //BAGIAN MENU PRODUCT FRONT
            function get_all_product($per_page, $from)
            {
                  $this->db->order_by($this->id, $this->order);
                  $this->db->where('stok', 'tersedia');
                  $query = $this->db->get($this->table, $per_page, $from);
                  return $query->result();
            }

            function get_all_product_notif()
            {
                  $this->db->order_by($this->id, 'desc');
                  return $this->db->get('produk');
            }

            function get_by_id_detail_front($id)
            {
                  $this->db->join('kategori', 'produk.id_kategori = kategori.id_kategori', 'left');
                  $this->db->join('subkategori', 'produk.id_subkategori = subkategori.id_subkategori', 'left');
                  $this->db->where('slug_produk', $id);
                  return $this->db->get($this->table)->row();
            }

            function get_random()
            {
                  $this->db->limit(6);
                  $this->db->order_by('judul_produk', 'RANDOM');
                  return $this->db->get($this->table)->result();
                  
            }

            function get_search_product()
            {
                  $search = $this->input->get('product');
                  $this->db->order_by('id_produk', 'desc');
                  $this->db->like('judul_produk', $search);
                  return $this->db->get($this->table)->result();
            }

            function get_cari_produk()
            {
                  $cari = $this->input->GET('cari', TRUE);

                  $data = $this->db->query("SELECT * from produk where judul_produk like '%$cari%' ");
                  return $data->result();
            }

            // kalo pake cara product pagination yg lain (filename : product_cara_lain.php)
            public function get_current_page_records($limit, $start)
            {
                  $this->db->limit($limit, $start);
                  $this->db->order_by('id_produk', 'desc');
                  $query = $this->db->get("produk");
                  if ($query->num_rows() > 0) {
                        foreach ($query->result() as $row) {
                              $data[] = $row;
                        }

                        return $data;
                  }

                  return false;
            }
            

      
      }
      
      /* End of file Produk_model.php */
      
?>