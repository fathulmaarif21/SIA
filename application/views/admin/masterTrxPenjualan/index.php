<?php $this->load->view('templates/header'); ?>
<!-- daterange picker -->
<link rel="stylesheet" href="<?= base_url(); ?>/assets/plugins/daterangepicker/daterangepicker.css">
<style>
    /* @media print {
        body * {
            visibility: hidden;
        }

        #div_cetak,
        #div_cetak * {
            visibility: visible !important;
        }

        #div_cetak {
            position: absolute;
            left: 0;
            top: 0;
            right: 0;
        }
    } */

    @media screen {
        #printSection {
            display: none;
        }
    }

    @media print {
        body * {
            visibility: hidden;
        }

        #printSection,
        #printSection * {
            visibility: visible;
        }

        #printSection {
            position: absolute;
            left: 0;
            top: 0;
            right: 0;

        }
    }
</style>
<?php $this->load->view('templates/topbar'); ?>
<?php $this->load->view('templates/sidebar'); ?>
<?php $this->load->view('admin/masterTrxPenjualan/content'); ?>
<?php $this->load->view('templates/footer'); ?>
<div class="modal fade bd-example-modal-xl" id="modal_detail_trx" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="table_detail_trx" class="table table-striped table-bordered table-responsive-sm" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Kd Transaksi</th>
                            <th>Nama Obat</th>
                            <th>Qty</th>
                            <th>Sub Total</th>
                        </tr>
                    </thead>
                </table>
                <tbody id="table_detail_trx">

                </tbody>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- modal cetak nota -->
<div class="modal fade bd-example-modal-xl" id="modal_cetakNota" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title">Cetak Nota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="printThis">
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
                                                        <td id="invoice_tgl_nota"></td>
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

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="btnPrint" type="button" class="btn btn-success">Print</button>
            </div>
        </div>
    </div>
</div>


<?php $this->load->view('templates/js'); ?>
<?php $this->load->view('admin/masterTrxPenjualan/js'); ?>