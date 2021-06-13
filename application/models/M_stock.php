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

		function update_stok($barang_nama, $qty,$id_toko){
			$x = $this->db->query("SELECT barang_stock_akhir,barang_id FROM barang WHERE barang_nama = '$barang_nama' and id_toko='$id_toko'")->row_array();
			$barang_stock_akhir=$x['barang_stock_akhir'];
			$stok_barang=$barang_stock_akhir+$qty; 
			$barang_id=$x['barang_id'];
				$this->db->query("UPDATE barang SET barang_stock_akhir ='$stok_barang' WHERE barang_id = '$barang_id'");
				$this->db->query("INSERT INTO history_stok_barang_masuk(barang_id,jumlah,stok_keluar,barang_stock_keluar,id_toko) VALUES ('$barang_id','$stok_barang','$qty','$barang_stock_akhir','$id_toko')");
				$this->db->query("INSERT INTO history_stock_masuk(barang_id,stock,id_toko) VALUES ('$barang_id','$qty','$id_toko')");
				 	$this->db->trans_complete();

	        if($this->db->trans_status()==true)
	        return true;
	        else
	        return false;

		}
	}
?>