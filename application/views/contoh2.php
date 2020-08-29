<?php
      $sql  = $this->db->query("SELECT * FROM kategori ORDER BY judul_kategori");
      $data = $sql->result();
      foreach ($data as $row) {
      $id_kat = $row->id_kategori;
      echo '<li class="col-lg-3 col-md-3 col-sm-12 col-xs-12 menu-home-lv2">
                  <ul>
                        <li><a href="' . base_url('category/read/') . $row->slug_kat . '">' . $row->judul_kategori . ' </a></li>
                  </ul>
                  
            </li>';
      }
?>