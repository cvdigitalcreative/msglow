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
             <li> <a href="<?php echo base_url()?>Owner/Stock/stok_keluar">History Stock Keluar Barang</a> </li>
              <li> <a href="<?php echo base_url()?>Owner/Stock/stok_masuk">History Stock Masuk Barang</a> </li>
               <li> <a href="<?php echo base_url()?>Owner/Stock/stok_kembali">History Stock Kembali</a> </li>
              
            
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
              <li><a href="<?php echo base_url()?>Owner/Transaksi/all/2">Transaksi Customer</a></li>
              <li> <a href="<?php echo base_url()?>Owner/Transaksi/all/1">Transaksi Reseller</a></li>
            </ul>
          </li>
        </li>

        <li>
             <a href="javascript:void(0);" data-toggle="collapse" data-target="#transaksi_cash">
              <div class="pull-left"><i class="ti-files"></i><span class="right-nav-text">Transaksi Kategori Cash</span></div>
              <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
            </a>
            <ul id="transaksi_cash" class="collapse" data-parent="#sidebarnav">
              <li> <a href="<?php echo base_url()?>Owner/Transaksi/gettrxbykategori_cash">Transaksi Keseluruhan</a> </li>
              <li><a href="<?php echo base_url()?>Owner/Transaksi/all_kategori_cash/2">Transaksi Customer</a></li>
              <li> <a href="<?php echo base_url()?>Owner/Transaksi/all_kategori_cash/1">Transaksi Reseller</a></li>
            </ul>
          </li>
        </li>
        <li>
             <a href="javascript:void(0);" data-toggle="collapse" data-target="#transaksi_bank">
              <div class="pull-left"><i class="ti-files"></i><span class="right-nav-text">Transaksi Kategori bank</span></div>
              <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
            </a>
            <ul id="transaksi_bank" class="collapse" data-parent="#sidebarnav">
              <li> <a href="<?php echo base_url()?>Owner/Transaksi/gettrxbykategori_bank">Transaksi Keseluruhan</a> </li>
              <li><a href="<?php echo base_url()?>Owner/Transaksi/all_kategori_bank/2">Transaksi Customer</a></li>
              <li> <a href="<?php echo base_url()?>Owner/Transaksi/all_kategori_bank/1">Transaksi Reseller</a></li>
            </ul>
          </li>
        </li>
        <li>
             <a href="javascript:void(0);" data-toggle="collapse" data-target="#transaksi_edcbca">
              <div class="pull-left"><i class="ti-files"></i><span class="right-nav-text">Transaksi Kategori edc bca</span></div>
              <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
            </a>
            <ul id="transaksi_edcbca" class="collapse" data-parent="#sidebarnav">
              <li> <a href="<?php echo base_url()?>Owner/Transaksi/gettrxbykategori_edcbca">Transaksi Keseluruhan</a> </li>
              <li><a href="<?php echo base_url()?>Owner/Transaksi/all_kategori_edcbca/2">Transaksi Customer</a></li>
              <li> <a href="<?php echo base_url()?>Owner/Transaksi/all_kategori_edcbca/1">Transaksi Reseller</a></li>
            </ul>
          </li>
        </li>
        <li>
             <a href="javascript:void(0);" data-toggle="collapse" data-target="#transaksi_shopee">
              <div class="pull-left"><i class="ti-files"></i><span class="right-nav-text">Transaksi Kategori Shopee</span></div>
              <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
            </a>
            <ul id="transaksi_shopee" class="collapse" data-parent="#sidebarnav">
              <li> <a href="<?php echo base_url()?>Owner/Transaksi/gettrxbykategori_shopee">Transaksi Keseluruhan</a> </li>
              <li><a href="<?php echo base_url()?>Owner/Transaksi/all_kategori_shopee/2">Transaksi Customer</a></li>
              <li> <a href="<?php echo base_url()?>Owner/Transaksi/all_kategori_shopee/1">Transaksi Reseller</a></li>
            </ul>
          </li>
        </li>

        <li>
             <a href="javascript:void(0);" data-toggle="collapse" data-target="#transaksi_admin_1">
              <div class="pull-left"><i class="ti-files"></i><span class="right-nav-text">Transaksi Admin Apri</span></div>
              <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
            </a>
            <ul id="transaksi_admin_1" class="collapse" data-parent="#sidebarnav">
              <li> <a href="<?php echo base_url()?>Owner/Transaksi/get_trx_admin_1">Transaksi Keseluruhan</a> </li>
              <li><a href="<?php echo base_url()?>Owner/Transaksi/all_trx_admin_1/2">Transaksi Customer</a></li>
              <li> <a href="<?php echo base_url()?>Owner/Transaksi/all_trx_admin_1/1">Transaksi Reseller</a></li>
            </ul>
          </li>
        </li>

        <li>
             <a href="javascript:void(0);" data-toggle="collapse" data-target="#transaksi_admin_2">
              <div class="pull-left"><i class="ti-files"></i><span class="right-nav-text">Transaksi Admin Munif</span></div>
              <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
            </a>
            <ul id="transaksi_admin_2" class="collapse" data-parent="#sidebarnav">
              <li> <a href="<?php echo base_url()?>Owner/Transaksi/get_trx_admin_2">Transaksi Keseluruhan</a> </li>
              <li><a href="<?php echo base_url()?>Owner/Transaksi/all_trx_admin_2/2">Transaksi Customer</a></li>
              <li> <a href="<?php echo base_url()?>Owner/Transaksi/all_trx_admin_2/1">Transaksi Reseller</a></li>
            </ul>
          </li>
        </li>

        <li>
             <a href="javascript:void(0);" data-toggle="collapse" data-target="#transaksi_admin_3">
              <div class="pull-left"><i class="ti-files"></i><span class="right-nav-text">Transaksi Admin Aisyah</span></div>
              <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
            </a>
            <ul id="transaksi_admin_3" class="collapse" data-parent="#sidebarnav">
              <li> <a href="<?php echo base_url()?>Owner/Transaksi/get_trx_admin_3">Transaksi Keseluruhan</a> </li>
              <li><a href="<?php echo base_url()?>Owner/Transaksi/all_trx_admin_3/2">Transaksi Customer</a></li>
              <li> <a href="<?php echo base_url()?>Owner/Transaksi/all_trx_admin_3/1">Transaksi Reseller</a></li>
            </ul>
          </li>
        </li>

        <li>
             <a href="javascript:void(0);" data-toggle="collapse" data-target="#transaksi_admin_4">
              <div class="pull-left"><i class="ti-files"></i><span class="right-nav-text">Transaksi Admin Selly</span></div>
              <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
            </a>
            <ul id="transaksi_admin_4" class="collapse" data-parent="#sidebarnav">
              <li> <a href="<?php echo base_url()?>Owner/Transaksi/get_trx_admin_4">Transaksi Keseluruhan</a> </li>
              <li><a href="<?php echo base_url()?>Owner/Transaksi/all_trx_admin_4/2">Transaksi Customer</a></li>
              <li> <a href="<?php echo base_url()?>Owner/Transaksi/all_trx_admin_4/1">Transaksi Reseller</a></li>
            </ul>
          </li>
        </li>

        <li>
             <a href="javascript:void(0);" data-toggle="collapse" data-target="#transaksi_admin_5">
              <div class="pull-left"><i class="ti-files"></i><span class="right-nav-text">Transaksi Admin 5</span></div>
              <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
            </a>
            <ul id="transaksi_admin_5" class="collapse" data-parent="#sidebarnav">
              <li> <a href="<?php echo base_url()?>Owner/Transaksi/get_trx_admin_5">Transaksi Keseluruhan</a> </li>
              <li><a href="<?php echo base_url()?>Owner/Transaksi/all_trx_admin_5/2">Transaksi Customer</a></li>
              <li> <a href="<?php echo base_url()?>Owner/Transaksi/all_trx_admin_5/1">Transaksi Reseller</a></li>
            </ul>
          </li>
        </li>

        <li>
             <a href="javascript:void(0);" data-toggle="collapse" data-target="#transaksi_admin_6">
              <div class="pull-left"><i class="ti-files"></i><span class="right-nav-text">Transaksi Admin 6</span></div>
              <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
            </a>
            <ul id="transaksi_admin_6" class="collapse" data-parent="#sidebarnav">
              <li> <a href="<?php echo base_url()?>Owner/Transaksi/get_trx_admin_6">Transaksi Keseluruhan</a> </li>
              <li><a href="<?php echo base_url()?>Owner/Transaksi/all_trx_admin_6/2">Transaksi Customer</a></li>
              <li> <a href="<?php echo base_url()?>Owner/Transaksi/all_trx_admin_6/1">Transaksi Reseller</a></li>
            </ul>
          </li>
        </li>

        <li>
             <a href="javascript:void(0);" data-toggle="collapse" data-target="#transaksi_admin_7">
              <div class="pull-left"><i class="ti-files"></i><span class="right-nav-text">Transaksi Admin 7</span></div>
              <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
            </a>
            <ul id="transaksi_admin_7" class="collapse" data-parent="#sidebarnav">
              <li> <a href="<?php echo base_url()?>Owner/Transaksi/get_trx_admin_7">Transaksi Keseluruhan</a> </li>
              <li><a href="<?php echo base_url()?>Owner/Transaksi/all_trx_admin_7/2">Transaksi Customer</a></li>
              <li> <a href="<?php echo base_url()?>Owner/Transaksi/all_trx_admin_7/1">Transaksi Reseller</a></li>
            </ul>
          </li>
        </li>

        <li>
             <a href="javascript:void(0);" data-toggle="collapse" data-target="#transaksi_admin_8">
              <div class="pull-left"><i class="ti-files"></i><span class="right-nav-text">Transaksi Admin 8</span></div>
              <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
            </a>
            <ul id="transaksi_admin_8" class="collapse" data-parent="#sidebarnav">
              <li> <a href="<?php echo base_url()?>Owner/Transaksi/get_trx_admin_8">Transaksi Keseluruhan</a> </li>
              <li><a href="<?php echo base_url()?>Owner/Transaksi/all_trx_admin_8/2">Transaksi Customer</a></li>
              <li> <a href="<?php echo base_url()?>Owner/Transaksi/all_trx_admin_8/1">Transaksi Reseller</a></li>
            </ul>
          </li>
        </li>

        <li>
             <a href="javascript:void(0);" data-toggle="collapse" data-target="#transaksi_admin_9">
              <div class="pull-left"><i class="ti-files"></i><span class="right-nav-text">Transaksi Admin 9</span></div>
              <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
            </a>
            <ul id="transaksi_admin_9" class="collapse" data-parent="#sidebarnav">
              <li> <a href="<?php echo base_url()?>Owner/Transaksi/get_trx_admin_9">Transaksi Keseluruhan</a> </li>
              <li><a href="<?php echo base_url()?>Owner/Transaksi/all_trx_admin_9/2">Transaksi Customer</a></li>
              <li> <a href="<?php echo base_url()?>Owner/Transaksi/all_trx_admin_9/1">Transaksi Reseller</a></li>
            </ul>
          </li>
        </li>

         <li>
             <a href="javascript:void(0);" data-toggle="collapse" data-target="#transaksi_admin_10">
              <div class="pull-left"><i class="ti-files"></i><span class="right-nav-text">Transaksi Admin 10</span></div>
              <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
            </a>
            <ul id="transaksi_admin_10" class="collapse" data-parent="#sidebarnav">
              <li> <a href="<?php echo base_url()?>Owner/Transaksi/get_trx_admin_10">Transaksi Keseluruhan</a> </li>
              <li><a href="<?php echo base_url()?>Owner/Transaksi/all_trx_admin_10/2">Transaksi Customer</a></li>
              <li> <a href="<?php echo base_url()?>Owner/Transaksi/all_trx_admin_10/1">Transaksi Reseller</a></li>
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