<div class="card shadow">
    <!-- <div class="card-header">
        Transaksi Pembelian
    </div> -->
    <form id="formSubmitAddObat">
        <div class="card-body">
            <div class="form-group">
                <label for="addNamaObat">Nama Obat</label>
                <input type="text" class="form-control" name="addNamaObat" id="addNamaObat" placeholder="Masukan Nama Obat" required>
            </div>
            <div class="form-group">
                <label for="addHargaJual">Harga Jual</label>
                <input type="number" class="form-control" name="addHargaJual" id="addHargaJual" required>
            </div>
            <div class="form-group">
                <label for="addStok">Stok</label>
                <input type="number" class="form-control" value="0" name="addStok" id="addStok" disabled>
            </div>
            <button type="submit" id="sumbitAddObat" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>