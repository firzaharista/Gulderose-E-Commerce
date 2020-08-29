<?php
      $sql = $this->db->query("SELECT * FROM kategori ORDER BY judul_kategori"); // Memanggil kategori/ top kategori
      $data = $sql->result();
      foreach($data as $row)
      {
      $id_kat = $row->id_kategori;
      echo '
      <li><a href="'.base_url('kategori/read/').$row->slug_kat.'">'.$row->judul_kategori.' </a>
      <ul>';

      $sql2   =  $this->db->query("SELECT * FROM subkategori WHERE id_kategori = '$id_kat' ORDER BY judul_subkategori "); // Memanggil subkategori/ middle kategori
      $data2  = $sql2->result();
      foreach($data2 as $row2)
      {
      $id_sub = $row2->id_subkategori;
      echo '
      <li><a href="'.base_url('kategori/read/').$row->slug_kat.'/'.$row2->slug_subkat.'">'.$row2->judul_subkategori.'</a>';
      }
      echo '
      </ul>';
      }
      echo '
      </li>';
?>