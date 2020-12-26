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
            <center><h1><?php echo $tanggal?></h1></center>
          </div>
          <hr style="margin-left:10px;margin-right:10px;">
          <br>

             <table border="1" cellpadding="7" width="100%" style="border-style: solid;border-width: thin;border-collapse: collapse;" >
              <tr>
                      <th style="width: 2%;">No</th>
                      <th style="width: 10%;">Nama Pemesan</th>
                      <th style="width: 8%;">No HP</th>
                      <th style="width: 20%;">Alamat</th>
                      <th style="width: 5%;"> Kurir </th>
                      <th style="width: 5%;"> Metode Pembayaran </th>
                       <th style="width: 8%;"> Admin Input </th>
                      <th style="width: 13%;">Barang</th>
                      <th style="width: 8%;">Total Omset</th>
                      <th style="width: 9%;">Total Untung</th>
              </tr>
                  <?php
                    function rupiah($angka){
                      $hasil_rupiah = number_format($angka,0,',','.');
                      return $hasil_rupiah;
                    }

                    $no = 0 ;
                    foreach($data->result_array() as $i) :
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
                      $at_nama = $i['mp_nama'];
                      $user_nama = $i['user_nama'];
                      if($level == 1){
                        $q=$this->db->query("SELECT SUM(a.lb_qty * d.br_harga) AS total_keseluruhan, ((SUM(a.lb_qty * d.br_harga))-SUM(a.lb_qty * c.barang_harga_modal)) AS total FROM list_barang a, pemesanan b, barang c, barang_reseller d WHERE a.pemesanan_id = '$pemesanan_id' AND a.ktg_qty = d.br_kuantitas AND a.pemesanan_id = b.pemesanan_id AND a.barang_id = c.barang_id AND a.barang_id = d.barang_id"); 
                        $c=$q->row_array();
                        $omset = $c['total_keseluruhan'];
                        $untung = $c['total'];
                           //diskon pemesanan
                        $z=$this->db->query("SELECT b.potongan_harga   FROM pemesanan a, diskon_all b WHERE a.pemesanan_id = '$pemesanan_id' and a.id_diskon=b.id ");
                        $c=$z->row_array();
                        $potongan_harga = $c['potongan_harga'];
                        $omset=$omset-($potongan_harga);
                        $untung = $untung-($potongan_harga);
                      }elseif($level == 2){
                        $q=$this->db->query("SELECT SUM(a.lb_qty * d.bnr_harga) AS total_keseluruhan, (SUM(a.lb_qty * d.bnr_harga))-(SUM(a.lb_qty * c.barang_harga_modal)) AS total FROM list_barang a, pemesanan b, barang c, barang_non_reseller d WHERE a.pemesanan_id = '$pemesanan_id' AND a.pemesanan_id = b.pemesanan_id AND a.barang_id = c.barang_id AND a.barang_id = d.barang_id");
                        $c=$q->row_array();
                        $omset = $c['total_keseluruhan'];
                        $untung = $c['total'];
                        //diskon
                      $z=$this->db->query("SELECT a.lb_qty ,a.barang_id,b.pemesanan_tanggal  FROM list_barang a, pemesanan b, barang c, barang_non_reseller d WHERE a.pemesanan_id = '$pemesanan_id' AND lb_lvl =2 AND a.pemesanan_id = b.pemesanan_id AND a.barang_id = c.barang_id AND a.barang_id = d.barang_id ORDER BY lb_id");
                        foreach ($z->result_array() as $i ) {
                                 $barang_id = $i['barang_id'];
                                 $lb_qty = $i['lb_qty'];
                                 $pemesanan_tanggal = $i['pemesanan_tanggal'];
                                  $z=$this->db->query("select potongan_harga from diskon where barang_id='$barang_id' and  tanggal_mulai <= '$pemesanan_tanggal' AND tanggal_berakhir >= '$pemesanan_tanggal'")->row_array();


                                  if($z['potongan_harga']==null){
                                    
                                  }else{
                                    $untung=$untung-($z['potongan_harga']*$lb_qty);
                                    $omset=$omset-($z['potongan_harga']*$lb_qty);
                                  }

                        }
                        //--------
                           //diskon pemesanan
                        $z=$this->db->query("SELECT b.potongan_harga   FROM pemesanan a, diskon_all b WHERE a.pemesanan_id = '$pemesanan_id' and a.id_diskon=b.id ");
                        $c=$z->row_array();
                        $potongan_harga = $c['potongan_harga'];
                        $omset=$omset-($potongan_harga);
                        $untung = $untung-($potongan_harga);
                      }
                  ?>
                    <tr>
                      <td style="word-break: break-all;"><center><?php echo $no?></center></td>
                      <td style="word-break: break-all;"><?php echo $pemesanan_nama?></td>
                      <td style="word-break: break-all;"><?php echo $hp?></td>
                      <td style="word-break: break-all;"><?php echo $alamat?></td>
                      <td style="word-break: break-all;"><?php echo $kurir_nama?></td>
                      <td style="word-break: break-all;"><?php echo $at_nama?></td>
                       <td><?php echo $user_nama?></td>
                      <td style="word-break: break-all;">
                        <?php
                           if($level==1){

                               $z=$this->db->query("SELECT a.lb_id,a.pemesanan_id,a.lb_qty,a.barang_id,b.pemesanan_nama,c.barang_nama,d.br_harga, a.lb_qty * d.br_harga AS total FROM list_barang a, pemesanan b, barang c, barang_reseller d WHERE b.pemesanan_id = '$pemesanan_id' AND a.ktg_qty = d.br_kuantitas AND a.pemesanan_id = b.pemesanan_id AND a.barang_id = c.barang_id AND a.barang_id = d.barang_id");

                                foreach ($z->result_array() as $i ) {
                                  $barang_nama = $i['barang_nama'];
                                   $jumlah_barang = $i['lb_qty'];
                                  echo "- ".$barang_nama."=  ".$jumlah_barang."<br>";
                                }

                          }else  if($level==2){
                               $z=$this->db->query("SELECT a.lb_id,a.pemesanan_id,a.lb_qty,a.barang_id,b.pemesanan_nama,c.barang_nama,d.bnr_harga, a.lb_qty * d.bnr_harga AS total FROM list_barang a, pemesanan b, barang c, barang_non_reseller d WHERE a.pemesanan_id = '$pemesanan_id' AND lb_lvl =2 AND a.pemesanan_id = b.pemesanan_id AND a.barang_id = c.barang_id AND a.barang_id = d.barang_id ORDER BY lb_id");
                               
                                foreach ($z->result_array() as $i ) {

                                    $barang_nama = $i['barang_nama'];

                                     $jumlah_barang = $i['lb_qty'];
                                   echo "- ".$barang_nama."=  ".$jumlah_barang."<br>";

                                  }
                          }
                         
                          
                          
                        ?>
                      </td>
                      <td style="word-break: break-all;">Rp. <?php echo rupiah($omset)?></td>
                      <td style="word-break: break-all;">Rp. <?php echo rupiah($untung)?></td>
                    </tr>
                  <?php endforeach;?>
                    <tr>
                      <th colspan="7"><center>Jumlah</center></th>
                      <th>Rp. <?php echo rupiah($total_omset)?></th>
                      <th>Rp. <?php echo rupiah($total_untung)?></th>
                    </tr>
             </table>
      </div>

</body>
</html>

<script type="text/javascript">
 window.print();
 window.close();
</script>
