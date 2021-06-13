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
       
          <li>
             <a href="javascript:void(0);" data-toggle="collapse" data-target="#transaksi">
              <div class="pull-left"><i class="ti-files"></i><span class="right-nav-text">Transaksi</span></div>
              <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
            </a>
            <ul id="transaksi" class="collapse" data-parent="#sidebarnav">
              <li> <a href="<?php echo base_url()?>Subowner/Transaksi">Transaksi Keseluruhan</a> </li>
              
            </ul>
          </li>
        </li>

        <li>
          <a href="<?php echo base_url()?>Subowner/Diskon"><i class="ti-calendar"></i><span class="right-nav-text">Diskon per Barang</span> </a>
        </li>
        <li>
          <a href="<?php echo base_url()?>Subowner/Diskon/diskon_pemesanan"><i class="ti-calendar"></i><span class="right-nav-text">Diskon Per Pemesanan</span> </a>
        </li>
        
        
    </ul>
  </div> 
</div>
<!-- Left Sidebar End-->