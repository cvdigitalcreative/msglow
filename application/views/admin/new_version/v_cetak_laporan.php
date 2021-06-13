<html>
<head>
  <title>Laporan Transaksi Perhari</title>
</head>
<!-- Favicon -->
<link rel="shortcut icon" href="<?php echo base_url()?>assets/images/logo.png" />
<!-- Font -->
<link  rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<style type="text/css" media="print">

@page {size: landscape;}

th,td{
  font-size: 14px;
}
</style>
<body>
     <div>
          
          <div class="col-xl-12">
            <center><h1>Laporan Transaksi <?php echo $levels?></h1></center>
            <center><h1><?php echo date("d-m-Y")?></h1></center>
          </div>
           <div class="col-md-3">
                <p class="mt-10"><b>=> Total Omset : <?php echo rupiah($total[0]['total_omset'])?></b></p>
              </div>
             
          <hr style="margin-left:10px;margin-right:10px;">
          <br>

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
                      <th style="width: 5%;"> Admin pemesan </th>
                      <th style="width: 5%;"> Toko </th>
                      <th style="width: 13%;">Barang</th>
                      <th>Total Omset</th>
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
                      $barang_all=$i['list_barang'];
                      $nama_toko=$i['nama_toko'];
                      $admin_pemesan=$i['admin_pemesan'];
                      $omset=$i['total_omset'];
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
                        <td><?php echo $admin_pemesan?></td>
                         <td><?php echo $nama_toko?></td>
                      <td style="word-break: break-all;">
                       <?php echo $barang_all?>
                      </td>
                      <td><?php echo rupiah($omset)?></td>
                    </tr>
                  <?php endforeach;?>
              </tbody>
           </table>
      </div>

</body>
</html>

<script type="text/javascript">
 window.print();
 window.close();
</script>
