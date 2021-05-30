<?php
	/**
	 * 
	 */
	class M_barang_new extends CI_Model
	{
		function get_all_barang_by_toko($id_toko){
			$hasil=$this->db->query("SELECT a.*,DATE_FORMAT(barang_tanggal,'%d/%m/%Y %H:%i') AS tanggal FROM barang a WHERE  id_toko='$id_toko' ORDER BY barang_nama ");

        	return $hasil;
		}
		function getHistoryStock($barang_id,$id_toko){
			$hasil=$this->db->query("SELECT a.lb_id,c.pemesanan_nama,a.lb_qty as stock_berkurang,a.barang_id,b.barang_nama,DATE_FORMAT(a.lb_tanggal,'%d/%m/%Y %H:%i') AS tanggal FROM list_barang a,barang b, pemesanan c WHERE a.barang_id = '$barang_id' and  a.id_toko = '$id_toko' AND a.barang_id = b.barang_id AND a.pemesanan_id = c.pemesanan_id  ORDER BY `a`.`lb_id` DESC");
        	return $hasil;
		}
		function get_barang_by_level_toko($level,$id_toko){
			$hasil=$this->db->query("SELECT a.*,DATE_FORMAT(barang_tanggal,'%d/%m/%Y %H:%i') AS tanggal FROM barang a WHERE  id_toko='$id_toko' and barang_stock_akhir>0 ORDER BY barang_nama ");

        	return $hasil;
		}
		function get_barang_by_id($id,$id_toko,$level,$qty){
			if($level==1){
				$hasil=$this->db->query("SELECT a.barang_nama,b.br_harga as harga_jual,a.barang_harga_modal as harga_modal FROM barang a,barang_reseller b WHERE  a.id_toko='$id_toko' and b.br_kuantitas='$qty' and a.barang_id=b.barang_id   ");
			}else if($level==2){
				$hasil=$this->db->query("SELECT a.barang_nama,b.bnr_harga as harga_jual,a.barang_harga_modal as harga_modal FROM barang a,barang_non_reseller b WHERE  a.id_toko='$id_toko'  and a.barang_id=b.barang_id   ");
			}
        	return $hasil;
		}
		function get_kategori_id_barang($id_barang,$id_toko){
			$hasil=$this->db->query("SELECT id_kategori FROM barang  WHERE barang_id = '$id_barang' and id_toko='$id_toko' ")->result_array();
        	return $hasil;
		}
		function save_list_barang($pemesanan_id,$qty,$barang_id,$lvl,$id_toko,$ktg_qty){
		   
		        $this->db->trans_start();
				$x = $this->db->query("SELECT barang_stock_akhir FROM barang WHERE barang_id = '$barang_id'")->row_array();
				$barang_stock_akhir=$x['barang_stock_akhir'];
				$stok_barang=$barang_stock_akhir-$qty; 

				$this->db->query("INSERT INTO list_barang(pemesanan_id,lb_qty,barang_id,lb_lvl,id_toko,ktg_qty) VALUES ('$pemesanan_id','$qty','$barang_id','$lvl','$id_toko','$ktg_qty')");
				


				$this->db->query("INSERT INTO history_stock_barang(pemesanan_id,barang_id,stock_berkurang,lvl,id_toko) VALUES ('$pemesanan_id','$barang_id','$qty','$lvl','$id_toko')");

				$this->db->query("INSERT INTO history_stok_barang_keluar(barang_id,jumlah,stok_keluar,barang_stock_keluar,id_toko) VALUES ('$barang_id',$stok_barang,$qty,$barang_stock_akhir,'$id_toko')");

				$this->db->query("UPDATE barang SET barang_stock_akhir ='$stok_barang' WHERE barang_id = '$barang_id' and id_toko='$id_toko' ");

	      	    $this->db->trans_complete(); 
	      	    if($this->db->trans_status()==true)
	      	    {

    	        	return true;
	      	    }
    	        else{
    	        	return false;
    	        }
		    
			
	       
		}

	}
?>
