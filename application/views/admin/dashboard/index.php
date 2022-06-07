<?php $this->load->view('admin/dashboard/header'); ?>
<?php $this->load->view('templates/topbar'); ?>
<?php $this->load->view('templates/sidebar'); ?>
<?php $this->load->view('admin/dashboard/content'); ?>
<?php $this->load->view('templates/footer'); ?>
<div class="modal fade bd-example-modal-xl" id="modal_obat_exp" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-gradient-danger">
                <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="expired" class="table table-striped table-bordered table-responsive-sm" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Kd Obat</th>
                            <th>Nama obat</th>
                            <th>No Faktur</th>
                            <th>No Batch</th>
                            <th>Expire_date</th>
                            <th>Jumlah</th>
                            <th>#</th>
                        </tr>
                    </thead>
                </table>
                <tbody></tbody>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('templates/js'); ?>
<?php $this->load->view('admin/dashboard/js'); ?>