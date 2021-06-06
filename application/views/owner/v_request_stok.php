<div class="content-wrapper">
    <div class="page-title">
      <div class="row">
          <div class="col-sm-6">
              <h4 class="mb-0">Data Stock Barang</h4>              
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
              <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
              <li class="breadcrumb-item active">Daftar Barang</li>
            </ol>
          </div>
        </div>
    </div>
    <!-- main body --> 
   
    <div class="row"> 
      <div class="col-xl-12 mb-10" style="display: flex">
              
             
                <a href="" data-toggle="modal" data-target="#stock" class="btn btn-primary btn-block ripple m-t-20">
                  <i class="fa fa-plus pr-2"></i> Tambah Stock Barang
                </a>
              
        
            
            </div>

      <div class="col-xl-12 mb-30">     
        <div class="card card-statistics h-100"> 
          <div class="card-body">
             
      <div class="col-xl-12 mb-30">     
        <div class="card card-statistics h-100"> 
          <div class="card-body">
            <div class="table-responsive">
              
            <table id="datatable" class="table table-striped table-bordered p-0">
              <thead>
                  <tr>
                      <th width="10">No</th>
                      <th>Nama Barang</th>
                      <th><center>Nama Toko Dari</center></th>
                      <th><center>Nama Toko Ke</center></th>
                      <th><center>Tanggal Request</center></th>
                      <th><center>Nama Admin</center></th>
                      <th><center>Jumlah</center></th>
                      <th><center>Aksi</center></th>
                  </tr>
              </thead>
              <tbody>
                  <?php 
                  $no = 0;
                  foreach($stock->result_array() as $i) :
                    $no++;
                    $id_request = $i['id_request'];
                    $nama_barang = $i['nama_barang'];
                    $id_toko_dari = $i['id_toko_dari'];
                    $nama_toko_dari = $i['nama_toko_dari'];
                    $id_toko_ke = $i['id_toko_ke'];
                    $nama_toko_ke = $i['nama_toko_ke'];
                    $tanggal_request = $i['tanggal_request'];
                    $id_admin = $i['id_admin'];
                    $user_nama = $i['user_nama'];
                    $jumlah = $i['jumlah'];
                   
                  ?>
                  <tr>
                      <td><center><?php echo $no?></center></td>
                      <td><?php echo $nama_barang?></td>
                      <td><center><?php echo $nama_toko_dari?></center></td>
                      <td><center><?php echo $nama_toko_ke?></center></td>
                      <td><center><?php echo $tanggal_request?></center></td>
                      <td><center><?php echo $user_nama?></center></td>
                      <td><center><?php echo $jumlah?></center></td>
                      <td><form action="<?php echo base_url()?>Owner/Request_stock/acc_request_stock" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id_request" value="<?php echo $id_request?>">
                         <input type="hidden" name="barang" value="<?php echo $nama_barang?>">
                          <input type="hidden" name="qty" value="<?php echo $jumlah?>">
                           <input type="hidden" name="dari_toko" value="<?php echo $id_toko_dari?>">
                            <input type="hidden" name="ke_toko" value="<?php echo $id_toko_ke?>">
                         <div class="modal-footer">
                       
                            <button type="submit" class="btn btn-success ripple save-category" id="acc">ACC</button>
                          </div>
                      </form></td>
                    </tr>
                    <?php endforeach;?>
              </tbody>
           </table>
          </div>
          </div>
        </div>   
      </div>
  </div>
  <div class="modal" tabindex="-1" role="dialog" id="stock">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Stock Barang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <form action="<?php echo base_url()?>Owner/Request_stock/tambah_request_stock" method="post" enctype="multipart/form-data">
                    <div class="modal-body p-20">
                                 <div class="form-group col-md-12 mt-10" id="dynamic_field">
                                        <div class="row"> 
                                          <div class="col-md-8">
                                            <label class="control-label">Barang</label>
                                            <select class="form-control" name="barang" required>
                                                <option selected value="">Pilih</option>
                                                <?php
                                                  foreach($nonreseller->result_array() as $i) :
                                                    $barang_id = $i['barang_id'];
                                                    $barang_nama = $i['barang_nama'];
                                                ?>
                                                  <option value="<?php echo $barang_nama?>"><?php echo $barang_nama?></option>
                                                <?php endforeach;?> 
                                            </select>
                                          </div>

                                          <div class="col-md-2">
                                            <label class="control-label" for="harga">Jumlah</label>
                                            <input class="form-control" type="number" name="qty" required>
                                          </div>

                                          
                                      </div> 


                               
                    </div>
                    
                        <div class="col-md-12">
                                  <label class="control-label">Dari Gudang</label>
                                  <select class="form-control" name="dari_toko" required>
                                  
                                    <?php
                                      foreach($toko->result_array() as $i) :
                                        $mp_id = $i['id_toko'];
                                        $mp_nama = $i['nama'];
                                        
                                    ?>
                                  <option value="<?php echo $mp_id?>"><?php echo $mp_nama?></option>
                                     <?php endforeach;?>
                                  </select>
                                </div>  
                                <div class="col-md-12">
                                  <label class="control-label">Ke Gudang</label>
                                  <select class="form-control" name="ke_toko" required>
                                  
                                    <?php
                                      foreach($toko->result_array() as $i) :
                                        $mp_id = $i['id_toko'];
                                        $mp_nama = $i['nama'];
                                        
                                    ?>
                                  <option value="<?php echo $mp_id?>"><?php echo $mp_nama?></option>
                                     <?php endforeach;?>
                                  </select>
                                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger ripple" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success ripple save-category" id="simpan">Save</button>
                    </div>
                    </form>
                </div>
            </div>
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
