<?php
	/**
	 * 
	 */
	class M_history_stock_barang_keluar extends CI_Model
	{
		function getHistoryStock_all(){
			$hasil=$this->db->query("SELECT barang.barang_nama,history_stok_barang_keluar.barang_id,barang_stock_keluar as stok_awal_hari,sum(stok_keluar) as total_barang_keluar,(barang_stock_keluar-sum(stok_keluar)) as stok_akhir_hari,DATE(date) as tanggal FROM `history_stok_barang_keluar`,barang where history_stok_barang_keluar.barang_id=barang.barang_id  GROUP by DATE(date),history_stok_barang_keluar.barang_id  
				ORDER BY `history_stok_barang_keluar`.`date`  Desc ");
        	return $hasil;
		}
		function getHistoryStock_all_by_tanggal(){
			$tanggal = date("Y-m-d");
			$hasil=$this->db->query("SELECT barang.barang_nama,history_stok_barang_keluar.barang_id,barang_stock_keluar as stok_awal_hari,sum(stok_keluar) as total_barang_keluar,(barang_stock_keluar-sum(stok_keluar)) as stok_akhir_hari,DATE(date) as tanggal FROM `history_stok_barang_keluar`,barang where history_stok_barang_keluar.barang_id=barang.barang_id and DATE(date)='$tanggal'  GROUP by DATE(date),history_stok_barang_keluar.barang_id  
				ORDER BY `history_stok_barang_keluar`.`date`  Desc ");
        	return $hasil;
		}
		function getHistoryStock_all_by_tanggal_filter($dari,$ke){
			$tanggal = date("Y-m-d");
			$hasil=$this->db->query("SELECT barang.barang_nama,history_stok_barang_keluar.barang_id,barang_stock_keluar as stok_awal_hari,sum(stok_keluar) as total_barang_keluar,(barang_stock_keluar-sum(stok_keluar)) as stok_akhir_hari FROM `history_stok_barang_keluar`,barang where history_stok_barang_keluar.barang_id=barang.barang_id and  (DATE(date) BETWEEN '$dari' AND '$ke') group by history_stok_barang_keluar.barang_id");
			

        	return $hasil;
		}




	}
?>