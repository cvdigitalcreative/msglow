<div class="content-wrapper">
    <div class="page-title">
      <div class="row">
          <div class="col-sm-6">
              <h4 class="mb-0">Data List Barang</h4>              
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
              <li class="breadcrumb-item"><a href="<?php echo base_url()?>Owner/Barang/pemesanan" class="default-color">Home</a></li>
              <li class="breadcrumb-item active">List Barang</li>
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
                <div class="col-md-6">
                  <a href="" data-toggle="modal" data-target="#kurir" class="btn btn-primary btn-block ripple m-t-20">
                    <i class="fa fa-plus pr-2"></i> Tambah List Barang
                  </a>
                </div>
                <div class="col-md-6">
                  <a href="<?php echo base_url()?>Owner/Pemesanan/Cetak_Invoice/<?php echo $p_id?>/<?php echo $lvl?>" target="blank" class="btn btn-primary btn-block ripple m-t-20">
                    <i class="fa fa-print pr-2"></i> Cetak Invoice
                  </a>
                </div>
              </div>
            <div class="table-responsive">
            <table id="datatable" class="table table-striped table-bordered p-0">
              <thead>
                  <tr>
                      <th width="20">No</th>
                      <th>Barang Nama</th>
                      <th>Jumlah Barang</th>
                      <th>Harga per item</th>
                      <th>Total Harga</th>
                      <th width="100"><center>Aksi</center></th>
                  </tr>
              </thead>
              <tbody>
                  <?php

                    function rupiah($angka){
                      $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
                      return $hasil_rupiah;
                    }

                    $no = 0 ;
                       $level=1;
                    foreach($listbarang->result_array() as $i) :
                      $no++;
                      $lb_id = $i['lb_id'];
                      $pemesanan_nama = $i['pemesanan_nama'];
                      $pemesanan_id = $i['pemesanan_id'];
                      $barang_id = $i['barang_id'];
                      $qty = $i['lb_qty'];
                      $barang_nama = $i['barang_nama'];
                      $br_harga = $i['br_harga'];
                      $total = $i['total'];
                      if($level == 1){
                        $q=$this->db->query("SELECT SUM(a.lb_qty * d.br_harga) AS total_keseluruhan FROM list_barang a, pemesanan b, barang c, barang_reseller d WHERE a.pemesanan_id = '$pemesanan_id' AND a.ktg_qty = d.br_kuantitas AND a.pemesanan_id = b.pemesanan_id AND a.barang_id = c.barang_id AND a.barang_id = d.barang_id");
                        $c=$q->row_array();
                        $jumlah = $c['total_keseluruhan'];
                         //diskon pemesanan
                        $z=$this->db->query("SELECT b.potongan_harga   FROM pemesanan a, diskon_all b WHERE a.pemesanan_id = '$pemesanan_id' and a.id_diskon=b.id ");
                        $c=$z->row_array();
                        $potongan_harga = $c['potongan_harga'];
                        $jumlah=$jumlah-($potongan_harga);
                      }elseif($level == 2){
                        $q=$this->db->query("SELECT SUM(a.lb_qty * d.bnr_harga) AS total_keseluruhan FROM list_barang a, pemesanan b, barang c, barang_non_reseller d WHERE a.pemesanan_id = '$pemesanan_id' AND a.pemesanan_id = b.pemesanan_id AND a.barang_id = c.barang_id AND a.barang_id = d.barang_id");
                        $c=$q->row_array();
                        $jumlah = $c['total_keseluruhan'];
                        //diskon
                        $z=$this->db->query("SELECT a.lb_qty ,a.barang_id,b.pemesanan_tanggal  FROM list_barang a, pemesanan b, barang c, barang_non_reseller d WHERE a.pemesanan_id = '$pemesanan_id' AND lb_lvl =2 AND a.pemesanan_id = b.pemesanan_id AND a.barang_id = c.barang_id AND a.barang_id = d.barang_id ORDER BY lb_id");
                        foreach ($z->result_array() as $i ) {
                                 $barang_id = $i['barang_id'];
                                 $lb_qty = $i['lb_qty'];
                                 $pemesanan_tanggal = $i['pemesanan_tanggal'];
                                  $z=$this->db->query("select potongan_harga from diskon where barang_id='$barang_id' and  tanggal_mulai <= '$pemesanan_tanggal' AND tanggal_berakhir >= '$pemesanan_tanggal'")->row_array();


                                  if($z['potongan_harga']==null){
                                    
                                  }else{
                                    $jumlah=$jumlah-($z['potongan_harga']*$lb_qty);
                                  }

                        }

                        //--------
                        //diskon pemesanan
                        $z=$this->db->query("SELECT b.potongan_harga   FROM pemesanan a, diskon_all b WHERE a.pemesanan_id = '$pemesanan_id' and a.id_diskon=b.id ");
                        $c=$z->row_array();
                        $potongan_harga = $c['potongan_harga'];
                        $jumlah=$jumlah-($potongan_harga);
                        
                      }
                  ?>
                    <tr>
                     <td><center><?php echo $no?></center></td>
                      <td><?php echo $barang_nama?></td>
                      <td><?php echo $qty?></td>
                      <td><?php echo rupiah($br_harga)?></td>
                      <td><?php echo rupiah($total)?></td>
                      <td>
                          <center><a href="#" style="margin-right: 10px" data-toggle="modal" data-target="#hapusdata"><span class="ti-trash"></span></a></center>
                      </td>
                    </tr>
                    <?php endforeach;?>
                    <tr>
                      <th colspan="4"><center>Jumlah</center></th>
                      <th><?php echo rupiah($jumlah)?></th>
                    </tr>
              </tbody>
           </table>
          </div>
          </div>
        </div>   
      </div>

       <!-- Modal Add Barang Reseller-->
        <div class="modal" tabindex="-1" role="dialog" id="kurir">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Kurir</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <form action="<?php echo base_url()?>Owner/Barang/tambahpesananR" method="post" enctype="multipart/form-data">
                    <div class="modal-body p-20">
                            <div class="row">
                                <div class="form-group col-md-12 mt-10" id="dynamic_field1">
                                        <div class="row"> 
                                          <div class="col-md-8">
                                            <input type="hidden" name="pemesanan_id" value="<?php echo $p_id?>">
                                            <label class="control-label">Barang</label>
                                            <select class="form-control" name="barang[]" required>
                                                <option selected value="">Pilih</option>
                                                <?php
                                                  foreach($reseller->result_array() as $i) :
                                                    $barang_id = $i['barang_id'];
                                                    $barang_nama = $i['barang_nama'];
                                                ?>
                                                  <option value="<?php echo $barang_id?>"><?php echo $barang_nama?></option>
                                                <?php endforeach;?> 
                                            </select>
                                          </div>
                                          <div class="col-md-2">
                                            <label class="control-label" for="harga">Jumlah</label>
                                            <input class="form-control" type="number" name="qty[]" required>
                                          </div>
                                        </div>
                                      </div>                                  
                                    <div class="col-md-12 mt-30">
                                        <input class="button" value="Add new" id="add1"/>
                                    </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger ripple" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success ripple save-category" id="simpan">Save</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

       <?php
                    $no = 0 ;
                  
                    foreach($listbarang->result_array() as $i) :
                      $no++;
                      $lb_id = $i['lb_id'];
                      $pemesanan_nama = $i['pemesanan_nama'];
                      $pemesanan_id = $i['pemesanan_id'];
                      $barang_id = $i['barang_id'];
                      $qty = $i['lb_qty'];
                      $barang_nama = $i['barang_nama'];
                      $br_harga = $i['br_harga'];
                      $total = $i['total'];
                     
                  ?>
        <div class="modal" tabindex="-1" role="dialog" id="hapusdata<?php echo $lb_id?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Hapus Barang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body p-20">
                        <form action="<?php echo base_url()?>Admin/Pemesanan/hapuspesananlb" method="post">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" name="pemesanan_id" value="<?php echo $pemesanan_id?>"/>
                                    <input type="hidden" name="lb_id" value="<?php echo $lb_id?>"/>
                                    <input type="hidden" name="qty" value="<?php echo $qty?>"/> 
                                    <input type="hidden" name="barang_id" value="<?php echo $barang_id?>"/>  
                                    <p>Apakah kamu yakin ingin menghapus data ini?</i></b></p>
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
        <?php endforeach;?>
        
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

<script type="text/javascript">
  $(document).ready(function(){
  var i=1;
  $('#add1').click(function(){
    i++;
    $('#dynamic_field1').append('<div class="row" id="roww'+i+'"><div class="col-md-8"><label class="control-label">Barang</label><select class="form-control" name="barang[]"><option selected value="">Pilih</option><?php foreach($reseller->result_array() as $i) :$barang_id = $i['barang_id']; $barang_nama = $i['barang_nama'];?><option value="<?php echo $barang_id?>"><?php echo $barang_nama?></option><?php endforeach;?> </select></div><div class="col-md-2"><label class="control-label" for="harga">Jumlah</label><input class="form-control" type="number" name="qty[]" ></div><div class="col-md-2 mt-30"><button type="button" id="'+i+'" class="btn btn-danger btn-block btn_remove1">Delete</button></div></div>');
  });
  
  $(document).on('click', '.btn_remove1', function(){
    var button_id = $(this).attr("id"); 
    $('#roww'+button_id+'').remove();
  });

  
});
</script>s

<?php if($this->session->flashdata('msg')=='update'):?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Update',
                    text: "Data berhasil Diupdate.",
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
                    text: "Data berhasil disimpan",
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
<?php elseif($this->session->flashdata('msg')=='delete'):?>
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
