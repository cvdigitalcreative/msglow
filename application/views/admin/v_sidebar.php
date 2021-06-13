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
            <div class="pull-left"><i class="ti-files"></i><span class="right-nav-text">Order</span></div>
            <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
          </a>
          <ul id="Barang" class="collapse" data-parent="#sidebarnav">
            <li><a href="<?php echo base_url()?>Admin/Pemesanan/Home/2">Order Customer</a></li>
            <li> <a href="<?php echo base_url()?>Admin/Pemesanan/Home/1">Order Reseller</a></li>
          </ul>
        </li>
          

         <li> <a href="<?php echo base_url()?>Admin/Transaksi"><i class="ti-calendar"></i><span class="right-nav-text">History Transaksi</span> </a></li>

         <li> <a href="<?php echo base_url()?>Admin/Stock"><i class="ti-calendar"></i><span class="right-nav-text">Stock Keseluruhaan</span> </a></li>
           
         <li>  <a href="<?php echo base_url()?>Admin/Stock/stok_keluar"><i class="ti-calendar"></i><span class="right-nav-text">Stock Keluar Hari ini</span> </a></li>
        <li>
          <li>  <a href="<?php echo base_url()?>Admin/Stock/stok_kembali"><i class="ti-calendar"></i><span class="right-nav-text">Stock Kembali Hari ini</span> </a></li>
        <li>
          <a href="<?php echo base_url()?>Admin/Pemesanan/Asal_Transaksi"><i class="ti-calendar"></i><span class="right-nav-text">Asal Transaksi</span> </a>
        </li>
        <li>
          <a href="<?php echo base_url()?>Admin/Pemesanan/Kurir"><i class="ti-calendar"></i><span class="right-nav-text">Kurir</span> </a>
        </li>
        <li>
          <a href="<?php echo base_url()?>Admin/Pemesanan/metode_pembayaran"><i class="ti-calendar"></i><span class="right-nav-text">Metode Pembayaran</span> </a>
        </li>
        <li>
          <a href="<?php echo base_url()?>Admin/Pemesanan/kategori_barang"><i class="ti-calendar"></i><span class="right-nav-text">Kategori Barang</span> </a>
        </li>
        
         <!-- <li>
          <a href="javascript:void(0);" data-toggle="collapse" data-target="#Barang">
            <div class="pull-left"><i class="ti-files"></i><span class="right-nav-text">Barang</span></div>
            <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
          </a>
          <ul id="Barang" class="collapse" data-parent="#sidebarnav">
            <li> <a href="<?php echo base_url()?>Owner/Barang">Barang Non Reseller</a> </li>
            <li> <a href="<?php echo base_url()?>Owner/Barang/Reseller">Barang Reseller</a> </li>
          </ul>
        </li> -->
<!--         <li>
          <a href="<?php echo base_url()?>TindakanPerbaikan/tindakan_perbaikan_admin"><i class="ti-world"></i><span class="right-nav-text">Tindakan Perbaikan</span> </a>
        </li> -->
    </ul>
  </div> 
</div>
<!-- Left Sidebar End-->