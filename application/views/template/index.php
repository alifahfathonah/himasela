

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
    <?php if($this->session->userdata('statusanggota') != 'administrator') { ?>
    <div class="alert alert-danger left-icon-alert" role="alert">

          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
     <?php

       $idlevel = $this->db->query("SELECT MAX(id_level) as id_level from tb_level");
        $lev = $idlevel->result();
        foreach ($lev as $lev) {  $levelmax = $lev->id_level; } 
        $id = $this->session->userdata('id_user');
        $a = $this->db->query("select * from tb_anggota where id_anggota = '$id'"); 
          $b = $a->result();
          foreach ($b as $level) { 
            if ($level->level < $levelmax ){ 
              $upline = $this->db->query("select * from tb_anggota where id_anggota = '$level->id_upline'"); 
              $uplinev = $upline->result();
              foreach ($uplinev as $uplinev) { 
                $up = $level->level+1;
                $donasi = $this->db->query("select * from tb_level where id_level = '$up'"); 
                $donasiv = $donasi->result();
                foreach ($donasiv as $donasiv) { ?>
                  <h2 style="text-align: center"><strong></strong> Silahkan upgrade ke Level <?php echo $level->level+1 ?> dan Donasi ke upline <?php echo $uplinev->nama; ?> sebesar <?php echo 'Rp. '.number_format($donasiv->nominal); ?> No Rek. <?php echo $uplinev->norek.' Bank '.$uplinev->bank.' No HP '.$uplinev->tlp.'</h2>';
                }
              }
            } 
          }
         ?>
    </div>
  <?php } ?>
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $anggota; ?></h3>

              <p>Jumlah Anggota</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">Info Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $konfirmupline; ?><sup style="font-size: 20px"></sup></h3>

              <p>Menunggu Konfirmasi Upline</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">Info Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
            <h3><?php echo $konfirmadmin; ?><sup style="font-size: 20px"></sup></h3>

              <p>Menunggu Konfirmasi Admin</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">Info Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
            <h3><?php echo $sdhbayar; ?><sup style="font-size: 20px"></sup></h3>

              <p>Jumlah Sudah Bayar</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">Info Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Berita Terbaru</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                
              <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                  <th>No</th>
                  <th>User</th>
                  <th>Tanggal Upload</th>
                  <th>Judul Berita</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                  $no=1;
                  foreach ($berita as $berita) {  ?>  
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $berita->nama; ?></td>
                      <td><?php echo $berita->tglupdate; ?></td>
                      <td><?php echo $berita->judul; ?></td>
                      <td><a href="<?php echo site_url('berita-view/'.$berita->id_berita); ?>"><button type="button" class="btn btn-success"><i class="fa fa-fw fa-search"></i></button></a>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <!-- /.box-footer -->
          </div>
        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
 