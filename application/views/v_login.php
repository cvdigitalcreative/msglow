<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="keywords" content="HTML5 Template" />
<meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
<meta name="author" content="potenzaglobalsolutions.com" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<title> Login</title>

<!-- Favicon -->
<link rel="shortcut icon" href="<?php echo base_url()?>assets/admin/images/logo.jpeg" />

<!-- Font -->
<link  rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">

<!-- css -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/admin/css/style.css" />
 
</head>
<body>

  <div class="wrapper">

<!--=================================
 preloader -->
 
<!-- <div id="pre-loader">
    <img src="<?php echo base_url()?>assets/admin/images/pre-loader/loader-01.svg" alt="">
</div> -->

<!--=================================
 preloader -->

 <!--=================================
 login-->
<section class="height-100vh d-flex align-items-center page-section-ptb login" style="background-image: url(<?php echo base_url()?>assets/admin/images/logo.jpeg); background-repeat: no-repeat; background-size: 100% 100%" >
  <div class="container">
    <div class="row justify-content-center no-gutters vertical-align">
      <div class="col-lg-4 col-md-6 login-fancy-bg bg">
        <div class="login-fancy">
          <h2 class="text-white mb-20">Hello!!!</h2>
        </div> 
      </div>
    
    <div class="col-lg-4 col-md-6 bg-white">
        <div class="login-fancy pb-40 clearfix">
          <h3 class="mb-30">Log In Admin</h3>
          <div>
            <p><?php echo $this->session->flashdata('msg');?></p>
          </div>
          <form action="<?php echo base_url().'Login/authadmin'?>" method="post" role="form" name="loginForm" novalidate="">
            <div class="section-field mb-20">
              <label class="mb-10" >Username* </label>
              <input name="username" class="web form-control" type="text" placeholder="Username" required=""/>
            </div>
            <div class="section-field mb-20">
              <label class="mb-10" >Password* </label>
              <input name="password" class="Password form-control" type="password" placeholder="Password" required=""/>
            </div>
            <button type="submit" class="button">Sign In</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<!--=================================
 login-->
  
</div>

<!--=================================
 jquery -->

<!-- jquery -->
<script src="<?php echo base_url()?>assets/admin/js/jquery-3.3.1.min.js"></script>

<!-- plugins-jquery -->
<script src="<?php echo base_url()?>assets/admin/js/plugins-jquery.js"></script>

<!-- plugin_path -->
<script>var plugin_path = '<?php echo base_url()?>assets/admin/js/';</script>

<!-- chart -->
<script src="<?php echo base_url()?>assets/admin/js/chart-init.js"></script>

<!-- calendar -->
<script src="<?php echo base_url()?>assets/admin/js/calendar.init.js"></script>

<!-- charts sparkline -->
<script src="<?php echo base_url()?>assets/admin/js/sparkline.init.js"></script>

<!-- charts morris -->
<script src="<?php echo base_url()?>assets/admin/js/morris.init.js"></script>

<!-- datepicker -->
<script src="<?php echo base_url()?>assets/admin/js/datepicker.js"></script>

<!-- sweetalert2 -->
<script src="<?php echo base_url()?>assets/admin/js/sweetalert2.js"></script>

<!-- toastr -->
<script src="<?php echo base_url()?>assets/admin/js/toastr.js"></script>

<!-- validation -->
<script src="<?php echo base_url()?>assets/admin/js/validation.js"></script>

<!-- lobilist -->
<script src="<?php echo base_url()?>assets/admin/js/lobilist.js"></script>
 
<!-- custom -->
<script src="<?php echo base_url()?>assets/admin/js/custom.js"></script>
 
</body>
</html>

