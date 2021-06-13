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
            <center><h1>Laporan Barang ></h1></center>
            <center><h1><?php echo date("d-m-Y")?></h1></center>
          </div>
          
              
          <hr style="margin-left:10px;margin-right:10px;">
          <br>

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

</body>
</html>

<script type="text/javascript">
 window.print();
 window.close();
</script>
