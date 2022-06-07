<!-- <div class="row">
    <div class="form-group col-5">
        <label>Telusuri Berdasarkan Tanggal Faktur</label>

        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="far fa-calendar-alt"></i>
                </span>
            </div>
            <input type="text" class="form-control float-right" id="reservation">
        </div>
    </div>
</div> -->

<form id="form_produk">
    <div class="card card-custom gutter-b" id="card_ejm">
        <div class="card-body">
            <div class="form-group row">
                <label class="col-2 text-lg-right">Periode Awal Tx</label>
                <div class="col-3">
                    <input class="form-control validate" placeholder="Periode Awal" name="TGL_AWAL" id="TGL_AWAL" type="date" value="<?= date('Y-m-d'); ?>" rules="required" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 text-lg-right">Periode Akhir Tx</label>
                <div class="col-3">
                    <input class="form-control validate" placeholder="Periode Akhir" name="TGL_AKHIR" id="TGL_AKHIR" type="date" value="<?= date('Y-m-d'); ?>" rules="required" />
                </div>
            </div>
        </div>
        <div class="card-footer" align="right">
            <button type="reset" class="btn btn-secondary" id="btn_reset">Reset</button>
            <button type="button" class="btn btn-primary" id="btn_cari">Cari</button>
        </div>
    </div>
</form>
<div id="div_inquery" class="row" style="display: none;">
    <!-- Table -->
    <button id="btn_export_excel" class="btn btn-warning  btn-sm mb-2">Export Excel</button>
    <table id='empTable' class="display dataTable table table-striped table-bordered table-sm table-responsive-sm" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>No Faktur</th>
                <th>Supplier</th>
                <th>Jumlah Harga</th>
                <th>PPn%</th>
                <th>PPn Rupiah</th>
                <th>Total Transaksi</th>
                <th>Tgl. Faktur</th>
                <th>Tgl. Jth Tempo</th>
                <th>Waktu Input</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>
<!-- export excel -->
<form id="form_excel" action="<?= base_url('Excel/exporFaktur'); ?>" method="post">
    <input type="hidden" id="tgl_start" name="tgl_start" value="">
    <input type="hidden" id="tgl_end" name="tgl_end" value="">
</form>