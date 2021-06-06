<div class="container-fluid">
  <div class="row">
    <!-- Left Sidebar -->
    <div class="side-menu-fixed">
     <div class="scrollbar side-menu-bg">
      <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <!-- menu title -->
         <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">Website Components</li>
        <!-- All Form  -->
         <li>

          <a href="javascript:void(0);" data-toggle="collapse" data-target="#Request">
            <div class="pull-left"><i class="ti-files"></i><span class="right-nav-text">Request Stock</span></div>
            <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
          </a>
          <ul id="Request" class="collapse" data-parent="#sidebarnav">
           
             <li> <a href="<?php echo base_url()?>admin_gudang/Admin_gudang_toko"> Request</a> </li>
              <li> <a href="<?php echo base_url()?>admin_gudang/Admin_gudang_toko/history_request_toko">History Request</a> </li>
             
              
            
          </ul>

        </li>
        
        
    </ul>
  </div> 
</div>
<!-- Left Sidebar End-->