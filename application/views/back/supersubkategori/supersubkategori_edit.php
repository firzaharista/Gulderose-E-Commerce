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
                              <li class="breadcrumb-item"><a href="<?php echo base_url('admin_gulderose/supersubkategori'); ?>"><?php echo $modul ?></a></li>
                              <li class="breadcrumb-item active">Edit <?php echo $modul ?></li>
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
                                          <strong>Edit</strong> <?php echo $modul ?>
                                          <small>Untuk mengubah data <?php echo $modul ?></small>
                                    </h2>
                                    <ul class="header-dropdown">
                                          <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                      <li><a href="<?php echo base_url('admin_gulderose/supersubkategori') ?>">Data <?php echo $modul ?></a></li>
                                                </ul>
                                          </li>
                                          <li class="remove">
                                                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                                          </li>
                                    </ul>
                              </div>
                              <div class="body">
                                    <form class="form-horizontal" id="form_validation_stats" method="POST" enctype="multipart/form-data">
                                          <div class="row clearfix">
                                                <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                                                      <label for="judul_superkategori">Judul <?php echo $modul ?></label>
                                                </div>
                                                <div class="col-lg-10 col-md-10 col-sm-8">
                                                      <div class="form-group has-success">
                                                            <input type="text" id="judul_supersubkategori" class="form-control form-control-success" placeholder="Judul SuperSubKategori">
                                                      </div>
                                                </div>
                                          </div>
                                          <div class="row clearfix">
                                                <div class="col-sm-8 offset-sm-2">
                                                      <button type="button" class="btn btn-raised btn-info btn-round waves-effect">SIMPAN</button>
                                                      <button type="button" class="btn btn-raised btn-info btn-round waves-effect">RESET</button>
                                                </div>
                                          </div>
                                    </form>

                              </div>
                              <div class="sparkline" data-type="line" data-spot-Radius="1" data-highlight-Spot-Color="rgb(63, 81, 181)" data-highlight-Line-Color="#222" data-min-Spot-Color="rgb(233, 30, 99)" data-max-Spot-Color="rgb(63, 81, 181)" data-spot-Color="rgb(63, 81, 181, 0.7)" data-offset="90" data-width="100%" data-height="40px" data-line-Width="1" data-line-Color="rgb(63, 81, 181, 0.7)" data-fill-Color="rgba(0,0,0, 0.2)"> 1,2,3,1,4,3,6,4,4,1 </div>
                        </div>
                  </div>

            </div>

      </div>
</section>