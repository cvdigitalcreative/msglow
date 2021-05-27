<?php 
	/**
	 * 
	 */
	class Pemesanan extends CI_Controller
	{
		
		function __construct()
	  	{
		    parent:: __construct();
		    if($this->session->userdata('masuk') !=TRUE){
		      $url=base_url('Login');
		      redirect($url);
		    };

		    $this->load->model('m_pemesanan');
		     $this->load->model('m_pemesanan_new');
		    $this->load->model('m_barang');
		    $this->load->model('m_barang_new');
		    $this->load->model('m_list_barang');
		    $this->load->model('m_diskon');
		    $this->load->library('upload');
	  	}

	  	function home($level){
	  		if($this->session->userdata('akses') == 2 && $this->session->userdata('masuk') == true){
	  			$uid=$this->session->userdata('id');
		      	$id_toko=$this->session->userdata('id_toko');
		      
		      if($level==1){
		      	$y['title'] = "Reseller";
		      	$y['home_url'] = base_url()."Admin/Pemesanan/Home/1";
		       	$y['url'] = base_url()."Admin/Pemesanan/Home/1";
		      } else{
		      	$y['title'] = "Customer";
		      	$y['home_url'] = base_url()."Admin/Pemesanan/Home/2";
		       $y['url'] = base_url()."Admin/Pemesanan/Home/2";
		      }
		      date_default_timezone_set("Asia/Jakarta");
        		$tanggal = date("Y-m-d");
		       $x['level'] = $level;
		       $x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
		       $x['kurir'] = $this->m_pemesanan->getAllkurir();
		       $x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
		       $x['barang'] = $this->m_barang_new->get_barang_by_level_toko($level,$id_toko);
		        $x['diskon'] = $this->m_diskon->getDataDiskon_pemesanan();
		       

		       	$x['admin'] = $this->m_pemesanan_new->getAlladmin();
		         $x['datapesanan'] = $this->m_pemesanan_new->getPemesanan_fix_admin($level,$id_toko,$tanggal,$uid);

		       $x['total']  = $this->m_pemesanan_new->getPemesanan_sum_fix($level,$id_toko,$tanggal,$uid)->result_array();
		       $this->load->view('v_header',$y);
		       $this->load->view('admin/v_sidebar');
		       $this->load->view('admin/new_version/v_pemesanan',$x);
		    }
		    else{
		       redirect('Login');
		    }
	  	}

	  	function savepemesanan(){	
	  		$uid=$this->session->userdata('id');
	  		$id_toko=$this->session->userdata('id_toko');
	  		$nama_pemesan = $this->input->post('nama_pemesan');
	  		$no_hp = $this->input->post('hp');
	  		$alamat = $this->input->post('alamat');
	  		$at_id = $this->input->post('at');
	  		$kurir_id = $this->input->post('kurir');
	  		$tanggal = $this->input->post('tanggal');
	  		$mp_id = $this->input->post('metpem');
	  		$level = $this->input->post('level');;
	  		$barang_id = $this->input->post('barang');
	  		$qty = $this->input->post('qty');
	  		$id_diskon = $this->input->post('diskon');
	  		$id_pegawai = $this->input->post('admin');
	  		$id_pemesan=uniqid();
	  		$this->m_pemesanan_new->save_pesanan($nama_pemesan,$tanggal,$no_hp,$alamat,$level,$kurir_id,$at_id,$mp_id,$id_diskon,$uid,$id_pegawai,$id_toko,$id_pemesan);
	  		$size = sizeof($barang_id);
	  		$list_barang="";
	  		$ktg_qty=0;

	  		if($level==1){
	  			$kategori_id_all=array();
		  		$qty_barang_all=array();
		  		for($i=0; $i < $size; $i++){
		  			$kategori_id=$this->m_barang_new->get_kategori_id_barang($barang_id[$i],$id_toko)[0]['id_kategori'];
		  			array_push($kategori_id_all,$kategori_id);
		  			array_push($qty_barang_all,$qty[$i]);
		  			// $this->m_list_barang->save_list_barang($pemesanan_id,$qty[$i],$barang_id[$i],$level);
		  		}

	  			$total_qty_barang_all=array();
		  		for($i=0; $i<sizeof($kategori_id_all); $i++){
		  			if($kategori_id_all[$i]==0){
		  				array_push($total_qty_barang_all,$qty[$i]);
		  			}else{
		  				$qty_totals=$qty_barang_all[$i];
		  				for($j=0; $j<sizeof($kategori_id_all); $j++){
		  					if($i!=$j){
		  						if($kategori_id_all[$i]==$kategori_id_all[$j]){
		  							$qty_totals=$qty_totals+$qty_barang_all[$j];
		  						}
		  					}
		  				}
		  				array_push($total_qty_barang_all,$qty_totals);
		  			}
	  			}
	  		}
	  		$harga_modal=0;
	  		$harga_jual=0;
	  		$diskon_barang=0;
            for($i=0; $i < $size; $i++){
	  			$this->m_barang_new->save_list_barang($id_pemesan,$qty[$i],$barang_id[$i],$level,$id_toko,$total_qty_barang_all[$i]);

	  			$temp=$this->m_barang_new->get_barang_by_id($barang_id[$i],$id_toko,$level,$total_qty_barang_all[$i])->row_array();
	  			$temp_list=" - ".$temp['barang_nama']." = ".$qty[$i]." pcs ";
	  			$list_barang=$list_barang.$temp_list;
	  			$harga_modal=$harga_modal+$temp['harga_modal'];
	  			$harga_jual=$harga_jual+$temp['harga_jual'];
	  			$temp=$this->m_diskon->get_potongan_harga_barang($barang_id[$i])->row_array();
	  			$diskon_barang=$temp['potongan_harga']+$diskon_barang;

	  		}
	  		$diskon_pesanan=0;
	  		$temp=$this->m_diskon->get_potongan_harga($id_diskon)->row_array();
	  		$diskon_pesanan=$temp['potongan_harga'];
	  		$total_untung=$harga_jual-$harga_modal;
	  		$this->m_pemesanan_new->save_detail_pesanan($id_pemesan,$harga_jual,$total_untung,$list_barang,$diskon_pesanan,$diskon_barang,$harga_modal);
	  		echo $this->session->set_flashdata('msg','success');

	       	redirect('Admin/Pemesanan/Home/'.$level);		  	
 	  	}

 	  	function tambahpesananNR(){
	  		$pemesanan_id = $this->input->post('pemesanan_id');
	  		$level = 2;
	  		$barang_id = $this->input->post('barang');
	  		$qty = $this->input->post('qty');

	  		$size = sizeof($barang_id);
            
            if($pemesanan_id!=0){
	  		for($i=0; $i < $size; $i++){
	  			$this->m_list_barang->save_list_barang($pemesanan_id,$qty[$i],$barang_id[$i],$level);
	  		}
            }
	  		echo $this->session->set_flashdata('msg','success');
	       	redirect("Admin/Pemesanan/list_barang/$pemesanan_id/$level");		  	
 	  	}

 	  	function tambahpesananR(){
	  		$pemesanan_id = $this->input->post('pemesanan_id');
	  		$level = 1;
	  		$barang_id = $this->input->post('barang');
	  		$qty = $this->input->post('qty');

	  		$size = sizeof($barang_id);
	  		$kategori_id_all=array();
	  		$qty_barang_all=array();
	  		for($i=0; $i < $size; $i++){
	  			$kategori_id=$this->m_barang->get_kategori_id_barang($barang_id[$i])[0]['id_kategori'];
	  			array_push($kategori_id_all,$kategori_id);
	  			array_push($qty_barang_all,$qty[$i]);
	  			// $this->m_list_barang->save_list_barang($pemesanan_id,$qty[$i],$barang_id[$i],$level);
	  		}

	  		$total_qty_barang_all=array();
	  		for($i=0; $i<sizeof($kategori_id_all); $i++){
	  			if($kategori_id_all[$i]==0){
	  				array_push($total_qty_barang_all,$qty[$i]);
	  			}else{
	  				$qty_totals=$qty_barang_all[$i];
	  				for($j=0; $j<sizeof($kategori_id_all); $j++){
	  					if($i!=$j){
	  						if($kategori_id_all[$i]==$kategori_id_all[$j]){
	  							$qty_totals=$qty_totals+$qty_barang_all[$j];
	  						}
	  					}
	  				}
	  				array_push($total_qty_barang_all,$qty_totals);
	  			}
	  		}
	  	
	  		for($i=0; $i < $size; $i++){
	  			$this->m_list_barang->save_lists_barang($pemesanan_id,$qty[$i],$barang_id[$i],$level,$total_qty_barang_all[$i]);
	  		}

	  		echo $this->session->set_flashdata('msg','success');
	       	redirect("Admin/Pemesanan/list_barang/$pemesanan_id/$level");		  	
 	  	}

 	  	function hapuspesananlb(){
	  		$lb_id = $this->input->post('lb_id');
	  		$pemesanan_id = $this->input->post('pemesanan_id');
	  		$barang_id = $this->input->post('barang_id');
	  		$qty = $this->input->post('qty');
	  		$this->m_list_barang->hapus_list_barang($pemesanan_id,$lb_id,$qty,$barang_id);
	  		echo $this->session->set_flashdata('msg','delete');
	       	redirect($this->agent->referrer());
	  	}

 	  	function savepemesananR(){
	  		$nama_pemesan = $this->input->post('nama_pemesan');
	  		$no_hp = $this->input->post('hp');
	  		$alamat = $this->input->post('alamat');
	  		$asal_transaksi = $this->input->post('at');
	  		$kurir = $this->input->post('kurir');
	  		$metpem = $this->input->post('metpem');
	  		$level = 1;
	  		$tanggal = $this->input->post('tanggal');
	  		$barang_id = $this->input->post('barang');
	  		$qty = $this->input->post('qty');
	  		$diskon = $this->input->post('diskon');	
	  		$uid=$this->session->userdata('id');
	  		$this->m_pemesanan->save_pesanan($nama_pemesan,$tanggal,$no_hp,$alamat,$level,$kurir,$asal_transaksi,$metpem,$diskon,$uid);
			$x=$this->m_pemesanan->getIdbyName($nama_pemesan);
			$z=$x->row_array();
			$pemesanan_id=$z['pemesanan_id'];
            
            
	  		$size = sizeof($barang_id);
	  		$kategori_id_all=array();
	  		$qty_barang_all=array();
	  		for($i=0; $i < $size; $i++){
	  			$kategori_id=$this->m_barang->get_kategori_id_barang($barang_id[$i])[0]['id_kategori'];
	  			array_push($kategori_id_all,$kategori_id);
	  			array_push($qty_barang_all,$qty[$i]);
	  			// $this->m_list_barang->save_list_barang($pemesanan_id,$qty[$i],$barang_id[$i],$level);
	  		}

	  		$total_qty_barang_all=array();
	  		for($i=0; $i<sizeof($kategori_id_all); $i++){
	  			if($kategori_id_all[$i]==0){
	  				array_push($total_qty_barang_all,$qty[$i]);
	  			}else{
	  				$qty_totals=$qty_barang_all[$i];
	  				for($j=0; $j<sizeof($kategori_id_all); $j++){
	  					if($i!=$j){
	  						if($kategori_id_all[$i]==$kategori_id_all[$j]){
	  							$qty_totals=$qty_totals+$qty_barang_all[$j];
	  						}
	  					}
	  				}
	  				array_push($total_qty_barang_all,$qty_totals);
	  			}
	  		}
	  	   
    	  		for($i=0; $i < $size; $i++){
    	  			$this->m_list_barang->save_lists_barang($pemesanan_id,$qty[$i],$barang_id[$i],$level,$total_qty_barang_all[$i]);
    	  		}
	  	    
	  		echo $this->session->set_flashdata('msg','success');
	       	redirect('Admin/Pemesanan/Home/1');	  	
 	  	}

 	  	function edit_pesanan(){
 	  		$pemesanan_id = $this->input->post('pemesanan_id');
 	  		$nama_pemesan = $this->input->post('nama_pemesan');
	  		$no_hp = $this->input->post('hp');
	  		$alamat = $this->input->post('alamat');
	  		$asal_transaksi = $this->input->post('at');
	  		$kurir = $this->input->post('kurir');
	  		$metode_pembayaran = $this->input->post('mp');
	  		$diskon = $this->input->post('diskon');
	  		// $tanggal = $this->input->post('tanggal');

	  		$this->m_pemesanan->edit_pesanan($pemesanan_id,$nama_pemesan,$no_hp,$alamat,$kurir,$asal_transaksi,$metode_pembayaran,$diskon);
	  		echo $this->session->set_flashdata('msg','update');
	       	redirect($this->agent->referrer());	
	  	}

	  	function hapus_pesanan(){
	  		$pemesanan_id = $this->input->post('pemesanan_id');
	  		$this->m_pemesanan->hapus_pesanan($pemesanan_id);
	  		echo $this->session->set_flashdata('msg','hapus');
	       	redirect($this->agent->referrer());	
	  	}



 	  	function list_barang($pemesanan_id){
 	  		if($this->session->userdata('akses') == 2 && $this->session->userdata('masuk') == true){
 	  		   $level = $this->uri->segment(5);
 	  		   if($level == 1){
 	  		   	   $x['p_id'] = $pemesanan_id;
 	  		   	   $x['lvl'] =$level;	
	 	  		   $y['title'] = "List Barang Pemesan";
	 	  		   $x['listbarang'] = $this->m_list_barang->getLBRbyid($pemesanan_id);	
	 	  		   $x['reseller'] = $this->m_barang->getDataReseller();
	 	  		   $a = $this->m_list_barang->SUMLBR($pemesanan_id)->row_array();
 	  		   	   $x['jumlah'] = $a['total_keseluruhan'];
			       $this->load->view('v_header',$y);
			       $this->load->view('admin/v_sidebar');
			       $this->load->view('admin/v_list_barang1',$x);
 	  		   }elseif($level == 2){
 	  		   	   $y['title'] = "List Barang Pemesan";
 	  		   	   $x['p_id'] = $pemesanan_id;
 	  		   	   $x['lvl'] =$level;	
 	  		   	   $x['listbarang'] = $this->m_list_barang->getLBNRbyid($pemesanan_id);
 	  		   	   $a = $this->m_list_barang->SUMLBNR($pemesanan_id)->row_array();
 	  		   	   $x['nonreseller'] = $this->m_barang->getDataNonReseller1();
 	  		   	   $x['jumlah'] = $a['total_keseluruhan'];
			       $this->load->view('v_header',$y);
			       $this->load->view('admin/v_sidebar');
			       $this->load->view('admin/v_list_barang',$x);		
 	  		   }
		       
		    }
		    else{
		       redirect('Login');
		    }
 	  	}
 	  	function cetak_transaksi1($level1){

	  		$uid=$this->session->userdata('id');

 	  		if($uid==11){
		        	$x['data'] = $this->m_pemesanan->getPemesananCurdate1($level1);
	  				$a = $this->m_pemesanan->getPemesananCurdate1($level1);
		        }else{
		        	 $x['data'] = $this->m_pemesanan->getPemesananCurdate1_by_id($level1,$uid);
	  				$a = $this->m_pemesanan->getPemesananCurdate1_by_id($level1,$uid);
		        }

		       $total_u = 0;
		       $total_o = 0;
		       foreach ($a->result_array() as $i) {
		       	$pemesanan_id = $i['pemesanan_id'];
		       	$level = $i['level'];

		       

		       	if($level == 1){
		       		$t = $this->db->query("SELECT SUM(a.lb_qty * d.br_harga) AS total_omset, (SUM(a.lb_qty * d.br_harga))-(SUM(a.lb_qty * c.barang_harga_modal)) AS total_untung FROM list_barang a, pemesanan b, barang c, barang_reseller d WHERE b.pemesanan_id = '$pemesanan_id' AND a.ktg_qty = d.br_kuantitas AND a.pemesanan_id = b.pemesanan_id AND a.barang_id = c.barang_id AND a.barang_id = d.barang_id");
              		$d=$t->row_array();
               		$total_untung = $d['total_untung'];
               		$total_omset = $d['total_omset'];
               		  //diskon pemesanan
                        $z=$this->db->query("SELECT b.potongan_harga   FROM pemesanan a, diskon_all b WHERE a.pemesanan_id = '$pemesanan_id' and a.id_diskon=b.id ");
                        $c=$z->row_array();
                        $potongan_harga = $c['potongan_harga'];
                        $total_omset=$total_omset-($potongan_harga);
                        $total_untung = $total_untung-($potongan_harga);
		       	}elseif($level == 2){
		       		$t = $this->db->query("SELECT SUM(a.lb_qty * d.bnr_harga) AS total_omset, (SUM(a.lb_qty * d.bnr_harga))-(SUM(a.lb_qty * c.barang_harga_modal)) AS total_untung FROM list_barang a, pemesanan b, barang c, barang_non_reseller d WHERE b.pemesanan_id = '$pemesanan_id' AND a.pemesanan_id = b.pemesanan_id AND a.barang_id = c.barang_id AND a.barang_id = d.barang_id");
              		$d=$t->row_array();
               		$total_untung = $d['total_untung'];
               		$total_omset = $d['total_omset'];
               		//diskon
              			  $z=$this->db->query("SELECT a.lb_qty ,a.barang_id,b.pemesanan_tanggal  FROM list_barang a, pemesanan b, barang c, barang_non_reseller d WHERE a.pemesanan_id = '$pemesanan_id' AND lb_lvl =2 AND a.pemesanan_id = b.pemesanan_id AND a.barang_id = c.barang_id AND a.barang_id = d.barang_id ORDER BY lb_id");
                        foreach ($z->result_array() as $i ) {
                                 $barang_id = $i['barang_id'];
                                 $lb_qty = $i['lb_qty'];
                                 $pemesanan_tanggal = $i['pemesanan_tanggal'];
                                  $z=$this->db->query("select potongan_harga from diskon where barang_id='$barang_id' and  tanggal_mulai <= '$pemesanan_tanggal' AND tanggal_berakhir >= '$pemesanan_tanggal'")->row_array();
                                  if($z['potongan_harga']==null){
                                  	
                                  }else{
                                  	$total_untung=$total_untung-($z['potongan_harga']*$lb_qty);
                                  	$total_omset=$total_omset-($z['potongan_harga']*$lb_qty);
                                  }

                        }
                          //diskon pemesanan
                        $z=$this->db->query("SELECT b.potongan_harga   FROM pemesanan a, diskon_all b WHERE a.pemesanan_id = '$pemesanan_id' and a.id_diskon=b.id ");
                        $c=$z->row_array();
                        $potongan_harga = $c['potongan_harga'];
                        $total_omset=$total_omset-($potongan_harga);
                        $total_untung = $total_untung-($potongan_harga);
		       	}

		       		$total_u = $total_u + $total_untung;
		       		$total_o = $total_o + $total_omset;
		       }
		       
               $total_untung = $total_u;
               $total_omset = $total_o;
               $x['total_untung'] = $total_untung;
               $x['total_omset'] = $total_omset;
               date_default_timezone_set("Asia/Jakarta");
        		$cur_date = date("Y-m-d H:i:s");
               $x['tanggal']=$cur_date;
               if($level1==0){
               	$x['levels']="Keseluruhan";
               }else if($level1==1){
               		$x['levels']="Reseller";
               }else if($level1==2){
               		$x['levels']="Customer";
               }
               	$x['level']=$level1;
	  		$this->load->view('admin/v_cetak_perhari',$x);
	  	}

 	  	function Cetak_Invoice($pemesanan_id){
 	  		$level = $this->uri->segment(5);
 	  		   if($level == 1){
 	  		   	$y['title'] = "List Barang Pemesan";
 	  		   	   $x['p_id'] = $pemesanan_id;
 	  		   	   $x['lvl'] =$level;	
	 	  		   $x['listbarang'] = $this->m_list_barang->getLBRbyid($pemesanan_id);	
	 	  		   $x['pemesan'] = $this->m_pemesanan->getIdbyid($pemesanan_id);
	 	  		    $a = $this->m_pemesanan->getIdbyid($pemesanan_id)->row_array();
 	  		   	   $x['kurir'] = $a['kurir_nama'];
 	  		   	   $x['at'] = $a['at_nama'];
 	  		   	   $x['mp_nama'] = $a['mp_nama'];
 	  		  	   $x['nama'] = $this->session->userdata('nama');
			       $this->load->view('admin/v_cetak_invoice',$x);
 	  		   }elseif($level == 2){
 	  		   	   $y['title'] = "List Barang Pemesan";
 	  		   	   $x['p_id'] = $pemesanan_id;
 	  		   	   $x['lvl'] =$level;	
 	  		   	   $x['listbarang'] = $this->m_list_barang->getLBNRbyid($pemesanan_id);
 	  		   	   $x['pemesan'] = $this->m_pemesanan->getIdbyid($pemesanan_id);
 	  		   	   $a = $this->m_pemesanan->getIdbyid($pemesanan_id)->row_array();
 	  		   	   $x['kurir'] = $a['kurir_nama'];
 	  		   	   $x['at'] = $a['at_nama'];
 	  		   	   $x['mp_nama'] = $a['mp_nama'];
 	  		   	   $x['nama'] = $this->session->userdata('nama');
			       $this->load->view('admin/v_cetak_invoice',$x);
 	  		   }
 	  	}

	  	function asal_transaksi(){
	  		if($this->session->userdata('akses') == 2 && $this->session->userdata('masuk') == true){
		       $y['title'] = "Asal Transaksi";
		       $x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
		       $this->load->view('v_header',$y);
		       $this->load->view('admin/v_sidebar');
		       $this->load->view('admin/v_asal_transaksi',$x);
		    }
		    else{
		       redirect('Login');
		    }
	  	}

	  	function saveAT(){
	  		$at_nama = $this->input->post('at_nama');
	  		$this->m_pemesanan->save_at($at_nama);
	  		echo $this->session->set_flashdata('msg','success');
	       	redirect('Admin/Pemesanan/asal_transaksi');
	  	}

	  	function updateAT(){
	  		$id = $this->input->post('at_id');
	  		$at_nama = $this->input->post('at_nama');
	  		$this->m_pemesanan->update_at($id,$at_nama);
	  		echo $this->session->set_flashdata('msg','update');
	       	redirect('Admin/Pemesanan/asal_transaksi');
	  	}

	  	function hapusAT(){
	  		$id = $this->input->post('at_id');
	  		$this->m_pemesanan->hapus_at($id);
	  		echo $this->session->set_flashdata('msg','delete');
	       	redirect('Admin/Pemesanan/asal_transaksi');
	  	}

	  	function kurir(){
	  		if($this->session->userdata('akses') == 2 && $this->session->userdata('masuk') == true){
		       $y['title'] = "Kurir";
		       $x['kurir'] = $this->m_pemesanan->getAllkurir();
		       $this->load->view('v_header',$y);
		       $this->load->view('admin/v_sidebar');
		       $this->load->view('admin/v_kurir',$x);
		    }
		    else{
		       redirect('Login');
		    }
	  	}

	  	function savekurir(){
	  		$kurir_nama = $this->input->post('kurir_nama');
	  		$this->m_pemesanan->save_kurir($kurir_nama);
	  		echo $this->session->set_flashdata('msg','success');
	       	redirect('Admin/Pemesanan/kurir');
	  	}

	  	function updatekurir(){
	  		$id = $this->input->post('kurir_id');
	  		$kurir_nama = $this->input->post('kurir_nama');
	  		$this->m_pemesanan->update_kurir($id,$kurir_nama);
	  		echo $this->session->set_flashdata('msg','update');
	       	redirect('Admin/Pemesanan/kurir');
	  	}

	  	function hapuskurir(){
	  		$id = $this->input->post('kurir_id');
	  		$this->m_pemesanan->hapus_kurir($id);
	  		echo $this->session->set_flashdata('msg','delete');
	       	redirect('Admin/Pemesanan/kurir');
	  	}

	  	function metode_pembayaran(){
	  		if($this->session->userdata('akses') == 2 && $this->session->userdata('masuk') == true){
		       $y['title'] = "Metode Pembayaran";
		       $x['metpem'] = $this->m_pemesanan->getAllMetpem();
		       $this->load->view('v_header',$y);
		       $this->load->view('admin/v_sidebar');
		       $this->load->view('admin/v_metode_pembayaran',$x);
		    }
		    else{
		       redirect('Login');
		    }
	  	}

	  	function saveMetodePembayaran(){
	  		$metpem_nama = $this->input->post('mp_nama');
	  		$this->m_pemesanan->save_Metpem($metpem_nama);
	  		echo $this->session->set_flashdata('msg','success');
	       	redirect('Admin/Pemesanan/metode_pembayaran');
	  	}

	  	function updateMetodePembayaran(){
	  		$id = $this->input->post('mp_id');
	  		$metpem_nama = $this->input->post('mp_nama');
	  		$this->m_pemesanan->update_Metpem($id,$metpem_nama);
	  		echo $this->session->set_flashdata('msg','update');
	       	redirect('Admin/Pemesanan/metode_pembayaran');
	  	}

	  	function hapusMetodePembayaran(){
	  		$id = $this->input->post('mp_id');
	  		$this->m_pemesanan->hapus_Metpem($id);
	  		echo $this->session->set_flashdata('msg','delete');
	       	redirect('Admin/Pemesanan/metode_pembayaran');
	  	}


	  	function kategori_barang(){
	  		if($this->session->userdata('akses') == 2 && $this->session->userdata('masuk') == true){
		       $y['title'] = "Kategori Barang";
		       $x['metpem'] = $this->m_pemesanan->getAllkategori();
		       $this->load->view('v_header',$y);
		       $this->load->view('admin/v_sidebar');
		       $this->load->view('admin/v_kategori',$x);
		    }
		    else{
		       redirect('Login');
		    }
	  	}

	  	function save_kategori(){
	  		$metpem_nama = $this->input->post('mp_nama');
	  		$this->m_pemesanan->save_Metpem($metpem_nama);
	  		echo $this->session->set_flashdata('msg','success');
	       	redirect('Admin/Pemesanan/metode_pembayaran');
	  	}

	  	function update_kategori(){
	  		$id = $this->input->post('mp_id');
	  		$metpem_nama = $this->input->post('mp_nama');
	  		$this->m_pemesanan->update_Metpem($id,$metpem_nama);
	  		echo $this->session->set_flashdata('msg','update');
	       	redirect('Admin/Pemesanan/metode_pembayaran');
	  	}

	  	function hapus_kategori(){
	  		$id = $this->input->post('mp_id');
	  		$this->m_pemesanan->hapus_Metpem($id);
	  		echo $this->session->set_flashdata('msg','delete');
	       	redirect('Admin/Pemesanan/metode_pembayaran');
	  	}
	}
?>