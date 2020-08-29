<?php $this->load->view('back/meta'); ?>
<?php $this->load->view('back/navbar'); ?>
<?php $this->load->view('back/left-sidebar'); ?>
<?php $this->load->view('back/right-sidebar'); ?>

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
                              <li class="breadcrumb-item"><a href="<?php echo base_url('admin_gulderose/companyprofile'); ?>"><?php echo $modul ?></a></li>
                              <li class="breadcrumb-item active">Edit <?php echo $modul ?></li>
                        </ul>
                  </div>
            </div>
      </div>
      <!-- Bagian total Penjualan dll -->
      <div class="container-fluid">
            <div class="row clearfix">
                  <div class="col-lg-12 col-md-12">
                        <div class="card">
                              <div class="header">
                                    <h2>
                                          <strong>Edit</strong> <?php echo $modul ?>
                                          <small>Untuk mengubah data <?php echo $modul ?></small>
                                    </h2>
                                    <ul class="header-dropdown">
                                          <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                      <li><a href="<?php echo base_url('admin_gulderose/companyprofile/update/2') ?>">Data <?php echo $modul ?></a></li>
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
                                                <label for="nama_perusahaan">Nama Perusahaan</label>
                                          </div>
                                          <div class="col-lg-10 col-md-10 col-sm-8">
                                                <div class="form-group has-success">
                                                      <?php echo form_input($nama_company, $company->nama_company) ?>
                                                </div>
                                          </div>
                                    </div>
                                    <div class="row clearfix">
                                          <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                                                <label for="judul_website">Judul Website</label></label>
                                          </div>
                                          <div class="col-lg-4 col-md-4 col-sm-4">
                                                <div class="form-group has-success">
                                                      <?php echo form_input($judul_website, $company->judul_website) ?>
                                                </div>
                                          </div>
                                          <div class="col-lg-1 col-md-2 col-sm-4 form-control-label">
                                                <label for="email">Email</label>
                                          </div>
                                          <div class="col-lg-5 col-md-4 col-sm-4">
                                                <div class="form-group has-success">
                                                      <?php echo form_input($email_company, $company->email_company) ?>
                                                </div>
                                          </div>
                                    </div>
                                    <div class="row clearfix">
                                          <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                                                <label for="no_hp">No. HP</label>
                                          </div>
                                          <div class="col-lg-4 col-md-4 col-sm-4">
                                                <div class="form-group has-success">
                                                      <?php echo form_input($no_hp, $company->no_hp) ?>
                                                </div>
                                          </div>
                                          <div class="col-lg-1 col-md-2 col-sm-4 form-control-label">
                                                <label for="telepon">Telepon</label>
                                          </div>
                                          <div class="col-lg-5 col-md-4 col-sm-4">
                                                <div class="form-group has-success">
                                                      <?php echo form_input($telp_company, $company->telp_company) ?>
                                                </div>
                                          </div>
                                    </div>
                                    <div class="row clearfix">
                                          <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                                                <label for="deskripsi">Deskripsi</label>
                                          </div>
                                          <div class="col-lg-10">
                                                <div class="form-group has-success">
                                                      <?php echo form_textarea($des_company, $company->des_company) ?>
                                                </div>
                                          </div>
                                    </div>
                                    <div class="row clearfix">
                                          <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                                                <label for="alamat">Alamat</label>
                                          </div>
                                          <div class="col-lg-10">
                                                <div class="form-group has-success">
                                                      <?php echo form_textarea($alamat_company, $company->alamat_company) ?>
                                                </div>
                                          </div>
                                    </div>
                                    <div class="row clearfix">
                                          <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                                                <label for="link_ig">Link Instagram</label>
                                          </div>
                                          <div class="col-lg-10 col-md-10 col-sm-8">
                                                <div class="form-group has-success">
                                                      <?php echo form_input($link_ig, $company->link_ig) ?>
                                                </div>
                                          </div>
                                    </div>
                                    <div class="row clearfix">
                                          <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                                                <label for="link_fb">Link Facebook</label>
                                          </div>
                                          <div class="col-lg-10 col-md-10 col-sm-8">
                                                <div class="form-group has-success">
                                                      <?php echo form_input($link_fb, $company->link_fb) ?>
                                                </div>
                                          </div>
                                    </div>
                                    <div class="row clearfix">
                                          <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                                                <label for="footer">Footer</label>
                                          </div>
                                          <div class="col-lg-10 col-md-10 col-sm-8">
                                                <div class="form-group has-success">
                                                      <?php echo form_input($footer, $company->footer) ?>
                                                </div>
                                          </div>
                                    </div>
                                    <div class="row clearfix">
                                          <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                                                <label for="logo_sebelum">Logo Sebelumnya</label>
                                          </div>
                                          <div class="col-lg-10 col-md-10 col-sm-8">
                                                <img src="<?php echo base_url('assets/images/company/'.$company->foto.$company->foto_type.'')?>" width='200px' alt="foto">
                                          </div>
                                    </div>
                                    <br>
                                    <div class="row clearfix">
                                          <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                                                <label for="logo_baru">Logo Baru</label>
                                          </div>
                                          <div class="col-lg-10 col-md-10 col-sm-8">
                                                <div class="form-group has-success">
                                                      <!-- <input type="file" id="logo_baru" class="form-control form-control-success"> -->
                                                      <input type="file" class="form-control form-control-success" name="foto" id="foto" onchange="tampilkanPreview(this,'preview')"/>
                                                </div>
                                          </div>
                                    </div>
                                    <div class="row clearfix">
                                          <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                                                <label for="preview">Preview Logo</label>
                                          </div>
                                          <div class="col-lg-10 col-md-10 col-sm-8">
                                                <img id="preview" src="" alt="" width="280px" />
                                          </div>
                                    </div>
                                    <br>
                                    <div class="row clearfix">
                                          <div class="col-sm-8 offset-sm-2">
                                                <button type=" submit" name='submit' class="btn btn-raised btn-info btn-round waves-effect"><?php echo $button_submit ?></button>
                                                <button type="reset" name='reset' class="btn btn-raised btn-info btn-round waves-effect"><?php echo $button_reset ?></button>
                                          </div>
                                    </div>
                              </div>
                              <?php echo form_input($id_company, $company->id_company) ?>
                              <div class="sparkline" data-type="line" data-spot-Radius="1" data-highlight-Spot-Color="rgb(63, 81, 181)" data-highlight-Line-Color="#222" data-min-Spot-Color="rgb(233, 30, 99)" data-max-Spot-Color="rgb(63, 81, 181)" data-spot-Color="rgb(63, 81, 181, 0.7)" data-offset="90" data-width="100%" data-height="40px" data-line-Width="1" data-line-Color="rgb(63, 81, 181, 0.7)" data-fill-Color="rgba(0,0,0, 0.2)"> 1,2,3,1,4,3,6,4,4,1 </div>
                              <?php form_close() ?>
                        </div>
                  </div>

            </div>

      </div>

</section>

<?php $this->load->view('back/js'); ?>
<script type="text/javascript">
      function tampilkanPreview(foto, idpreview) { //membuat objek gambar
            var gb = foto.files;
            //loop untuk merender gambar
            for (var i = 0; i < gb.length; i++) { //bikin variabel
                  var gbPreview = gb[i];
                  var imageType = /image.*/;
                  var preview = document.getElementById(idpreview);
                  var reader = new FileReader();
                  if (gbPreview.type.match(imageType)) { //jika tipe data sesuai
                        preview.file = gbPreview;
                        reader.onload = (function(element) {
                              return function(e) {
                                    element.src = e.target.result;
                              };
                        })(preview);
                        //membaca data URL gambar
                        reader.readAsDataURL(gbPreview);
                  } else { //jika tipe data tidak sesuai
                        alert("Tipe file tidak sesuai. Gambar harus bertipe .png, .gif atau .jpg.");
                  }
            }
      }
</script>
</body>

</html>