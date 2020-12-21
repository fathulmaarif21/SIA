<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">TRANSAKSI PENJUALAN</h3>
        <button type="button" class="btn btn-warning float-right" data-toggle="modal" data-target="#Shortcut"><i class="fas fa-info-circle"></i> Shortcut</button>
    </div>
    <div class="card-body shadow">
        <?php $this->load->view('kasir/transaksi'); ?>
    </div>
    <div style="visibility: hidden;" id="printThis">

    </div>
</div>