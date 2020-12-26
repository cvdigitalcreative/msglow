<?php
	/**
	 * 
	 */
	class M_stock extends CI_Model
	{
		function save_stock_masuk($barang_id, $stock){
			$hsl = $this->db->query("INSERT INTO history_stock_masuk(barang_id,stock) VALUES ('$barang_id','$stock')");
			$x = $this->db->query("SELECT barang_stock_akhir FROM barang WHERE barang_id = '$barang_id'")->row_array();
			$barang_stock_akhir=$x['barang_stock_akhir'];
			$stok_barang=$barang_stock_akhir-$stock; 
			$this->db->query("INSERT INTO history_stok_barang_masuk(barang_id,jumlah,stok_keluar,barang_stock_keluar) VALUES ('$barang_id',$barang_stock_akhir,$stock,$stok_barang)");
			
			$this->db->trans_complete();

	        if($this->db->trans_status()==true)
	        return true;
	        else
	        return false;

		}
		function getHistoryStock($barang_id){
			$hasil=$this->db->query("SELECT a.stock,a.barang_id,b.barang_nama,DATE_FORMAT(a.pemesanan,'%d/%m/%Y %H:%i') AS tanggal FROM history_stock_masuk a,barang b WHERE a.barang_id = '$barang_id' AND a.barang_id = b.barang_id ");
        	return $hasil;
		}

		function update_stok($barang_id, $qty){
			$x = $this->db->query("SELECT barang_stock_akhir FROM barang WHERE barang_id = '$barang_id'")->row_array();
			$barang_stock_akhir=$x['barang_stock_akhir'];
			$stok_barang=$barang_stock_akhir+$qty; 
				$this->db->query("UPDATE barang SET barang_stock_akhir ='$stok_barang' WHERE barang_id = '$barang_id'");
				$this->db->query("INSERT INTO history_stok_barang_masuk(barang_id,jumlah,stok_keluar,barang_stock_keluar) VALUES ('$barang_id',$stok_barang,$qty,$barang_stock_akhir)");
				$this->db->query("INSERT INTO history_stock_masuk(barang_id,stock) VALUES ('$barang_id','$qty')");
				 	$this->db->trans_complete();

	        if($this->db->trans_status()==true)
	        return true;
	        else
	        return false;

		}
	}
?>