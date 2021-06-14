<div class="content-wrapper">
  <div class="page-title">
    <div class="row">
      <div class="col-sm-6">
        <h4 class="mb-0"><?php echo $title ?></h4>              
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
          <li class="breadcrumb-item"><a href="<?php echo $home_url?>" class="default-color">Home</a></li>
          <li class="breadcrumb-item active"><a href="<?php echo $url?>" class="default-color"><?php echo $title ?></a></li>
        </ol>
      </div>
    </div>
  </div>
  <div class="row"> 
    <div class="col-xl-12 mb-30"> 
       <div class="card-body">
         
         <div class="col-xl-12 mb-10" style="display: flex">
           
          <div class="col-md-12">
            <form action="<?php echo base_url()?>Admin/Pemesanan/cetak_pemesanan"  method="post" enctype="multipart/form-data">
             <input class="" type="hidden" name="level"
             value="<?php echo $level ?>" />
             <div class="modal-footer">
              <button type="submit" class="btn btn-primary btn-block ripple m-t-20" name="action" value="cetak">Cetak Laporan</button>
            </div> 
          </form>
        </div>
      </div>
      <div class="col-xl-12 mb-10" style="display: flex">
       
        <div class="col-md-12">
          <a href="" data-toggle="modal" data-target="#tambahpesanan" class="btn btn-success btn-block ripple m-t-20">
            <i class="fa fa-plus pr-2"></i> Tambah Pemesanan <?php echo $title ?>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">   
  <div class="col-xl-12 mb-30">     
    <div class="card card-statistics h-100"> 
      <div class="card-body">
        <div class="col-xl-12 mb-10" style="display: flex">
          
         
          <div class="col-md-3">
            <p class="mt-10"><b>=> Total Omset : <?php echo rupiah($total[0]['total_omset'])?></b></p>
          </div>
          
        </div>

        
        <div class="table-responsive">
          <table id="datatable" class="table table-striped table-bordered p-0">
            <thead>
              <tr>
                <th width="5">Checkbox Invoice</th>
                <th width="5">No</th>
                <th>Nama Pemesan</th>
                <th width="10">Tanggal Pesanan</th>
                <th>No HP</th>
                <th>Alamat</th>
                <th>Kurir</th>
                <th>Asal Transaksi</th>
                <th>Metode Pembayaran</th>
                <th style="width: 5%;"> Admin Input </th>
                <th style="width: 5%;"> Admin pemesan </th>
                <th style="width: 5%;"> Toko </th>
                <th style="width: 13%;">Barang</th>
                <th>Total Omset</th>
                <th>Action</th>
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
                $mp_id = $i['mp_id'];
                $at_nama = $i['at_nama'];
                $user_nama = $i['user_nama'];
                $barang_all=$i['list_barang'];
                $nama_toko=$i['nama_toko'];
                $admin_pemesan=$i['admin_pemesan'];
                $omset=$i['total_omset'];
                ?>
                <tr>
                  <td>
                    <!-- <input type="checkbox" id="cetak" name="cetak" value="<?php echo $pemesanan_id?>"> -->
                    <input type="checkbox" id="cek_<?php echo $pemesanan_id?>" onclick="myFunction('<?php echo $pemesanan_id?>')" value="<?php echo $pemesanan_id?>">

                  </td>
                  <td><center><?php echo $no?></center></td>
                  <td><?php echo $pemesanan_nama?></td>
                  <td><?php echo $tanggal?></td>
                  <td><?php echo $hp?></td>
                  <td><?php echo $alamat?></td>
                  <td><?php echo $kurir_nama?></td>
                  <td><?php echo $at_nama?></td>
                  <td><?php echo $mp_nama?></td>
                  <td><?php echo $user_nama?></td>
                  <td><?php echo $admin_pemesan?></td>
                  <td><?php echo $nama_toko?></td>
                  <td style="word-break: break-all;">
                   <?php echo $barang_all?>
                 </td>
                 <td><?php echo rupiah($omset)?></td>
                 <td>
                   <form action="<?php echo base_url()?>Admin/Pemesanan/f" method="post" enctype="multipart/form-data">
                    <div class="modal-footer">
                      <input class="" type="hidden" name="pemesanan_id" value="<?php echo $pemesanan_id ?>" />
                      <button type="submit" class="btn btn-danger ripple save-category" id="hapus">Hapus</button>
                    </div>
                  </form>
                  <div class="col-xl-12 mb-10" style="display: flex">
                    <div class="col-md-12">
                      <a href="" data-toggle="modal" data-target="#edit<?php echo $pemesanan_id?>" class="btn btn-primary btn-block ripple m-t-20">
                        <i class=" pr-2"></i> Edit Pemesanan 
                      </a>
                    </div>
                  </div>
                  
                </td>
              </tr>
              <!-- edit data --> 
              <div class="modal" tabindex="-1" role="dialog" id="edit<?php echo $pemesanan_id?>">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Tambah Pemesanan <?php echo $title ?></h5>
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <form action="<?php echo base_url()?>Admin/Pemesanan/edit_pesanan" method="post" enctype="multipart/form-data">
                      <div class="modal-body p-20">
                        <div class="row">
                         <input class="" type="hidden" name="level"
                         value="<?php echo $level ?>" />
                         <input class="" type="hidden" name="pemesanan_id"
                         value="<?php echo $pemesanan_id ?>" />
                         <div class="col-md-12">
                          <label class="control-label">Nama Pemesan</label>
                          <input class="form-control form-white" type="text" name="nama_pemesan" value="<?php echo $pemesanan_nama?>" required/>
                        </div>

                        <div class="col-md-12">
                          <label class="control-label">No HP</label>
                          <input class="form-control form-white" type="number" name="hp" value="<?php echo $hp?>" required/>
                        </div>

                        <div class="col-md-12">
                          <label class="control-label">Tanggal</label>
                          <input class="form-control form-white" type="date" name="tanggal" value="<?php echo $tanggal?>"  required/>
                        </div>
                        <div class="col-md-12">
                          <label class="control-label">Alamat</label>
                          <input class="form-control form-white"  type="text" name="alamat" value="<?php echo $alamat?>"  required/>
                        </div>

                        <div class="col-md-12">
                          <label class="control-label">Asal Transaksi</label>
                          <select class="form-control" name="at" required>
                            <option selected value="<?php echo $at_id ?>"><?php echo $at_nama ?></option>
                            <?php
                            foreach($asal_transaksi->result_array() as $i) :
                              $at_id = $i['at_id'];
                              $at_nama = $i['at_nama'];
                              ?>
                              <option value="<?php echo $at_id?>"><?php echo $at_nama?></option>
                            <?php endforeach;?>
                          </select>
                        </div>

                        <div class="col-md-12">
                          <label class="control-label">Kurir</label>
                          <select class="form-control" name="kurir" required>
                            <option selected value="<?php echo $kurir_id ?>"><?php echo $kurir_nama ?></option>
                            <?php
                            foreach($kurir->result_array() as $i) :
                              $at_id = $i['kurir_id'];
                              $at_nama = $i['kurir_nama'];
                              ?>
                              <option value="<?php echo $at_id?>"><?php echo $at_nama?></option>
                            <?php endforeach;?>
                          </select>
                        </div>

                        <div class="col-md-12">
                          <label class="control-label">Metode Pembayaran</label>
                          <select class="form-control" name="metpem" required>
                            <option selected value="<?php echo $mp_id ?>"><?php echo $mp_nama ?></option>
                            <?php
                            foreach($metode_pembayaran->result_array() as $i) :
                              $at_id = $i['mp_id'];
                              $at_nama = $i['mp_nama'];
                              ?>
                              <option value="<?php echo $at_id?>"><?php echo $at_nama?></option>
                            <?php endforeach;?>
                          </select>
                        </div>

                        <div class="col-md-12">
                          <label class="control-label">Admin Pemesan</label>
                          <select class="form-control" name="admin" required>
                           <option selected value="1">Pilih Admin</option>
                           <?php
                           foreach($admin->result_array() as $i) :
                            $at_id = $i['id_pegawai'];
                            $at_nama = $i['nama'];
                            ?>
                            <option value="<?php echo $at_id?>"><?php echo $at_nama?></option>
                          <?php endforeach;?>
                        </select>
                      </div>
                      
                      


                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger ripple" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-success ripple save-category" id="simpan">Save</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        



      <?php endforeach;?>
    </tbody>

  </table>
  <div class="col-md-12">
    <form action="<?php echo base_url()?>Admin/Pemesanan/cetak_invoice"  method="post" enctype="multipart/form-data">
     <input class="" type="hidden" name="level"
     value="<?php echo $level ?>" />
     <div id="invoices">
     </div>
     <div class="modal-footer">
      <button type="submit" class="btn btn-primary btn-block ripple m-t-20" name="action" value="cetak">Cetak Invoice</button>
    </div> 
  </form>
</div>
</div>
</div>
</div>   
</div>


</div>

<!-- tambah pemesanan -->
<div class="modal" tabindex="-1" role="dialog" id="tambahpesanan">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Pemesanan <?php echo $title ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <form action="<?php echo base_url()?>Admin/Pemesanan/savepemesanan" method="post" enctype="multipart/form-data">
        <div class="modal-body p-20">
          <div class="row">
           <input class="" type="hidden" name="level"
           value="<?php echo $level ?>" />
           <div class="col-md-12">
            <label class="control-label">Nama Pemesan</label>
            <input class="form-control form-white" type="text" name="nama_pemesan"  required/>
          </div>

          <div class="col-md-12">
            <label class="control-label">No HP</label>
            <input class="form-control form-white" type="number" name="hp" required/>
          </div>

          <div class="col-md-12">
            <label class="control-label">Tanggal</label>
            <input class="form-control form-white" type="date" name="tanggal" required/>
          </div>
          <div class="col-md-12">
            <label class="control-label">Alamat</label>
            <input class="form-control form-white"  type="text" name="alamat" required/>
          </div>

          <div class="col-md-12">
            <label class="control-label">Asal Transaksi</label>
            <select class="form-control" name="at" required>
              <option selected value="">Pilih</option>
              <?php
              foreach($asal_transaksi->result_array() as $i) :
                $at_id = $i['at_id'];
                $at_nama = $i['at_nama'];
                ?>
                <option value="<?php echo $at_id?>"><?php echo $at_nama?></option>
              <?php endforeach;?>
            </select>
          </div>

          <div class="col-md-12">
            <label class="control-label">Kurir</label>
            <select class="form-control" name="kurir" required>
              <option selected value="">Pilih</option>
              <?php
              foreach($kurir->result_array() as $i) :
                $at_id = $i['kurir_id'];
                $at_nama = $i['kurir_nama'];
                ?>
                <option value="<?php echo $at_id?>"><?php echo $at_nama?></option>
              <?php endforeach;?>
            </select>
          </div>

          <div class="col-md-12">
            <label class="control-label">Metode Pembayaran</label>
            <select class="form-control" name="metpem" required>
              <option selected value="">Pilih</option>
              <?php
              foreach($metode_pembayaran->result_array() as $i) :
                $at_id = $i['mp_id'];
                $at_nama = $i['mp_nama'];
                ?>
                <option value="<?php echo $at_id?>"><?php echo $at_nama?></option>
              <?php endforeach;?>
            </select>
          </div>

          <div class="col-md-12">
            <label class="control-label">Admin Pemesan</label>
            <select class="form-control" name="admin" required>
              <option selected value="">Pilih</option>
              <?php
              foreach($admin->result_array() as $i) :
                $at_id = $i['id_pegawai'];
                $at_nama = $i['nama'];
                ?>
                <option value="<?php echo $at_id?>"><?php echo $at_nama?></option>
              <?php endforeach;?>
            </select>
          </div>
          <div class="form-group col-md-12 mt-10" id="dynamic_field1">
            <div class="row"> 
              <div class="col-md-10">
                <label class="control-label">Barang</label>
                <select class="form-control" name="barang[]" required>
                 <option selected value="">Pilih</option>
                 <?php
                 foreach($barang->result_array() as $i) :
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
          <input class="button" value="Add new" id="add"/>
        </div>
        

        <div class="col-md-12">
          <label class="control-label">DISKON</label>
          <select class="form-control" name="diskon" required>
            <option selected value="1">Tidak Ada Diskon</option>
            <?php
            foreach($diskon->result_array() as $i) :
              $diskon_id = $i['id'];
              $barang_nama = $i['nama_diskon'];
              $harga_potongan = $i['potongan_harga'];
              ?>
              <option value="<?php echo $diskon_id?>"><?php echo $barang_nama." potongan sebesar Rp. ".$harga_potongan?></option>
            <?php endforeach;?>
          </select>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger ripple" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success ripple save-category" id="simpan">Save</button>
      </div>
    </div>
  </form>
</div>
</div>
</div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    var i=1;
    $('#add').click(function(){
      i++;
      $('#dynamic_field1').append('<div class="row" id="roww'+i+'"><div class="col-md-8"><label class="control-label">Barang</label><select class="form-control" name="barang[]"><option selected value="">Pilih</option><?php foreach($barang->result_array() as $i) :$barang_id = $i['barang_id']; $barang_nama = $i['barang_nama'];?><option value="<?php echo $barang_id?>"><?php echo $barang_nama?></option><?php endforeach;?> </select></div><div class="col-md-2"><label class="control-label" for="harga">Jumlah</label><input class="form-control" type="number" name="qty[]" ></div><div class="col-md-2 mt-30"><button type="button" id="'+i+'" class="btn btn-danger btn-block btn_remove1">Delete</button></div></div>');
    });
    $(document).on('click', '.btn_remove1', function(){
      var button_id = $(this).attr("id"); 
      $('#roww'+button_id+'').remove();
    });
  });
  function myFunction(id_pemesan) {
      // Get the checkbox
      var s = "cek_"+id_pemesan;
      var checkBox = document.getElementById(s);
      var value = document.getElementById(s).value;
      var nota = document.getElementById('invoices');
      var newChild = '<input  type="hidden" name="invoice[]" value= "' + id_pemesan +'" id=invo_'+id_pemesan+' />';
      // Get the output text
      var text = document.getElementById("text");
      // If the checkbox is checked, display the output text
      if (checkBox.checked == true){
        nota.insertAdjacentHTML('beforeend', newChild);
        text.style.display = "block";
      } else {
        var x = "invo_"+id_pemesan;
        document.getElementById(x).remove();
        text.style.display = "none";
      }
    }
  </script>