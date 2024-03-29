<html>
<head>
  <title>Laporan Stock Perhari</title>
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
            <center><h1>Laporan Stock Masuk </h1></center>
            <center><h1><?php echo $tanggal?></h1></center>
          </div>
          <hr style="margin-left:10px;margin-right:10px;">
          <br>

             <table border="1"  width="100%" style="border-style: solid;border-width: thin;border-collapse: collapse;" >
              <tr>
                      <th style="width: 10%;">No</th>
                      <th style="width: 15%;">Nama Barang</th>
                      <th style="width: 15%;"><center>Stock Awal Hari</center></th>
                      <th style="width: 15%;"><center>Barang Masuk</center></th>
                      <th style="width: 15%;"> <center>Stock Akhir Hari</center></th>
                      <th style="width: 15%;"><center>Tanggal</center></th>
                      <th style="width: 15%;"><center>Toko</center></th>
                  </tr>
              </thead>
              <tbody>
                  <?php 
                  $no = 0;
                  foreach($stock->result_array() as $i) :
                    $no++;
                    $barang_id = $i['barang_id'];
                    $barang_nama = $i['barang_nama'];
                    $barang_stock_awal = $i['stok_awal_hari'];
                    $barang_stock_akhir = $i['stok_akhir_hari'];
                    $total = $i['total_barang_masuk'];
                    $tanggal = $i['tanggal'];
                    $nama_toko = $i['nama_toko'];
                  ?>
                  <tr>
                      <td style="word-break: break-all;"> <center><?php echo $no?></center></td>
                      <td style="word-break: break-all;"><?php echo $barang_nama?></td>
                      <td style="word-break: break-all;"><center><?php echo $barang_stock_awal?></center></td>
                      <td style="word-break: break-all;"><center><?php echo $total?></center></td>
                      <td style="word-break: break-all;"><center><?php echo $barang_stock_akhir?></center></td>
                      <td style="word-break: break-all;"><center><?php echo $tanggal?></center></td>
                      <td style="word-break: break-all;"><center><?php echo $nama_toko?></center></td>
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
