<?php
      
      defined('BASEPATH') OR exit('No direct script access allowed');
      
      class Produkrekomendasi_model extends CI_Model 
      {
            public $table = 'produk_rekomendasi';
            public $id    = 'id_produkrekomendasi';
            public $order = 'DESC';

            function count_all()
            {
                  $this->db->from($this->table);
                  return $this->db->count_all_results();
            }

            function get_all()
            {
                  $this->db->join('produk', 'produk_rekomendasi.id_produk = produk.id_produk');
                  $this->db->order_by('id_produkrekomendasi', 'desc');
                  return $this->db->get($this->table)->result();
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
                  $this->db->update($this->table, $data);
            }

            function delete($id)
            {
                  $this->db->where($this->id, $id);
                  $this->db->delete($this->table);
            }

            function get_by_id($id)
            {
                  $this->db->where($this->id, $id);
                  return $this->db->get($this->table)->row();
            }

            function del_by_id($id)
            {
                  $this->db->where($this->id, $id);
                  return $this->db->get($this->table)->row();
            }

            // ----- TAMPILAN USER PEMBELI - PENGUNJUNG -----
            function get_all_home()
            {
                  $this->db->limit(4);
                  $this->db->join('produk', 'produk_rekomendasi.id_produk = produk.id_produk');
                  $this->db->join('kategori', 'produk.id_kategori = kategori.id_kategori');
                  $this->db->order_by('id_produkrekomendasi', 'desc');
                  $this->db->where('stok', 'tersedia');
                  return $this->db->get($this->table)->result();
            }

            function get_all_front()
            {
                  $this->db->limit(5);
                  $this->db->where('stok', 'tersedia');
                  $this->db->join('produk', 'produk_rekomendasi.id_produk = produk.id_produk');
                  $this->db->order_by('id_produkrekomendasi', 'DESC');
                  return $this->db->get($this->table)->result();
            }

      
      }
      
      /* End of file Produk_model.php */

