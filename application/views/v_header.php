<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="keywords" content="HTML5 Template" />
<meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
<meta name="author" content="potenzaglobalsolutions.com" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<title><?php echo $title;?></title>

<!-- Favicon -->
<link rel="shortcut icon" href="<?php echo base_url()?>assets/admin/images/logo.jpeg" />

<!-- Font -->
<link  rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">

<!-- css -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/admin/css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/admin/css/jquery.toast.min.css">

 
</head>

<body>

<div class="wrapper">

<!--=================================
 header start-->
<?php
  $id=$this->session->userdata('id');
  $q=$this->db->query("SELECT * FROM user WHERE user_id='$id'");
  $c=$q->row_array();
?>
<nav class="admin-header navbar navbar-default col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <!-- logo -->
  <div class="text-left navbar-brand-wrapper">
    <h5 class="mt-0 mb-0" style="text-align: center;"><?php echo $c['user_nama'];?></h5>
  </div>
  <!-- Top bar left -->
  <ul class="nav navbar-nav mr-auto">
    <li class="nav-item">
      <a id="button-toggle" class="button-toggle-nav inline-block ml-20 pull-left" href="javascript:void(0);"><i class="zmdi zmdi-menu ti-align-right"></i></a>
    </li>
  </ul>
  <!-- top bar right -->
  
  <ul class="nav navbar-nav ml-auto">
    <?php
              $id=$this->session->userdata('id');
              $q=$this->db->query("SELECT * FROM user WHERE user_id='$id'");
              $c=$q->row_array();
    ?>
    <li class="nav-item dropdown mr-30">
      <a class="nav-link nav-pill user-avatar" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
        <img src="<?php echo base_url().'assets/admin/images/'.$c['user_foto'];?>" alt="avatar">
      </a>
      
      <div class="dropdown-menu dropdown-menu-right">
        <div class="dropdown-header">
          <div class="media">
            <div class="media-body">
              <h5 class="mt-0 mb-0"><?php echo $c['user_nama'];?></h5>
              
            </div>
          </div>
        </div>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="<?php echo base_url().'Login/logout'?>"><i class="text-danger ti-unlock"></i>Logout</a>
      </div>
    </li>
  </ul>
</nav>

<!--=================================
 header End-->