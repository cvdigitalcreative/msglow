 <div class="content-wrapper">
      <div class="page-title">
      <div class="row">
          <div class="col-sm-6">
              <h4 class="mb-0"> User</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
              <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
              <li class="breadcrumb-item"><a href="#" class="default-color">Owner</a></li>
              <li class="breadcrumb-item active">User</li>
            </ol>
          </div>
        </div>
      </div>
      <!-- main body --> 
      <div class="row">   
        <div class="col-xl-12 mb-30">     
          <div class="card card-statistics h-100"> 
            <div class="card-body">
              <div class="col-xl-12 mb-10">
                  <a href="" data-toggle="modal" data-target="#tambah-data" class="btn btn-primary btn-block ripple m-t-20">
                      <i class="fa fa-plus pr-2"></i> Tambah Transaksi
                  </a>
            </div>
              <div class="table-responsive">
              <table id="datatable" class="table table-striped table-bordered p-0">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Nomor HP</th>
                        <th>Alamat</th>
                        <th>Level</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th style="width: 50px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                  <?php foreach($user->result_array() as $i) :
                    $id = $i['user_id'];
                    $nama = $i['user_nama'];
                    $hp = $i['user_hp'];
                    $alamat = $i['user_alamat'];
                    $foto = $i['user_foto'];
                    $level = $i['user_level'];
                    $username = $i['username'];
                    $password = $i['password'];
                  ?>
                  <tr>
                    <td style="width: 8%"><img src="<?php echo base_url()?>assets/admin/images/<?= $foto;?>"  style="width: 60px"></td>
                    <td><?= $nama?></td>
                    <td><?= $hp?></td>
                    <td><?= $alamat?></td>
                    <?php
                      if ($level ==  1)
                        echo "<td>Owner</td>";
                      else
                        echo "<td>Admin</td>";
                    ?>
                    <td><?= $username?></td>
                    <td><?= $password?></td>
                    <td style="text-align:left;">
                      <a href="#" data-toggle="modal" data-target="#EditData<?= $id?>"><span class="ti-pencil"></span></a>
                      <a href="#" style="margin-left: 10px" data-toggle="modal" data-target="#HapusData<?= $id?>"><span class="ti-trash"></span></a>
                    </td>
                  </tr>
                  <?php endforeach;?>            
                </tbody>  
            </table>
            </div>
            </div>
          </div>   
        </div>
        
        <div class="modal" tabindex="-1" role="dialog" id="tambah-data">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body p-20">
                        <form action="<?php echo base_url().'Owner/User/save_user'?>" method="post" enctype="multipart/form-data">
                            <div class="row">
                                  <div class="col-md-12">
                                      <label class="control-label">Nama User*</label>
                                      <input class="form-control form-white" placeholder="Nama Pegawai" type="text" name="nama_pegawai" required/>
                                  </div>
                                  <div class="col-md-12">
                                      <label class="control-label">Level User</label>
                                      <select class="form-control" name="level">
                                          <option selected value="">Pilih</option>
                                          <option value="1">Owner</option>
                                          <option value="2">Admin</option>
                                      </select>
                                  </div>
                                  <div class="col-md-12">
                                      <label class="control-label">Nomor HP*</label>
                                      <input class="form-control form-white" placeholder="Nomor HP" type="number" name="nohp" required/>
                                  </div>
                                  <div class="col-md-12">
                                      <label class="control-label">Alamat</label>
                                      <input class="form-control form-white" placeholder="Alamat Pegawai" type="text" name="alamat" required/>
                                  </div>
                                  <div class="col-md-12">
                                      <label class="control-label">Username</label>
                                      <input class="form-control form-white" placeholder="Username Pegawai" type="text" name="username" required/>
                                  </div>
                                  <div class="col-md-12">
                                      <label class="control-label">Password</label>
                                      <input class="form-control form-white" placeholder="Password Pegawai" type="text" name="password" required/>
                                  </div>
                                  <div class="col-md-12">
                                    <label for="exampleFormControlFile1">Upload Gambar</label>
                                    <input type="file" class="form-control-file" name="filefoto" required>
                                  </div>
                              </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger ripple" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success ripple save-category">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <?php foreach($user->result_array() as $i) :
                    $id = $i['user_id'];
                    $nama = $i['user_nama'];
                    $hp = $i['user_hp'];
                    $alamat = $i['user_alamat'];
                    $foto = $i['user_foto'];
                    $level = $i['user_level'];
                    $username = $i['username'];
                    $password = $i['password'];
                  ?>
        <div class="modal" tabindex="-1" role="dialog" id="EditData<?= $id?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                   <div class="modal-body p-20">
                        <form action="<?php echo base_url().'Owner/User/update_user'?>" method="post" enctype="multipart/form-data">
                            <div class="row">
                                  <div class="col-md-12">
                                      <label class="control-label">Nama User*</label>
                                      <input type="hidden" name="id" value="<?= $id?>">
                                      <input type="hidden" name="gambar" value="<?= $foto?>">
                                      <input class="form-control form-white" placeholder="Nama Pegawai" type="text" name="nama_pegawai" value="<?=  $nama?>" />
                                  </div>
                                  <div class="col-md-12">
                                      <label class="control-label">Level User</label>
                                      <select class="form-control" name="level">
                                        <?php 
                                          if ($level == 1) {
                                            echo "<option value=''>Pilih</option>";
                                            echo "<option selected value='1'>Owner</option>";
                                            echo "<option value='2'>Admin</option>";
                                          }elseif ($level == 2) {
                                            echo "<option value=''>Pilih</option>";
                                            echo "<option value='1'>Owner</option>";
                                            echo "<option selected value='2'>Admin</option>";
                                          }else{
                                            echo "<option selected value=''>Pilih</option>";
                                            echo "<option value='1'>Owner</option>";
                                            echo "<option value='2'>Admin</option>";
                                          }
                                        ?>
                                      </select>
                                  </div>
                                  <div class="col-md-12">
                                      <label class="control-label">Nomor HP*</label>
                                      <input class="form-control form-white" placeholder="Nomor HP" type="number" name="nohp" value="<?=  $hp?>"/>
                                  </div>
                                  <div class="col-md-12">
                                      <label class="control-label">Alamat</label>
                                      <input class="form-control form-white" placeholder="Alamat Pegawai" type="text" name="alamat" value="<?=  $alamat?>"/>
                                  </div>
                                  <div class="col-md-12">
                                      <label class="control-label">Username</label>
                                      <input class="form-control form-white" placeholder="Username Pegawai" type="text" name="username" value="<?=  $username?>"/>
                                  </div>
                                  <div class="col-md-12">
                                      <label class="control-label">Password</label>
                                      <input class="form-control form-white" placeholder="Password Pegawai" type="text" name="password" value="<?=  $password?>"/>
                                  </div>
                                  <div class="col-md-12">
                                    <label for="exampleFormControlFile1">Upload Gambar</label>
                                    <input type="file" class="form-control-file" name="filefoto">
                                  </div>
                              </div> 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger ripple" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success ripple save-category">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
      <?php endforeach; ?>
        
        <?php foreach($user->result_array() as $i) :
                    $id = $i['user_id'];
                    $nama = $i['user_nama'];
                    $hp = $i['user_hp'];
                    $alamat = $i['user_alamat'];
                    $foto = $i['user_foto'];
                    $level = $i['user_level'];
                    $username = $i['username'];
                    $password = $i['password'];
                  ?>
        <div class="modal" tabindex="-1" role="dialog" id="HapusData<?= $id?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body p-20">
                        <form action="<?php echo base_url().'Owner/User/hapus_user'?>" method="post">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" name="id" value="<?= $id?>">
                                    <input type="hidden" name="gambar" value="<?= $foto?>">
                                    <p>Apakah kamu yakin ingin menghapus data User <b><i><?= $nama?></i></b>?</p>
                                </div>
                            </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger ripple" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-success ripple save-category">Ya</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        
    </div> 
<!--=================================
 wrapper -->
      
<!--=================================
 footer -->

    <footer class="bg-white p-4">
      <div class="row">
        <div class="col-md-6">
          <div class="text-center text-md-left">
              <p class="mb-0"> &copy; Copyright <span id="copyright"> <script>document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))</script></span>. <a href="https://www.digitalcreative.web.id" target="blank"> Digital Creative </a> All Rights Reserved. </p>
          </div>
        </div>
        <div class="col-md-6">
          <ul class="text-center text-md-right">
            <li class="list-inline-item"><a href="#">Terms & Conditions </a> </li>
            <li class="list-inline-item"><a href="#">API Use Policy </a> </li>
            <li class="list-inline-item"><a href="#">Privacy Policy </a> </li>
          </ul>
        </div>
      </div>
    </footer>
    </div><!-- main content wrapper end-->
  </div>
</div>
</div>

<!--=================================
 footer -->


 
<!--=================================
 jquery -->

<!-- jquery -->
<script src="<?php echo base_url()?>assets/admin/js/jquery-3.3.1.min.js"></script>

<!-- plugins-jquery -->
<script src="<?php echo base_url()?>assets/admin/js/plugins-jquery.js"></script>

<!-- plugin_path -->
<script>var plugin_path = '<?php echo base_url()?>assets/admin/js/';</script>

<!-- chart -->
<script src="<?php echo base_url()?>assets/admin/js/chart-init.js"></script>

<!-- calendar -->
<script src="<?php echo base_url()?>assets/admin/js/calendar.init.js"></script>

<!-- charts sparkline -->
<script src="<?php echo base_url()?>assets/admin/js/sparkline.init.js"></script>

<!-- charts morris -->
<script src="<?php echo base_url()?>assets/admin/js/morris.init.js"></script>

<!-- datepicker -->
<script src="<?php echo base_url()?>assets/admin/js/datepicker.js"></script>

<!-- sweetalert2 -->
<script src="<?php echo base_url()?>assets/admin/js/sweetalert2.js"></script>

<!-- toastr -->
<!-- <script src="<?php echo base_url()?>assets/admin/js/toastr.js"></script> -->

<!-- validation -->
<script src="<?php echo base_url()?>assets/admin/js/validation.js"></script>

<!-- lobilist -->
<script src="<?php echo base_url()?>assets/admin/js/lobilist.js"></script>
 
<!-- custom -->
<script src="<?php echo base_url()?>assets/admin/js/custom.js"></script>
<script src="<?php echo base_url().'assets/admin/js/jquery.toast.min.js'?>"></script>
 
</body>
</html>
<?php if($this->session->flashdata('msg')=='error'):?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Error',
                    text: "Password dan Ulangi Password yang Anda masukan tidak sama.",
                    showHideTransition: 'slide',
                    icon: 'error',
                    hideAfter: false,
                    position: 'bottom-right',
                    bgColor: '#FF4859'
                });
        </script>

    <?php elseif($this->session->flashdata('msg')=='success'):?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Sukses',
                    text: "Data Berhasil disimpan ke database.",
                    showHideTransition: 'slide',
                    icon: 'success',
                    loader: true,        // Change it to false to disable loader
                    loaderBg: '#ffffff',
                    position: 'top-right',
                    bgColor: '#7EC857'
                });
        </script>

      <?php elseif($this->session->flashdata('msg')=='hapus'):?>
          <script type="text/javascript">
                  $.toast({
                      heading: 'Sukses',
                      text: "Hapus data berhasil",
                      showHideTransition: 'slide',
                      icon: 'warning',
                      loader: true,        // Change it to false to disable loader
                      loaderBg: '#ffffff',
                      position: 'top-right',
                      bgColor: 'red'
                  });
          </script>
      <?php elseif($this->session->flashdata('msg')=='warning'):?>
          <script type="text/javascript">
                  $.toast({
                      heading: 'Error',
                      text: "Data tidak berhasil disimpan data berhasil",
                      showHideTransition: 'slide',
                      icon: 'warning',
                      loader: true,        // Change it to false to disable loader
                      loaderBg: '#ffffff',
                      position: 'top-right',
                      bgColor: 'orange'
                  });
          </script>
    <?php else:?>

    <?php endif;?>


