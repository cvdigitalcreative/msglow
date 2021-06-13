<?php
	/**
	 * 
	 */
	class M_pemesanan_new extends CI_Model
	{
		function edit_pesanan($pemesanan_id,$nama,$no_hp,$alamat,$kurir_id,$at_id,$mp_id,$admin){
			$hsl = $this->db->query("UPDATE pemesanan SET pemesanan_nama='$nama',pemesanan_hp='$no_hp',pemesanan_alamat='$alamat',kurir_id='$kurir_id',at_id='$at_id',mp_id = '$mp_id',id_pegawai = '$admin' WHERE pemesanan_id='$pemesanan_id'");
        	return $hsl;
		}
		function pindah_stock($barang_id,$nama_barang,$stock,$toko){
			$this->db->trans_start();

			$x = $this->db->query("SELECT id_toko,barang_stock_akhir FROM barang WHERE barang_id = '$barang_id'  ")->row_array();
			$barang_stock_akhir=$x['barang_stock_akhir'];
			$id_toko=$x['id_toko'];
			$stok_barang=$barang_stock_akhir-$stock; 
			$this->db->query("UPDATE barang SET barang_stock_akhir = $stok_barang WHERE barang_id = '$barang_id' ");
			$this->db->query("INSERT INTO history_stok_barang_keluar(barang_id,jumlah,stok_keluar,barang_stock_keluar,id_toko) VALUES ('$barang_id',$stok_barang,$stock,$barang_stock_akhir,'$id_toko')");

			$x = $this->db->query("SELECT barang_id,barang_stock_akhir FROM barang WHERE barang_nama = '$nama_barang' and id_toko='$toko'  ")->row_array();
			$barang_stock_akhir=$x['barang_stock_akhir'];
			$id_barang=$x['barang_id'];
			$stok_barang=$barang_stock_akhir+$stock; 
			$this->db->query("UPDATE barang SET barang_stock_akhir = $stok_barang WHERE barang_id = '$id_barang' ");
			$this->db->query("INSERT INTO history_stok_barang_masuk(barang_id,jumlah,stok_keluar,barang_stock_keluar) VALUES ('$id_barang',$stok_barang,$stock,$barang_stock_akhir)");
				$this->db->query("INSERT INTO history_stock_masuk(barang_id,stock) VALUES ('$id_barang','$stock')");

        	$this->db->trans_complete();
	        if($this->db->trans_status()==true)
	        return true;
	        else
	        return false;
		}
		function hapus_pesanan($pemesanan_id,$id_toko){
			$this->db->trans_start();
				$this->db->query("DELETE FROM pemesanan WHERE pemesanan_id='$pemesanan_id'");
				$this->db->query("DELETE FROM detail_transaksi WHERE id_pemesanan='$pemesanan_id'");
				$data = $this->db->query("SELECT * FROM list_barang WHERE pemesanan_id='$pemesanan_id'");
				foreach ($data->result_array() as $i) {
					$qty = $i['lb_qty'];
					$barang_id = $i['barang_id'];
					$x = $this->db->query("SELECT barang_stock_akhir FROM barang WHERE barang_id = '$barang_id' and id_toko = '$id_toko' ")->row_array();
					$barang_stock_akhir=$x['barang_stock_akhir'];
					$stok_barang=$barang_stock_akhir+$qty; 
					$this->db->query("UPDATE barang SET barang_stock_akhir = $stok_barang WHERE barang_id = '$barang_id' and id_toko = '$id_toko' ");
					
					// $this->db->query("INSERT INTO history_stock_masuk(barang_id,stock,id_toko) VALUES ('$barang_id','$qty','$id_toko')");
					$this->db->query("INSERT INTO history_stok_barang_kembali(barang_id,jumlah,stok_keluar,barang_stock_keluar,id_toko) VALUES ('$barang_id','$stok_barang','$qty','$barang_stock_akhir','$id_toko')");
				}
				$this->db->query("DELETE FROM list_barang WHERE pemesanan_id='$pemesanan_id'");
	      	$this->db->trans_complete();
	        if($this->db->trans_status()==true)
	        return true;
	        else
	        return false;
		}
		function getPemesanan_fix(){
			//and pemesanan_tanggal>=DATE_ADD(NOW(), INTERVAL -3 MONTH)
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,f.*,e.user_nama,g.nama as nama_toko , h.nama as admin_pemesan,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d, user e, detail_transaksi f, toko g,pegawai h  WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.uid=e.user_id and a.pemesanan_id=f.id_pemesanan and a.id_pegawai=h.id_pegawai and a.id_toko=g.id_toko  ORDER BY a.pemesanan_id desc ");
        	return $hasil;
		}
		function getPemesanan_fix_admin($level,$id_toko,$tanggal,$uid){
			//and pemesanan_tanggal>=DATE_ADD(NOW(), INTERVAL -3 MONTH)
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,f.*,e.user_nama,g.nama as nama_toko , h.nama as admin_pemesan,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d, user e, detail_transaksi f, toko g,pegawai h  WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.uid=e.user_id and a.pemesanan_id=f.id_pemesanan and a.id_pegawai=h.id_pegawai and a.id_toko=g.id_toko and  (a.pemesanan_tanggal BETWEEN '$tanggal' AND '$tanggal') and a.id_toko='$id_toko'  AND a.level = '$level' AND a.uid = '$uid' ORDER BY a.pemesanan_id desc ");
			
			
        	return $hasil;
		}

		function getPemesanan_fix_admin_all($id_toko,$uid){
			//and pemesanan_tanggal>=DATE_ADD(NOW(), INTERVAL -3 MONTH)
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,f.*,e.user_nama,g.nama as nama_toko , h.nama as admin_pemesan,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d, user e, detail_transaksi f, toko g,pegawai h  WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.uid=e.user_id and a.pemesanan_id=f.id_pemesanan and a.id_pegawai=h.id_pegawai and a.id_toko=g.id_toko and a.id_toko='$id_toko'   AND a.uid = '$uid' ORDER BY a.pemesanan_id desc ");
			
			
        	return $hasil;
		}
		function get_filter($dari,  $ke,$admin,$metode,$asal_transaksi,$toko,$customer){
			$string_query="SELECT a.*,b.*,c.*,d.*,f.*,e.user_nama,g.nama as nama_toko , h.nama as admin_pemesan,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d, user e, detail_transaksi f, toko g,pegawai h  WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.uid=e.user_id and a.pemesanan_id=f.id_pemesanan and a.id_pegawai=h.id_pegawai and a.id_toko=g.id_toko and (a.pemesanan_tanggal BETWEEN '$dari' AND '$ke') and a.mp_id ".$metode." and a.at_id ".$asal_transaksi." and a.id_pegawai ".$admin." and a.id_toko".$toko." and a.level ".$customer." ORDER BY a.pemesanan_id desc ";
			$hasil=$this->db->query($string_query);
        	return $hasil;
		}

		function getPemesanan_sum(){
			//and pemesanan_tanggal>=DATE_ADD(NOW(), INTERVAL -3 MONTH)
			$hasil=$this->db->query("SELECT sum(total_omset),sum(total_omset) as total_omset,sum(total_untung) as total_untung FROM pemesanan a,detail_transaksi f  WHERE a.pemesanan_id=f.id_pemesanan  ORDER BY a.pemesanan_id desc ");
        	return $hasil;
		}

		function getPemesanan_filter_sum($dari,  $ke,$admin,$metode,$asal_transaksi,$toko,$customer){
			$string_query="SELECT sum(total_omset),sum(total_omset) as total_omset,sum(total_untung) as total_untung FROM pemesanan a,detail_transaksi f  WHERE a.pemesanan_id=f.id_pemesanan and (a.pemesanan_tanggal BETWEEN '$dari' AND '$ke') and a.mp_id ".$metode." and a.at_id ".$asal_transaksi." and a.id_pegawai ".$admin." and a.id_toko".$toko." and a.level ".$customer." ORDER BY a.pemesanan_id desc ";
			$hasil=$this->db->query($string_query);
        	return $hasil;
		}
		
		function getPemesanan_sum_fix($level,$id_toko,$tanggal,$uid){
			//and pemesanan_tanggal>=DATE_ADD(NOW(), INTERVAL -3 MONTH)
			$hasil=$this->db->query("SELECT sum(total_omset),sum(total_omset) as total_omset,sum(total_untung) as total_untung FROM pemesanan a,detail_transaksi f  WHERE a.pemesanan_id=f.id_pemesanan and (a.pemesanan_tanggal BETWEEN '$tanggal' AND '$tanggal') and a.id_toko='$id_toko'  AND a.level = '$level' AND a.uid = '$uid'  ORDER BY a.pemesanan_id desc ");
        	return $hasil;
		}

		function save_pesanan($nama_pemesan,$tanggal,$no_hp,$alamat,$level,$kurir_id,$at_id,$mp_id,$id_diskon,$uid,$id_pegawai,$id_toko,$id_pemesan){
			$hsl = $this->db->query("INSERT INTO pemesanan(pemesanan_nama,pemesanan_tanggal,pemesanan_hp,pemesanan_alamat,level,kurir_id,at_id,mp_id,id_diskon,uid,id_pegawai,id_toko,pemesanan_id) VALUES ('$nama_pemesan','$tanggal','$no_hp','$alamat','$level','$kurir_id','$at_id','$mp_id','$id_diskon','$uid','$id_pegawai','$id_toko','$id_pemesan')");
        	return $hsl;
		}

		function save_detail_pesanan($id_pemesan,$total_omset,$total_untung,$list_barang,$diskon_pesanan,$diskon_barang,$total_modal){
			$hsl = $this->db->query("INSERT INTO detail_transaksi(id_pemesanan,total_omset,total_untung,list_barang,diskon_pesanan,diskon_barang,total_modal) VALUES ('$id_pemesan','$total_omset','$total_untung','$list_barang','$diskon_pesanan','$diskon_barang','$total_modal')");
        	return $hsl;
		}

		function getAllAT(){
			$hasil=$this->db->query("SELECT * FROM asal_transaksi");
        	return $hasil;
		}
		function getAllkurir(){
			$hasil=$this->db->query("SELECT * FROM kurir");
        	return $hasil;
		}
		function getAllMetpem(){
			$hasil=$this->db->query("SELECT * FROM metode_pembayaran");
        	return $hasil;
		}
		function getAlladmin(){
			$hasil=$this->db->query("SELECT * FROM pegawai");
        	return $hasil;
		}
		function getAlltoko(){
			$hasil=$this->db->query("SELECT * FROM toko");
        	return $hasil;
		}
		function getAllcustomer(){
			$hasil=$this->db->query("SELECT * FROM jenis_customer");
        	return $hasil;
		}
	}