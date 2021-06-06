<?php
	/**
	 * 
	 */
	class M_request_stock extends CI_Model
	{
		function get_request_stock(){
			$hasil=$this->db->query("SELECT a.*,b.user_nama, DATE_FORMAT(a.tanggal_request,'%d/%m/%Y %H:%i') AS tanggal_request FROM request_stok_barang a,user b WHERE a.status = 0 and b.user_id=a.id_admin ");
        	return $hasil;
		}
		function get_request_stock_suplier(){
			$hasil=$this->db->query("SELECT a.*,b.user_nama, DATE_FORMAT(a.tanggal_request,'%d/%m/%Y %H:%i') AS tanggal_request FROM request_stok_barang a,user b WHERE a.status = 2 and b.user_id=a.id_admin ");
        	return $hasil;
		}

		function get_request_stock_acc(){
			$hasil=$this->db->query("SELECT a.*,b.user_nama, DATE_FORMAT(a.tanggal_request,'%d/%m/%Y %H:%i') AS tanggal_request FROM request_stok_barang a,user b WHERE a.status = 1 and b.user_id=a.id_admin ");
        	return $hasil;
		}

		function get_request_stock_acc_filter($dari,$ke){
			$hasil=$this->db->query("SELECT a.*,b.user_nama, DATE_FORMAT(a.tanggal_request,'%d/%m/%Y %H:%i') AS tanggal_request FROM request_stok_barang a,user b WHERE a.status = 1 and b.user_id=a.id_admin and (DATE(tanggal_request) BETWEEN '$dari' AND '$ke')  ");
        	return $hasil;
		}

		function tambah_request_stock($nama_barang,$jumlah,$id_toko_dari,$id_toko_ke,$id,$tanggal_acc,$status){
			$x = $this->db->query("SELECT nama FROM toko WHERE id_toko = '$id_toko_dari'")->row_array();
			$nama_toko_dari=$x['nama'];

			$x = $this->db->query("SELECT nama FROM toko WHERE id_toko = '$id_toko_ke'")->row_array();
			$nama_toko_ke=$x['nama'];


			$hasil= $this->db->query("INSERT INTO request_stok_barang(nama_barang,id_toko_dari,nama_toko_dari,id_toko_ke,nama_toko_ke,id_admin,tanggal_acc,status,jumlah) VALUES ('$nama_barang','$id_toko_dari','$nama_toko_dari','$id_toko_ke','$nama_toko_ke','$id','$tanggal_acc','$status','$jumlah')");

			$x = $this->db->query("SELECT barang_stock_akhir,barang_id FROM barang WHERE barang_nama = '$nama_barang' and id_toko='$id_toko_dari'")->row_array();
			$barang_stock_akhir=$x['barang_stock_akhir'];
			$stok_barang=$barang_stock_akhir-$jumlah; 
			$barang_id=$x['barang_id'];
				$this->db->query("UPDATE barang SET barang_stock_akhir ='$stok_barang' WHERE barang_id = '$barang_id'");
				$this->db->query("INSERT INTO history_stok_barang_keluar(barang_id,jumlah,stok_keluar,barang_stock_keluar,id_toko) VALUES ('$barang_id','$stok_barang','$jumlah','$barang_stock_akhir','$id_toko_dari')");
				$this->db->query("INSERT INTO history_stock_barang(barang_id,stock_berkurang,id_toko) VALUES ('$barang_id','$jumlah','$id_toko_dari')");


			$x = $this->db->query("SELECT barang_stock_akhir,barang_id FROM barang WHERE barang_nama = '$nama_barang' and id_toko='$id_toko_ke'")->row_array();
			$barang_stock_akhir=$x['barang_stock_akhir'];
			$stok_barang=$barang_stock_akhir+$jumlah; 
			$barang_id=$x['barang_id'];
				$this->db->query("UPDATE barang SET barang_stock_akhir ='$stok_barang' WHERE barang_id = '$barang_id'");
				$this->db->query("INSERT INTO history_stok_barang_masuk(barang_id,jumlah,stok_keluar,barang_stock_keluar,id_toko) VALUES ('$barang_id','$stok_barang','$jumlah','$barang_stock_akhir','$id_toko_ke')");
				$this->db->query("INSERT INTO history_stock_masuk(barang_id,stock,id_toko) VALUES ('$barang_id','$jumlah','$id_toko_ke')");


        	return $hasil;
		}

		function acc_request_stock($nama_barang,$jumlah,$id_toko_dari,$id_toko_ke,$id,$tanggal_acc,$status,$id_request){
			$x = $this->db->query("SELECT nama FROM toko WHERE id_toko = '$id_toko_dari'")->row_array();
			$nama_toko_dari=$x['nama'];

			$x = $this->db->query("SELECT nama FROM toko WHERE id_toko = '$id_toko_ke'")->row_array();
			$nama_toko_ke=$x['nama'];
			$tanggal_acc = date("Y-m-d");
			$this->db->query("UPDATE request_stok_barang SET status ='1',tanggal_acc ='$tanggal_acc' WHERE id_request = '$id_request'");
			

			$x = $this->db->query("SELECT barang_stock_akhir,barang_id FROM barang WHERE barang_nama = '$nama_barang' and id_toko='$id_toko_dari'")->row_array();
			$barang_stock_akhir=$x['barang_stock_akhir'];
			$stok_barang=$barang_stock_akhir-$jumlah; 
			$barang_id=$x['barang_id'];
				$this->db->query("UPDATE barang SET barang_stock_akhir ='$stok_barang' WHERE barang_id = '$barang_id'");
				$this->db->query("INSERT INTO history_stok_barang_keluar(barang_id,jumlah,stok_keluar,barang_stock_keluar,id_toko) VALUES ('$barang_id','$stok_barang','$jumlah','$barang_stock_akhir','$id_toko_dari')");
				$this->db->query("INSERT INTO history_stock_barang(barang_id,stock_berkurang,id_toko) VALUES ('$barang_id','$jumlah','$id_toko_dari')");


			$x = $this->db->query("SELECT barang_stock_akhir,barang_id FROM barang WHERE barang_nama = '$nama_barang' and id_toko='$id_toko_ke'")->row_array();
			$barang_stock_akhir=$x['barang_stock_akhir'];
			$stok_barang=$barang_stock_akhir+$jumlah; 
			$barang_id=$x['barang_id'];
				$this->db->query("UPDATE barang SET barang_stock_akhir ='$stok_barang' WHERE barang_id = '$barang_id'");
				$this->db->query("INSERT INTO history_stok_barang_masuk(barang_id,jumlah,stok_keluar,barang_stock_keluar,id_toko) VALUES ('$barang_id','$stok_barang','$jumlah','$barang_stock_akhir','$id_toko_ke')");
				$this->db->query("INSERT INTO history_stock_masuk(barang_id,stock,id_toko) VALUES ('$barang_id','$jumlah','$id_toko_ke')");


        	return $hasil;
		}

		function acc_suplier_stock($nama_barang,$jumlah,$id_toko_dari,$id_toko_ke,$id,$tanggal_acc,$status,$id_request){
			$tanggal_acc = date("Y-m-d");

			$this->db->query("UPDATE request_stok_barang SET status ='1',tanggal_acc ='$tanggal_acc' WHERE id_request = '$id_request'");
			
			$x = $this->db->query("SELECT barang_stock_akhir,barang_id FROM barang WHERE barang_nama = '$nama_barang' and id_toko='$id_toko_ke'")->row_array();
			$barang_stock_akhir=$x['barang_stock_akhir'];
			$stok_barang=$barang_stock_akhir+$jumlah; 
			$barang_id=$x['barang_id'];
				$this->db->query("UPDATE barang SET barang_stock_akhir ='$stok_barang' WHERE barang_id = '$barang_id'");
				$this->db->query("INSERT INTO history_stok_barang_masuk(barang_id,jumlah,stok_keluar,barang_stock_keluar,id_toko) VALUES ('$barang_id','$stok_barang','$jumlah','$barang_stock_akhir','$id_toko_ke')");
				$this->db->query("INSERT INTO history_stock_masuk(barang_id,stock,id_toko) VALUES ('$barang_id','$jumlah','$id_toko_ke')");


        	return $hasil;
		}


		function tambah_suplier_stock($nama_barang,$jumlah,$id_toko_dari,$id_toko_ke,$id,$tanggal_acc,$status,$suplier){
			$x = $this->db->query("SELECT nama FROM toko WHERE id_toko = '$id_toko_dari'")->row_array();
			$nama_toko_dari=$x['nama'];

			$x = $this->db->query("SELECT nama FROM toko WHERE id_toko = '$id_toko_ke'")->row_array();
			$nama_toko_ke=$x['nama'];


			$hasil= $this->db->query("INSERT INTO request_stok_barang(nama_barang,id_toko_dari,nama_toko_dari,id_toko_ke,nama_toko_ke,id_admin,tanggal_acc,status,jumlah,suplier) VALUES ('$nama_barang','$id_toko_dari','$nama_toko_dari','$id_toko_ke','$nama_toko_ke','$id','$tanggal_acc','$status','$jumlah','$suplier')");


			$x = $this->db->query("SELECT barang_stock_akhir,barang_id FROM barang WHERE barang_nama = '$nama_barang' and id_toko='$id_toko_ke'")->row_array();
			$barang_stock_akhir=$x['barang_stock_akhir'];
			$stok_barang=$barang_stock_akhir+$jumlah; 
			$barang_id=$x['barang_id'];
				$this->db->query("UPDATE barang SET barang_stock_akhir ='$stok_barang' WHERE barang_id = '$barang_id'");
				$this->db->query("INSERT INTO history_stok_barang_masuk(barang_id,jumlah,stok_keluar,barang_stock_keluar,id_toko) VALUES ('$barang_id','$stok_barang','$jumlah','$barang_stock_akhir','$id_toko_ke')");
				$this->db->query("INSERT INTO history_stock_masuk(barang_id,stock,id_toko) VALUES ('$barang_id','$jumlah','$id_toko_ke')");


        	return $hasil;
		}

		
	}
?>