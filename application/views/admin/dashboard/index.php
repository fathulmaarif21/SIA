<?php $this->load->view('admin/dashboard/header'); ?>
<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <?php $this->load->view('templates/sidebar'); ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <?php $this->load->view('templates/topbar'); ?>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <?php $this->load->view('admin/dashboard/content'); ?>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <?php $this->load->view('templates/footer'); ?>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

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
<div class="modal fade bd-example-modal-xl" style="z-index:6000" id="modal_obat_exp" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
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
                            <th>expire_date</th>
                            <th>stok</th>
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