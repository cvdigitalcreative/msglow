<?php
	/**
	 * 
	 */
	class User extends CI_Controller
	{
		
		function __construct()
	  	{
		    parent:: __construct();
		    if($this->session->userdata('masuk') !=TRUE){
		      $url=base_url('Login');
		      redirect($url);
		    };

		    $this->load->model('m_login');
		    $this->load->library('upload');
	  	}

	  	function index(){
	  		if($this->session->userdata('akses') == 1 && $this->session->userdata('masuk') == true){
		       $y['title'] = "User";
		       $x['user'] = $this->m_login->getAlluser();
		       $this->load->view('v_header',$y);
		       $this->load->view('owner/v_sidebar');
		       $this->load->view('owner/v_user',$x);
		    }
		    else{
		       redirect('Login');
		    }
	  	}

	  	function save_user(){
    		  $config['upload_path'] = './assets/admin/images/'; //path folder
              $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
              $config['max_size']             = 0; //type yang dapat diakses bisa anda sesuaikan
              // $config['encrypt_name'] = TRUE; //nama yang terupload nantinya

              $this->upload->initialize($config);
              if(!empty($_FILES['filefoto']['name']))
              {
                  if ($this->upload->do_upload('filefoto'))
                  {
                        $gbr = $this->upload->data();
                        //Compress Image
                        $config['image_library']='gd2';
                        $config['source_image']='./assets/images/'.$gbr['file_name'];
                        $config['create_thumb']= FALSE;
                        $config['maintain_ratio']= FALSE;
                        $config['quality']= '100%';
                        // $config['width']= 917;
                        // $config['height']= 719;
                        $config['new_image']= './arssets/images/'.$gbr['file_name'];
                        $this->load->library('image_lib', $config);
                        $this->image_lib->resize();

                        $foto=$gbr['file_name'];
                        $nama = $this->input->post('nama_pegawai');
                        $level = $this->input->post('level');
                        $nohp = $this->input->post('nohp');
                        $alamat = $this->input->post('alamat');
                        $username = $this->input->post('username');
                        $password = $this->input->post('password');

                        $this->m_login->saveUser($nama, $level, $nohp, $alamat, $username, $password, $foto);
            			echo $this->session->set_flashdata('msg','success');
            			redirect('Owner/User');
                          
                      
                  }else{
                      echo $this->session->set_flashdata('msg','warning');
                      redirect('Owner/User');
                  }
              }
    	}

    	function update_user(){
    		$id = $this->input->post('id');
    		$nama = $this->input->post('nama_pegawai');
            $level = $this->input->post('level');
            $nohp = $this->input->post('nohp');
            $alamat = $this->input->post('alamat');
            $username = $this->input->post('username');
            $password = $this->input->post('password');

    		$config['upload_path'] = './assets/admin/images/'; //path folder
              $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
              $config['max_size']             = 0; //type yang dapat diakses bisa anda sesuaikan
              // $config['encrypt_name'] = TRUE; //nama yang terupload nantinya

              $this->upload->initialize($config);
              if(!empty($_FILES['filefoto']['name']))
              {
                  if ($this->upload->do_upload('filefoto'))
                  {
                          $gbr = $this->upload->data();
                          //Compress Image
                          $config['image_library']='gd2';
                          $config['source_image']='./assets/images/'.$gbr['file_name'];
                          $config['create_thumb']= FALSE;
                          $config['maintain_ratio']= FALSE;
                          $config['quality']= '100%';
                          // $config['width']= 917;
                          // $config['height']= 719;
                          $config['new_image']= './assets/images/'.$gbr['file_name'];
                          $this->load->library('image_lib', $config);
                          $this->image_lib->resize();

                          $foto=$gbr['file_name'];
                          $images=$this->input->post('gambar');
                          $path='./assets/admin/images/'.$images;
                          unlink($path);

                          $this->m_login->updateUser($id, $nama, $level, $nohp, $alamat, $username, $password, $foto);
						  echo $this->session->set_flashdata('msg','success');
						  redirect('Owner/User');
                      
                  }else{
                      echo $this->session->set_flashdata('msg','warning');
                      redirect('Owner/User');
                  }
                  
              }else{

                $this->m_login->updateUserNoFoto($id, $nama, $level, $nohp, $alamat, $username, $password);
        		echo $this->session->set_flashdata('msg','success');
        		redirect('Owner/User');
              }
    	}

    	function hapus_user(){
	      $id = $this->input->post('id');
	      $images=$this->input->post('gambar');
	      $path='./assets/admin/images/'.$images;
	      unlink($path);

	      $this->m_login->hapusUser($id);
	      echo $this->session->set_flashdata('msg','Hapus');
	      redirect('Owner/User');
    	}

	}
?>