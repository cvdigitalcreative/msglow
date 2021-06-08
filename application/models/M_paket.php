<?php
	/**
	 * 
	 */
	class M_paket extends CI_Model
	{
		function get_barang_paket(){
			$hsl = $this->db->query("select  barang.*,barang_non_reseller.bnr_harga as harga_jual from barang,barang_non_reseller where barang.barang_nama like 'paket%' and id_toko='1' and barang.barang_id=barang_non_reseller.barang_id ");
     		return $hsl;
		}
		function get_barang_pecahaan(){
			$hsl = $this->db->query("select  barang.*,barang_non_reseller.bnr_harga as harga_jual from barang,barang_non_reseller where barang.barang_nama Not like 'paket%' and id_toko='1' and barang.barang_id=barang_non_reseller.barang_id ");
     		return $hsl;
		}
		function get_barang_by_id($id){
			$hasil=$this->db->query("SELECT a.barang_nama,b.bnr_harga as harga_jual,a.barang_harga_modal as harga_modal and a.barang_stock_akhir FROM barang a,barang_non_reseller b WHERE  a.id_toko='1'  and a.barang_id=b.barang_id  and a.barang_id='$id'    ");
        	return $hasil;
		}

		function save_paket($id_paket,$nama_paket,$id_barang,$nama_barang,$jumlah){
			$hsl = $this->db->query("INSERT INTO paket_belong_to(id_paket,nama_paket,id_barang,nama_barang,jumlah) VALUES ('$id_paket','$nama_paket','$id_barang','$nama_barang','$jumlah')");
     		return $hsl;
		}
		function get_barang_pecahaan_paket(){
			$hsl = $this->db->query("select * from paket_belong_to");
     		return $hsl;
		}

		function get_barang_pecahaan_paket_by_id($id_paket){
			$hsl = $this->db->query("select id_barang,jumlah from paket_belong_to where id_paket='$id_paket'");
     		return $hsl;
		}
		function savebarang($id_barang,$nama_barang, $barang_stock_awal, $barang_stock_akhir, $barang_harga_modal, $barang_level, $barang_foto,$kategori,$suplier,$bnr_harga){
			
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

		function update_stok_pecahaan($barang_id, $qty,$id_toko){
			$x = $this->db->query("SELECT barang_stock_akhir FROM barang WHERE barang_id = '$barang_id' and id_toko='$id_toko'")->row_array();
			$barang_stock_akhir=$x['barang_stock_akhir'];
			$stok_barang=$barang_stock_akhir-$qty; 
			
				$this->db->query("UPDATE barang SET barang_stock_akhir ='$stok_barang' WHERE barang_id = '$barang_id'");
				$this->db->query("INSERT INTO history_stok_paket(barang_id,jumlah,stok_keluar,barang_stock_keluar,id_toko) VALUES ('$barang_id','$stok_barang','$qty','$barang_stock_akhir','$id_toko')");
				$this->db->query("INSERT INTO history_stock_masuk(barang_id,stock,id_toko) VALUES ('$barang_id','$qty','$id_toko')");
				 	$this->db->trans_complete();

	        if($this->db->trans_status()==true)
	        return true;
	        else
	        return false;

		}
		function update_stok_paket($barang_id, $qty,$id_toko){
			$x = $this->db->query("SELECT barang_stock_akhir FROM barang WHERE barang_id = '$barang_id' and id_toko='$id_toko'")->row_array();
			$barang_stock_akhir=$x['barang_stock_akhir'];
			$stok_barang=$barang_stock_akhir+$qty; 
			
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
