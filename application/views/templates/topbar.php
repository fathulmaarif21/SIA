<!-- Navbar -->
<nav class="main-header navbar navbar-expand  navbar-light navbar-white">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <!-- <a href="<?= base_url('Home'); ?>" class="nav-link">Home</a> -->
            <a href="#" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= base_url(); ?>/kasir" class="nav-link">Kasir</a>
        </li>
        <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Data Master</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                <li><a href="<?= base_url(); ?>admin/viewMasterObat" class="dropdown-item"><i class="nav-icon fas fa-briefcase-medical"></i> Master Obat </a></li>
                <li><a href="<?= base_url(); ?>admin/viewMasterTrxPenjualan" class="dropdown-item"><i class="nav-icon fas fa-exchange-alt"></i> Master Transaksi Penjualan </a></li>
                <li><a href="<?= base_url(); ?>admin/masterFaktuPembelian" class="dropdown-item"><i class="nav-icon fas fa-file-invoice"></i> Master Faktur Pembelian</a></li>
                <li><a href="<?= base_url(); ?>admin/viewMasterSupplier" class="dropdown-item"><i class="nav-icon fas fa-user-tie"></i> Master Supplier </a></li>
                <li class="dropdown-divider"></li>
            </ul>
        </li>
    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>

        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fas fa-sign-out-alt"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <div class="dropdown-divider"></div>
                <a href="<?= base_url('Login/logout'); ?>" class="dropdown-item">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <!-- <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-users mr-2"></i> 8 friend requests
                    <span class="float-right text-muted text-sm">12 hours</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-file mr-2"></i> 3 new reports
                    <span class="float-right text-muted text-sm">2 days</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a> -->
            </div>
        </li>

        <!-- <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li> -->
    </ul>
</nav>
<!-- /.navbar -->