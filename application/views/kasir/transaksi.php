<div class="row">
    <div class="col-sm-7">
        <div class="card border-primary mb-2 border-left-primary shadow ">
            <div class="card-body text-info">
                <h5>Search <i class="fas fa-search"></i></h5>
                <div class="input-group mb-3">
                    <select class="" id="id_select_obat">
                        <option selected>Ketik Nama Obat Atau kd Obat</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-5">
        <!-- <div class="card text-white bg-info" style="max-width: 18rem;">
            <div class="card-header">Total</div>
            <div class="card-body">
                <h3>Rp. 0</h3>
            </div>
        </div> -->
        <div class="card  mb-2  shadow  mb-2 bg-success">
            <div class="card-body">
                <p class="card-text"><b>Total :</b></p>
                <h1 class="h2">Rp. <span id="totalTagihan">0</span></h1>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-9">
        <div class="card shadow text-center text-gray-800">
            <div class="card-body font-weight-bold">
                <div class="table-responsive-sm">
                    <table id="keranjangList" class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Obat</th>
                                <th scope="col">Harga</th>
                                <th scope="col" style="width: 8em;">qty</th>
                                <th scope="col">Subtotal</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="addList">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="card  shadow">
            <div class="card-body">
                <form class="needs-validation" novalidate>
                    <div class="form-group">
                        <label for="totalBayar">Total Bayar</label>
                        <input type="text" class="form-control form-control-lg" name="totalBayar" id="totalBayar" placeholder="Bayar" required>
                    </div>
                    <div class="form-group">
                        <label for="tampilan_kembalian">Kembalian</label>
                        <input type="text" class="form-control form-control-lg" name="tampilan_kembalian" id="tampilan_kembalian" placeholder="Rp. 0" readonly>
                        <input type="hidden" class="form-control" name="kembalian" id="kembalian" value="0" readonly>
                        <div class="invalid-feedback">
                            Uang Ta Kurang
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit <i class="fas fa-angle-double-right"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="printThis">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Main content -->
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <span> <img src="<?= base_url('assets/'); ?>dist/img/logoSIA.png" width="40"></span> AdminLTE, Inc.
                                    <small class="float-right"><?= date("d/m/Y"); ?></small>
                                </h4>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                <address>
                                    <strong>Jalan Nuri</strong><br>
                                    Phone: (804) 123-5432<br>
                                    Email: info@apotekajwa.com
                                </address>
                            </div>
                        </div>
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                <table class="table table-borderless table-sm" id="rowNota">
                                    <tr>
                                        <th>No. Nota</th>
                                        <th>:</th>
                                        <th id="invoice_no_nota"></th>
                                    </tr>
                                    <tr>
                                        <th>Tgl. Nota</th>
                                        <th>:</th>
                                        <th id="invoice_no_nota"><?= date("Y/m/d"); ?></th>
                                    </tr>
                                    <tr>
                                        <th>Nama</th>
                                        <th>:</th>
                                        <th id="invoice_nama"></th>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <th>:</th>
                                        <th id="invoice_alamat"></th>
                                    </tr>
                                    <tr>
                                        <th>Keterangan</th>
                                        <th>:</th>
                                        <th id="invoice_note"></th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- /.row -->

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Kode</th>
                                            <th>Nama Obat</th>
                                            <th>Harga @</th>
                                            <th>qty</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <!-- accepted payments column -->
                            <div class="col-6">
                            </div>
                            <!-- /.col -->
                            <div class="col-6">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:50%">Total:</th>
                                            <td id="invoice_Total">$250.30</td>
                                        </tr>
                                        <tr>
                                            <th>Total Bayar</th>
                                            <td>$10.34</td>
                                        </tr>
                                        <tr>
                                            <th>Kembalian:</th>
                                            <td>$5.80</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- this row will not appear when printing -->
                        <div class="row no-print">
                            <div class="col-12">
                                <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                                <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                                    Payment
                                </button>
                                <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                    <i class="fas fa-download"></i> Generate PDF
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- /.invoice -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
</div>