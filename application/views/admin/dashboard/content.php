<div class="row">
    <div class="col-md-3 product">
        <div class="effect-1"></div>
        <div class="effect-2"></div>
        <div class="dbox  dbox--color-3 shadow">
            <div class="dbox__icon">
                <i class="far fa-money-bill-alt"></i>
            </div>
            <div class="dbox__body">
                <div class="dbox__count" id="r_saldo"></div>
                <span class="dbox__title">Saldo</span>
            </div>

            <div class="dbox__action">
                <a href="<?= base_url('user'); ?>/trxPenjualan" class="dbox__action__btn btn btn-primary">More Info</a>
            </div>
        </div>
    </div>
    <div class="col-md-3 product">
        <div class="effect-3"></div>
        <div class="effect-4"></div>
        <div class="dbox dbox--color-2 shadow">
            <div class="dbox__icon">
                <i class="fas fa-exchange-alt"></i>
            </div>
            <div class="dbox__body">
                <div class="dbox__count" id="r_trx"></div>
                <span class="dbox__title">Jumlah Transaksi</span>
            </div>

            <div class="dbox__action">
                <a href="<?= base_url('user'); ?>/trxPenjualan" class="dbox__action__btn btn btn-warning">More Info</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="dbox dbox--color-4 shadow">
            <div class="dbox__icon">
                <i class="far fa-meh-blank"></i>
            </div>
            <div class="dbox__body">
                <div class="dbox__count" id="r_stok"></div>
                <span class="dbox__title">Stok Obat Kosong</span>
            </div>
            <div class="dbox__action">
                <a href="<?= base_url('user'); ?>/dataObat" class="dbox__action__btn  btn btn-success">More Info</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="dbox dbox--color-1 shadow">
            <div class="dbox__icon">
                <i class="fas fa-skull-crossbones"></i>
            </div>
            <div class="dbox__body">
                <span class="dbox__count"><?= $jml_expired; ?></span>
                <span class="dbox__title">Total Obat Expired</span>
            </div>

            <div class="dbox__action">
                <button onclick="get_data_expired()" class="dbox__action__btn btn btn-danger">More Info</button>
            </div>
        </div>
    </div>
</div>
<div class="row mt-5 ml-4">
    <div class="col-md-5">
        <!-- <div class="card">
            <div class="card-header">
                <h4>Top Sale</h4>
            </div>
            <div class="card-body"> -->
        <div id="chartdiv">
        </div>
        <!-- </div>
        </div> -->

    </div>
    <div class="col-md-7">
        <div id="controls"></div>
        <div id="chartSaldo"></div>
    </div>
</div>
<div class="row">

</div>