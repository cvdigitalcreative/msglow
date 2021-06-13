<?php
	/**
	 * 
	 */
	class M_history_stock_barang_masuk extends CI_Model
	{
		function getHistoryStock_all(){
			$hasil=$this->db->query("SELECT barang.barang_nama,history_stok_barang_masuk.barang_id,(jumlah) as stok_akhir_hari ,sum(stok_keluar) as total_barang_masuk,(jumlah-sum(stok_keluar)) as stok_awal_hari,DATE(date) as tanggal,toko.nama as nama_toko FROM `history_stok_barang_masuk`,barang,toko where history_stok_barang_masuk.barang_id=barang.barang_id and history_stok_barang_masuk.id_toko=toko.id_toko and date>=DATE_ADD(NOW(), INTERVAL -3 MONTH)   GROUP by DATE(date),history_stok_barang_masuk.barang_id  
				ORDER BY `history_stok_barang_masuk`.`date`  Desc ");
        	return $hasil;
		}
		function getHistoryStock_all_by_tanggal(){
			$tanggal = date("Y-m-d");
			$hasil=$this->db->query("SELECT barang.barang_nama,history_stok_barang_masuk.barang_id,(jumlah) as stok_akhir_hari ,sum(stok_keluar) as total_barang_masuk,(jumlah-sum(stok_keluar)) as stok_awal_hari,DATE(date) as tanggal FROM  `history_stok_barang_masuk`,barang where history_stok_barang_masuk.barang_id=barang.barang_id and DATE(date)='$tanggal'  GROUP by DATE(date),history_stok_barang_masuk.barang_id  
				ORDER BY `history_stok_barang_masuk`.`date`  Desc ");
        	return $hasil;
		}
		function getHistoryStock_all_by_tanggal_filter($dari,$ke){
			$tanggal = date("Y-m-d");
			$hasil=$this->db->query("SELECT barang.barang_nama,history_stok_barang_masuk.barang_id,(jumlah) as stok_akhir_hari ,sum(stok_keluar) as total_barang_masuk,(jumlah-sum(stok_keluar)) as stok_awal_hari,DATE(date) as tanggal FROM `history_stok_barang_masuk`,barang where history_stok_barang_masuk.barang_id=barang.barang_id and (DATE(date) BETWEEN '$dari' AND '$ke')  GROUP by DATE(date),history_stok_barang_masuk.barang_id  
				ORDER BY `history_stok_barang_masuk`.`date`  ASC ");
        	return $hasil;
		}

		function getHistoryStock_all_filter($dari,$ke,$id_toko){
			
			if($id_toko=='0'){
				$hasil=$this->db->query("SELECT barang.barang_nama,history_stok_barang_masuk.barang_id,(jumlah) as stok_akhir_hari ,sum(stok_keluar) as total_barang_masuk,(jumlah-sum(stok_keluar)) as stok_awal_hari,DATE(date) as tanggal,toko.nama as nama_toko FROM `history_stok_barang_masuk`,barang,toko  where history_stok_barang_masuk.barang_id=barang.barang_id and  (DATE(date) BETWEEN '$dari' AND '$ke') and history_stok_barang_masuk.id_toko=toko.id_toko  GROUP by DATE(date),history_stok_barang_masuk.barang_id  
				ORDER BY `history_stok_barang_masuk`.`date`  Desc ");
				return $hasil;
			}else{
				$hasil=$this->db->query("SELECT barang.barang_nama,history_stok_barang_masuk.barang_id,(jumlah) as stok_akhir_hari ,sum(stok_keluar) as total_barang_masuk,(jumlah-sum(stok_keluar)) as stok_awal_hari,DATE(date) as tanggal,toko.nama as nama_toko FROM `history_stok_barang_masuk`,barang,toko  where history_stok_barang_masuk.barang_id=barang.barang_id and  (DATE(date) BETWEEN '$dari' AND '$ke') and history_stok_barang_masuk.id_toko='$id_toko'  GROUP by DATE(date),history_stok_barang_masuk.barang_id  
				ORDER BY `history_stok_barang_masuk`.`date`  Desc ");
				return $hasil;
			}
			
        	
		}




	}
?>