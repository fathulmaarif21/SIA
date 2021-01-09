<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-4 sidebar-light-lime">
    <a href="" class="brand-link navbar-light">
        <img src="<?= base_url('assets/'); ?>dist/img/logoSIA.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-2" style="opacity: .8">
        <span class="brand-text font-weight-light"><b>Apotek Ajwa</b></span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url('assets/'); ?>img/undraw_profile.svg" class="img-circle elevation-2" alt="User Image">
                <span class="brand-text "> <?= $this->session->userdata('nama'); ?></span>
            </div>
            <div class="info">
                <a href="#" class="d-block"></a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="<?= base_url(); ?>Dashboard" class="nav-link <?php if ($this->uri->segment(1) == 'Dashboard') {
                                                                                echo 'active';
                                                                            } ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-header">MENU</li>
                <li class="nav-item">
                    <a href="<?= base_url(); ?>kasir" class="nav-link <?php if ($this->uri->segment(1) == 'kasir') {
                                                                            echo 'active';
                                                                        } ?>">
                        <!-- <i class="nav-icon far fa-calendar-alt"></i> -->
                        <i class="nav-icon fas fa-cash-register"></i>
                        <p>
                            Kasir
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url(); ?>user/dataObat" class="nav-link <?php if ($this->uri->segment(2) == 'dataObat') {
                                                                                    echo 'active';
                                                                                } ?>">
                        <i class="nav-icon fas fa-briefcase-medical"></i>
                        <p>
                            Data Obat
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url(); ?>user/trxPenjualan" class="nav-link <?php if ($this->uri->segment(2) == 'trxPenjualan') {
                                                                                        echo 'active';
                                                                                    } ?>">
                        <i class="nav-icon fas fa-exchange-alt"></i>
                        <p>
                            Data Transaksi Harian
                        </p>
                    </a>
                </li>
                <?php if ($this->session->userdata('role_id') == '1') : ?>
                    <?php $this->load->view('templates/sidebarAdmin') ?>
                <?php endif ?>


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

    </section>
    <!-- Main content -->
    <section class="content">