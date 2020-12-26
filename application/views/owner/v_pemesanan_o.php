<div class="content-wrapper">
    <div class="page-title">
      <div class="row">
          <div class="col-sm-6">
              <h4 class="mb-0">Data Daftar Barang</h4>              
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
              <li class="breadcrumb-item"><a href="<?php echo base_url()?>Admin/Pemesanan" class="default-color">Home</a></li>
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
              <?php if($level1 == 2) :?>
                

                <a href="" data-toggle="modal" data-target="#tambah-pesanan-non-reseller" class="btn btn-primary btn-block ripple m-t-20">
                  <i class="fa fa-plus pr-2"></i> Tambah Pemesanan Customer
                </a>
              
              <?php elseif($level1 == 1) :?>
             
                <a href="" data-toggle="modal" data-target="#reseller" class="btn btn-primary btn-block ripple m-t-20">
                  <i class="fa fa-plus pr-2"></i> Tambah Pemesanan Reseller
                </a>
              
            <?php endif;?>
            
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
                      <th>Total Harga</th>
                      <th>List Barang</th> 
                      <th width="50"><center>Aksi</center></th>
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
                      $mp_id1 = $i['mp_id'];
                      $mp_nama = $i['mp_nama'];
                      $level = $i['level'];
                      $kurir_nama = $i['kurir_nama'];
                      $at_id = $i['at_id'];
                      $at_nama = $i['at_nama'];

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
                      <td><?php echo $pemesanan_nama?></td>
                      <td><?php echo $tanggal?></td>
                      <td><?php echo $hp?></td>
                      <td><?php echo $alamat?></td>
                      <td><?php echo $kurir_nama?></td>
                      <td><?php echo $at_nama?></td>
                      <td><?php echo $mp_nama?></td>
                      <td><?php echo rupiah($jumlah)?></td>
                      <td><a href="<?php echo base_url()?>Owner/Barang/list_barang/<?php echo $pemesanan_id?>/<?php echo $level?>" target="_blank" class="btn btn-primary">List Barang</a></td>
                      <td>
                          <a href="#" style="margin-right: 10px; margin-left: 10px;" data-toggle="modal" data-target="#editdata<?php echo $pemesanan_id?>"><span class="ti-pencil"></span></a>
                          <a href="#" style="margin-right: 10px" data-toggle="modal" data-target="#hapusdata<?php echo $pemesanan_id?>"><span class="ti-trash"></span></a>
                      </td>
                    </tr>
                  <?php endforeach;?>
              </tbody>
           </table>
          </div>
          </div>
        </div>   
      </div>

      <!-- Modal Add Barang Reseller-->
        <div class="modal" tabindex="-1" role="dialog" id="tambah-pesanan-non-reseller">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Pesanan Non Reseller</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <form action="<?php echo base_url()?>Owner/Barang/savepemesananNR" method="post" enctype="multipart/form-data">
                    <div class="modal-body p-20">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="control-label">Nama Pemesan</label>
                                    <input class="form-control form-white" type="text" name="nama_pemesan"  required />
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
                                        $at_tanggal = $i['at_tanggal'];
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
                                        $kurir_id = $i['kurir_id'];
                                        $kurir_nama = $i['kurir_nama'];
                                        $kurir_tanggal = $i['kurir_tanggal'];
                                    ?>
                                    <option value="<?php echo $kurir_id?>"><?php echo $kurir_nama?></option>
                                  <?php endforeach;?>
                                  </select>
                                 </div>
                                 <div class="col-md-12">
                                  <label class="control-label">Metode_Pembayaran</label>
                                  <select class="form-control" name="metpem" required>
                                    <option selected value="">Pilih</option>
                                    <?php
                                      foreach($metode_pembayaran->result_array() as $i) :
                                        $mp_id = $i['mp_id'];
                                        $mp_nama = $i['mp_nama'];
                                        $mp_tanggal = $i['mp_tanggal'];
                                    ?>
                                    <option value="<?php echo $mp_id?>"><?php echo $mp_nama?></option>
                                  <?php endforeach;?>
                                  </select>
                                 </div>
                                      <div class="form-group col-md-12 mt-10" id="dynamic_field">
                                        <div class="row"> 
                                          <div class="col-md-8">
                                            <label class="control-label">Barang</label>
                                            <select class="form-control" name="barang[]" required>
                                                <option selected value="">Pilih</option>
                                                <?php
                                                  foreach($nonreseller->result_array() as $i) :
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

                                          <div class="col-md-12">
                                            <label class="control-label">DISKON</label>
                                            <select class="form-control" name="diskon" required>
                                               <option selected value="1">Tidak Ada Diskon</option>
                                              <?php
                                               foreach($diskon->result_array() as $i) :
                                                  $no++;
                                                  $diskon_id = $i['id'];
                                                  $barang_nama = $i['nama_diskon'];
                                                  $harga_potongan = $i['potongan_harga'];
                                                 
                                                ?>
                                              <option value="<?php echo $diskon_id?>"><?php echo $barang_nama." potongan sebesar Rp. ".$harga_potongan?></option>
                                              <?php endforeach;?>
                                            </select>
                                           </div>
                                        </div>
                                      </div>                                  
                                    <div class="col-md-12 mt-30">
                                        <input class="button" value="Add new" id="add"/>
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

         <!-- Modal Add Barang Reseller-->
        <div class="modal" tabindex="-1" role="dialog" id="reseller">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Pesanan Reseller</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <form action="<?php echo base_url()?>Owner/Barang/savepemesananR" method="post" enctype="multipart/form-data">
                    <div class="modal-body p-20">
                            <div class="row">
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
                                        $at_tanggal = $i['at_tanggal'];
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
                                        $kurir_id = $i['kurir_id'];
                                        $kurir_nama = $i['kurir_nama'];
                                        $kurir_tanggal = $i['kurir_tanggal'];
                                    ?>
                                    <option value="<?php echo $kurir_id?>"><?php echo $kurir_nama?></option>
                                  <?php endforeach;?>
                                  </select>
                                 </div>
                                 <div class="col-md-12">
                                  <label class="control-label">Metode_Pembayaran</label>
                                  <select class="form-control" name="metpem" required>
                                    <option selected value="">Pilih</option>
                                    <?php
                                      foreach($metode_pembayaran->result_array() as $i) :
                                        $mp_id = $i['mp_id'];
                                        $mp_nama = $i['mp_nama'];
                                        $mp_tanggal = $i['mp_tanggal'];
                                    ?>
                                    <option value="<?php echo $mp_id?>"><?php echo $mp_nama?></option>
                                  <?php endforeach;?>
                                  </select>
                                 </div>
                                      <div class="form-group col-md-12 mt-10" id="dynamic_field1">
                                        <div class="row"> 
                                          <div class="col-md-8">
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
                                      <div class="col-md-12">
                                            <label class="control-label">DISKON</label>
                                            <select class="form-control" name="diskon" required>
                                               <option selected value="1">Tidak Ada Diskon</option>
                                              <?php
                                               foreach($diskon->result_array() as $i) :
                                                  $no++;
                                                  $diskon_id = $i['id'];
                                                  $barang_nama = $i['nama_diskon'];
                                                  $harga_potongan = $i['potongan_harga'];
                                                 
                                                ?>
                                              <option value="<?php echo $diskon_id?>"><?php echo $barang_nama." potongan sebesar Rp. ".$harga_potongan?></option>
                                              <?php endforeach;?>
                                            </select>
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
          foreach($datapesanan->result_array() as $i) :
            $no++;
            $pemesanan_id = $i['pemesanan_id'];
            $pemesanan_nama = $i['pemesanan_nama'];
            $tanggal = $i['tanggal'];
            $hp = $i['pemesanan_hp'];
            $alamat = $i['pemesanan_alamat'];
            $kurir_id1 = $i['kurir_id'];
            $level = $i['level'];
            $kurir_nama = $i['kurir_nama'];
            $at_id1 = $i['at_id'];
            $mp_id1 = $i['mp_id'];
            $mp_nama = $i['mp_nama'];
            $at_nama = $i['at_nama'];
            $id_diskon = $i['id_diskon'];
        ?>
        <!-- Modal edit Data -->
          <div class="modal" tabindex="-1" role="dialog" id="editdata<?php echo $pemesanan_id?>">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <form action="<?php echo base_url()?>Owner/Barang/edit_pesanan_barang/<?= $pemesanan_id?>" method="post" enctype="multipart/form-data">
                      <input class="form-control form-white" type="text" name="pemesanan_id" value="<?php echo $pemesanan_id?>" hidden/>
                      <input class="form-control form-white" type="text" name="level" value="<?php echo $level?>" hidden/>
                    <div class="modal-body p-20">
                            <div class="row">
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
                                    <input class="form-control form-white" type="date" name="tanggal"/>
                                </div>
                                <div class="col-md-12">
                                    <label class="control-label">Alamat</label>
                                    <input class="form-control form-white"  type="text" name="alamat" value="<?php echo $alamat?>" required/>
                                </div>
                                <div class="col-md-12">
                                  <label class="control-label">Asal Transaksi</label>
                                  <select class="form-control" name="at" required>
                                    <option value="">Pilih</option>
                                    <?php
                                      foreach($asal_transaksi->result_array() as $i) :
                                        $at_id = $i['at_id'];
                                        $at_nama = $i['at_nama'];
                                        $at_tanggal = $i['at_tanggal'];
                                        if($at_id1 == $at_id){
                                          echo "<option selected value='$at_id'>$at_nama</option>";
                                        }else{
                                          echo "<option value='$at_id'>$at_nama</option>";
                                        }
                                      endforeach;
                                    ?>  

                                  </select>
                                 </div>
                                 <div class="col-md-12">
                                  <label class="control-label">Kurir</label>
                                  <select class="form-control" name="kurir" required>
                                    <option selected value="">Pilih</option>
                                    <?php
                                      foreach($kurir->result_array() as $i) :
                                        $kurir_id = $i['kurir_id'];
                                        $kurir_nama = $i['kurir_nama'];
                                        $kurir_tanggal = $i['kurir_tanggal'];
                                        if($kurir_id1 == $kurir_id){
                                          echo "<option selected value='$kurir_id'>$kurir_nama</option>";
                                        }else{
                                          echo "<option value='$kurir_id'>$kurir_nama</option>";
                                        }
                                       endforeach;
                                    ?>
                                  </select>
                                 </div>
                                  <div class="col-md-12">
                                  <label class="control-label">Metode Pembayaran</label>
                                  <select class="form-control" name="mp" required>
                                    <option selected value="">Pilih</option>
                                    <?php
                                      foreach($metode_pembayaran->result_array() as $i) :
                                        $mp_id = $i['mp_id'];
                                        $mp_nama = $i['mp_nama'];
                                        $mp_tanggal = $i['mp_tanggal'];
                                        if($mp_id1 == $mp_id){
                                          echo "<option selected value='$mp_id'>$mp_nama</option>";
                                        }else{
                                          echo "<option value='$mp_id'>$mp_nama</option>";
                                        }
                                       endforeach;
                                    ?>
                                  </select>
                                 </div>

                                 <div class="col-md-12">
                                  <label class="control-label">Diskon</label>
                                  <select class="form-control" name="diskon" required>
                                     <option selected value="1">Tidak Ada Diskon</option>
                                    <?php
                                      foreach($diskon->result_array() as $i) :
                                        $id = $i['id'];
                                        $barang_nama = $i['nama_diskon'];
                                        $harga_potongan = $i['potongan_harga'];
                                        if($id_diskon == $id){
                                          echo "<option selected value='$id'>$barang_nama</option>";
                                        }else{
                                          echo "<option value='$id'>$barang_nama</option>";
                                        }
                                       endforeach;
                                    ?>
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

        <?php
          $no = 0 ;
          foreach($datapesanan->result_array() as $i) :
            $no++;
            $pemesanan_id = $i['pemesanan_id'];
        ?>

        <div class="modal" tabindex="-1" role="dialog" id="hapusdata<?php echo $pemesanan_id?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Hapus Pesanan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body p-20">
                        <form action="<?php echo base_url()?>Owner/Barang/hapus_pesanan" method="post">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" name="pemesanan_id" value="<?php echo $pemesanan_id?>"/> 
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
  $('#add').click(function(){
    i++;
    $('#dynamic_field').append('<div class="row" id="row'+i+'"><div class="col-md-8"><label class="control-label">Barang</label><select class="form-control" name="barang[]"><option selected value="">Pilih</option><?php foreach($nonreseller->result_array() as $i) :$barang_id = $i['barang_id']; $barang_nama = $i['barang_nama'];?><option value="<?php echo $barang_id?>"><?php echo $barang_nama?></option><?php endforeach;?> </select></div><div class="col-md-2"><label class="control-label" for="harga">Jumlah</label><input class="form-control" type="number" name="qty[]" ></div><div class="col-md-2 mt-30"><button type="button" id="'+i+'" class="btn btn-danger btn-block btn_remove">Delete</button></div></div>');
  });
  
  $(document).on('click', '.btn_remove', function(){
    var button_id = $(this).attr("id"); 
    $('#row'+button_id+'').remove();
  });
  
});
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
