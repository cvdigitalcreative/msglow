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
            <div class="table-responsive">
            <table id="datatable" class="table table-striped table-bordered p-0">
              <thead>
                  <tr>
                      <th width="10">No</th>
                      <th>Nama Pemesan</th>
                      <th>Nama Barang</th>
                      <th><center>Stock Berkurang</center></th>
                      <th><center>Tanggal</center></th>
                  </tr>
              </thead>
              <tbody>
                  <?php 
                  $no = 0;
                  foreach($stock->result_array() as $i) :
                    $no++;
                    $barang_id = $i['barang_id'];
                    $barang_nama = $i['barang_nama'];
                    $stock_berkurang = $i['stock_berkurang'];
                    $tanggal = $i['tanggal'];
                    $nama_pemesan = $i['pemesanan_nama'];
                  ?>
                  <tr>
                      <td><center><?php echo $no?></center></td>
                      <td><?php echo $nama_pemesan?></td>
                      <td><?php echo $barang_nama?></td>
                      <td><center><?php echo $stock_berkurang?></center></td>
                      <td><center><?php echo $tanggal?></center></td>
                    </tr>
                    <?php endforeach;?>
              </tbody>
           </table>
          </div>
          </div>
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
