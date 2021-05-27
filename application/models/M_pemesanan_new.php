<?php
	/**
	 * 
	 */
	class M_pemesanan_new extends CI_Model
	{
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