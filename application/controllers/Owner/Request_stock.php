<?php 
	/**
	 * 
	 */
	class Request_stock extends CI_Controller
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
	  		if($this->session->userdata('akses') == 1 && $this->session->userdata('masuk') == true){
	  			$y['title'] = "Stock";
	  			$x['stock'] = $this->m_request_stock->get_request_stock();
	  			$x['nonreseller'] = $this->m_barang_new->get_barang();
	  			$x['toko'] = $this->m_pemesanan_new->getAlltoko();
		       	$this->load->view('v_header',$y);
		       	$this->load->view('owner/v_sidebar');
		       	$this->load->view('owner/v_request_stok',$x);
		    }
		    else{
		       redirect('Login');
		    }
	  	}
	  	
	  
	  	function tambah_request_stock(){
	  		if($this->session->userdata('akses') == 1 && $this->session->userdata('masuk') == true){
		  		$barang_nama = $this->input->post('barang');
		  		$jumlah = $this->input->post('qty');
		  		$id_toko_dari = $this->input->post('dari_toko');
		  		$id_toko_ke = $this->input->post('ke_toko');
		  		$id_admin=$this->session->userdata('id');
		  		$tanggal_acc = date("Y-m-d");
		  		$status = 1;
		  		$this->m_request_stock->tambah_request_stock($barang_nama,$jumlah,$id_toko_dari,$id_toko_ke,$id_admin,$tanggal_acc,$status);
		  		echo $this->session->set_flashdata('msg','success');
		       	redirect("Owner/Request_stock");	
	       }else{
		       redirect('Login');
		    }
	  	}

	  	function acc_request_stock(){
	  		if($this->session->userdata('akses') == 1 && $this->session->userdata('masuk') == true){
	  			$id_request = $this->input->post('id_request');
		  		$barang_nama = $this->input->post('barang');
		  		$jumlah = $this->input->post('qty');
		  		$id_toko_dari = $this->input->post('dari_toko');
		  		$id_toko_ke = $this->input->post('ke_toko');
		  		$id_admin=$this->session->userdata('id');
		  		$tanggal_acc = date("Y-m-d");
		  		$status = 1;
		  		$this->m_request_stock->acc_request_stock($barang_nama,$jumlah,$id_toko_dari,$id_toko_ke,$id_admin,$tanggal_acc,$status,$id_request );
		  		echo $this->session->set_flashdata('msg','success');
		       	redirect("Owner/Request_stock");	
	       }else{
		       redirect('Login');
		    }
	  	}

	  	function history_request_toko(){
	  		if($this->session->userdata('akses') == 1 && $this->session->userdata('masuk') == true){
	  			$y['title'] = "Stock";
	  			$x['stock'] = $this->m_request_stock->get_request_stock_acc();
	  			$x['nonreseller'] = $this->m_barang_new->get_barang();
	  			$x['toko'] = $this->m_pemesanan_new->getAlltoko();
		       	$this->load->view('v_header',$y);
		       	$this->load->view('owner/v_sidebar');
		       	$this->load->view('owner/v_request_stock_history',$x);
		    }
		    else{
		       redirect('Login');
		    }
	  	}

	  	function history_request_toko_filter(){
	  		if($this->session->userdata('akses') == 1 && $this->session->userdata('masuk') == true){
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
				       	$this->load->view('owner/v_sidebar');
				       	$this->load->view('owner/v_request_stock_history',$x);
				} else if ($_POST['action'] == 'cetak') {
					
				     	$x['tanggal']=$dari." sampai ".$ke;
		       			$this->load->view('v_cetak_stock_masuk',$x);
				   
				}
		    }
		    else{
		       redirect('Login');
		    }
	  	}

	  	
	  	function stok_kembali(){
	  		if($this->session->userdata('akses') == 1 && $this->session->userdata('masuk') == true){
	  			$y['title'] = "Stock Kembali";
	  			$x['stock'] = $this->M_history_stock_barang_kembali->getHistoryStock_all();
	  			$x['nonreseller'] = $this->m_barang->getDataNonReseller11();
	  			$x['toko'] = $this->m_pemesanan_new->getAlltoko();
		       	$this->load->view('v_header',$y);
		       	$this->load->view('owner/v_sidebar');
		       	$this->load->view('owner/v_stock_kembali',$x);
		    }
		    else{
		       redirect('Login');
		    }
	  	}

	  	function stok_kembali_filter(){
	  		if($this->session->userdata('akses') == 1 && $this->session->userdata('masuk') == true){
	  			$y['title'] = "Stock Kembali";
	  			$dari = $this->input->post('daritgl');
		       	$ke = $this->input->post('ketgl');
		       	$id_toko = $this->input->post('toko');
		       	if($dari==''){
		       		$dari="2020-05-21";
		       	}

		       	if($ke==''){
		       		$ke=date("Y-m-d");
		       	}
	  			$x['stock'] = $this->M_history_stock_barang_kembali->getHistoryStock_all_filter($dari,$ke,$id_toko);
	  			$x['toko'] = $this->m_pemesanan_new->getAlltoko();
	  			$x['nonreseller'] = $this->m_barang_new->get_barang();
		       
		       	if ($_POST['action'] == 'filter') {
			        	$this->load->view('v_header',$y);
				       	$this->load->view('owner/v_sidebar');
				       	$this->load->view('owner/v_stock_kembali',$x);
				} else if ($_POST['action'] == 'cetak') {
					
				     	$x['tanggal']=$dari." sampai ".$ke;
		       			$this->load->view('v_cetak_stock',$x);
				   
				}
		    }
		    else{
		       redirect('Login');
		    }
	  	}

	  	function cetak_stok_kembali(){
	  		if($this->session->userdata('akses') == 1 && $this->session->userdata('masuk') == true){
	  			$dari = $this->input->post('daritgl');
			    $ke = $this->input->post('ketgl');
			 
	  			$y['title'] = "Stock Kembali";
	  			$x['stock'] = $this->M_history_stock_barang_kembali->getHistoryStock_all_by_tanggal_filter($dari,$ke);
               	$x['tanggal']=$dari." sampai ".$ke;
		   
		       	$this->load->view('v_cetak_stock',$x);
		    }
		    else{
		       redirect('Login');
		    }
	  	}
	  	function cari_stok_kembali(){
	  		if($this->session->userdata('akses') == 1 && $this->session->userdata('masuk') == true){
	  			$dari = $this->input->post('daritgl');
			    $ke = $this->input->post('ketgl');
			 
	  			$y['title'] = "Stock Kembali dari ".$dari." sampai ".$ke;
	  			$x['stock'] = $this->M_history_stock_barang_kembali->getHistoryStock_all_by_tanggal_filter($dari,$ke);
	  			$x['nonreseller'] = $this->m_barang->getDataNonReseller11();
               $this->load->view('v_header',$y);
		       	$this->load->view('owner/v_sidebar');
		       	$this->load->view('owner/v_stock_kembali',$x);
		    }
		    else{
		       redirect('Login');
		    }
	  	}
	  	
	}
?>
