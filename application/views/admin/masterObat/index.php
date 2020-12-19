<?php $this->load->view('templates/header'); ?>

<?php $this->load->view('templates/topbar'); ?>
<?php $this->load->view('templates/sidebar'); ?>
<?php $this->load->view('admin/masterObat/content'); ?>
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
                <form id="form_obat">
                    <input type="hidden" value="" name="kd_obat" />
                    <div class="form-group">
                        <label for="nama_obat" class="col-form-label">Nama Obat:</label>
                        <input type="text" class="form-control" name="nama_obat" value="" id="nama_obat">
                    </div>
                    <div class="form-group">
                        <label for="kemasan" class="col-form-label">Kemasan:</label>
                        <input type="text" class="form-control" name="kemasan" value="" id="kemasan">
                    </div>
                    <div class="form-group">
                        <label for="harga_jual" class="col-form-label">Harga Jual:</label>
                        <input type="text" class="form-control" name="harga_jual" value="" id="harga_jual">
                    </div>
                    <div class="form-group">
                        <label for="stok" class="col-form-label">stok :</label>
                        <input type="text" class="form-control" name="stok" value="" id="stok">
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
<?php $this->load->view('admin/masterObat/js'); ?>