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
		     $this->load->model('m_stock');
		    $this->load->model('m_list_barang');
		    $this->load->model('M_history_stock_barang_keluar');
		    $this->load->model('M_history_stock_barang_masuk');
		    $this->load->model('M_history_stock_barang_kembali');

		    $this->load->model('m_pemesanan_new');
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
	  			$x['toko'] = $this->m_pemesanan_new->getAlltoko();
		       	$this->load->view('v_header',$y);
		       	$this->load->view('owner/v_sidebar');
		       	$this->load->view('owner/v_stock_keluar',$x);
		    }
		    else{
		       redirect('Login');
		    }
	  	}
	  	function stok_keluar_filter(){
	  		if($this->session->userdata('akses') == 1 && $this->session->userdata('masuk') == true){
	  			$y['title'] = "Stock Keluar";
	  			$dari = $this->input->post('daritgl');
		       	$ke = $this->input->post('ketgl');
		       	$id_toko = $this->input->post('toko');
		       	if($dari==''){
		       		$dari="2020-05-21";
		       	}

		       	if($ke==''){
		       		$ke=date("Y-m-d");
		       	}
	  			$x['stock'] = $this->M_history_stock_barang_keluar->getHistoryStock_all_filter($dari,$ke,$id_toko);

	  			$x['toko'] = $this->m_pemesanan_new->getAlltoko();
		       
		       	if ($_POST['action'] == 'filter') {
			        	$this->load->view('v_header',$y);
				       	$this->load->view('owner/v_sidebar');
				       	$this->load->view('owner/v_stock_keluar',$x);
				} else if ($_POST['action'] == 'cetak') {
					
				     	$x['tanggal']=$dari." sampai ".$ke;
		       			$this->load->view('v_cetak_stok_keluar',$x);
				   
				}
		    }
		    else{
		       redirect('Login');
		    }
	  	}

	  
	  	function update_stok(){
	  		$barang_id = $this->input->post('barang');
	  		$qty = $this->input->post('qty');
	  		$id_toko = $this->input->post('toko');
	  		$size = sizeof($barang_id);
	  		for($i=0; $i < $size; $i++){
	  			$this->m_stock->update_stok($barang_id[$i], $qty[$i],$id_toko);
	  		}

	  		echo $this->session->set_flashdata('msg','success');
	       	redirect("Owner/Stock/stok_masuk");	
	  	}
	  	function stok_masuk(){
	  		if($this->session->userdata('akses') == 1 && $this->session->userdata('masuk') == true){
	  			$y['title'] = "Stock Masuk";
	  			
	  			$x['stock'] = $this->M_history_stock_barang_masuk->getHistoryStock_all();
	  			$x['toko'] = $this->m_pemesanan_new->getAlltoko();
	  			$x['nonreseller'] = $this->m_barang_new->get_barang();
		       	$this->load->view('v_header',$y);
		       	$this->load->view('owner/v_sidebar');
		       	$this->load->view('owner/v_stock_masuk',$x);
		    }
		    else{
		       redirect('Login');
		    }
	  	}

	  	function stok_masuk_filter(){
	  		if($this->session->userdata('akses') == 1 && $this->session->userdata('masuk') == true){
	  			$y['title'] = "Stock Masuk";
	  			$dari = $this->input->post('daritgl');
		       	$ke = $this->input->post('ketgl');
		       	$id_toko = $this->input->post('toko');
		       	if($dari==''){
		       		$dari="2020-05-21";
		       	}

		       	if($ke==''){
		       		$ke=date("Y-m-d");
		       	}
	  			$x['stock'] = $this->M_history_stock_barang_masuk->getHistoryStock_all_filter($dari,$ke,$id_toko);
	  			$x['toko'] = $this->m_pemesanan_new->getAlltoko();
	  			$x['nonreseller'] = $this->m_barang_new->get_barang();
		       
		       	if ($_POST['action'] == 'filter') {
			        	$this->load->view('v_header',$y);
				       	$this->load->view('owner/v_sidebar');
				       	$this->load->view('owner/v_stock_masuk',$x);
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
