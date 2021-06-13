<?php 

	/**
	 * 
	 */
	class M_list_barang extends CI_Model
	{
		
		function save_list_barang($pemesanan_id,$qty,$barang_id,$lvl){
		   
		    if($pemesanan_id!=0)
		    {
		        $this->db->trans_start();
					$x = $this->db->query("SELECT barang_stock_akhir FROM barang WHERE barang_id = '$barang_id'")->row_array();
				// if($cek->num_rows > 0){

				// }
				$barang_stock_akhir=$x['barang_stock_akhir'];
				$stok_barang=$barang_stock_akhir-$qty; 
				
					$this->db->query("INSERT INTO list_barang(pemesanan_id,lb_qty,barang_id,lb_lvl) VALUES ('$pemesanan_id','$qty','$barang_id','$lvl')");
				
				
				$this->db->query("UPDATE barang SET barang_stock_akhir ='$stok_barang' WHERE barang_id = '$barang_id'");
				$this->db->query("INSERT INTO history_stock_barang(pemesanan_id,barang_id,stock_berkurang,lvl) VALUES ('$pemesanan_id','$barang_id','$qty','$lvl')");
				$this->db->query("INSERT INTO history_stok_barang_keluar(barang_id,jumlah,stok_keluar,barang_stock_keluar) VALUES ('$barang_id',$stok_barang,$qty,$barang_stock_akhir)");
				
	      	    $this->db->trans_complete(); 
	      	     if($this->db->trans_status()==true)
    	        return true;
    	        else
    	        return false;
		    }else{
		       return false; 
		    }
			
	       
		}

		function save_lists_barang($pemesanan_id,$qty,$barang_id,$lvl,$ktg_qty){
		
			 if($pemesanan_id!=0)
		    {
		        	$this->db->trans_start();
				$x = $this->db->query("SELECT barang_stock_akhir FROM barang WHERE barang_id = '$barang_id'")->row_array();
				// if($cek->num_rows > 0){

				// }
				$barang_stock_akhir=$x['barang_stock_akhir'];
				$stok_barang=$barang_stock_akhir-$qty; 
				$this->db->query("INSERT INTO list_barang(pemesanan_id,lb_qty,barang_id,lb_lvl,ktg_qty) VALUES ('$pemesanan_id','$qty','$barang_id','$lvl','$ktg_qty')");
				$this->db->query("UPDATE barang SET barang_stock_akhir ='	$stok_barang' WHERE barang_id = '$barang_id'");
				$this->db->query("INSERT INTO history_stock_barang(pemesanan_id,barang_id,stock_berkurang,lvl) VALUES ('$pemesanan_id','$barang_id','$qty','$lvl')");
				$this->db->query("INSERT INTO history_stok_barang_keluar(barang_id,jumlah,stok_keluar,barang_stock_keluar) VALUES ('$barang_id',$stok_barang,$qty,$barang_stock_akhir)");
				
	      	$this->db->trans_complete();
	        if($this->db->trans_status()==true)
	        return true;
	        else
	        return false;
		    }else{
		         return false;
		    }
		}

		function hapus_list_barang($pemesanan_id,$lb_id,$qty,$barang_id){
			$this->db->trans_start();
				$this->db->query("DELETE FROM list_barang WHERE lb_id='$lb_id'");
				$x = $this->db->query("SELECT barang_stock_akhir FROM barang WHERE barang_id = '$barang_id'")->row_array();
				// if($cek->num_rows > 0){

				// }
				$barang_stock_akhir=$x['barang_stock_akhir'];
					$stok_barang=$barang_stock_akhir+$qty; 
				$this->db->query("UPDATE barang SET barang_stock_akhir ='$stok_barang' WHERE barang_id = '$barang_id'");
				$this->db->query("DELETE FROM history_stock_barang WHERE $pemesanan_id='$pemesanan_id' AND barang_id = '$barang_id'");
				$this->db->query("INSERT INTO history_stock_masuk(barang_id,stock) VALUES ('$barang_id','$qty')");
				$this->db->query("INSERT INTO history_stok_barang_kembali(barang_id,jumlah,stok_keluar,barang_stock_keluar) VALUES ('$barang_id',$stok_barang,$qty,$barang_stock_akhir)");
	      	$this->db->trans_complete();
	        if($this->db->trans_status()==true)
	        return true;
	        else
	        return false;
		}

		function getLBNRbyid($pemesanan_id){
			$hasil=$this->db->query("SELECT a.lb_id,a.pemesanan_id,a.lb_qty,a.barang_id,b.pemesanan_nama,c.barang_nama,d.bnr_harga, a.lb_qty * d.bnr_harga AS total FROM list_barang a, pemesanan b, barang c, barang_non_reseller d WHERE a.pemesanan_id = '$pemesanan_id' AND lb_lvl =2 AND a.pemesanan_id = b.pemesanan_id AND a.barang_id = c.barang_id AND a.barang_id = d.barang_id ORDER BY lb_id");
        	return $hasil;
		}

		function SUMLBNR($pemesanan_id){
			$hasil=$this->db->query("SELECT SUM(a.lb_qty * d.bnr_harga) AS total_keseluruhan FROM list_barang a, pemesanan b, barang c, barang_non_reseller d WHERE a.pemesanan_id = '$pemesanan_id' AND a.pemesanan_id = b.pemesanan_id AND a.barang_id = c.barang_id AND a.barang_id = d.barang_id ORDER BY lb_id");
        	return $hasil;
		}


		function getLBRbyid($pemesanan_id){
			// $x = $this->db->query("SELECT SUM(lb_qty) AS jumlah_barang FROM list_barang WHERE pemesanan_id = '$pemesanan_id'")->row_array();
			// $jumlah = $x['jumlah_barang'];

			$hasil=$this->db->query("SELECT a.lb_id,a.pemesanan_id,a.lb_qty,a.barang_id,b.pemesanan_nama,c.barang_nama,d.br_harga,a.lb_qty * d.br_harga AS total FROM list_barang a, pemesanan b, barang c, barang_reseller d WHERE a.pemesanan_id = '$pemesanan_id' AND a.ktg_qty = d.br_kuantitas AND a.pemesanan_id = b.pemesanan_id AND a.barang_id = c.barang_id AND a.barang_id = d.barang_id ORDER BY lb_id");
        	return $hasil;
		}

		function SUMLBR($pemesanan_id){
			$x = $this->db->query("SELECT SUM(lb_qty) AS jumlah_barang FROM list_barang WHERE pemesanan_id = '$pemesanan_id'")->row_array();
			$jumlah = $x['jumlah_barang'];

			$hasil=$this->db->query("SELECT SUM(a.lb_qty * d.br_harga) AS total_keseluruhan FROM list_barang a, pemesanan b, barang c, barang_reseller d WHERE a.pemesanan_id = '$pemesanan_id' AND '$jumlah' = d.br_kuantitas AND a.pemesanan_id = b.pemesanan_id AND a.barang_id = c.barang_id AND a.barang_id = d.barang_id ORDER BY lb_id ");
        	return $hasil;
		}
	}
?>