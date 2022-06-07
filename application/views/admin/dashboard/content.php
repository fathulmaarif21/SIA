<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3 id="r_saldo"></h3>

                <p>Saldo <?= date("j-m-Y"); ?></p>
            </div>
            <div class="icon">
                <i class="far fa-money-bill-alt"></i>
            </div>
            <a href="<?= base_url('user'); ?>/trxPenjualan" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3 id="r_trx"></h3>

                <p>Jumlah Transaksi</p>
            </div>
            <div class="icon">
                <i class="fas fa-exchange-alt"></i>
            </div>
            <a href="<?= base_url('user'); ?>/trxPenjualan" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3 id="r_stok"></h3>

                <p>Stok Obat Kosong</p>
            </div>
            <div class="icon">
                <i class="far fa-meh-blank"></i>
            </div>
            <a href="<?= base_url('user'); ?>/dataObat" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3><?= $jml_expired; ?></h3>

                <p>Total Obat Expired</p>
            </div>
            <div class="icon">
                <i class="fas fa-skull-crossbones"></i>
            </div>
            <a href="#" onclick="get_data_expired()" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>

<!-- <div class="row">
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Saldo <?= date("F Y"); ?></span>
                <span class="info-box-number" id="saldo_bulanan">
                    0
                </span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Likes</span>
                <span class="info-box-number">41,410</span>
            </div>
        </div>
    </div>
    <div class="clearfix hidden-md-up"></div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Sales</span>
                <span class="info-box-number">760</span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">New Members</span>
                <span class="info-box-number">2,000</span>
            </div>
        </div>
    </div>
</div> -->

<div class="row ">
    <div class="col-md-5">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chart-pie"></i> <b>Top 5 (<?= date("F Y"); ?>)</b></h3>
            </div>
            <div id="chartdiv">
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chart-bar"></i> <b>Chart Transaksi</b></h3>
            </div>
            <div id="controls"></div>
            <div id="chartSaldo"></div>
        </div>
    </div>
</div>

<div class="row">

</div>