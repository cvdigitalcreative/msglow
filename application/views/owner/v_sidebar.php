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
          <a href="javascript:void(0);" data-toggle="collapse" data-target="#Barang">
            <div class="pull-left"><i class="ti-files"></i><span class="right-nav-text">Barang</span></div>
            <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
          </a>
          <ul id="Barang" class="collapse" data-parent="#sidebarnav">
            <li> <a href="<?php echo base_url()?>Owner/Barang/kategori_barang">Kategori Barang</a> </li>
            <li> <a href="<?php echo base_url()?>Owner/Barang">Barang Customer</a> </li>
            <li> <a href="<?php echo base_url()?>Owner/Barang/Reseller">Barang Reseller</a> </li>
             
              
            
          </ul>
          <a href="javascript:void(0);" data-toggle="collapse" data-target="#History">
            <div class="pull-left"><i class="ti-files"></i><span class="right-nav-text">History</span></div>
            <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
          </a>
          <ul id="History" class="collapse" data-parent="#sidebarnav">
           
             <li> <a href="<?php echo base_url()?>Owner/Stock/stok_keluar">History Stock Keluar Barang</a> </li>
              <li> <a href="<?php echo base_url()?>Owner/Stock/stok_masuk">History Stock Masuk Barang</a> </li>
               <li> <a href="<?php echo base_url()?>Owner/Stock/stok_kembali">History Stock Kembali</a> </li>
              
            
          </ul>

          <a href="javascript:void(0);" data-toggle="collapse" data-target="#Request">
            <div class="pull-left"><i class="ti-files"></i><span class="right-nav-text">Request Stock</span></div>
            <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
          </a>
          <ul id="Request" class="collapse" data-parent="#sidebarnav">
           
             <li> <a href="<?php echo base_url()?>Owner/Request_stock"> Request</a> </li>
              <li> <a href="<?php echo base_url()?>Owner/Request_stock/history_request_toko">History Request</a> </li>
              <li> <a href="<?php echo base_url()?>Owner/Request_stock/suplier_stock">Suplier Request</a> </li>
            
              
            
          </ul>

        </li>
        <li>
       
          <li>
             <a href="javascript:void(0);" data-toggle="collapse" data-target="#transaksi">
              <div class="pull-left"><i class="ti-files"></i><span class="right-nav-text">Transaksi</span></div>
              <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
            </a>
            <ul id="transaksi" class="collapse" data-parent="#sidebarnav">
              <li> <a href="<?php echo base_url()?>Owner/Transaksi">Transaksi Keseluruhan</a> </li>
              
            </ul>
          </li>
        </li>

        

        <li>
           <a href="javascript:void(0);" data-toggle="collapse" data-target="#order">
            <div class="pull-left"><i class="ti-files"></i><span class="right-nav-text">Order</span></div>
            <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
          </a>
          <ul id="order" class="collapse" data-parent="#sidebarnav">
            <li><a href="<?php echo base_url()?>Owner/Barang/pemesanan/2">Order Customer</a></li>
            <li> <a href="<?php echo base_url()?>Owner/Barang/pemesanan/1">Order Reseller</a></li>
          </ul>
        </li>
        <li>
          <a href="<?php echo base_url()?>Owner/Diskon"><i class="ti-calendar"></i><span class="right-nav-text">Diskon per Barang</span> </a>
        </li>
        <li>
          <a href="<?php echo base_url()?>Owner/Diskon/diskon_pemesanan"><i class="ti-calendar"></i><span class="right-nav-text">Diskon Per Pemesanan</span> </a>
        </li>
        <li>
          <a href="<?php echo base_url()?>Owner/User"><i class="ti-user"></i><span class="right-nav-text">User</span> </a>
        </li>
        
    </ul>
  </div> 
</div>
<!-- Left Sidebar End-->