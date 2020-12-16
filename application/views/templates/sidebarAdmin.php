<div class="sidebar-heading">
    Admin Menu
</div>
<li class="nav-item">
    <a class="nav-link" href="<?= base_url(); ?>/admin/fakturPembelian">
        <i class="fas fa-envelope-open-text"></i>
        <span>Faktur Pembelian</span></a>
</li>
<li class="nav-item">
    <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-database"></i>
        <span>Master</span>
    </a>
    <div id="collapsePages" class="collapse " aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Master:</h6>
            <a class="collapse-item" href="<?= base_url(); ?>/admin/masterObat"><i class="fas fa-briefcase-medical"></i> Master Obat</a>
            <a class="collapse-item" href="<?= base_url(); ?>/admin/masterTrxPenjualan"><i class="fas fa-envelope-open-text"></i> Master Transaksi Penjualan</a>
            <a class="collapse-item" href="<?= base_url(); ?>/admin/masterfakturP"><i class="fas fa-exchange-alt"></i> Master Faktur Pembelian</a>
            <a class="collapse-item" href="<?= base_url(); ?>/admin/masterSupplier"><i class="fas fa-user-tie"></i> Master Supplier</a>
            <div class="collapse-divider"></div>
        </div>
    </div>
</li>
<li class="nav-item">
    <a class="nav-link" href="<?= base_url(); ?>/admin/userManagement">
        <i class="fas fa-users-cog"></i>
        <span>User Management</span></a>
</li>