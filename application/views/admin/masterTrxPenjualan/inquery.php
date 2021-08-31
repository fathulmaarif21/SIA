<div class="row">
    <div class="form-group col-5">
        <label>Telusuri Berdasarkan Tanggal</label>

        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="far fa-calendar-alt"></i>
                </span>
            </div>
            <input type="text" class="form-control float-right" id="reservation">
        </div>
    </div>
</div>
<div id="div_inquery" class="row" style="display: none;">
    <!-- Table -->
    <button id="btn_export_excel" class="btn btn-warning  btn-sm mb-2">Export Excel</button>
    <table id='empTable' class="display dataTable table table-striped table-bordered table-sm table-responsive-sm" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Kode Trx</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Note</th>
                <th>Total Trx</th>
                <th>Total Bayar</th>
                <th>Kembalian</th>
                <th>Waktu Trx</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>
<!-- export excel -->
<form id="form_excel" action="<?= base_url('Excel/exporTrx'); ?>" method="post">
    <input type="hidden" id="tgl_start" name="tgl_start" value="">
    <input type="hidden" id="tgl_end" name="tgl_end" value="">
</form>