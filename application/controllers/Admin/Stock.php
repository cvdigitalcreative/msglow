<?php 
	/**
	 * 
	 */
	class stock extends CI_Controller
	{
		
		function __construct()
	  	{
		    parent:: __construct();
		    if($this->session->userdata('masuk') !=TRUE){
		      $url=base_url('Login');
		      redirect($url);
		    };

		    $this->load->model('m_pemesanan');
		    $this->load->model('m_barang');
		     $this->load->model('m_barang_new');
		    $this->load->model('m_list_barang');
		    $this->load->model('M_history_stock_barang_keluar');
		    
		    $this->load->model('M_history_stock_barang_kembali');
		    $this->load->library('upload');
	  	}

	  	function index(){
	  		if($this->session->userdata('akses') == 2 && $this->session->userdata('masuk') == true){
	  			$y['title'] = "Stock";
	  			$id_toko=$this->session->userdata('id_toko');
	  			$x['stock'] = $this->m_barang_new->get_all_barang_by_toko($id_toko);
		       	$this->load->view('v_header',$y);
		       	$this->load->view('admin/v_sidebar');
		       	$this->load->view('admin/v_stock',$x);
		    }
		    else{
		       redirect('Login');
		    }
	  	}
	  	function cetak_stok_keseluruhan(){
	  		if($this->session->userdata('akses') == 2 && $this->session->userdata('masuk') == true){
	  			$y['title'] = "Stock Keluar";
	  			$id_toko=$this->session->userdata('id_toko');
	  			$x['stock'] = $this->m_barang_new->get_all_barang_by_toko($id_toko);
	  			$cur_date = date("Y-m-d H:i:s");
               	$x['tanggal']=$cur_date;
		   
		       	$this->load->view('v_cetak_stock_keseluruhan.php',$x);
		    }
		    else{
		       redirect('Login');
		    }
	  	}

	  	function stok_keluar(){
	  		if($this->session->userdata('akses') == 2 && $this->session->userdata('masuk') == true){
	  			$y['title'] = "Stock Keluar";
	  			$id_toko=$this->session->userdata('id_toko');
	  			$x['stock'] = $this->M_history_stock_barang_keluar->getHistoryStock_all_by_tanggal($id_toko);
		       	$this->load->view('v_header',$y);
		       	$this->load->view('admin/v_sidebar');
		       	$this->load->view('admin/v_stock_keluar',$x);
		    }
		    else{
		       redirect('Login');
		    }
	  	}
	  	function cetak_stok_keluar(){
	  		if($this->session->userdata('akses') == 2 && $this->session->userdata('masuk') == true){
	  			$y['title'] = "Stock Keluar";
	  			$id_toko=$this->session->userdata('id_toko');
	  			$x['stock'] = $this->M_history_stock_barang_keluar->getHistoryStock_all_by_tanggal($id_toko);
	  			$cur_date = date("Y-m-d H:i:s");
               	$x['tanggal']=$cur_date;
		       	$this->load->view('v_cetak_stock',$x);
		    }
		    else{
		       redirect('Login');
		    }
	  	}


	  	function stok_kembali(){
	  		if($this->session->userdata('akses') == 2 && $this->session->userdata('masuk') == true){
	  			$y['title'] = "Stock Kembali";
	  			$id_toko=$this->session->userdata('id_toko');
	  			$x['stock'] = $this->M_history_stock_barang_kembali->getHistoryStock_all_by_tanggal($id_toko);
		       	$this->load->view('v_header',$y);
		       	$this->load->view('admin/v_sidebar');
		       	$this->load->view('admin/v_stock_kembali',$x);
		    }
		    else{
		       redirect('Login');
		    }
	  	}
	  	function cetak_stok_kembali(){
	  		if($this->session->userdata('akses') == 2 && $this->session->userdata('masuk') == true){
	  			$y['title'] = "Stock Kembali";
	  			$id_toko=$this->session->userdata('id_toko');
	  			$x['stock'] = $this->M_history_stock_barang_kembali->getHistoryStock_all_by_tanggal($id_toko);
	  			$cur_date = date("Y-m-d H:i:s");
               	$x['tanggal']=$cur_date;
		   
		       	$this->load->view('v_cetak_stock_kembali',$x);
		    }
		    else{
		       redirect('Login');
		    }
	  	}

	  	function history($barang_id){
 	  		if($this->session->userdata('akses') == 2 && $this->session->userdata('masuk') == true){
 	  			$y['title'] = "Stock";
 	  			$id_toko=$this->session->userdata('id_toko');
	 	  		   $x['stock'] = $this->m_barang_new->getHistoryStock($barang_id,$id_toko);	
			       $this->load->view('v_header',$y);
			       $this->load->view('admin/v_sidebar');
			       $this->load->view('admin/v_history_stock',$x);
		       
		    }
		    else{
		       redirect('Login');
		    }
 	  	}
	}
?>