<?php $this->load->view('back/meta'); ?>
<?php $this->load->view('back/navbar'); ?>
<?php $this->load->view('back/left-sidebar'); ?>
<?php $this->load->view('back/right-sidebar'); ?>

<section class="content">
  <div class="block-header">
    <div class="row">
      <div class="col-lg-7 col-md-5 col-sm-12">
        <h2>Ecommerce Dashboard
          <small>Welcome to Gulderose Bunga Flanel</small>
        </h2>
      </div>
      <div class="col-lg-5 col-md-7 col-sm-12">
        <button class="btn btn-white btn-icon btn-round hidden-sm-down float-right m-l-10" type="button">
          <i class="zmdi zmdi-plus"></i>
        </button>
        <ul class="breadcrumb float-md-right">
          <li class="breadcrumb-item"><a href="<?php echo base_url('admin_gulderose/dashboard'); ?>"><i class="zmdi zmdi-home"></i> Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url('admin_gulderose/auth'); ?>">User</a></li>
          <li class="breadcrumb-item active">Data User</li>
        </ul>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <div class="row clearfix">
      <div class="col-lg-12">
        <div class="card">
          <div class="header">
            <h2>
              <strong>Data</strong> <?php echo $modul ?> Superadmin
              <small>Kumpulan pengguna Sistem Gulderose</small>
            </h2>
            <ul class="header-dropdown">
              <a href="<?php echo base_url('admin_gulderose/auth/create_user') ?>"><button class="btn btn-info btn-round">Tambah</button></a>
              <li class="remove">
                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
              </li>
            </ul>
          </div>
          <?php echo $message; ?>
          <div class="body">
            <div class="table-responsive">
              <a href="<?php echo base_url('admin_gulderose/auth') ?>"><button class="btn btn-info btn-round">All Users</button></a>
              <a href="<?php echo base_url('admin_gulderose/auth/users_admin') ?>"><button class="btn btn-info btn-round">Admin</button></a>
              <a href="<?php echo base_url('admin_gulderose/auth/users_buyer') ?>"><button class="btn btn-info btn-round">Buyer</button></a>
              <table class="table table-bordered table-striped table-hover dataTable js-basic-example">
                <?php if ($this->session->userdata('user_id') == '1') { ?>
                  <thead>
                    <tr>
                      <th style="text-align: center">No.</th>
                      <th style="text-align: center">Nama</th>
                      <th style="text-align: center">Username</th>
                      <th style="text-align: center">Email</th>
                      <th style="text-align: center">Last Login</th>
                      <th style="text-align: center">Level User</th>
                      <th style="text-align: center">Status</th>
                      <th style="text-align: center">Aksi</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th style="text-align: center">No.</th>
                      <th style="text-align: center">Nama</th>
                      <th style="text-align: center">Username</th>
                      <th style="text-align: center">Email</th>
                      <th style="text-align: center">Last Login</th>
                      <th style="text-align: center">Level User</th>
                      <th style="text-align: center">Status</th>
                      <th style="text-align: center">Aksi</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php $start = 0;
                      foreach ($users_superadmin as $user) : ?>
                      <tr>
                        <td style="text-align:center"><?php echo ++$start ?></td>
                        <td style="text-align:left"><?php echo $user->nama ?></td>
                        <td style="text-align:center"><?php echo $user->username ?></td>
                        <td style="text-align:center"><?php echo $user->email ?></td>
                        <td style="text-align:center"><?php if (!empty($user->last_login)) {
                                                            echo date("d-m-Y H:i:s", $user->last_login);
                                                          } ?> WIB</td>
                        <td style="text-align:center"><?php echo $user->nama_group ?></td>
                        <td style="text-align:center"><?php echo ($user->active) ? anchor("admin_gulderose/auth/deactivate/" . $user->id, 'ACTIVE', 'title="ACTIVE", class="btn btn-sm btn-info"', lang('index_active_link')) : anchor("admin_gulderose/auth/activate/" . $user->id, 'INACTIVE', 'title="INACTIVE", class="btn btn-sm btn-danger"', lang('index_inactive_link')); ?></td>
                        <td style="text-align:center">
                          <!-- pake fungsi anchor -->
                          <?php
                              echo anchor(site_url('admin_gulderose/auth/edit_user/' . $user->id), '<button type="button" class="btn btn-icon btn-icon-mini btn-round btn-info"><i class="zmdi zmdi-edit"></i></button>');
                              echo ' ';
                              echo anchor(site_url('admin_gulderose/auth/delete_user/' . $user->id), '<button type="button" class="btn btn-icon btn-icon-mini btn-round btn-danger"><i class="zmdi zmdi-delete"></i></button>');
                              ?>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                <?php } else { ?>
                  <thead>
                    <tr>
                      <th style="text-align: center">No.</th>
                      <th style="text-align: center">Nama</th>
                      <th style="text-align: center">Username</th>
                      <th style="text-align: center">Email</th>
                      <th style="text-align: center">Last Login</th>
                      <th style="text-align: center">Usertype</th>
                      <th style="text-align: center">Status</th>
                      <th style="text-align: center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $start = 0;
                      foreach ($users as $user) : ?>
                      <tr>
                        <td style="text-align:center"><?php echo ++$start ?></td>
                        <td style="text-align:left"><?php echo $user->nama ?></td>
                        <td style="text-align:center"><?php echo $user->username ?></td>
                        <td style="text-align:center"><?php echo $user->email ?></td>
                        <td style="text-align:center"><?php echo $user->last_login ?></td>
                        <td style="text-align:center"><?php echo $user->nama_group ?></td>
                        <td style="text-align:center"><?php echo ($user->active) ? anchor("admin_gulderose/auth/deactivate/" . $user->id, 'ACTIVE', 'title="ACTIVE", class="btn btn-sm btn-info"', lang('index_active_link')) : anchor("admin_gulderose/auth/activate/" . $user->id, 'INACTIVE', 'title="INACTIVE", class="btn btn-sm btn-danger"', lang('index_inactive_link')); ?></td>
                        <td style="text-align:center">
                          <!-- pake fungsi anchor -->
                          <?php
                              echo anchor(site_url('admin_gulderose/auth/edit_user/' . $user->id), '<button type="button" class="btn btn-icon btn-icon-mini btn-round btn-info"><i class="zmdi zmdi-edit"></i></button>');
                              echo ' ';
                              echo anchor(site_url('admin_gulderose/auth/delete_user/' . $user->id), '<button type="button" class="btn btn-icon btn-icon-mini btn-round btn-danger"><i class="zmdi zmdi-delete"></i></button>');
                              ?>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                <?php } ?>

              </table>
            </div>
          </div>

        </div>
      </div>

    </div>

</section>
<?php $this->load->view('back/js'); ?>
</body>

</html>