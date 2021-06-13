<?php
	/**
	 * 
	 */
	class M_pemesanan extends CI_Model
	{
		function getPemesanan_fix(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,f.*,e.user_nama,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d, user e, detail_transaksi f  WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.uid=e.user_id and a.pemesanan_id=f.id_pemesanan and pemesanan_tanggal>=DATE_ADD(NOW(), INTERVAL -3 MONTH) ORDER BY a.pemesanan_id desc ");
        	return $hasil;
		}

		function getPemesanan_sum(){
			$hasil=$this->db->query("SELECT sum(total_omset),sum(total_omset) as total_omset,sum(total_untung) as total_untung FROM pemesanan a,detail_transaksi f  WHERE a.pemesanan_id=f.id_pemesanan and pemesanan_tanggal>=DATE_ADD(NOW(), INTERVAL -3 MONTH) ORDER BY a.pemesanan_id desc ");
        	return $hasil;
		}

		function save_pesanan($nama_pemesan,$tanggal,$no_hp,$alamat,$level,$kurir_id,$at_id,$mp_id,$id_diskon,$uid){
			$hsl = $this->db->query("INSERT INTO pemesanan(pemesanan_nama,pemesanan_tanggal,pemesanan_hp,pemesanan_alamat,level,kurir_id,at_id,mp_id,id_diskon,uid) VALUES ('$nama_pemesan','$tanggal','$no_hp','$alamat','$level','$kurir_id','$at_id','$mp_id','$id_diskon','$uid')");
        	return $hsl;
		}

		function getPemesanan(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,e.user_nama,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d, user e  WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.uid=e.user_id and pemesanan_tanggal>=DATE_ADD(NOW(), INTERVAL -3 MONTH) ORDER BY a.pemesanan_id desc ");
        	return $hasil;
		}

		function getPemesananby_uid($uid){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,e.user_nama,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d, user e  WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.uid='$uid' and a.uid=e.user_id ORDER BY a.pemesanan_id  DESC limit 100");
        	return $hasil;
		}


		function getPemesananby_kategori($kategori){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,e.user_nama,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d, user e  WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.mp_id='$kategori' and a.uid=e.user_id  ORDER BY a.pemesanan_id  DESC limit 100");
        	return $hasil;
		}
		function getPemesananlevel_kategori($level,$kategori){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,e.user_nama,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d, user e  WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id AND a.level = '$level' and a.mp_id='$kategori' and a.uid=e.user_id ORDER BY a.pemesanan_id DESC limit 100");
        	return $hasil;
		}
		function getPemesananlevel_uid($level,$uid){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,e.user_nama,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d, user e  WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id AND a.level = '$level' and a.uid='$uid'  and a.uid=e.user_id ORDER BY a.pemesanan_id DESC limit 100");
        	return $hasil;
		}

		function getPemesananlevel($level){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,e.user_nama,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d, user e  WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id AND a.level = '$level' and a.uid=e.user_id  ORDER BY a.pemesanan_id DESC limit 100");
        	return $hasil;
		}

		function getPemesananCurdate(){
			date_default_timezone_set("Asia/Jakarta");
        	$cur_date = date("Y-m-d");
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,e.user_nama,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d, user e  WHERE pemesanan_tanggal = '$cur_date' AND a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.uid=e.user_id ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}
		function getPemesananCurdate1_by_id($level,$uid){
			date_default_timezone_set("Asia/Jakarta");
        	$cur_date = date("Y-m-d");
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,e.user_nama,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d, user e  WHERE a.pemesanan_tanggal = '$cur_date' AND a.level = '$level'  AND a.uid = '$uid' AND a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.uid=e.user_id ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}

		function getPemesananCurdate1($level){
			date_default_timezone_set("Asia/Jakarta");
        	$cur_date = date("Y-m-d");
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,e.user_nama,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d, user e  WHERE a.pemesanan_tanggal = '$cur_date' AND a.level = '$level' AND a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.uid=e.user_id ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}
		function getPemesananMonth_uid($dari,$ke,$uid){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,e.user_nama,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c,  metode_pembayaran d,user e WHERE (a.pemesanan_tanggal BETWEEN '$dari' AND '$ke') AND a.kurir_id = b.kurir_id AND a.at_id = c.at_id and d.mp_id =a.mp_id and a.uid='$uid' and a.uid=e.user_id ORDER BY a.pemesanan_id DESC");

        	return $hasil;
		}
		function getPemesananMonth_kategori($dari,$ke,$kategori){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,e.user_nama,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c,  metode_pembayaran d,user e WHERE (a.pemesanan_tanggal BETWEEN '$dari' AND '$ke') AND a.kurir_id = b.kurir_id AND a.at_id = c.at_id and d.mp_id =a.mp_id and a.mp_id='$kategori' and a.uid=e.user_id ORDER BY a.pemesanan_id DESC");

        	return $hasil;
		}
		function getPemesananMonth_filter_uid($dari,$ke,$level,$uid){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,e.user_nama,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c ,  metode_pembayaran d,user e WHERE (a.pemesanan_tanggal BETWEEN '$dari' AND '$ke') AND a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.level = '$level' and d.mp_id =a.mp_id and a.uid='$uid' and a.uid=e.user_id  ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}
		function getPemesananMonth_filter_kategori($dari,$ke,$level,$kategori){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,e.user_nama,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c ,  metode_pembayaran d,user e WHERE (a.pemesanan_tanggal BETWEEN '$dari' AND '$ke') AND a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.level = '$level' and d.mp_id =a.mp_id and a.mp_id='$kategori'  and a.uid=e.user_id ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}

		function getPemesananMonth($dari,$ke){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,e.user_nama,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c,  metode_pembayaran d,user e WHERE (a.pemesanan_tanggal BETWEEN '$dari' AND '$ke') AND a.kurir_id = b.kurir_id AND a.at_id = c.at_id and d.mp_id =a.mp_id and a.uid=e.user_id ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}

		function getPemesananMonth_filter($dari,$ke,$level){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,e.user_nama,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c ,  metode_pembayaran d, user e WHERE (a.pemesanan_tanggal BETWEEN '$dari' AND '$ke') AND a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.level = '$level' and d.mp_id =a.mp_id and a.uid=e.user_id ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}


		function getIdbyName($nama_pemesan){
			$hasil=$this->db->query("SELECT * FROM pemesanan WHERE pemesanan_nama='$nama_pemesan' ORDER BY pemesanan_id DESC LIMIT 1");
        	return $hasil;
		}

		function getIdbyid($pemesanan_id){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,e.user_nama,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d, user e  WHERE pemesanan_id='$pemesanan_id' AND  a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.uid=e.user_id LIMIT 1");
        	return $hasil;
		}

		function edit_pesanan($pemesanan_id,$nama,$no_hp,$alamat,$kurir_id,$at_id,$mp_id,$diskon){
			$hsl = $this->db->query("UPDATE pemesanan SET pemesanan_nama='$nama',pemesanan_hp='$no_hp',pemesanan_alamat='$alamat',kurir_id='$kurir_id',at_id='$at_id',mp_id = '$mp_id',id_diskon = '$diskon' WHERE pemesanan_id='$pemesanan_id'");
        	return $hsl;
		}

		function edit_pesanan1($pemesanan_id,$nama,$tanggal,$no_hp,$alamat,$kurir_id,$at_id,$mp_id,$diskon){
			$hsl = $this->db->query("UPDATE pemesanan SET pemesanan_nama='$nama',pemesanan_tanggal = '$tanggal',pemesanan_hp='$no_hp',pemesanan_alamat='$alamat',kurir_id='$kurir_id',at_id='$at_id',mp_id = '$mp_id',id_diskon = '$diskon' WHERE pemesanan_id='$pemesanan_id'");
        	return $hsl;
		}

		function hapus_pesanan($pemesanan_id){
			$this->db->trans_start();
				$this->db->query("DELETE FROM pemesanan WHERE pemesanan_id='$pemesanan_id'");
				$data = $this->db->query("SELECT * FROM list_barang WHERE pemesanan_id='$pemesanan_id'");
				foreach ($data->result_array() as $i) {
					$qty = $i['lb_qty'];
					$barang_id = $i['barang_id'];
					$x = $this->db->query("SELECT barang_stock_akhir FROM barang WHERE barang_id = '$barang_id'")->row_array();
					$barang_stock_akhir=$x['barang_stock_akhir'];
					$stok_barang=$barang_stock_akhir+$qty; 
					$this->db->query("UPDATE barang SET barang_stock_akhir = $stok_barang WHERE barang_id = '$barang_id'");
					
					$this->db->query("INSERT INTO history_stock_masuk(barang_id,stock) VALUES ('$barang_id','$qty')");
					$this->db->query("INSERT INTO history_stok_barang_kembali(barang_id,jumlah,stok_keluar,barang_stock_keluar) VALUES ('$barang_id',$stok_barang,$qty,$barang_stock_akhir)");
				}
				$this->db->query("DELETE FROM list_barang WHERE pemesanan_id='$pemesanan_id'");
	      	$this->db->trans_complete();
	        if($this->db->trans_status()==true)
	        return true;
	        else
	        return false;
		}
		
		function getAllAT(){
			$hasil=$this->db->query("SELECT * FROM asal_transaksi");
        	return $hasil;
		}

		function save_at($nama){
			$hsl = $this->db->query("INSERT INTO asal_transaksi(at_nama) VALUES ('$nama')");
        	return $hsl;
		}

		function update_at($id,$nama){
			$hsl = $this->db->query("UPDATE asal_transaksi SET at_nama='$nama' WHERE at_id='$id'");
        	return $hsl;
		}

		function hapus_at($id){
	      	$hsl = $this->db->query("DELETE FROM asal_transaksi WHERE at_id='$id'");
	      	return $hsl;
    	}

    	function getAllkurir(){
			$hasil=$this->db->query("SELECT * FROM kurir");
        	return $hasil;
		}

		function save_kurir($nama){
			$hsl = $this->db->query("INSERT INTO kurir(kurir_nama) VALUES ('$nama')");
        	return $hsl;
		}

		function update_kurir($id,$nama){
			$hsl = $this->db->query("UPDATE kurir SET kurir_nama='$nama' WHERE 	kurir_id='$id'");
        	return $hsl;
		}

		function hapus_kurir($id){
	      	$hsl = $this->db->query("DELETE FROM kurir WHERE kurir_id='$id'");
	      	return $hsl;
    	}

    	function getAllMetpem(){
			$hasil=$this->db->query("SELECT * FROM metode_pembayaran");
        	return $hasil;
		}

		function save_Metpem($nama){
			$hsl = $this->db->query("INSERT INTO metode_pembayaran(mp_nama) VALUES ('$nama')");
        	return $hsl;
		}

		function update_Metpem($id,$nama){
			$hsl = $this->db->query("UPDATE metode_pembayaran SET mp_nama='$nama' WHERE mp_id='$id'");
        	return $hsl;
		}

		function hapus_Metpem($id){
	      	$hsl = $this->db->query("DELETE FROM metode_pembayaran WHERE mp_id='$id'");
	      	return $hsl;
    	}

    	function SUMR(){
    		date_default_timezone_set("Asia/Jakarta");
        	$cur_date = date("Y-m-d");
    		return $this->db->query("SELECT SUM(a.lb_qty * d.br_harga) AS total_keseluruhan FROM list_barang a, pemesanan b, barang c, barang_reseller d WHERE pemesanan_tanggal = '$cur_date' AND a.lb_qty = d.br_kuantitas AND a.pemesanan_id = b.pemesanan_id AND a.barang_id = c.barang_id AND a.barang_id = d.barang_id");
    	}

    	function SUMNR(){
    		date_default_timezone_set("Asia/Jakarta");
        	$cur_date = date("Y-m-d");
    		return $this->db->query("SELECT SUM(a.lb_qty * d.bnr_harga) AS total_keseluruhan FROM list_barang a, pemesanan b, barang c, barang_non_reseller d WHERE pemesanan_tanggal = '$cur_date' AND a.pemesanan_id = b.pemesanan_id AND a.barang_id = c.barang_id AND a.barang_id = d.barang_id");
    	}

    	function SUMAR(){
    		return $this->db->query("SELECT SUM(a.lb_qty * d.br_harga) AS total_keseluruhan FROM list_barang a, pemesanan b, barang c, barang_reseller d WHERE  a.lb_qty = d.br_kuantitas AND a.pemesanan_id = b.pemesanan_id AND a.barang_id = c.barang_id AND a.barang_id = d.barang_id");
    	}

    	function SUMANR(){
    		return $this->db->query("SELECT SUM(a.lb_qty * d.bnr_harga) AS total_keseluruhan FROM list_barang a, pemesanan b, barang c, barang_non_reseller d WHERE a.pemesanan_id = b.pemesanan_id AND a.barang_id = c.barang_id AND a.barang_id = d.barang_id");
    	}



    	function getAllkategori(){
			$hasil=$this->db->query("SELECT * FROM kategori");
        	return $hasil;
		}

		function save_kategori($nama){
			$hsl = $this->db->query("INSERT INTO kategori(nama_kategori) VALUES ('$nama')");
        	return $hsl;
		}

		function update_kategori($id,$nama){
			$hsl = $this->db->query("UPDATE kategori SET nama_kategori='$nama' WHERE id_kategori='$id'");
        	return $hsl;
		}

		function hapus_kategori($id){
	      	$hsl = $this->db->query("DELETE FROM kategori WHERE id_kategori='$id'");
	      	return $hsl;
    	}
	}
?>