<?php
	/**
	 * 
	 */
	class Diskon extends CI_Controller
	{
		
		function __construct()
	  	{
		    parent:: __construct();
		    if($this->session->userdata('masuk') !=TRUE){
		      $url=base_url('Login');
		      redirect($url);
		    };

		    $this->load->model('m_barang');
		    $this->load->model('m_diskon');
		    $this->load->library('upload');
	  	}

	  	

	  	function save_diskon_pemesanan(){
	  		$diskon = str_replace(".", "", $this->input->post('diskon'));
	  		$nama_diskon = $this->input->post('nama_diskon');
	  		
				$this->m_diskon->saveDiskon_pemesanan($nama_diskon,$diskon);
	  			echo $this->session->set_flashdata('msg','success');
	            redirect('Subowner/Diskon/diskon_pemesanan');
	  	}

	  	function diskon_pemesanan(){
	  		if($this->session->userdata('akses') == 5 && $this->session->userdata('masuk') == true){
		       $y['title'] = "List Diskon Barang";
		       $x['diskon'] = $this->m_diskon->getDataDiskon_pemesanan();
		       $this->load->view('v_header',$y);
		       $this->load->view('subowner/v_sidebar');
		       $this->load->view('subowner/v_diskon_pemesanan',$x);
		    }
		    else{
		       redirect('Login');
		    }
	  	}
	  	function update_diskon_pemesanan(){
	  		$diskon = str_replace(".", "", $this->input->post('diskon'));
	  		$nama_diskon = $this->input->post('nama_diskon');
	  		$diskon_id = $this->input->post('diskon_id');
	  				

	  		$this->m_diskon->updateDiskon_pemesanan($diskon_id,$nama_diskon,$diskon);
	  			echo $this->session->set_flashdata('msg','update');
	               redirect('Subowner/Diskon/diskon_pemesanan');
	  	}
	  	function hapus_diskon_pemesanan(){
	  		$diskon_id = $this->input->post('diskon_id');
	  		$this->m_diskon->hapusDiskon_pemesanan($diskon_id);
	  		echo $this->session->set_flashdata('msg','delete');
	        redirect('Subowner/Diskon/diskon_pemesanan');
	  	}

	  	function index(){
	  		if($this->session->userdata('akses') == 5 && $this->session->userdata('masuk') == true){
		       $y['title'] = "List Diskon Barang";
		       $x['barang'] = $this->m_barang->getAllBarangR();
		       $x['diskon'] = $this->m_diskon->getDataDiskon();
		       $this->load->view('v_header',$y);
		       $this->load->view('subowner/v_sidebar');
		       $this->load->view('subowner/v_diskon',$x);
		    }
		    else{
		       redirect('Login');
		    }
	  	}

	  	function save_diskon(){
	  		$diskon = str_replace(".", "", $this->input->post('diskon'));
	  		$barang_id = $this->input->post('barang');
	  		$tanggal_mulai_diskon = $this->input->post('tanggal_mulai_diskon');
	  		$tanggal_akhir_diskon = $this->input->post('tanggal_akhir_diskon');

	  		if($diskon > 100){
	  			$this->m_diskon->saveDiskon($barang_id,$diskon,$tanggal_mulai_diskon,$tanggal_akhir_diskon);
	  			echo $this->session->set_flashdata('msg','success');
	            redirect('Subowner/Diskon');
	  		}elseif($diskon <= 100){
	  			$a = $this->db->query("SELECT * FROM barang_non_reseller WHERE barang_id='$barang_id'")->row_array();
	  			$diskon_new = ($a['bnr_harga'] * $diskon)/100;
	  			$this->m_diskon->saveDiskon($barang_id,$diskon,$tanggal_mulai_diskon,$tanggal_akhir_diskon);
	  			echo $this->session->set_flashdata('msg','success');
	            redirect('Subowner/Diskon');
	  		}
	  	}



	  	function update_diskon(){
	  		$diskon = str_replace(".", "", $this->input->post('diskon'));
	  		$barang_id = $this->input->post('barang_id');
	  		$diskon_id = $this->input->post('diskon_id');
	  			$tanggal_mulai_diskon = $this->input->post('tanggal_mulai_diskon');
	  		$tanggal_akhir_diskon = $this->input->post('tanggal_akhir_diskon');

	  		if($diskon > 100){
	  			$this->m_diskon->updateDiskon($diskon_id,$barang_id,$diskon,$tanggal_mulai_diskon,$tanggal_akhir_diskon);
	  			echo $this->session->set_flashdata('msg','update');
	            redirect('Subowner/Diskon');
	  		}elseif($diskon <= 100){
	  			$a = $this->db->query("SELECT * FROM barang_non_reseller WHERE barang_id='$barang_id'")->row_array();
	  			$diskon_new = ($a['bnr_harga'] * $diskon)/100;
	  			$this->m_diskon->updateDiskon($diskon_id,$barang_id,$diskon,$tanggal_mulai_diskon,$tanggal_akhir_diskon);
	  			echo $this->session->set_flashdata('msg','update');
	            redirect('Subowner/Diskon');
	  		}
	  	}

	  	

	  	// function hapus_diskon_t(){
	  	// 	$tanggal = $this->input->post('tanggal');

	  	// 	$this->m_diskon->hapusDiskonT($tanggal);
	  	// 	echo $this->session->set_flashdata('msg','delete');
	   //      redirect('Subowner/Diskon');
	  	// }


	}
?>