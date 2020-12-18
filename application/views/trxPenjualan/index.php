<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/topbar'); ?>
<?php $this->load->view('templates/sidebar'); ?>
<?php $this->load->view('trxPenjualan/content'); ?>
<?php $this->load->view('templates/footer'); ?>
<div class="modal fade bd-example-modal-xl" id="modal_detail_trx" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-gradient-indigo">
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
<?php $this->load->view('templates/js'); ?>
<?php $this->load->view('trxPenjualan/js'); ?>