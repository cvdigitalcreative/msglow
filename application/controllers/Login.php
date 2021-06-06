<?php
class Login extends CI_Controller{
    function __construct(){
        parent:: __construct();
        $this->load->model('m_login');
    }
    function index(){
        $this->load->view('v_login');
    }

    function authadmin(){
        $username=strip_tags(str_replace("'", "", $this->input->post('username')));
        $password=strip_tags(str_replace("'", "", $this->input->post('password')));
        $u=$username;
        $p=$password;
        $cadmin=$this->m_login->cekuser($u,$p);
        if($cadmin->num_rows() > 0){
         $this->session->set_userdata('masuk',true);
         $this->session->set_userdata('user',$u);
         $xcadmin=$cadmin->row_array();
             if($xcadmin['user_level']=='1')
             {
                $this->session->set_userdata('akses','1');
                $id=$xcadmin['user_id'];
                $user_nama=$xcadmin['user_nama'];
                $user_hp=$xcadmin['user_hp'];
                $this->session->set_userdata('hp',$user_hp);
                $this->session->set_userdata('id',$id);
                $this->session->set_userdata('nama',$user_nama);
                redirect('Owner/Barang');
            }
             else if($xcadmin['user_level']=='2')
             {
                $this->session->set_userdata('akses','2');
                $id=$xcadmin['user_id'];
                $user_nama=$xcadmin['user_nama'];
                $user_hp=$xcadmin['user_hp'];
                $id_toko=$xcadmin['user_toko'];
                $this->session->set_userdata('hp',$user_hp);
                $this->session->set_userdata('id',$id);
                $this->session->set_userdata('nama',$user_nama);
                $this->session->set_userdata('id_toko',$id_toko);
                redirect('Admin/Pemesanan/Home/2');
             } //Front Office 
              else if($xcadmin['user_level']=='3')
             {
                $this->session->set_userdata('akses','3');
                $id=$xcadmin['user_id'];
                $user_nama=$xcadmin['user_nama'];
                $user_hp=$xcadmin['user_hp'];
                $id_toko=$xcadmin['user_toko'];
                $this->session->set_userdata('hp',$user_hp);
                $this->session->set_userdata('id',$id);
                $this->session->set_userdata('nama',$user_nama);
                $this->session->set_userdata('id_toko',$id_toko);
                redirect('admin_gudang/Admin_gudang_pusat');
             } //Front Office 
              else if($xcadmin['user_level']=='4')
             {
                $this->session->set_userdata('akses','4');
                $id=$xcadmin['user_id'];
                $user_nama=$xcadmin['user_nama'];
                $user_hp=$xcadmin['user_hp'];
                $id_toko=$xcadmin['user_toko'];
                $this->session->set_userdata('hp',$user_hp);
                $this->session->set_userdata('id',$id);
                $this->session->set_userdata('nama',$user_nama);
                $this->session->set_userdata('id_toko',$id_toko);
                redirect('admin_gudang/Admin_gudang_toko');
             } //Front Office 
        }
        
        else{
            redirect('Login/gagallogin');
        }
    }

    
        function gagallogin(){
            $url=base_url('Login');
            echo $this->session->set_flashdata('msg','<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> Username Atau Password Salah</div>');
            redirect($url);
        }
        function logout(){
            $this->session->sess_destroy();
            $url=base_url('Login');
            redirect($url);
        }
}