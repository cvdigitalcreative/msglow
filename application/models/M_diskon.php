<?php
	/**
	 * 
	 */
	class M_diskon extends CI_Model
	{

		function get_potongan_harga($id){
			$hasil=$this->db->query("SELECT potongan_harga  from diskon_all where id='$id'");
        	return $hasil;
		}

		function get_potongan_harga_barang($id_barang){
			date_default_timezone_set("Asia/Jakarta");
        	$cur_date = date("Y-m-d");
			$hasil=$this->db->query("SELECT potongan_harga  from diskon where barang_id='$id_barang' and '$cur_date' BETWEEN diskon.tanggal_mulai AND diskon.tanggal_berakhir ");
        	return $hasil;
		}

		function getDataDiskon_pemesanan(){
			$hasil=$this->db->query("SELECT *  from diskon_all where id!=1");
        	return $hasil;
		}
		function saveDiskon_pemesanan($nama_diskon,$potongan_harga){
			
			$this->db->trans_start();
			$this->db->query("INSERT INTO diskon_all(nama_diskon,potongan_harga) VALUES ('$nama_diskon','$potongan_harga')");
			
	      	$this->db->trans_complete();
	        if($this->db->trans_status()==true)
	        return true;
	        else
	        return false;
		}

		function updateDiskon_pemesanan($diskon_id,$nama_diskon,$potongan_harga){
			$this->db->trans_start();
			$this->db->query("UPDATE diskon_all SET nama_diskon = '$nama_diskon' WHERE id='$diskon_id'");
			$this->db->query("UPDATE diskon_all SET potongan_harga = '$potongan_harga' WHERE id='$diskon_id'");
	      	$this->db->trans_complete();
	        if($this->db->trans_status()==true)
	        return true;
	        else
	        return false;
		}
		function hapusDiskon_pemesanan($diskon_id){
			$this->db->trans_start();
			$this->db->query("DELETE FROM diskon_all WHERE id='$diskon_id'");
	      	$this->db->trans_complete();
	        if($this->db->trans_status()==true)
	        return true;
	        else
	        return false;
		}


		function getDataDiskon(){
			$hasil=$this->db->query("SELECT a.diskon_id,a.potongan_harga,a.barang_id,b.barang_nama,DATE_FORMAT(a.tanggal_mulai,'%d/%m/%Y') AS mulai_diskon ,DATE_FORMAT(a.tanggal_berakhir,'%d/%m/%Y') AS akhir_diskon FROM diskon a, barang b WHERE a.barang_id = b.barang_id");
        return $hasil;
		}	
		
		function saveDiskon($barang_id,$diskon,$tanggal_mulai,$tanggal_berakhir){
			date_default_timezone_set("Asia/Jakarta");
        	$tanggal = date("Y-m-d");
			$this->db->trans_start();
			$this->db->query("INSERT INTO diskon(barang_id,potongan_harga,tanggal_mulai,tanggal_berakhir) VALUES ('$barang_id','$diskon','$tanggal_mulai','$tanggal_berakhir')");
			
	      	$this->db->trans_complete();
	        if($this->db->trans_status()==true)
	        return true;
	        else
	        return false;
		}

		function updateDiskon($diskon_id,$barang_id,$diskon,$tanggal_mulai,$tanggal_berakhir){
			$this->db->trans_start();
			$this->db->query("UPDATE diskon SET potongan_harga = '$diskon' WHERE diskon_id='$diskon_id'");
			$this->db->query("UPDATE diskon SET tanggal_mulai = '$tanggal_mulai' WHERE diskon_id='$diskon_id'");
			$this->db->query("UPDATE diskon SET tanggal_berakhir = '$tanggal_berakhir' WHERE diskon_id='$diskon_id'");
	      	$this->db->trans_complete();
	        if($this->db->trans_status()==true)
	        return true;
	        else
	        return false;
		}

		function hapusDiskon($diskon_id,$barang_id){
			$this->db->trans_start();
			$this->db->query("DELETE FROM diskon WHERE diskon_id='$diskon_id'");
	      	$this->db->trans_complete();
	        if($this->db->trans_status()==true)
	        return true;
	        else
	        return false;
		}

		function hapusDiskonT($tanggal){
			$this->db->trans_start();
			$a = $this->db->query("SELECT * FROM diskon WHERE diskon_tanggal = '$tanggal'");
			foreach ($a->result_array() as $i) {
				$barang_id = $i['barang_id'];
				$diskon_id = $i['diskon_id'];
				$z = $this->db->query("SELECT * FROM diskon WHERE diskon_id = '$diskon_id'")->row_array();
				$diskon_lama = $z['potongan_harga'];
				$this->db->query("UPDATE barang_non_reseller SET bnr_harga = bnr_harga + '$diskon_lama' WHERE barang_id='$barang_id'");
				$this->db->query("DELETE FROM diskon WHERE diskon_id='$diskon_id'");
			}
	      	$this->db->trans_complete();
	        if($this->db->trans_status()==true)
	        return true;
	        else
	        return false;
		}

	}
?>