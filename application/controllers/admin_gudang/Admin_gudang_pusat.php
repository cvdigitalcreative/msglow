<?php 
	/**
	 * 
	 */
	class Admin_gudang_pusat extends CI_Controller
	{
		
		function __construct()
	  	{
		    parent:: __construct();
		    if($this->session->userdata('masuk') !=TRUE){
		      $url=base_url('Login');
		      redirect($url);
		    };

		    $this->load->model('m_request_stock');
		    $this->load->model('m_paket');
		    $this->load->model('m_pemesanan_new');
		    $this->load->model('m_stock');
		    $this->load->model('m_pemesanan');
		    $this->load->model('m_barang_new');
		      $this->load->model('m_barang');
		    $this->load->library('upload');
	  	}

	  	function index(){
	  		if($this->session->userdata('akses') == 3 && $this->session->userdata('masuk') == true){
	  			$y['title'] = "Stock";
	  			$x['stock'] = $this->m_request_stock->get_request_stock();
	  			$x['nonreseller'] = $this->m_barang_new->get_barang();
	  			$x['toko'] = $this->m_pemesanan_new->getAlltoko();
		       	$this->load->view('v_header',$y);
		       	$this->load->view('admin/gudang/v_sidebar_admin_pusat');
		       	$this->load->view('admin/gudang/v_request_stok',$x);
		    }
		    else{
		       redirect('Login');
		    }
	  	}

	  	function lihat_barang(){
	  		if($this->session->userdata('akses') == 3 && $this->session->userdata('masuk') == true){
		       $y['title'] = "Barang Customer";
		       $x['nonreseller'] = $this->m_barang_new->get_all_barang_customer();
		       $x['total_omset']=$this->m_barang->getTotalomsetBarang();
		       $x['total_untung']=$this->m_barang->getTotalUntung();
		       $x['kategori'] = $this->m_pemesanan->getAllkategori();
		        $x['toko'] = $this->m_pemesanan_new->getAlltoko();
		       $this->load->view('v_header',$y);
		       $this->load->view('admin/gudang/v_sidebar_admin_pusat');
		       $this->load->view('admin/gudang/v_barang_non_reseller',$x);
		    }
		    else{
		       redirect('Login');
		    }
	  	}
	  	function barang_filter(){
	  		if($this->session->userdata('akses') == 3 && $this->session->userdata('masuk') == true){
		       $y['title'] = "Barang Customer";
		       $id_toko = $this->input->post('toko');
		       $x['nonreseller'] = $this->m_barang_new->get_all_barang_customer_filter_toko($id_toko);
		       $x['total_omset']=$this->m_barang->getTotalomsetBarang();
		       $x['total_untung']=$this->m_barang->getTotalUntung();
		       $x['kategori'] = $this->m_pemesanan->getAllkategori();
		        $x['toko'] = $this->m_pemesanan_new->getAlltoko();
		        if ($_POST['action'] == 'filter') {
			       	$this->load->view('v_header',$y);
		       		$this->load->view('admin/gudang/v_sidebar_admin_pusat');
		       		$this->load->view('admin/gudang/v_barang_non_reseller',$x);
				} else if ($_POST['action'] == 'cetak') {
				    //action for delete
				     $this->load->view('admin/gudang/v_cetak_laporan',$x);
				}
		      
		    }
		    else{
		       redirect('Login');
		    }
	  	}

	  	function paket_stok(){
	  		if($this->session->userdata('akses') == 3 && $this->session->userdata('masuk') == true){
	  			$y['title'] = "Buat Paket";
	  			$x['barang'] = $this->m_paket->get_barang_paket();
		       $x['kategori'] = $this->m_pemesanan->getAllkategori();
	  			$x['barang_pecahaan'] = $this->m_paket->get_barang_pecahaan();
		       	$this->load->view('v_header',$y);
		       	$this->load->view('admin/gudang/v_sidebar_admin_pusat');
		       	$this->load->view('admin/gudang/v_paket_pecahaan',$x);
		    }
		    else{
		       redirect('Login');
		    }
	  	}
	  	function tambah_stok_paket(){
	  		if($this->session->userdata('akses') == 3 && $this->session->userdata('masuk') == true){
	  			$id_paket = $this->input->post('barang');
	  			$qty = $this->input->post('qty');
	  			$temp=$this->m_paket->get_barang_pecahaan_paket_by_id($id_paket)->result_array();
	  			$size = sizeof($temp);
	  			$id_toko=1;
	  			$checked=false;
	  			foreach($temp as $i){
	  				$id_barang= $i['id_barang'];
	  				$jumlah_stok=$i['jumlah']*$qty;
	  				$x = $this->db->query("SELECT barang_stock_akhir FROM barang WHERE barang_id = '$id_barang' and id_toko='$id_toko'")->row_array();
					$barang_stock_akhir=$x['barang_stock_akhir'];
					if($barang_stock_akhir<$jumlah_stok){
						$checked=true;
					}
	  				
	  			}
	  			if($checked==true){
	  				echo $this->session->set_flashdata('msg','error');
					redirect('admin_gudang/Admin_gudang_pusat/paket_stok');
	  			}else{
	  				foreach($temp as $i){
		  				$id_barang= $i['id_barang'];
		  				$jumlah_stok=$i['jumlah']*$qty;
		  				$this->m_paket->update_stok_pecahaan($id_barang, $jumlah_stok,$id_toko);
		  			}
		  			$this->m_paket->update_stok_paket($id_paket, $qty,$id_toko);
		  			echo $this->session->set_flashdata('msg','success');
					redirect('admin_gudang/Admin_gudang_pusat/paket_stok');
	  			}
	  			
	  		}
	  	}
	  	
	  	function tambah_paket_barang(){
	  		if($this->session->userdata('akses') == 3 && $this->session->userdata('masuk') == true){
		  		//Config Upload File 
					$config['upload_path'] = './assets/image_barang/'; //Tempat menyimpan file
			        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //tipe filenya 
			        $config['max_size']             = 0; //size limits

			        $harga_jual =str_replace(".", "",$this->input->post('harga_jual')) ;
			        $paket = $this->input->post('paket');
					$barang = $this->input->post('barang');
					$stock_awal = $this->input->post('stock_akhir');
					$stock_akhir = $this->input->post('stock_akhir');
					$kategori = $this->input->post('kategori');
					$level = 2;
					$harga_modal=0;
	  				$qty = $this->input->post('qty');
			  		$barang_id = $this->input->post('barang');
			  		$size = sizeof($barang_id);
			  	
			  		$suplier="-";
			  		$id_paket=uniqid();
					for($i=0; $i < $size; $i++){
			  			$temp=$this->m_paket->get_barang_by_id($barang_id[$i])->row_array();
	  					$harga_modal=$harga_modal+$temp['harga_modal'];
	  					$barang_nama=$temp['barang_nama'];
			  			$id_barang=$barang_id[$i];
			  			$jumlah=$qty[$i];
			  			$this->m_paket->save_paket($id_paket,$paket,$id_barang,$barang_nama,$jumlah);
	  				}
	  			
			        $this->upload->initialize($config);
			        if(!empty($_FILES['filefoto']['name']))// cek apakah file ada di form
			        {
			            if ($this->upload->do_upload('filefoto'))// cek kondisi do_upload == true
			            {
			                $gbr = $this->upload->data(); // upload data 
			                $gambar=$gbr['file_name']; //ambil file nama
					  		
					  		$this->m_paket->savebarang($id_paket,$paket, $stock_awal, $stock_akhir, $harga_modal, $level, $gambar,$kategori,$suplier,$harga_jual);
					  		
							echo $this->session->set_flashdata('msg','success_non_reseller');

			                redirect('admin_gudang/Admin_gudang_pusat/paket_stok');
						}else{
			                // echo $this->session->set_flashdata('msg','warning');
			                // redirect('Owner/Barang');
			                $gambar=$_FILES['filefoto']['name']; //ambil file nama
					  		$this->m_paket->savebarang($id_paket,$paket, $stock_awal, $stock_akhir, $harga_modal, $level, $gambar,$kategori,$suplier,$harga_jual);
					  		
							echo $this->session->set_flashdata('msg','success_non_reseller');
							  die();
			                redirect('admin_gudang/Admin_gudang_pusat/paket_stok');
			            } 

			        }else{
			        	echo $this->session->set_flashdata('msg','eroor');
						redirect('admin_gudang/Admin_gudang_pusat/paket_stok');
					}	
	       }else{
		       redirect('Login');
		    }
	  	}


	  	function request_dari_gudang_lain(){
	  		if($this->session->userdata('akses') == 3 && $this->session->userdata('masuk') == true){
	  			$y['title'] = "Stock";
	  			$x['stock'] = $this->m_request_stock->get_request_stock_dari_gudang_lain();
	  			$x['nonreseller'] = $this->m_barang_new->get_barang();
	  			$x['toko'] = $this->m_pemesanan_new->getAlltoko();
		      
		       		$this->load->view('v_header',$y);
		       	$this->load->view('admin/gudang/v_sidebar_admin_pusat');
		       	$this->load->view('admin/gudang/request_dari_gudang_lain',$x);
		    }
		    else{
		       redirect('Login');
		    }
	  	}

	  	function acc_request_dari_gudang_lain(){
	  		if($this->session->userdata('akses') == 3 && $this->session->userdata('masuk') == true){
	  			$id_request = $this->input->post('id_request');
		  		$barang_nama = $this->input->post('barang');
		  		$jumlah = $this->input->post('qty');
		  		$id_toko_dari = $this->input->post('dari_toko');
		  		$id_toko_ke = $this->input->post('ke_toko');
		  		$id_admin=$this->session->userdata('id');
		  		$tanggal_acc = date("Y-m-d");
		  		$status = 0;
		  		$this->m_request_stock->acc_request_stock_dari_gudang_lain($barang_nama,$jumlah,$id_toko_dari,$id_toko_ke,$id_admin,$tanggal_acc,$status,$id_request );
		  		echo $this->session->set_flashdata('msg','success');
		       	redirect("admin_gudang/Admin_gudang_pusat/request_dari_gudang_lain");	
	       }else{
		       redirect('Login');
		    }
	  	}


	  	function tambah_request_stock(){
	  		if($this->session->userdata('akses') == 3 && $this->session->userdata('masuk') == true){
		  		$barang_nama = $this->input->post('barang');
		  		$jumlah = $this->input->post('qty');
		  		$id_toko_dari = $this->input->post('dari_toko');
		  		$id_toko_ke = $this->input->post('ke_toko');
		  		$id_admin=$this->session->userdata('id');
		  		$tanggal_acc = date("Y-m-d");
		  		$status = 0;
		  		$this->m_request_stock->tambah_request_stock_admin($barang_nama,$jumlah,$id_toko_dari,$id_toko_ke,$id_admin,$tanggal_acc,$status);
		  		echo $this->session->set_flashdata('msg','success');
		       	redirect("admin_gudang/Admin_gudang_pusat");	
	       }else{
		       redirect('Login');
		    }
	  	}

	  	

	  	function suplier_stock(){
	  		if($this->session->userdata('akses') == 3 && $this->session->userdata('masuk') == true){
	  			$y['title'] = "Stock";
	  			$x['stock'] = $this->m_request_stock->get_request_stock_suplier();
	  			$x['nonreseller'] = $this->m_barang_new->get_barang();
	  			$x['toko'] = $this->m_pemesanan_new->getAlltoko();
		       	$this->load->view('v_header',$y);
		       	$this->load->view('admin/gudang/v_sidebar_admin_pusat');
		       	$this->load->view('admin/gudang/v_request_stok_suplier',$x);
		    }
		    else{
		       redirect('Login');
		    }
	  	}

	  	function tambah_suplier_stock(){
	  		if($this->session->userdata('akses') == 3 && $this->session->userdata('masuk') == true){
		  		$barang_nama = $this->input->post('barang');
		  		$jumlah = $this->input->post('qty');
		  		$id_toko_dari = $this->input->post('dari_toko');
		  		$id_toko_ke = $this->input->post('ke_toko');
		  		$id_admin=$this->session->userdata('id');
		  		$suplier=$this->input->post('suplier');
		  		$tanggal_acc = date("Y-m-d");
		  		$status = 2;
		  		$this->m_request_stock->tambah_suplier_stock_admin($barang_nama,$jumlah,$id_toko_dari,$id_toko_ke,$id_admin,$tanggal_acc,$status,$suplier);
		  		echo $this->session->set_flashdata('msg','success');
		       		redirect("admin_gudang/Admin_gudang_pusat/suplier_stock");	
	       }else{
		       redirect('Login');
		    }
	  	}

	  

	  	function history_request_toko(){
	  		if($this->session->userdata('akses') == 3 && $this->session->userdata('masuk') == true){
	  			$y['title'] = "Stock";
	  			$x['stock'] = $this->m_request_stock->get_request_stock_acc();
	  			$x['nonreseller'] = $this->m_barang_new->get_barang();
	  			$x['toko'] = $this->m_pemesanan_new->getAlltoko();
		       	$this->load->view('v_header',$y);
		       	$this->load->view('admin/gudang/v_sidebar_admin_pusat');
		       	$this->load->view('admin/gudang/v_request_stok_history',$x);
		    }
		    else{
		       redirect('Login');
		    }
	  	}

	  	function history_request_toko_filter(){
	  		if($this->session->userdata('akses') == 3 && $this->session->userdata('masuk') == true){
	  			$y['title'] = "Stock Masuk";
	  			$dari = $this->input->post('daritgl');
		       	$ke = $this->input->post('ketgl');
		       	if($dari==''){
		       		$dari="2020-05-21";
		       	}

		       	if($ke==''){
		       		$ke=date("Y-m-d");
		       	}
	  			$x['stock'] = $this->m_request_stock->get_request_stock_acc_filter($dari,$ke);
	  			$x['nonreseller'] = $this->m_barang_new->get_barang();
	  			$x['toko'] = $this->m_pemesanan_new->getAlltoko();
		       
		       	if ($_POST['action'] == 'filter') {
			        	$this->load->view('v_header',$y);
				       	$this->load->view('admin/gudang/v_sidebar_admin_pusat');
		       			$this->load->view('admin/gudang/v_request_stok_history',$x);
				} else if ($_POST['action'] == 'cetak') {
					
				     	$x['tanggal']=$dari." sampai ".$ke;
		       			$this->load->view('v_cetak_stock_masuk',$x);
				   
				}
		    }
		    else{
		       redirect('Login');
		    }
	  	}

	  	
	  	
	  	
	}
?>
