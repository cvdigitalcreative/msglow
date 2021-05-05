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
		     $this->load->model('m_stock');
		    $this->load->model('m_list_barang');
		    $this->load->model('M_history_stock_barang_keluar');
		    $this->load->model('M_history_stock_barang_masuk');
		    $this->load->model('M_history_stock_barang_kembali');
		    $this->load->library('upload');
	  	}

	  	function index(){
	  		if($this->session->userdata('akses') == 1 && $this->session->userdata('masuk') == true){
	  			$y['title'] = "Stock";
	  			$x['stock'] = $this->m_barang->getAllBarang();
		       	$this->load->view('v_header',$y);
		       	$this->load->view('owner/v_sidebar');
		       	$this->load->view('owner/v_stock',$x);
		    }
		    else{
		       redirect('Login');
		    }
	  	}
	  	function stok_keluar(){
	  		if($this->session->userdata('akses') == 1 && $this->session->userdata('masuk') == true){
	  			$y['title'] = "Stock Keluar";
	  			$x['stock'] = $this->M_history_stock_barang_keluar->getHistoryStock_all();
		       	$this->load->view('v_header',$y);
		       	$this->load->view('owner/v_sidebar');
		       	$this->load->view('owner/v_stock_keluar',$x);
		    }
		    else{
		       redirect('Login');
		    }
	  	}

	  	function cari_stok_keluar(){
	  		if($this->session->userdata('akses') == 1 && $this->session->userdata('masuk') == true){
	  			$dari = $this->input->post('daritgl');
			    $ke = $this->input->post('ketgl');
			 	$x['tanggal']=$dari." sampai ".$ke;
	  			$y['title'] = "Stock Keluar dari ".$dari." sampai ".$ke;
	  			$x['stock'] = $this->M_history_stock_barang_keluar->getHistoryStock_all_by_tanggal_filter($dari,$ke);
               $this->load->view('v_header',$y);
		       	$this->load->view('owner/v_sidebar');
		       	$this->load->view('owner/v_stock_keluar_cari',$x);
		    }
		    else{
		       redirect('Login');
		    }
	  	}
	  	function cetak_stok_keluar(){
	  		if($this->session->userdata('akses') == 1 && $this->session->userdata('masuk') == true){
	  			$dari = $this->input->post('daritgl');
			    $ke = $this->input->post('ketgl');
			 
	  			$y['title'] = "Stock Keluar";
	  			$x['stock'] = $this->M_history_stock_barang_keluar->getHistoryStock_all_by_tanggal_filter($dari,$ke);
               	$x['tanggal']=$dari." sampai ".$ke;
		   
		       	$this->load->view('v_cetak_stok_keluar',$x);
		    }
		    else{
		       redirect('Login');
		    }
	  	}
	  	function update_stok(){
	  		$barang_id = $this->input->post('barang');
	  		$qty = $this->input->post('qty');
	  		$size = sizeof($barang_id);
	  		for($i=0; $i < $size; $i++){
	  			$this->m_stock->update_stok($barang_id[$i], $qty[$i]);
	  		}

	  		echo $this->session->set_flashdata('msg','success');
	       	redirect("Owner/Stock/stok_masuk");	
	  	}
	  	function stok_masuk(){
	  		if($this->session->userdata('akses') == 1 && $this->session->userdata('masuk') == true){
	  			$y['title'] = "Stock Masuk";
	  			$x['stock'] = $this->M_history_stock_barang_masuk->getHistoryStock_all();
	  			$x['nonreseller'] = $this->m_barang->getDataNonReseller11();
		       	$this->load->view('v_header',$y);
		       	$this->load->view('owner/v_sidebar');
		       	$this->load->view('owner/v_stock_masuk',$x);
		    }
		    else{
		       redirect('Login');
		    }
	  	}
	  	function cetak_stok_masuk(){
	  		if($this->session->userdata('akses') == 1 && $this->session->userdata('masuk') == true){
	  			$dari = $this->input->post('daritgl');
			    $ke = $this->input->post('ketgl');
			 
	  			$y['title'] = "Stock Masuk";
	  			$x['stock'] = $this->M_history_stock_barang_masuk->getHistoryStock_all_by_tanggal_filter($dari,$ke);
               	$x['tanggal']=$dari." sampai ".$ke;
		       	$this->load->view('v_cetak_stock_masuk',$x);
		    }
		    else{
		       redirect('Login');
		    }
	  	}
	  	function cari_stok_masuk(){
	  		if($this->session->userdata('akses') == 1 && $this->session->userdata('masuk') == true){
	  			$dari = $this->input->post('daritgl');
			    $ke = $this->input->post('ketgl');
			 
	  			$y['title'] = "Stock Masuk dari ".$dari." sampai ".$ke;
	  			$x['stock'] = $this->M_history_stock_barang_masuk->getHistoryStock_all_by_tanggal_filter($dari,$ke);
	  			$x['nonreseller'] = $this->m_barang->getDataNonReseller11();
               $this->load->view('v_header',$y);
		       	$this->load->view('owner/v_sidebar');
		       	$this->load->view('owner/v_stock_masuk',$x);
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
		       	$this->load->view('v_header',$y);
		       	$this->load->view('owner/v_sidebar');
		       	$this->load->view('owner/v_stock_kembali',$x);
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
