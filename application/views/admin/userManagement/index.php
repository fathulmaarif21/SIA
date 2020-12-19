<?php $this->load->view('templates/header'); ?>

<?php $this->load->view('templates/topbar'); ?>
<?php $this->load->view('templates/sidebar'); ?>
<?php $this->load->view('admin/userManagement/content'); ?>
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
                <form id="form_user">
                    <input type="hidden" value="" name="id_user" />
                    <input type="hidden" value="" name="old_fileName" />
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" name="namaUpdate" id="namaUpdate" placeholder="Masukan Nama" required>
                    </div>
                    <div class="form-group">
                        <label for="username">User Name</label>
                        <input type="text" class="form-control" name="usernameUpdate" id="usernameUpdate" required>
                    </div>

                    <div class="form-group">
                        <label for="role">Sebagai</label>
                        <select class="form-control" name="roleUpdate" id="roleUpdate" required>
                            <option value="1">Admin</option>
                            <option value="2">Karyawan</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="btnSaveUser" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>

<?php $this->load->view('templates/js'); ?>
<?php $this->load->view('admin/userManagement/js'); ?>