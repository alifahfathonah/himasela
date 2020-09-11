<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Donasi User
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('Welcome'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo site_url('C_DOnasi'); ?>">Data Donasi User</a></li>
        <li class="active">Data Donasi User</li>
      </ol>
    </section>
    <div class="box-body">
    <?php if ($this->session->flashdata('Sukses')) { ?>
        <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h5><i class="icon fa fa-check"></i> Sukses!</h5>
          <?=$this->session->flashdata('Sukses')?>.
        </div>                 
      <?php } ?>
    </div>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Donasi User</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                  <th>No</th>
                  <th>NIK</th>
                  <th>Nama</th>
                  <th>Upline</th>
                  <th>Level</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                  $no=1;
                  foreach ($upline as $upline) { 
                    $nourut = $upline->nourut;
                    $cekjumlah = $this->db->query("select * from tb_anggota where nourut Like '$nourut%' "); 
                    $query = $cekjumlah->result();
                    if(count($query)>5){
                      ?>  <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $upline->nik; ?></td>
                            <td><?php echo $upline->nama; ?></td>
                            <td><?php echo $upline->namaupline; ?></td>
                            <td><?php echo $upline->level; ?></td>
                            <td><?php 
                              $levelup = $upline->level+1;
                              $cekdonasi = $this->db->query("select * from tb_donasi where id_anggota = '$upline->id_anggota' and levelupgrade = '$levelup'");
                              $querydonasi = $cekdonasi->result();
                              if(count($querydonasi) != NULL){
                                foreach ($querydonasi as $key) {
                                  echo $key->status."<td><button type='button' disabled class='btn btn-info'><i class='fa fa-fw fa-dollar'></i></button></td>";
                                }
                              } else { echo "Upgrade Level"; ?></td>
                            <td> 

                                <a href="<?php echo site_url('C_Donasi/bayar/'.$upline->id_anggota.'/'.$levelup); ?>"><button type="button" class="btn btn-info"><i class="fa fa-fw fa-dollar"></i></button></a>
                               <!--  <a 
                                    href="javascript:;"
                                    data-id="<?php echo $upline->id_anggota ?>"
                                    data-level="<?php echo $levelup ?>"
                                    data-toggle="modal" data-target="#edit-data"> -->
                                    <!-- <button  data-idgotaaa="<?php echo $upline->id_anggota ?>"
                                    data-level="<?php echo $levelup ?>"
                                    data-toggle="modal" data-target="#edit-data" class="btn btn-info" value="<?php echo $levelup.'/'.$upline->id_anggota; ?>"><i class="fa fa-fw fa-dollar"></i></button> -->
                                <!-- </a> -->
                            
                            </td>
                          <?php } ?>
                          </tr>
                        <?php 
                      } 
                    } ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

 <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="edit-data" class="modal fade">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                 <h4 class="modal-title">Bukti Transfer</h4>
             </div>
            <?php echo form_open("C_Donasi/upgrade", array('enctype'=>'multipart/form-data', 'class'=>'form-horizontal') ); ?>
              <div class="modal-body">
                      <div class="modal-body">
                        <input type="file" id="imagebt" class="demoInputBox" name="imagebt" required onchange="ValidateSize(this)">
                           
                           <input type="text" id="idgota" name="idgota">
                              <input type="text" class="form-control" id="level" name="level" placeholder="Tuliskan Nama">
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button class="btn btn-info" type="submit"> Simpan&nbsp;</button>
                      <button type="button" class="btn btn-warning" data-dismiss="modal"> Batal</button>
                  </div>
           <?php echo form_close();?>
             </div>
         </div>
     </div>
 </div>
<!-- 
<div class="modal fade" id="modaluploadbuktitransfer">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Bukti Transfer</h4>
      </div>
      <div class="modal-body">
        <input type="file" id="imagebt" class="demoInputBox" name="imagebt" required onchange="ValidateSize(this)">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btnsimpantfupgrade" >Save changes</button>
      </div>
    </div>
  </div>
</div> -->