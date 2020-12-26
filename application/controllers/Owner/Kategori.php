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
		    $this->load->library('upload');
	  	}

	  	function index(){
	  		if($this->session->userdata('akses') == 1 && $this->session->userdata('masuk') == true){
		       $y['title'] = "List Diskon Barang";
		       $x['barang'] = $this->m_barang->getAllBarangR();
		       $x['diskon'] = $this->m_barang->getDataDiskon();
		       $this->load->view('v_header',$y);
		       $this->load->view('owner/v_sidebar');
		       $this->load->view('owner/v_diskon',$x);
		    }
		    else{
		       redirect('Login');
		    }
	  	}

	  	function save_diskon(){
	  		$diskon = str_replace(".", "", $this->input->post('diskon'));
	  		$barang_id = $this->input->post('barang');


	  		if($diskon > 100){
	  			$this->m_barang->saveDiskon($barang_id,$diskon);
	  			echo $this->session->set_flashdata('msg','success');
	            redirect('Owner/Diskon');
	  		}elseif($diskon <= 100){
	  			$a = $this->db->query("SELECT * FROM barang_non_reseller WHERE barang_id='$barang_id'")->row_array();
	  			$diskon_new = ($a['bnr_harga'] * $diskon)/100;
	  			$this->m_barang->saveDiskon($barang_id,$diskon_new);
	  			echo $this->session->set_flashdata('msg','success');
	            redirect('Owner/Diskon');
	  		}
	  	}

	  	function update_diskon(){
	  		$diskon = str_replace(".", "", $this->input->post('diskon'));
	  		$barang_id = $this->input->post('barang_id');
	  		$diskon_id = $this->input->post('diskon_id');


	  		if($diskon > 100){
	  			$this->m_barang->updateDiskon($diskon_id,$barang_id,$diskon);
	  			echo $this->session->set_flashdata('msg','update');
	            redirect('Owner/Diskon');
	  		}elseif($diskon <= 100){
	  			$a = $this->db->query("SELECT * FROM barang_non_reseller WHERE barang_id='$barang_id'")->row_array();
	  			$diskon_new = ($a['bnr_harga'] * $diskon)/100;
	  			$this->m_barang->updateDiskon($diskon_id,$barang_id,$diskon_new);
	  			echo $this->session->set_flashdata('msg','update');
	            redirect('Owner/Diskon');
	  		}
	  	}

	  	function hapus_diskon(){
	  		$barang_id = $this->input->post('barang_id');
	  		$diskon_id = $this->input->post('diskon_id');
	  		$this->m_barang->hapusDiskon($diskon_id,$barang_id);
	  		echo $this->session->set_flashdata('msg','delete');
	        redirect('Owner/Diskon');
	  	}

	  	function hapus_diskon_t(){
	  		$tanggal = $this->input->post('tanggal');

	  		$this->m_barang->hapusDiskonT($tanggal);
	  		echo $this->session->set_flashdata('msg','delete');
	        redirect('Owner/Diskon');
	  	}


	}
?>