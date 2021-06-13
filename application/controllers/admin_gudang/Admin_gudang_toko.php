<?php 
	/**
	 * 
	 */
	class Admin_gudang_toko extends CI_Controller
	{
		
		function __construct()
	  	{
		    parent:: __construct();
		    if($this->session->userdata('masuk') !=TRUE){
		      $url=base_url('Login');
		      redirect($url);
		    };

		    $this->load->model('m_request_stock');

		    $this->load->model('m_pemesanan_new');
		    $this->load->model('m_barang_new');
		    $this->load->library('upload');
	  	}

	  	function index(){
	  		if($this->session->userdata('akses') == 4 && $this->session->userdata('masuk') == true){
	  			$y['title'] = "Stock";
	  			$id_toko=$this->session->userdata('id_toko');
	  			$x['stock'] = $this->m_request_stock->get_request_stock_by_toko($id_toko);
	  			$x['nonreseller'] = $this->m_barang_new->get_barang();
	  			$x['toko'] = $this->m_pemesanan_new->getAlltoko();
		       	$this->load->view('v_header',$y);
		       	$this->load->view('admin/gudang_toko/v_sidebar_admin_pusat');
		       	$this->load->view('admin/gudang_toko/v_request_stok',$x);
		    }
		    else{
		       redirect('Login');
		    }
	  	}
	  	
	  
	  	function tambah_request_stock(){
	  		if($this->session->userdata('akses') == 4 && $this->session->userdata('masuk') == true){
		  		$barang_nama = $this->input->post('barang');
		  		$jumlah = $this->input->post('qty');
		  		$id_toko_dari = $this->input->post('dari_toko');
		  		$id_toko_ke = $this->session->userdata('id_toko');
		  		$id_admin=$this->session->userdata('id');
		  		$tanggal_acc = date("Y-m-d");
		  		$status = 3;
		  		$this->m_request_stock->tambah_request_stock_admin($barang_nama,$jumlah,$id_toko_dari,$id_toko_ke,$id_admin,$tanggal_acc,$status);
		  		echo $this->session->set_flashdata('msg','success');
		       	redirect("admin_gudang/Admin_gudang_toko");	
	       }else{
		       redirect('Login');
		    }
	  	}

	  	

	  	
	  

	  	function history_request_toko(){
	  		if($this->session->userdata('akses') == 4 && $this->session->userdata('masuk') == true){
	  			$y['title'] = "Stock";

		  		$id_toko_ke = $this->session->userdata('id_toko');
	  			$x['stock'] = $this->m_request_stock->get_request_stock_acc_by_toko($id_toko_ke);
	  			$x['nonreseller'] = $this->m_barang_new->get_barang();
	  			$x['toko'] = $this->m_pemesanan_new->getAlltoko();
		       	$this->load->view('v_header',$y);
		       	$this->load->view('admin/gudang_toko/v_sidebar_admin_pusat');
		       	$this->load->view('admin/gudang_toko/v_request_stok_history',$x);
		    }
		    else{
		       redirect('Login');
		    }
	  	}

	  	function history_request_toko_filter(){
	  		if($this->session->userdata('akses') == 4 && $this->session->userdata('masuk') == true){
	  			$y['title'] = "Stock Masuk";
	  			$id_toko_ke = $this->session->userdata('id_toko');
	  			$dari = $this->input->post('daritgl');
		       	$ke = $this->input->post('ketgl');
		       	if($dari==''){
		       		$dari="2020-05-21";
		       	}

		       	if($ke==''){
		       		$ke=date("Y-m-d");
		       	}
	  			$x['stock'] = $this->m_request_stock->get_request_stock_acc_filter_by_toko($dari,$ke,$id_toko_ke);
	  			$x['nonreseller'] = $this->m_barang_new->get_barang();
	  			$x['toko'] = $this->m_pemesanan_new->getAlltoko();
		       
		       	if ($_POST['action'] == 'filter') {
			        	$this->load->view('v_header',$y);
				       	$this->load->view('admin/gudang_toko/v_sidebar_admin_pusat');
		       			$this->load->view('admin/gudang_toko/v_request_stok_history',$x);
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
