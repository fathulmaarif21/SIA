<li class="nav-item menu-open">
    <a href="#" class="nav-link <?php if ($this->uri->segment(1) == 'Report') {
                                    echo 'active';
                                } ?>">
        <i class="nav-icon fas fa-book-medical"></i>
        <p>
            LAPORAN
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="<?= base_url(); ?>report/viewBulanan" class="nav-link <?php if ($this->uri->segment(2) == 'viewMasterObat') {
                                                                                echo 'active';
                                                                            } ?>">
                <i class="nav-icon fas fa-briefcase-medical"></i>
                <p>Laporan Bulanan</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= base_url(); ?>report/viewMasterTrxPenjualan" class="nav-link <?php if ($this->uri->segment(2) == 'viewMasterObat') {
                                                                                            echo 'active';
                                                                                        } ?>">
                <i class="nav-icon fas fa-exchange-alt"></i>
                <p>Master Transaksi Penjualan</p>
            </a>
        </li>
        <!-- <li class="nav-item">
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
        </li> -->
    </ul>
</li>