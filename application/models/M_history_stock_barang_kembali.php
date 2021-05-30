<?php
	/**
	 * 
	 */
	class M_history_stock_barang_kembali extends CI_Model
	{
		function getHistoryStock_all(){
			$hasil=$this->db->query("SELECT barang.barang_nama,history_stok_barang_kembali.barang_id,(jumlah) as stok_akhir_hari ,sum(stok_keluar) as total_barang_masuk,(jumlah-sum(stok_keluar)) as stok_awal_hari,DATE(date) as tanggal FROM `history_stok_barang_kembali`,barang where history_stok_barang_kembali.barang_id=barang.barang_id and date>=DATE_ADD(NOW(), INTERVAL -3 MONTH)   GROUP by DATE(date),history_stok_barang_kembali.barang_id  
				ORDER BY `history_stok_barang_kembali`.`date`  Desc ");
        	return $hasil;
		}
		function getHistoryStock_all_by_tanggal($id_toko){
			$tanggal = date("Y-m-d");
			$hasil=$this->db->query("SELECT barang.barang_nama,history_stok_barang_kembali.barang_id,(jumlah) as stok_akhir_hari ,sum(stok_keluar) as total_barang_masuk,(jumlah-sum(stok_keluar)) as stok_awal_hari,DATE(date) as tanggal FROM  `history_stok_barang_kembali`,barang where history_stok_barang_kembali.barang_id=barang.barang_id and DATE(date)='$tanggal' and history_stok_barang_kembali.id_toko='$id_toko' GROUP by DATE(date),history_stok_barang_kembali.barang_id  
				ORDER BY `history_stok_barang_kembali`.`date`  Desc ");
        	return $hasil;
		}
		function getHistoryStock_all_by_tanggal_filter($dari,$ke){
			$tanggal = date("Y-m-d");
			$hasil=$this->db->query("SELECT barang.barang_nama,history_stok_barang_kembali.barang_id,(jumlah) as stok_akhir_hari ,sum(stok_keluar) as total_barang_masuk,(jumlah-sum(stok_keluar)) as stok_awal_hari,DATE(date) as tanggal FROM `history_stok_barang_kembali`,barang where history_stok_barang_kembali.barang_id=barang.barang_id and (DATE(date) BETWEEN '$dari' AND '$ke')  GROUP by DATE(date),history_stok_barang_kembali.barang_id  
				ORDER BY `history_stok_barang_kembali`.`date`  ASC ");
        	return $hasil;
		}




	}
?>