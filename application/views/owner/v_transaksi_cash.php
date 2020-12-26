<div class="content-wrapper">
    <div class="page-title">
      <div class="row">
          <div class="col-sm-6">
              <h4 class="mb-0">Transaksi</h4>              
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
              <li class="breadcrumb-item"><a href="<?php echo base_url()?>Admin/Pemesanan" class="default-color">Home</a></li>
              <li class="breadcrumb-item active">Transaksi</li>
            </ol>
          </div>
        </div>
    </div>
    <!-- main body --> 
    <div class="row">   
      <div class="col-xl-12 mb-30">     
        <div class="card card-statistics h-100"> 
          <div class="card-body">
            <div class="col-xl-12 mb-10" style="display: flex">
              <div class="col-md-3">
                <a href="" data-toggle="modal" data-target="#cari" class="btn btn-primary btn-block ripple m-t-20">
                  <i class="fa fa-search pr-2"></i> Cari Transaksi
                </a>
              </div>
              <div class="col-md-3">
                <a href="" data-toggle="modal" data-target="#cetak_tanggal" target="blank" class="btn btn-success btn-block ripple m-t-20">
                  <i class="fa fa-print pr-2"></i> Cetak
                </a>
              </div>
              <div class="col-md-3">
                <p class="mt-10"><b>=> Total Omset : <?php echo rupiah($total_omset)?></b></p>
              </div>
              <div class="col-md-3">
                <p class="mt-10"><b>=> Total Untung : <?php echo rupiah($total_untung)?></b></p>
              </div>
            </div>
             
            </div>
            <div class="table-responsive">
            <table id="datatable" class="table table-striped table-bordered p-0">
              <thead>
                  <tr>
                      <th width="5">No</th>
                      <th>Nama Pemesan</th>
                      <th width="10">Tanggal Pesanan</th>
                      <th>No HP</th>
                      <th>Alamat</th>
                      <th>Kurir</th>
                      <th>Asal Transaksi</th>
                      <th>Metode Pembayaran</th>
                      <th style="width: 5%;"> Admin Input </th>
                      <th style="width: 13%;">Barang</th>
                      <th>Total Omset</th>
                      <th>Total Keuntungan</th>
                  </tr>
              </thead>
              <tbody>
                  <?php
                    function rupiah($angka){
                      $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
                      return $hasil_rupiah;
                    }

                    $no = 0 ;
                    foreach($datapesanan->result_array() as $i) :
                      $no++;
                      $pemesanan_id = $i['pemesanan_id'];
                      $pemesanan_nama = $i['pemesanan_nama'];
                      $tanggal = $i['tanggal'];
                      $hp = $i['pemesanan_hp'];
                      $alamat = $i['pemesanan_alamat'];
                      $kurir_id = $i['kurir_id'];
                      $level = $i['level'];
                      $kurir_nama = $i['kurir_nama'];
                      $at_id = $i['at_id'];
                      $mp_nama = $i['mp_nama'];
                      $at_nama = $i['at_nama'];

                      $user_nama = $i['user_nama'];
                      if($level == 1){
                        $q=$this->db->query("SELECT SUM(a.lb_qty * d.br_harga) AS total_keseluruhan, ((SUM(a.lb_qty * d.br_harga))-SUM(a.lb_qty * c.barang_harga_modal)) AS total FROM list_barang a, pemesanan b, barang c, barang_reseller d WHERE a.pemesanan_id = '$pemesanan_id' AND a.ktg_qty = d.br_kuantitas AND a.pemesanan_id = b.pemesanan_id AND a.barang_id = c.barang_id AND a.barang_id = d.barang_id"); 
                        $c=$q->row_array();
                        $omset = $c['total_keseluruhan'];
                        $untung = $c['total'];
                           //diskon pemesanan
                        $z=$this->db->query("SELECT b.potongan_harga   FROM pemesanan a, diskon_all b WHERE a.pemesanan_id = '$pemesanan_id' and a.id_diskon=b.id ");
                        $c=$z->row_array();
                        $potongan_harga = $c['potongan_harga'];
                        $omset=$omset-($potongan_harga);
                        $untung = $untung-($potongan_harga);
                      }elseif($level == 2){
                        $q=$this->db->query("SELECT SUM(a.lb_qty * d.bnr_harga) AS total_keseluruhan, (SUM(a.lb_qty * d.bnr_harga))-(SUM(a.lb_qty * c.barang_harga_modal)) AS total FROM list_barang a, pemesanan b, barang c, barang_non_reseller d WHERE a.pemesanan_id = '$pemesanan_id' AND a.pemesanan_id = b.pemesanan_id AND a.barang_id = c.barang_id AND a.barang_id = d.barang_id");
                        $c=$q->row_array();
                        $omset = $c['total_keseluruhan'];
                        $untung = $c['total'];
                        //diskon
                      $z=$this->db->query("SELECT a.lb_qty ,a.barang_id,b.pemesanan_tanggal  FROM list_barang a, pemesanan b, barang c, barang_non_reseller d WHERE a.pemesanan_id = '$pemesanan_id' AND lb_lvl =2 AND a.pemesanan_id = b.pemesanan_id AND a.barang_id = c.barang_id AND a.barang_id = d.barang_id ORDER BY lb_id");
                        foreach ($z->result_array() as $i ) {
                                 $barang_id = $i['barang_id'];
                                 $lb_qty = $i['lb_qty'];
                                 $pemesanan_tanggal = $i['pemesanan_tanggal'];
                                  $z=$this->db->query("select potongan_harga from diskon where barang_id='$barang_id' and  tanggal_mulai <= '$pemesanan_tanggal' AND tanggal_berakhir >= '$pemesanan_tanggal'")->row_array();


                                  if($z['potongan_harga']==null){
                                    
                                  }else{
                                    $untung=$untung-($z['potongan_harga']*$lb_qty);
                                    $omset=$omset-($z['potongan_harga']*$lb_qty);
                                  }

                        }
                        //--------
                           //diskon pemesanan
                        $z=$this->db->query("SELECT b.potongan_harga   FROM pemesanan a, diskon_all b WHERE a.pemesanan_id = '$pemesanan_id' and a.id_diskon=b.id ");
                        $c=$z->row_array();
                        $potongan_harga = $c['potongan_harga'];
                        $omset=$omset-($potongan_harga);
                        $untung = $untung-($potongan_harga);
                      }

                      
                  ?>
                    <tr>
                      <td><center><?php echo $no?></center></td>
                      <td><?php echo $pemesanan_nama?></td>
                      <td><?php echo $tanggal?></td>
                      <td><?php echo $hp?></td>
                      <td><?php echo $alamat?></td>
                      <td><?php echo $kurir_nama?></td>
                      <td><?php echo $at_nama?></td>
                      <td><?php echo $mp_nama?></td>
                       <td><?php echo $user_nama?></td>
                      <td style="word-break: break-all;">
                        <?php
                           if($level==1){

                               $z=$this->db->query("SELECT a.lb_id,a.pemesanan_id,a.lb_qty,a.barang_id,b.pemesanan_nama,c.barang_nama,d.br_harga, a.lb_qty * d.br_harga AS total FROM list_barang a, pemesanan b, barang c, barang_reseller d WHERE b.pemesanan_id = '$pemesanan_id' AND a.ktg_qty = d.br_kuantitas AND a.pemesanan_id = b.pemesanan_id AND a.barang_id = c.barang_id AND a.barang_id = d.barang_id");

                                foreach ($z->result_array() as $i ) {
                                  $barang_nama = $i['barang_nama'];
                                   $jumlah_barang = $i['lb_qty'];
                                   echo "- ".$barang_nama."=  ".$jumlah_barang."<br>";
                                }

                          }else  if($level==2){
                               $z=$this->db->query("SELECT a.lb_id,a.pemesanan_id,a.lb_qty,a.barang_id,b.pemesanan_nama,c.barang_nama,d.bnr_harga, a.lb_qty * d.bnr_harga AS total FROM list_barang a, pemesanan b, barang c, barang_non_reseller d WHERE a.pemesanan_id = '$pemesanan_id' AND lb_lvl =2 AND a.pemesanan_id = b.pemesanan_id AND a.barang_id = c.barang_id AND a.barang_id = d.barang_id ORDER BY lb_id");
                               
                                foreach ($z->result_array() as $i ) {

                                    $barang_nama = $i['barang_nama'];

                                     $jumlah_barang = $i['lb_qty'];
                                   echo "- ".$barang_nama."=  ".$jumlah_barang."<br>";

                                  }
                          }
                         
                          
                          
                        ?>
                      </td>
                      <td><?php echo rupiah($omset)?></td>
                      <td><?php echo rupiah($untung)?></td>
                    </tr>
                  <?php endforeach;?>
              </tbody>
           </table>
          </div>
          </div>
        </div>   
      </div>

      <!-- Modal edit Data -->
      <?php if($level1 == 0) :?>
                

               <div class="modal" tabindex="-1" role="dialog" id="cari">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Pilih Bulan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <form action="<?php echo base_url()?>Owner/Transaksi/Caritrxkategori_cash/0" method="post" enctype="multipart/form-data">
                    <div class="modal-body p-20">
                            <div class="row">
                               <div class="col-md-6">
                                      <label class="control-label">Dari Tanggal*</label>
                                      <input class="form-control form-white" type="date" name="daritgl" required/>
                                  </div>
                                  <div class="col-md-6">
                                      <label class="control-label">Ke Tanggal*</label>
                                      <input class="form-control form-white" type="date" name="ketgl" required/>
                                  </div>
                            </div>          
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger ripple" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success ripple save-category" id="simpan">Cari</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

              
              <?php elseif($level1 == 1) :?>
             
               
               <div class="modal" tabindex="-1" role="dialog" id="cari">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Pilih Bulan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <form action="<?php echo base_url()?>Owner/Transaksi/Caritrxkategori_cash/1" method="post" enctype="multipart/form-data">
                    <div class="modal-body p-20">
                            <div class="row">
                               <div class="col-md-6">
                                      <label class="control-label">Dari Tanggal*</label>
                                      <input class="form-control form-white" type="date" name="daritgl" required/>
                                  </div>
                                  <div class="col-md-6">
                                      <label class="control-label">Ke Tanggal*</label>
                                      <input class="form-control form-white" type="date" name="ketgl" required/>
                                  </div>
                            </div>          
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger ripple" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success ripple save-category" id="simpan">Cari</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

            <?php elseif($level1 == 2) :?>
             
                
               <div class="modal" tabindex="-1" role="dialog" id="cari">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Pilih Bulan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <form action="<?php echo base_url()?>Owner/Transaksi/Caritrxkategori_cash/2" method="post" enctype="multipart/form-data">
                    <div class="modal-body p-20">
                            <div class="row">
                               <div class="col-md-6">
                                      <label class="control-label">Dari Tanggal*</label>
                                      <input class="form-control form-white" type="date" name="daritgl" required/>
                                  </div>
                                  <div class="col-md-6">
                                      <label class="control-label">Ke Tanggal*</label>
                                      <input class="form-control form-white" type="date" name="ketgl" required/>
                                  </div>
                            </div>          
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger ripple" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success ripple save-category" id="simpan">Cari</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
              
            <?php endif;?>


             <!-- Modal edit Data -->
      <?php if($level1 == 0) :?>
                

               <div class="modal" tabindex="-1" role="dialog" id="cetak_tanggal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Pilih tanggal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    
                    <form action="<?= base_url()?>Owner/Transaksi/cetaktrxkategori_cash/0" method="post" enctype="multipart/form-data">
                       
                        
                           
                    <div class="modal-body p-20">
                            <div class="row">
                               <div class="col-md-6">
                                      <label class="control-label">Dari Tanggal*</label>
                                      <input class="form-control form-white" type="date" name="daritgl" required/>
                                  </div>
                                  <div class="col-md-6">
                                      <label class="control-label">Ke Tanggal*</label>
                                      <input class="form-control form-white" type="date" name="ketgl" required/>
                                  </div>
                            </div>          
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger ripple" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success ripple save-category" id="simpan">Cari</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
              
              <?php elseif($level1 == 1) :?>
             
               
              <div class="modal" tabindex="-1" role="dialog" id="cetak_tanggal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Pilih tanggal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    
                    <form action="<?= base_url()?>Owner/Transaksi/cetaktrxkategori_cash/1" method="post" enctype="multipart/form-data">
                       
                        
                           
                    <div class="modal-body p-20">
                            <div class="row">
                               <div class="col-md-6">
                                      <label class="control-label">Dari Tanggal*</label>
                                      <input class="form-control form-white" type="date" name="daritgl" required/>
                                  </div>
                                  <div class="col-md-6">
                                      <label class="control-label">Ke Tanggal*</label>
                                      <input class="form-control form-white" type="date" name="ketgl" required/>
                                  </div>
                            </div>          
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger ripple" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success ripple save-category" id="simpan">Cari</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

            <?php elseif($level1 == 2) :?>
             
                
              <div class="modal" tabindex="-1" role="dialog" id="cetak_tanggal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Pilih tanggal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    
                    <form action="<?= base_url()?>Owner/Transaksi/cetaktrxkategori_cash/2" method="post" enctype="multipart/form-data">
                       
                        
                           
                    <div class="modal-body p-20">
                            <div class="row">
                               <div class="col-md-6">
                                      <label class="control-label">Dari Tanggal*</label>
                                      <input class="form-control form-white" type="date" name="daritgl" required/>
                                  </div>
                                  <div class="col-md-6">
                                      <label class="control-label">Ke Tanggal*</label>
                                      <input class="form-control form-white" type="date" name="ketgl" required/>
                                  </div>
                            </div>          
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger ripple" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success ripple save-category" id="simpan">Cari</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
              
            <?php endif;?>
            
         
        
  </div>
  

    
<!--=================================
 footer -->
 
    <footer class="bg-white p-4">
      <div class="row">
        <div class="col-md-6">
          <div class="text-center text-md-left">
              <p class="mb-0"> &copy; Copyright <span id="copyright"> <script>document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))</script></span>. <a href="#"> Webmin </a> All Rights Reserved. </p>
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
    </div> 
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
<script src="<?php echo base_url().'assets/admin/js/jquery.toast.min.js'?>"></script>

<!-- validation -->
<script src="<?php echo base_url()?>assets/admin/js/validation.js"></script>

<!-- lobilist -->
<script src="<?php echo base_url()?>assets/admin/js/lobilist.js"></script>
 
<!-- custom -->
<script src="<?php echo base_url()?>assets/admin/js/custom.js"></script>
  
<!-- mask -->
<script src="<?php echo base_url()?>assets/admin/js/jquery.mask.min.js"></script>
 
</body>
</html> 

<script type="text/javascript">
  $(document).ready(function(){
    // Format mata uang.
    $( '.money' ).mask('000.000.000.000.000', {reverse: true});

  })
</script>



<?php if($this->session->flashdata('msg')=='update'):?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Update',
                    text: "Data Diupdate.",
                    showHideTransition: 'slide',
                    icon: 'success',
                    loader: true,        // Change it to false to disable loader
                    loaderBg: '#ffffff',
                    position: 'top-right',
                    bgColor: '#00C9E6'
                });
        </script>
<?php elseif($this->session->flashdata('msg')=='success'):?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Success',
                    text: "Berhasil tambah data",
                    showHideTransition: 'slide',
                    icon: 'info',
                    loader: true,        // Change it to false to disable loader
                    loaderBg: '#ffffff',
                    position: 'top-right',
                    bgColor: '#7EC857'
                });
        </script>
<?php elseif($this->session->flashdata('msg')=='warning'):?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Warning',
                    text: "Data gagal dimasukkan kedalam database",
                    showHideTransition: 'slide',
                    icon: 'info',
                    loader: true,        // Change it to false to disable loader
                    loaderBg: '#ffffff',
                    position: 'top-right',
                    bgColor: '#orange'
                });
        </script>
<?php elseif($this->session->flashdata('msg')=='error'):?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Error',
                    text: "Data gagal dimasukkan kedalam database",
                    showHideTransition: 'slide',
                    icon: 'error',
                    loader: true,        // Change it to false to disable loader
                    loaderBg: '#ffffff',
                    position: 'top-right',
                    bgColor: '#orange'
                });
        </script>
<?php elseif($this->session->flashdata('msg')=='success_non_reseller'):?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Success',
                    text: "Berhasil tambah data barang reseller",
                    showHideTransition: 'slide',
                    icon: 'info',
                    loader: true,        // Change it to false to disable loader
                    loaderBg: '#ffffff',
                    position: 'top-right',
                    bgColor: '#7EC857'
                });
        </script>
<?php elseif($this->session->flashdata('msg')=='hapus'):?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Delete',
                    text: "Data berhasil didelete",
                    showHideTransition: 'slide',
                    icon: 'info',
                    loader: true,        // Change it to false to disable loader
                    loaderBg: '#ffffff',
                    position: 'top-right',
                    bgColor: 'red'
                });
        </script>
<?php else:?>
<?php endif;?>
