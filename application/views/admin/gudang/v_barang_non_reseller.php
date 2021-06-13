<div class="content-wrapper">
    <div class="page-title">
      <div class="row">
          <div class="col-sm-6">
              <h4 class="mb-0">Data Daftar Barang</h4>              
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
              <li class="breadcrumb-item"><a href="<?php echo base_url()?>" class="default-color">Home</a></li>
              <li class="breadcrumb-item active">Daftar Barang</li>
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
               
              
              
             
            </div>
             <div class="col-xl-12 mb-10" style="display: flex">
              <form action="<?php echo base_url()?>admin_gudang/Admin_gudang_pusat/barang_filter"  method="post" enctype="multipart/form-data">
                 <div class="modal-body p-20">
                            <div class="row">

                              
                                

                                <div class="col-md-12">
                                  <label class="control-label">Toko</label>
                                  <select class="form-control" name="toko" required>
                                  <option value="0">Seluruh Gudang</option>
                                    <?php
                                      foreach($toko->result_array() as $i) :
                                        $mp_id = $i['id_toko'];
                                        $mp_nama = $i['nama'];
                                        
                                    ?>
                                  <option value="<?php echo $mp_id?>"><?php echo $mp_nama?></option>
                                     <?php endforeach;?>
                                  </select>
                                </div>

                               

                            </div> 
                            <div class="modal-footer">
                                 <button type="submit" class="btn btn-success ripple save-category" name="action" value="filter">Filter</button>
                                <button type="submit" class="btn btn-update ripple save-category" name="action" value="cetak">Cetak</button>
                            </div> 
                    </div>
              </form>
            </div>
            <div class="table-responsive">
            <table id="datatable" class="table table-striped table-bordered p-0">
              <thead>
                  <tr>
                      <th width="10">No</th>
                      <th>Foto Barang</th>
                      <th>Nama Barang</th>
                      <th>Stock Awal</th>
                      <th>Stock Akhir</th>
                      <th>Harga Jual</th>
                      <th>Total Omsel</th>
                      <th>Kategori </th>
                      <th>Tanggal Input</th>
                      <th>Toko</th>
                  </tr>
              </thead>
              <tbody>
                  <?php 
                  $no = 0;

                  function rupiah($angka){
                    $hasil_rupiah = number_format($angka,0,',','.');
                    return $hasil_rupiah;
                  }

                  foreach($nonreseller->result_array() as $i) :
                    $no++;
                    $gambar = $i['barang_foto'];
                    $barang_id = $i['barang_id'];
                    $barang_nama = $i['barang_nama'];
                    $barang_stock_awal = $i['barang_stock_awal'];
                    $barang_stock_akhir = $i['barang_stock_akhir'];
                    $barang_harga_modal = $i['barang_harga_modal'];
                    $barang_level = $i['barang_level'];
                    $tanggal = $i['tanggal'];
                    $bnr_id = $i['bnr_id'];
                    $harga_normal = $i['bnr_harga'];
                    $nama_kategori = $i['nama_kategori'];
                    $id_kategori = $i['id_kategori'];
                    $nama_toko = $i['nama_toko'];
                     $id_toko = $i['id_toko'];
                  ?>
                  <tr>
                      <td><center><?php echo $no?></center></td>
                      <td style="width: 8%"><img src="<?php echo base_url()?>assets/image_barang/<?php echo $gambar;?>"  style="width: 100px"></td>
                      <td><?php echo $barang_nama?></td>
                      <td><?php echo $barang_stock_awal?></td>
                      <td><?php echo $barang_stock_akhir?></td>
                      <td><?php echo rupiah($harga_normal)?></td>
                      <td><?php echo rupiah($harga_normal * $barang_stock_akhir)?></td>
                      <td><?php echo $nama_kategori ?></td>
                      <td><?php echo $tanggal?></td>
                      <td><?php echo $nama_toko?></td>
                      
                    </tr>
                    <?php endforeach;?>
              </tbody>
           </table>
          </div>
          </div>
        </div>   
      </div>

        <!-- Modal Add Barang Non Reseller-->
        
  
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
  $('#add').click(function(){
    i++;
    $('#dynamic_field').append('<div class="row" id="row'+i+'"><div class="col-md-2"><label class="control-label" for="harga">Min.qty</label><input class="form-control" type="number" name="minqty[]" ></div><div class="col-md-2"><label class="control-label" for="harga">Max.qty</label><input class="form-control" type="number" name="maxqty[]"></div><div class="col-md-5"><label class="control-label" for="harga">Harga</label><input class="form-control money" type="text" name="harga[]"></div><div class="col-md-2 mt-30"><button type="button" id="'+i+'" class="btn btn-danger btn-block btn_remove">Delete</button></div></div>');
  });
  
  $(document).on('click', '.btn_remove', function(){
    var button_id = $(this).attr("id"); 
    $('#row'+button_id+'').remove();
  });
  
  $('#submit').click(function(){    
    $.ajax({
      url:"<?php echo base_url()?>Owner/Barang",
      method:"POST",
      data:$('#add_name').serialize(),
      success:function(data)
      {
        $('#add_name')[0].reset();
      }
    });
  });
  
});
</script>

<?php if($this->session->flashdata('msg')=='update'):?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Update',
                    text: "Data Harian berhasil Diupdate.",
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
                    text: "Berhasil tambah data barang reseller",
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
                    text: "Barang berhasil didelete",
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
