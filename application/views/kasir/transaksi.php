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
                    <table id="keranjangList" class="table table-responsive table-striped w-auto small" style="width: 100%;">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Obat</th>
                                <th scope="col">Satuan</th>
                                <th scope="col" style="width: 25%;">Harga</th>
                                <th scope="col" style="width: 18%;">qty</th>
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
                        <label for="totalBayar">Jumlah Bayar</label>
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
                    <!-- <button type="button" onclick="showmodal()" class="btn btn-primary">print <i class="fas fa-angle-double-right"></i></button> -->
                </form>
            </div>
        </div>
    </div>
</div>

<div id="div_cetak" style="visibility: hidden;">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Main content -->
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row invoice-info">
                            <div class="col-12 invoice-col">
                                <h4>
                                    <span> <img src="<?= base_url('assets/'); ?>dist/img/logoSIA.png" width="40"></span> Apotek Ajwa
                                    <!-- <small class="float-right"><?= date("d/m/Y"); ?></small> -->
                                </h4>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                <address>
                                    <strong>Jl. Daeng Pasau No. 9A Kel. Tahoa</strong><br>
                                    No. Hp: 085241804046<br>
                                    Email: rahmat.nur515@gmail.com
                                </address>
                            </div>
                        </div>
                        <div class="row invoice-info">
                            <div class="col-12 table-responsive invoice-col">
                                <table class="table table-borderless table-sm tableLine" id="tablenota" style="width: 100%;">
                                    <tr>
                                        <th style="width: 10%;">No. Nota :</th>
                                        <td style="width: 40%;" id="invoice_no_nota"></td>
                                        <th style="width: 15%;"> Nama :</th>
                                        <td style="width: 35%;" id="invoice_nama"></td>
                                    </tr>
                                    <tr>
                                        <th>Tgl. Nota :</th>
                                        <td><?= date("d/m/Y"); ?></td>
                                        <th> Alamat :</th>
                                        <td id="invoice_alamat"></td>
                                    </tr>
                                    <tr>
                                        <th colspan="2"></th>
                                        <th>Keterangan :</th>
                                        <td id="invoice_note"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- /.row -->

                        <!-- Table row -->
                        <div class="row nvoice-info">
                            <div class="col-12 table-responsive invoice-col">
                                <table class="table table-borderless table-sm tableLine" id="detaillist_nota" style="width: 100%;" border="0">
                                    <thead>
                                        <tr>
                                            <th>Kode</th>
                                            <th>Nama Obat</th>
                                            <th>Satuan</th>
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

                        <div class="row nvoice-info">
                            <!-- accepted payments column -->
                            <div class="col-8">
                            </div>
                            <!-- /.col -->
                            <div class="col-4 table-responsive invoice-col">
                                <table class="table table-borderless tableLine">
                                    <tr>
                                        <th style="width:50%">Total :</th>
                                        <td id="invoice_Total"></td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Bayar :</th>
                                        <td id="invoice_bayar"></td>
                                    </tr>
                                    <tr>
                                        <th>Kembalian :</th>
                                        <td id="invoice_kembali"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-7"></div>
                            <div class="col-5" style="text-align:center">
                                Tanggal, <?= date("d/m/Y"); ?> <br><br><br><br><br>(_______________)
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.invoice -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
</div>

<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            ...
        </div>
    </div>
</div>

<!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#success_tic">Open Modal</button> -->

<!-- Modal -->
<div id="success_tic" class="modal fade" role="dialog">
    <div class="modal-dialog  modal-dialog-centered ">
        <!-- Modal content-->
        <div class="modal-content">
            <a class="close" href="#" data-dismiss="modal">&times;</a>
            <div class="page-body">
                <h1 style="text-align:center;">
                    <div class="checkmark-circle">
                        <div class="background"></div>
                        <div class="checkmark draw"></div>
                    </div>
                    <h1>
                        <div class="head">
                            <h4>Transaksi Berhasil!</h4>
                            <button type="button" onclick="klikbtnPrint()" id="btn_print" class="btn btn-success"><i class="fas fa-print"></i> Cetak Nota?</button>
                        </div>
            </div>
        </div>
    </div>

</div>