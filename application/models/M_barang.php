<?php
	/**
	 * 
	 */
	class M_barang extends CI_Model
	{
		function getAllkategori(){
			$hasil=$this->db->query("SELECT * FROM kategori");
        	return $hasil;
		}
		function tambah_kategori($nama_kategori){
			$hsl = $this->db->query("INSERT INTO kategori(nama_kategori) VALUES ('$nama_kategori')");
        	return $hsl;
		}
		function update_kategori($id_kategori,$nama_kategori){
			$hsl = $this->db->query("UPDATE kategori SET nama_kategori='$nama_kategori' WHERE id_kategori='$id_kategori'");
     		return $hsl;
		}
		function hapus_kategori($id_kategori){
			$this->db->trans_start();
				$this->db->query("DELETE FROM kategori WHERE id_kategori='$id_kategori'");
	      	$this->db->trans_complete();
	        if($this->db->trans_status()==true)
	        return true;
	        else
	        return false;
		}
		
		function savebarang($nama_barang, $barang_stock_awal, $barang_stock_akhir, $barang_harga_modal, $barang_level, $barang_foto,$kategori){
			$hsl = $this->db->query("INSERT INTO barang(barang_nama,barang_stock_awal,barang_stock_akhir,barang_harga_modal,barang_level,barang_foto,id_kategori) VALUES ('$nama_barang','$barang_stock_awal','$barang_stock_akhir','$barang_harga_modal','$barang_level','$barang_foto','$kategori')");
        	return $hsl;
		}

		function update_barangImage($barang_id,$nama_barang, $stock=0, $barang_harga_modal, $barang_foto,$id_kategori){
			$hsl = $this->db->query("UPDATE barang SET barang_nama='$nama_barang', barang_stock_awal=barang_stock_awal + '$stock',barang_stock_akhir=barang_stock_akhir + '$stock',barang_harga_modal='$barang_harga_modal',barang_foto='$barang_foto',id_kategori='$id_kategori' WHERE barang_id='$barang_id'");
     		return $hsl;
		}

		function update_barang_noImage($barang_id,$nama_barang, $stock=0, $barang_harga_modal,$id_kategori){
			$hsl = $this->db->query("UPDATE barang SET barang_nama='$nama_barang', barang_stock_awal=barang_stock_awal + '$stock',barang_stock_akhir=barang_stock_akhir + '$stock',barang_harga_modal='$barang_harga_modal',id_kategori='$id_kategori' WHERE barang_id='$barang_id'");
     		return $hsl;
		}

		function update_harga($br_id,$harga){
			$hsl = $this->db->query("UPDATE barang_reseller SET br_harga='$harga' WHERE br_id='$br_id'");
     		return $hsl;
		}

		function getIdbyName($nama_barang){
			$hasil=$this->db->query("SELECT * FROM barang WHERE barang_nama='$nama_barang' ORDER BY barang_id DESC LIMIT 1");
        	return $hasil;
		}

		function savebarangreseller($barang_id, $kuantitas, $harga){
			$hsl = $this->db->query("INSERT INTO barang_reseller(barang_id,br_kuantitas,br_harga) VALUES ('$barang_id', '$kuantitas', '$harga')");
        	return $hsl;
		}

		function savebarangnonreseller($barang_id, $harga){
			$hsl = $this->db->query("INSERT INTO barang_non_reseller(barang_id,bnr_harga) VALUES ('$barang_id', '$harga')");
        	return $hsl;
		}

		function update_barang_reseller($br_id, $harga){
			$hsl = $this->db->query("UPDATE barang_reseller SET br_harga='$harga' WHERE br_id='$br_id'");
     		return $hsl;
		}

		function update_barang_non_reseller($bnr_id, $harga){
			$hsl = $this->db->query("UPDATE barang_non_reseller SET bnr_harga='$harga' WHERE bnr_id='$bnr_id'");
			
     		return $hsl;
		}

		function hapus_barang_R($barang_id){
			$this->db->trans_start();
				$this->db->query("DELETE FROM barang_reseller WHERE barang_id='$barang_id'");
	      	$this->db->trans_complete();
	        if($this->db->trans_status()==true)
	        return true;
	        else
	        return false;
		}

		function hapus_barang_NR($barang_id){
			$this->db->trans_start();
				$this->db->query("DELETE FROM barang WHERE barang_id='$barang_id'");
				$this->db->query("DELETE FROM barang_non_reseller WHERE barang_id='$barang_id'");
	      	$this->db->trans_complete();
	        if($this->db->trans_status()==true)
	        return true;
	        else
	        return false;
		}

		function getHargaReseller($barang_id){
			$hasil=$this->db->query("SELECT * FROM barang_reseller WHERE barang_id = '$barang_id'");
        	return $hasil;
		}

		function getAllBarang(){
			$hasil=$this->db->query("SELECT barang.*,DATE_FORMAT(barang_tanggal,'%d/%m/%Y %H:%i') AS tanggal FROM barang where barang_stock_akhir>0  ORDER BY barang_nama");
        	return $hasil;
		}
		function getAllBarangR(){
			$hasil=$this->db->query("SELECT barang.*,DATE_FORMAT(barang_tanggal,'%d/%m/%Y %H:%i') AS tanggal FROM barang where barang_stock_akhir>0 ORDER BY barang_nama");
        	return $hasil;
		}

		function getDataReseller(){
			$hasil=$this->db->query("SELECT a.*,DATE_FORMAT(barang_tanggal,'%d/%m/%Y %H:%i') AS tanggal FROM barang a WHERE barang_level = 1");
        	return $hasil;
		}

		function getDataNonReseller1(){
			$hasil=$this->db->query("SELECT a.*,DATE_FORMAT(barang_tanggal,'%d/%m/%Y %H:%i') AS tanggal FROM barang a WHERE barang_level = 2 and  a.barang_stock_akhir>0");
        	return $hasil;
		}

		function getDataNonReseller(){
			$hasil=$this->db->query("SELECT a.*,b.*, c.nama_kategori,DATE_FORMAT(barang_tanggal,'%d/%m/%Y %H:%i') AS tanggal FROM barang a, barang_non_reseller b,kategori c WHERE a.barang_id = b.barang_id and a.id_kategori=c.id_kategori");
        	return $hasil;
		}

		function getTotalomsetBarang(){ 
			$hasil=$this->db->query('SELECT sum(a.barang_stock_akhir * b.bnr_harga) as total_omset FROM barang a, barang_non_reseller b WHERE a.barang_id = b.barang_id')->result_array();
        	return $hasil[0]['total_omset'];
		}

		function getTotalUntung(){
			$hasil=$this->db->query('SELECT (sum(a.barang_stock_akhir * b.bnr_harga)-sum(a.barang_stock_akhir * a.barang_harga_modal) ) as total_untung  FROM barang a, barang_non_reseller b WHERE a.barang_id = b.barang_id')->result_array();
        	
        	return $hasil[0]['total_untung'];
		}

		function getHistoryStock($barang_id){
			$hasil=$this->db->query("SELECT a.lb_id,c.pemesanan_nama,a.lb_qty as stock_berkurang,a.barang_id,b.barang_nama,DATE_FORMAT(a.lb_tanggal,'%d/%m/%Y %H:%i') AS tanggal FROM list_barang a,barang b, pemesanan c WHERE a.barang_id = '$barang_id' AND a.barang_id = b.barang_id AND a.pemesanan_id = c.pemesanan_id  ORDER BY `a`.`lb_id` DESC");
        	return $hasil;
		}


		function get_kategori_id_barang($id_barang){
			$hasil=$this->db->query("SELECT id_kategori FROM barang  WHERE barang_id = '$id_barang' ")->result_array();
        	return $hasil;
		}

	}
?>
