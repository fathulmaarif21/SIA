<?php $this->load->view('templates/header'); ?>

<?php $this->load->view('templates/topbar'); ?>
<?php $this->load->view('templates/sidebar'); ?>
<?php $this->load->view('admin/masterSupplier/content'); ?>
<?php $this->load->view('templates/footer'); ?>
<div class="modal fade" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_supplier">
                    <input type="hidden" value="" name="id_suplier" />
                    <div class="form-group">
                        <label for="nama_supplier" class="col-form-label">Nama Supplier:</label>
                        <input type="text" class="form-control" name="nama_supplier" value="" id="nama_supplier">
                    </div>
                    <div class="form-group">
                        <label for="hp" class="col-form-label">No Hp:</label>
                        <input type="text" class="form-control" name="hp" value="" id="hp">
                    </div>
                    <div class="form-group">
                        <label for="alamat" class="col-form-label">Alamat :</label>
                        <textarea class="form-control" name="alamat" id="alamat"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="save()" id="btnSave" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('templates/js'); ?>
<?php $this->load->view('admin/masterSupplier/js'); ?>