<form id="formSubmitFaktur">
    <div class="card shadow">
        <!-- <div class="card-header">
        Transaksi Pembelian
    </div> -->
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="tglFaktur">Tanggal Faktur Pembelian</label>
                    <input type="date" class="form-control" name="tglFaktur" id="tglFaktur" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="jt_tempo">Jatuh Tempo</label>
                    <input type="date" class="form-control" name="jt_tempo" id="jt_tempo" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="NomorFaktur">Nomor Faktur</label>
                    <input type="text" class="form-control" name="NomorFaktur" id="NomorFaktur" placeholder="Masukan Nomor Faktur" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="suplier">Suplier</label>
                    <select class="form-control js-example-basic-single" id="suplier" name="suplier" required>
                        <option value="">Pilih Supplier</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="id_select_obat">Cari Obat</label>
                    <select class="" id="id_select_obat">
                        <option selected>Ketik Nama Obat Atau kd Obat</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-4 shadow">
        <div class="card-body">
            <div class="row">
                <div class="col-auto">
                    <table id="keranjangList" class="table table-responsive table-striped w-auto small" style="width: 100%;">
                        <thead>
                            <tr>
                                <th scope="col">Kd Obat</th>
                                <th scope="col">Nama Obat</th>
                                <th scope="col">No Batch</th>
                                <th scope="col">Harga Beli</th>
                                <th scope="col" style="width: 10%;">qty</th>
                                <th scope="col">Tgl Expired</th>
                                <th scope="col">Subtotal</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="addList">

                        </tbody>
                    </table>
                </div>

            </div>

            <div class="row">
                <div class="col-sm-8">
                    <div class="card">
                        <div class="card-body">
                            <form class="form-horizontal">
                                <div class="card-body">

                                    <div class="form-row">
                                        <div class="col-7">
                                            <div class="form-group">
                                                <label for="jml_harga">Jumlah Harga</label>
                                                <input type="text" class="form-control form-control-lg" value="0" name="jml_harga" id="jml_harga" readonly>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="PPn">PPn</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <input type="checkbox" id="myCheck" onclick="enablePPn()">
                                                        </span>
                                                    </div>
                                                    <input type="number" value="0" class="form-control form-control-lg" name="PPn" id="PPn" readonly>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"> %</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group" id="div_ppn" style="display: none;">
                                                <input type="text" class="form-control form-control-lg" value="0" name="resultPPn" id="resultPPn" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-footer -->
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><b>Total :</b></h5>
                            <br>
                            <div class="card-text">
                                <h2 class="h2">Rp. <span id="totalTagihan">0</span></h2>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary" type="button"><i class="fas fa-save"></i> Simpan Data</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>