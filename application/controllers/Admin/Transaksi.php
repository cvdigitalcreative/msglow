<?php 
	/**
	 * 
	 */
	class Transaksi extends CI_Controller
	{
		
		function __construct()
	  	{
		    parent:: __construct();
		    if($this->session->userdata('masuk') !=TRUE){
		      $url=base_url('Login');
		      redirect($url);
		    };
		    $this->load->model('M_pemesanan_new');
		     $this->load->model('m_pemesanan');
		     $this->load->model('m_pemesanan_new');
		    $this->load->model('m_barang');
		    $this->load->model('m_barang_new');
		    $this->load->model('m_list_barang');
		    $this->load->model('m_diskon');
	  	}
	  	function hapus_pesanan(){
	  		$pemesanan_id = $this->input->post('pemesanan_id');
	  		$id_toko=$this->session->userdata('id_toko');
	  		$this->m_pemesanan_new->hapus_pesanan($pemesanan_id,$id_toko);
	  		echo $this->session->set_flashdata('msg','hapus');
	       	redirect($this->agent->referrer());	
	  	}

	  	function index(){
	  		if($this->session->userdata('akses') == 2 && $this->session->userdata('masuk') == true){
	  			$uid=$this->session->userdata('id');
		      	$id_toko=$this->session->userdata('id_toko');
		       $y['title'] = "Transaksi ALL";
		       $y['home_url'] = base_url()."Admin/Transaksi";
		       $y['url'] = base_url()."Admin/Transaksi";
		       $x['datapesanan']  = $this->M_pemesanan_new->getPemesanan_fix_admin_all($id_toko,$uid);
		    	$x['asal_transaksi'] = $this->M_pemesanan_new->getAllAT();
		       $x['toko'] = $this->M_pemesanan_new->getAlltoko();
		       $x['admin'] = $this->M_pemesanan_new->getAlladmin();
		       $x['metode_pembayaran'] = $this->M_pemesanan_new->getAllMetpem();
		       $x['jenis_customer'] = $this->M_pemesanan_new->getAllcustomer();
		       $x['kurir'] = $this->M_pemesanan_new->getAllkurir();
		        $x['total']  = $this->M_pemesanan_new->getPemesanan_sum()->result_array();
		       $x['level1']=0;
		       $this->load->view('v_header',$y);
		       $this->load->view('admin/v_sidebar');
		       $this->load->view('admin/new_version/v_transaksi',$x);
		    }
		    else{
		       redirect('Login');
		    }
		     
	  	}

	  	function filter(){
	  		if($this->session->userdata('akses') == 2 && $this->session->userdata('masuk') == true){
	  			$dari = $this->input->post('daritgl');
		       	$ke = $this->input->post('ketgl');
		       	$admin = $this->input->post('admin');
		       	$metode = $this->input->post('metode');
		       	$asal_transaksi = $this->input->post('asal_transaksi');
		       	$toko = $this->session->userdata('id_toko');
		       	$customer = $this->input->post('customer');

		       	if($dari==''){
		       		$dari="2020-05-21";
		       	}

		       	if($ke==''){
		       		$ke=date("Y-m-d");
		       	}

		       	if($admin==0){
		       		$admin="!=0";
		       	}else{
		       		$admin="=".$admin;
		       	}

		       	if($metode==0){
		       		$metode="!=0";
		       	}else{
		       		$metode="=".$metode;
		       	}

		       	if($asal_transaksi==0){
		       		$asal_transaksi="!=0";
		       	}else{
		       		$asal_transaksi="=".$asal_transaksi;
		       	}

		       	if($toko==0){
		       		$toko="!=0";
		       	}else{
		       		$toko="=".$toko;
		       	}
		       	$x['levels']="All";
		       	if($customer==0){
		       		$customer="!=0";
		       	}else{
		       		if($customer==2){
		       			$x['levels']="Customer";
		       		}else{
		       			$x['levels']="Reseller";
		       		}
		       		$customer="=".$customer;
		       	}
		      
		      
		       $y['title'] = "Transaksi ALL";
		       $y['home_url'] = base_url()."Admin/Transaksi";
		       $y['url'] = base_url()."Admin/Transaksi";
		       $x['datapesanan']  = $this->M_pemesanan_new->get_filter($dari,  $ke,$admin,$metode,$asal_transaksi,$toko,$customer);
		    	$x['asal_transaksi'] = $this->M_pemesanan_new->getAllAT();
		       
		       $x['toko'] = $this->M_pemesanan_new->getAlltoko();
		       $x['admin'] = $this->M_pemesanan_new->getAlladmin();
		       $x['metode_pembayaran'] = $this->M_pemesanan_new->getAllMetpem();
		       $x['jenis_customer'] = $this->M_pemesanan_new->getAllcustomer();
		        $x['total']  = $this->M_pemesanan_new->getPemesanan_filter_sum($dari,  $ke,$admin,$metode,$asal_transaksi,$toko,$customer)->result_array();
		       $x['level1']=0;
		       
		       if ($_POST['action'] == 'filter') {
			       	$this->load->view('v_header',$y);
			       	$this->load->view('admin/v_sidebar');
				     $this->load->view('admin/new_version/v_transaksi',$x);
				} else if ($_POST['action'] == 'cetak') {
				    //action for delete
				     $this->load->view('admin/new_version/v_cetak_laporan',$x);
				}
		      
		    }
		    else{
		       redirect('Login');
		    }
		     
	  	}

	}
?>