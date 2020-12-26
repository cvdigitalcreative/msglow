<?php
	/**
	 * 
	 */
	class Home extends CI_Controller
	{
		
		function __construct()
	  	{
		    parent:: __construct();
		    $this->load->model('m_barang');
	  	}

	  	function index(){
	  		$x['title'] = "MSGlow Palemabang";
	  		$x['nonreseller'] = $this->m_barang->getDataNonReseller();

	  		$this->load->view('v_home',$x);
	  	}
	}
?>