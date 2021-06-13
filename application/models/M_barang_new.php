<?php
	/**
	 * 
	 */
	class M_barang_new extends CI_Model
	{
		function update_barang_noImage($barang_id,$nama_barang, $stock=0, $barang_harga_modal,$id_kategori){
			$hsl = $this->db->query("UPDATE barang SET barang_nama='$nama_barang', barang_stock_awal=barang_stock_awal + '$stock',barang_stock_akhir=barang_stock_akhir + '$stock',barang_harga_modal='$barang_harga_modal',id_kategori='$id_kategori' WHERE barang_id='$barang_id'");
     		return $hsl;
		}
		function update_barangImage($barang_id,$nama_barang, $stock=0, $barang_harga_modal, $barang_foto,$id_kategori){
			$hsl = $this->db->query("UPDATE barang SET barang_nama='$nama_barang', barang_stock_awal=barang_stock_awal + '$stock',barang_stock_akhir=barang_stock_akhir + '$stock',barang_harga_modal='$barang_harga_modal',barang_foto='$barang_foto',id_kategori='$id_kategori' WHERE barang_id='$barang_id'");
     		return $hsl;
		}
		function get_all_barang_by_toko($id_toko){
			$hasil=$this->db->query("SELECT a.*,DATE_FORMAT(barang_tanggal,'%d/%m/%Y %H:%i') AS tanggal FROM barang a WHERE  id_toko='$id_toko' ORDER BY barang_nama ");

        	return $hasil;
		}
		function get_all_barang_customer(){
			
			$hasil=$this->db->query("SELECT a.*,b.*, c.nama_kategori,DATE_FORMAT(barang_tanggal,'%d/%m/%Y %H:%i') AS tanggal,d.nama as nama_toko,d.id_toko FROM barang a, barang_non_reseller b,kategori c , toko d WHERE a.barang_id = b.barang_id and a.id_kategori=c.id_kategori and  a.id_toko=d.id_toko  ORDER BY barang_nama asc");
        	return $hasil;
		}
		function get_all_barang_customer_filter_toko($id_toko){
			if($id_toko==0){
				$hasil=$this->db->query("SELECT a.*,b.*, c.nama_kategori,DATE_FORMAT(barang_tanggal,'%d/%m/%Y %H:%i') AS tanggal,d.nama as nama_toko,d.id_toko FROM barang a, barang_non_reseller b,kategori c , toko d WHERE a.barang_id = b.barang_id and a.id_kategori=c.id_kategori and  a.id_toko=d.id_toko  ORDER BY barang_nama asc");
			}else{
				$hasil=$this->db->query("SELECT a.*,b.*, c.nama_kategori,DATE_FORMAT(barang_tanggal,'%d/%m/%Y %H:%i') AS tanggal,d.nama as nama_toko,d.id_toko FROM barang a, barang_non_reseller b,kategori c , toko d WHERE a.barang_id = b.barang_id and a.id_kategori=c.id_kategori and  a.id_toko=d.id_toko and a.id_toko='$id_toko'  ORDER BY barang_nama asc");
			}
			
        	return $hasil;
		}

		
		function get_all_barang_reseller(){
			
			$hasil=$this->db->query("SELECT barang.*,DATE_FORMAT(barang_tanggal,'%d/%m/%Y %H:%i') AS tanggal,d.nama as nama_toko,d.id_toko FROM barang,toko d where barang.id_toko=d.id_toko and barang.id_toko='1' ORDER BY barang_nama");
        	return $hasil;
		}

		function savebarangreseller($barang_nama, $kuantitas, $harga){
			$id=$this->db->query("SELECT barang_id FROM barang where barang_nama='$barang_nama'")->result_array();

			foreach($id as $i){
				

				$id_barang=uniqid();
				$barang_id=$i['barang_id'];
				 $this->db->query("INSERT INTO barang_reseller(barang_id,br_kuantitas,br_harga) VALUES ('$barang_id', '$kuantitas', '$harga')");
			}
		
        	
		}

		function getHistoryStock($barang_id,$id_toko){
			$hasil=$this->db->query("SELECT a.lb_id,c.pemesanan_nama,a.lb_qty as stock_berkurang,a.barang_id,b.barang_nama,DATE_FORMAT(a.lb_tanggal,'%d/%m/%Y %H:%i') AS tanggal FROM list_barang a,barang b, pemesanan c WHERE a.barang_id = '$barang_id' and  a.id_toko = '$id_toko' AND a.barang_id = b.barang_id AND a.pemesanan_id = c.pemesanan_id  ORDER BY `a`.`lb_id` DESC");
        	return $hasil;
		}

		function get_barang(){
			$hasil=$this->db->query("SELECT a.*,DATE_FORMAT(barang_tanggal,'%d/%m/%Y %H:%i') AS tanggal FROM barang a WHERE barang_level = 2 and id_toko=1 order by a.barang_nama asc ");
        	return $hasil;
		}

		function get_barang_by_level_toko($level,$id_toko){
			$hasil=$this->db->query("SELECT a.*,DATE_FORMAT(barang_tanggal,'%d/%m/%Y %H:%i') AS tanggal FROM barang a WHERE  id_toko='$id_toko' and barang_stock_akhir>0 ORDER BY barang_nama ");

        	return $hasil;
		}
		function get_barang_by_id($id,$id_toko,$level,$qty){
			if($level==1){
				$hasil=$this->db->query("SELECT a.barang_nama,b.br_harga as harga_jual,a.barang_harga_modal as harga_modal FROM barang a,barang_reseller b WHERE  a.id_toko='$id_toko' and b.br_kuantitas='$qty' and a.barang_id=b.barang_id  and a.barang_id='$id'  ");
			}else if($level==2){
				$hasil=$this->db->query("SELECT a.barang_nama,b.bnr_harga as harga_jual,a.barang_harga_modal as harga_modal FROM barang a,barang_non_reseller b WHERE  a.id_toko='$id_toko'  and a.barang_id=b.barang_id  and a.barang_id='$id'    ");
			}
        	return $hasil;
		}
		function get_kategori_id_barang($id_barang,$id_toko){
			$hasil=$this->db->query("SELECT id_kategori FROM barang  WHERE barang_id = '$id_barang' and id_toko='$id_toko' ")->result_array();
        	return $hasil;
		}
		function savebarang($nama_barang, $barang_stock_awal, $barang_stock_akhir, $barang_harga_modal, $barang_level, $barang_foto,$kategori,$suplier,$bnr_harga){
			$id_barang=uniqid();
			$this->db->query("INSERT INTO barang(barang_id,barang_nama,barang_stock_awal,barang_stock_akhir,barang_harga_modal,barang_level,barang_foto,id_kategori,id_toko,suplier) VALUES ('$id_barang','$nama_barang','$barang_stock_awal','$barang_stock_akhir','$barang_harga_modal','$barang_level','$barang_foto','$kategori','1','$suplier')");
			$this->db->query("INSERT INTO barang_non_reseller(barang_id,bnr_harga) VALUES ('$id_barang', '$bnr_harga')");

			$id=$this->db->query("SELECT id_toko FROM toko where id_toko!='1'")->result_array();

			foreach($id as $i){
				

				$id_barang=uniqid();
				$id_toko=$i['id_toko'];
				$this->db->query("INSERT INTO barang(barang_id,barang_nama,barang_stock_awal,barang_stock_akhir,barang_harga_modal,barang_level,barang_foto,id_kategori,id_toko,suplier) VALUES ('$id_barang','$nama_barang','0','0','$barang_harga_modal','$barang_level','$barang_foto','$kategori','$id_toko','$suplier')");
				$this->db->query("INSERT INTO barang_non_reseller(barang_id,bnr_harga) VALUES ('$id_barang', '$bnr_harga')");
			}
		

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
