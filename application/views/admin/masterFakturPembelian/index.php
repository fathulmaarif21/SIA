<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/topbar'); ?>
<?php $this->load->view('templates/sidebar'); ?>
<?php $this->load->view('admin/masterFakturPembelian/content'); ?>
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
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addDetailFaktur">
                    Tambah Detail Faktur
                </button>
                <table id="table_detail_trx" class="table table-striped table-bordered table-responsive-sm" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>No Faktur</th>
                            <th>Obat</th>
                            <th>No Batch</th>
                            <th>Qty</th>
                            <th>Harga Beli</th>
                            <th>Sub Total</th>
                            <th>Tanggal Expired</th>
                            <th>#</th>
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

<!-- Modal -->
<div class="modal fade" id="addDetailFaktur" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-primary">
                <h5 class="">Tambah Detail Faktur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formSubmitAddDetailFaktur">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="addno_faktur">No Faktur</label>
                            <input type="text" class="form-control" name="addno_faktur" id="addno_faktur" readonly required>
                            <input type="hidden" class="form-control" name="addkd_obat" id="addkd_obat" readonly required>
                        </div>
                        <div class="form-group ">
                            <label for="id_select_obat">Cari Obat</label>
                            <select class="" id="id_select_obat" required>
                                <option selected>Ketik Nama Obat Atau kd Obat</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="addno_batch">No Batch</label>
                            <input type="text" class="form-control" name="addno_batch" id="addno_batch" required>
                        </div>
                        <div class="form-group">
                            <label for="addharga_beli">Harga Beli</label>
                            <input type="number" class="form-control" name="addharga_beli" id="addharga_beli" required>
                        </div>
                        <div class="form-group">
                            <label for="addqty">Qty</label>
                            <input type="number" class="form-control" name="addqty" id="addqty" required>
                        </div>
                        <div class="form-group">
                            <label for="addsub_total">Sub Total</label>
                            <input type="number" class="form-control" name="addsub_total" id="addsub_total" readonly required>
                        </div>
                        <div class="form-group">
                            <label for="addtgl_expired">tgl_expired</label>
                            <input type="date" class="form-control" value="0" name="addtgl_expired" id="addtgl_expired" required>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
<?php $this->load->view('templates/js'); ?>
<?php $this->load->view('admin/masterFakturPembelian/js'); ?>