<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<section class="content home">
      <div class="block-header">
            <div class="row">
                  <div class="col-lg-5 col-md-5 col-sm-12">
                        <h2>Ecommerce Dashboard
                              <small>Welcome to Gulderose Bunga Flanel</small>
                        </h2>
                  </div>
                  <div class="col-lg-7 col-md-7 col-sm-12 text-right">

                        <button class="btn btn-white btn-icon btn-round hidden-sm-down float-right m-l-10" type="button">
                              <i class="zmdi zmdi-plus"></i>
                        </button>
                        <ul class="breadcrumb float-md-right">
                              <li class="breadcrumb-item"><a href="<?php echo base_url('admin_gulderose/dashboard'); ?>"><i class="zmdi zmdi-home"></i> Home</a></li>
                              <li class="breadcrumb-item"><a href="<?php echo base_url('admin_gulderose/kategori'); ?>">Kategori</a></li>
                              <li class="breadcrumb-item active">Tambah Kategori</li>
                        </ul>
                  </div>
            </div>
      </div>
      <!-- Bagian Kategori -->
      <div class="container-fluid">
            <div class="row clearfix">
                  <div class="col-lg-12 col-md-12">
                        <div class="card">
                              <div class="header">
                                    <h2>
                                          <strong>Tambah</strong> Kategori
                                          <small>Untuk menambah data Kategori</small>
                                    </h2>
                                    <ul class="header-dropdown">
                                          <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                      <li><a href="<?php echo base_url('admin_gulderose/kategori') ?>">Data Kategori</a></li>
                                                </ul>
                                          </li>
                                          <li class="remove">
                                                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                                          </li>
                                    </ul>
                              </div>
                              <div class="body">
                                    <?php echo validation_errors() ?>
                                    <?php if ($this->session->flashdata('message')) {
                                          echo $this->session->flashdata('message');
                                    } ?>
                                    <?php echo form_open_multipart($action) ?>
                                    <div class="row clearfix">
                                          <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                                                <label for="judul_kategori">Judul Kategori</label>
                                          </div>
                                          <div class="col-lg-10 col-md-10 col-sm-8">
                                                <div class="form-group has-success">
                                                      <select name="kategori" id="kategori" class="form-control show-tick">
                                                            <option value="">Select kategori</option>
                                                            <?php
                                                            foreach ($kategori as $row) {
                                                                  echo '<option value="' . $row->id_kategori . '">' . $row->judul_kategori . '</option>';
                                                            }
                                                            ?>
                                                      </select>
                                                </div>
                                          </div>
                                    </div>
                                    <div class="row clearfix">
                                          <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                                                <label for="judul_kategori">Judul SubKategori</label>
                                          </div>
                                          <div class="col-lg-10 col-md-10 col-sm-8">
                                                <div class="form-group has-success">
                                                      <select name="subkategori" id="subkategori" class="form-control show-tick">
                                                            <option value="">Select subkategori</option>

                                                      </select>
                                                </div>
                                          </div>
                                    </div>
                                    <div class="row clearfix">
                                          <div class="col-sm-8 offset-sm-2">
                                                <button type=" submit" name='submit' class="btn btn-raised btn-info btn-round waves-effect"><?php echo $button_submit ?></button>
                                                <button type="reset" name='reset' class="btn btn-raised btn-info btn-round waves-effect"><?php echo $button_reset ?></button>
                                          </div>
                                    </div>
                              </div>

                              <div class="sparkline" data-type="line" data-spot-Radius="1" data-highlight-Spot-Color="rgb(63, 81, 181)" data-highlight-Line-Color="#222" data-min-Spot-Color="rgb(233, 30, 99)" data-max-Spot-Color="rgb(63, 81, 181)" data-spot-Color="rgb(63, 81, 181, 0.7)" data-offset="90" data-width="100%" data-height="40px" data-line-Width="1" data-line-Color="rgb(63, 81, 181, 0.7)" data-fill-Color="rgba(0,0,0, 0.2)"> 1,2,3,1,4,3,6,4,4,1 </div>
                              <?php form_close() ?>
                        </div>
                  </div>

            </div>

      </div>
</section>
<script>
      $(document).ready(function() {
            $('#kategori').change(function() {
                  var id_kategori = $('#kategori').val();
                  if (id_kategori != '') {
                        $.ajax({
                              url: "<?php echo base_url(); ?>admin_gulderose/select/fetch_subkategori",
                              method: "POST",
                              data: {
                                    id_kategori: id_kategori
                              },
                              success: function(data) {
                                    console.log(data);
                                    $('#subkategori').empty();
                                    $('#subkategori').append('<option value="">Select asdsa</option>');
                                    //$('#subkategori').html(data);
                              }
                        });
                  } else {
                        $('#subkategori').html('<option value="">Select subkategori</option>');
                  }
            });

            $('#subkategori').change(function() {
                  var subkategori_id = $('#subkategori').val();
                  if (subkategori_id != '') {
                        $.ajax({
                              url: "<?php echo base_url(); ?>index.php/dynamic_dependent/fetch_city",
                              method: "POST",
                              data: {
                                    subkategori_id: subkategori_id
                              },
                              success: function(data) {
                                    $('#city').html(data);
                              }
                        });
                  } else {
                        $('#city').html('<option value="">Select City</option>');
                  }
            });

      });
</script>