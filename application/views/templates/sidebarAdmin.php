<li class="nav-header">ADMIN MENU</li>
<li class="nav-item">
    <a href="<?= base_url(); ?>admin/viewFaktuPembelian" class="nav-link <?php if ($this->uri->segment(2) == 'viewFaktuPembelian') {
                                                                                echo 'active';
                                                                            } ?>">
        <i class="fas fa-file-invoice  nav-icon"></i>
        <p>
            Faktur Pembelian
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="<?= base_url(); ?>admin/viewUserManagement" class="nav-link <?php if ($this->uri->segment(2) == 'viewUserManagement') {
                                                                                echo 'active';
                                                                            } ?>">
        <i class="nav-icon fas fa-users-cog"></i>
        <p>
            User Management
        </p>
    </a>
</li>
<li class="nav-item menu-open">
    <a href="#" class="nav-link <?php if ($this->uri->segment(1) == 'admin') {
                                    echo 'active';
                                } ?>">
        <i class="nav-icon fas fa-database"></i>
        <p>
            MASTER
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="<?= base_url(); ?>admin/viewMasterObat" class="nav-link <?php if ($this->uri->segment(2) == 'viewMasterObat') {
                                                                                    echo 'active';
                                                                                } ?>">
                <i class="nav-icon fas fa-briefcase-medical"></i>
                <p>Master Obat</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= base_url(); ?>admin/viewMasterTrxPenjualan" class="nav-link <?php if ($this->uri->segment(2) == 'viewMasterObat') {
                                                                                            echo 'active';
                                                                                        } ?>">
                <i class="nav-icon fas fa-exchange-alt"></i>
                <p>Master Transaksi Penjualan</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= base_url(); ?>admin/masterFaktuPembelian" class="nav-link <?php if ($this->uri->segment(2) == 'viewMasterObat') {
                                                                                        echo 'active';
                                                                                    } ?>">
                <i class="fas fa-file-invoice  nav-icon"></i>
                <p>Master Faktur Pembelian</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= base_url(); ?>admin/viewMasterSupplier" class="nav-link <?php if ($this->uri->segment(2) == 'viewMasterObat') {
                                                                                        echo 'active';
                                                                                    } ?>">
                <i class="fas fa-user-tie nav-icon"></i>
                <p>Master Supplier</p>
            </a>
        </li>
    </ul>
</li>