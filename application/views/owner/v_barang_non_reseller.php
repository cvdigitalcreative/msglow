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
               <div class="col-md-3">
               <a href="" data-toggle="modal" data-target="#tambah-barang-non-reseller" class="btn btn-primary btn-block ripple m-t-20">
                <i class="fa fa-plus pr-2"></i> Tambah Barang Customer
               </a>
              </div>
              <div class="col-md-3">
                <p class="mt-10"><b>=> Total Omset : <?php echo rupiah($total_omset)?></b></p>
              </div>
              <div class="col-md-3">
                <p class="mt-10"><b>=> Total Untung : <?php echo rupiah($total_untung)?></b></p>
              </div>
             
            </div>
             <div class="col-xl-12 mb-10" style="display: flex">
              <form action="<?php echo base_url()?>Owner/Barang/barang_filter"  method="post" enctype="multipart/form-data">
                 <div class="modal-body p-20">
                            <div class="row">

                              
                                

                                <div class="col-md-12">
                                  <label class="control-label">Toko</label>
                                  <select class="form-control" name="toko" required>
                                  <option value="0">Tidak Dipilih</option>
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
                      <th>Harga Modal</th>
                      <th>Total Modal</th>
                      <th>Harga Customer</th>
                      <th>Kategori </th>
                      <th>Total Omset</th>
                      <th>Tanggal Input</th>
                      <th>Toko</th>
                      <th width="100"><center>Aksi</center></th>
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
                      <td><?php echo rupiah($barang_harga_modal)?></td>
                      <td><?php echo rupiah($barang_harga_modal * $barang_stock_akhir)?></td>
                      <td><?php echo rupiah($harga_normal)?></td>
                      <td><?php echo $nama_kategori ?></td>
                      <td><?php echo rupiah($harga_normal * $barang_stock_akhir)?></td>

                      <td><?php echo $tanggal?></td>
                      <td><?php echo $nama_toko?></td>
                      <td>
                          <a href="#" style="margin-right: 10px; margin-left: 20px;" data-toggle="modal" data-target="#editdata<?php echo $barang_id?>"><span class="ti-pencil"></span></a>
                           <a href="#" style="margin-right: 10px; margin-left: 20px;" data-toggle="modal" data-target="#pindahstock<?php echo $barang_id?>"><span class="ti-files"></span></a>
                          <a href="#" style="margin-right: 10px" data-toggle="modal" data-target="#hapusdata<?php echo $barang_id?>"><span class="ti-trash"></span></a>
                          <a href="<?php echo base_url()?>Owner/Barang/History/<?php echo $barang_id?>" data-toggle="tooltip" data-placement="top" title="Lihat History Stock Keluar"><span class="ti-eye"></span></a>
                           <a href="<?php echo base_url()?>Owner/Barang/History_stock_masuk/<?php echo $barang_id?>" data-toggle="tooltip" data-pladcement="top" title="Lihat History Stock Masuk"><span class="ti-eye"></span></a>
                      </td>
                    </tr>

                     <div class="modal" tabindex="-1" role="dialog" id="pindahstock<?php echo $barang_id?>">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title">Pindah Barang</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                                <form action="<?php echo base_url()?>Owner/Barang/pindahstock" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="barang_id" value="<?php echo $barang_id?>"/> 
                                    <input type="hidden" name="nama_barang" value="<?php echo $barang_nama?>"/>
                                   
                                <div class="modal-body p-20">
                                        <div class="row">
                                            
                                            <div class="col-md-12">
                                                <label class="control-label">Jumlah yang diinginkan</label>
                                                <input class="form-control form-white" type="number" name="stock" placeholder="masukkan jumlah stock yang ingin dipindahkan" />
                                            </div>
                                           
                                            <div class="col-md-12">
                                              <label class="control-label">Pilih Gudang Tujuan</label>
                                              <select class="form-control" name="toko" required>
                                                 <option value="">Pilih salah satu</option>
                                                <?php
                                                  foreach($toko->result_array() as $i) :
                                                    $id_toko = $i['id_toko'];
                                                    $nama = $i['nama'];

                                                ?>
                                                <option value="<?php echo $id_toko?>"><?php echo $nama?></option>
                                                <?php endforeach;?>
                                              </select>
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

                    <div class="modal" tabindex="-1" role="dialog" id="hapusdata<?php echo $barang_id?>">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Hapus Barang</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                                <div class="modal-body p-20">
                                    <form action="<?php echo base_url()?>Owner/Barang/hapus_non_reseller" method="post">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="hidden" name="barang_id" value="<?php echo $barang_id?>"/> 
                                                <input type="hidden" name="barang_foto" value="<?php echo $gambar?>"/>
                                                <input type="hidden" name="bnr_id" value="bnr_id">
                                                <p>Apakah kamu yakin ingin menghapus data ini?</i></b></p>
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
                    </div>

                    <div class="modal" tabindex="-1" role="dialog" id="editdata<?php echo $barang_id?>">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Barang</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                                <form action="<?php echo base_url()?>Owner/Barang/edit_non_reseller" method="post" enctype="multipart/form-data">
                                <div class="modal-body p-20">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="control-label">Nama Barang</label>
                                                <input type="hidden" name="barang_id" value="<?php echo $barang_id?>">
                                                <input type="hidden" name="barang_foto" value="<?php echo $gambar?>">
                                                <input type="hidden" name="bnr_id" value="<?php echo $bnr_id?>">
                                                <input class="form-control form-white" type="text" name="nama_barang" value="<?php echo $barang_nama?>" required/>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="control-label">Stock Awal : <?= $barang_stock_awal?> | Stock Akhir : <?= $barang_stock_akhir?></label>
                                                <input class="form-control form-white" type="number" name="stock" value="0" placeholder="masukkan jumlah stock yang ingin ditambah" />
                                            </div>
                                           
                                            <div class="col-md-12">
                                                <label class="control-label">Harga Modal</label>
                                                <input class="form-control form-white money"  type="text" name="harga_modal" value="<?php echo $barang_harga_modal?>" required/>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="control-label">Harga Normal</label>
                                                <input class="form-control form-white money"  type="text" name="harga_normal" value="<?php echo $harga_normal?>" required/>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="control-label">Foto Barang</label>
                                                <input class="form-control form-white" type="file" name="filefoto" />
                                            </div>
                                            <div class="col-md-12">
                                              <label class="control-label">Kategori Barang</label>
                                              <select class="form-control" name="kategori" required>
                                                 <option value="<?php echo $id_kategori?>"><?php echo $nama_kategori?></option>
                                                <?php
                                                  foreach($kategori->result_array() as $i) :
                                                    $barang_id = $i['id_kategori'];
                                                    $barang_nama = $i['nama_kategori'];

                                                ?>
                                                <option value="<?php echo $barang_id?>"><?php echo $barang_nama?></option>
                                                <?php endforeach;?>
                                              </select>
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



                    

                    <?php endforeach;?>
              </tbody>
           </table>
          </div>
          </div>
        </div>   
      </div>

        <!-- Modal Add Barang Non Reseller-->
        <div class="modal" tabindex="-1" role="dialog" id="tambah-barang-non-reseller">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Barang Customer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <form action="<?php echo base_url()?>Owner/Barang/s_barang_non_reseller" method="post" enctype="multipart/form-data">
                    <div class="modal-body p-20">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="control-label">Nama Barang</label>
                                    <input class="form-control form-white" type="text" name="nama_barang"  required="" />
                                </div>
                                <div class="col-md-12">
                                    <label class="control-label">Stock Awal</label>
                                    <input class="form-control form-white" type="number" name="stock_awal" required="" />
                                </div>
                                <div class="col-md-12">
                                    <label class="control-label">Stock Akhir</label>
                                    <input class="form-control form-white"  type="number" name="stock_akhir" required="" />
                                </div>
                                <div class="col-md-12">
                                    <label class="control-label">Harga Modal</label>
                                    <input class="form-control form-white money"  type="text" name="harga_modal" required="" />
                                </div>
                                <div class="col-md-12">
                                    <label class="control-label">Harga Normal</label>
                                    <input class="form-control form-white money"  type="text" name="harga_normal" required="" />
                                </div>
                                <div class="col-md-12">
                                    <label class="control-label">Foto Barang</label>
                                    <input class="form-control form-white" type="file" name="filefoto" />
                                </div>
                                <div class="col-md-12">
                                    <label class="control-label">Suplier</label>
                                    <input class="form-control form-white" type="text" name="suplier" />
                                </div>
                                <div class="col-md-12">
                                  <label class="control-label">Kategori Barang</label>
                                  <select class="form-control" name="kategori" required>
                                    <option selected value="">Pilih</option>
                                    <?php
                                      foreach($kategori->result_array() as $i) :
                                        $barang_id = $i['id_kategori'];
                                        $barang_nama = $i['nama_kategori'];

                                    ?>
                                    <option value="<?php echo $barang_id?>"><?php echo $barang_nama?></option>
                                    <?php endforeach;?>
                                  </select>
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
