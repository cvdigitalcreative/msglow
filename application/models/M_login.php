<?php
class M_login extends CI_Model
{
    function cekuser($username,$password){
        $hasil=$this->db->query("SELECT * FROM user WHERE username='$username' AND password='$password' ");
        return $hasil;
    }

    function getuser($id){
        $hasil=$this->db->query("SELECT * FROM user WHERE user_id='$id' ");
        return $hasil;
    } 

    function getAlluser(){
        $hasil=$this->db->query("SELECT * FROM user");
        return $hasil;
    }

    function saveUser($nama, $level, $nohp, $alamat, $username, $password, $foto){
            $hsl = $this->db->query("INSERT INTO user(user_nama, user_level, user_hp, user_alamat, username, password, user_foto) VALUES ('$nama', '$level', '$nohp', '$alamat', '$username', '$password', '$foto')");
            return $hsl;
    }

    function updateUser($id, $nama, $level, $nohp, $alamat, $username, $password, $foto){
            $hsl = $this->db->query("UPDATE user SET user_nama='$nama', user_level='$level', user_hp='$nohp', user_alamat = '$alamat', username = '$username', password = '$password', user_foto='$foto' WHERE user_id='$id'");
            return $hsl;
        }

    function updateUserNoFoto($id, $nama, $level, $nohp, $alamat, $username, $password){
            $hsl = $this->db->query("UPDATE user SET user_nama='$nama', user_level='$level', user_hp='$nohp', user_alamat = '$alamat', username = '$username', password = '$password' WHERE user_id='$id'");
            return $hsl;
        }

    function hapusUser($id){
            $hsl = $this->db->query("DELETE FROM user WHERE user_id='$id'");
            return $hsl;
        }  
}?>
