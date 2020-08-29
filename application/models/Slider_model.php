<?php
      defined('BASEPATH') OR exit('No direct script access allowed');
      
      class Slider_model extends CI_Model 
      {
            public $table = 'slider';
            public $id    = 'id_slider';
            public $order = 'DESC';
            
            //untuk menghitung jumlah semuanya
            function count_all()
            {
                  $this->db->from($this->table);
                  return $this->db->count_all_results();
            }

            //mengambil data slider dan mengorder dari id slidernya DESC (dari yg terbesar)
            function get_all()
            {
                  $this->db->order_by($this->id, $this->order); //$this->order sama dg $order = 'DESC' 
                  return $this->db->get($this->table)->result(); //$this->table = $table yg isinya 'slider'      
            }

            //mengambil data dari id-nya 
            function get_by_id($id)
            {
                  $this->db->where($this->id, $id);
                  return $this->db->get($this->table)->row();
            }

            //mengambil total row
            function total_row()
            {
                  return $this->db->get($this->table)->num_rows();
            }

            //insert data
            function insert($data)
            {
                  $this->db->insert($this->table, $data);
            }

            //update data
            function update($id, $data)
            {
                  $this->db->where($this->id, $id);
                  $this->db->update($this->table, $data);
            }

            //delete
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

            // ----- TAMPILAN USER PEMBELI - PENGUNJUNG -----

            //mengambil data dari slider berdasarkan id slider ASC buat Home (Pembeli)
            function get_all_home()
            {
                  $this->db->order_by($this->id, 'ASC');
                  return $this->db->get($this->table)->result();
            }

      }

      
      
      /* End of file Slider_model.php */
      
?>