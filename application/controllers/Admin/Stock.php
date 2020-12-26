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
		    $this->load->model('m_list_barang');
		    $this->load->model('M_history_stock_barang_keluar');
		    
		    $this->load->model('M_history_stock_barang_kembali');
		    $this->load->library('upload');
	  	}

	  	function index(){
	  		if($this->session->userdata('akses') == 2 && $this->session->userdata('masuk') == true){
	  			$y['title'] = "Stock";
	  			$x['stock'] = $this->m_barang->getAllBarang();
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
	  			$x['stock'] = $this->m_barang->getAllBarang();
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
	  			$x['stock'] = $this->M_history_stock_barang_keluar->getHistoryStock_all_by_tanggal();
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
	  			$x['stock'] = $this->M_history_stock_barang_keluar->getHistoryStock_all_by_tanggal();
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
	  			$x['stock'] = $this->M_history_stock_barang_kembali->getHistoryStock_all_by_tanggal();
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
	  			$x['stock'] = $this->M_history_stock_barang_kembali->getHistoryStock_all_by_tanggal();
	  			$cur_date = date("Y-m-d H:i:s");
               	$x['tanggal']=$cur_date;
		   
		       	$this->load->view('v_cetak_stock_masuk',$x);
		    }
		    else{
		       redirect('Login');
		    }
	  	}

	  	function history($barang_id){
 	  		if($this->session->userdata('akses') == 2 && $this->session->userdata('masuk') == true){
 	  			$y['title'] = "Stock";
	 	  		   $x['stock'] = $this->m_barang->getHistoryStock($barang_id);	
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