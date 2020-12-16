<div class="row">
    <div class="col-sm-7">
        <div class="card border-primary mb-2 border-left-primary shadow ">
            <div class="card-body text-info">
                <h5>Search <i class="fas fa-search"></i></h5>
                <div class="input-group mb-3">
                    <!-- <select class="" id="id_select_obat">
                        <option selected>Ketik Nama Obat Atau kd Obat</option>
                    </select> -->
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-5">
        <!-- <div class="card text-white bg-info" style="max-width: 18rem;">
            <div class="card-header">Total</div>
            <div class="card-body">
                <h3>Rp. 0</h3>
            </div>
        </div> -->
        <div class="card  mb-2 border-left-warning shadow  mb-2" style="background-color: greenyellow;">
            <div class="card-body">
                <p class="card-text"><b>Total :</b></p>
                <h2 class="card-title">Rp. <span id="totalTagihan">0</span></h2>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-9">
        <div class="card shadow text-center text-gray-800">
            <div class="card-body font-weight-bold">
                <div class="table-responsive-sm">
                    <table id="keranjangList" class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Obat</th>
                                <th scope="col">Harga</th>
                                <th scope="col" style="width: 8em;">qty</th>
                                <th scope="col">Subtotal</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="addList">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="card  shadow">
            <div class="card-body">
                <form class="needs-validation" novalidate>
                    <div class="form-group">
                        <label for="totalBayar">Total Bayar</label>
                        <input type="text" class="form-control form-control-lg" name="totalBayar" id="totalBayar" placeholder="Bayar" required>
                    </div>
                    <div class="form-group">
                        <label for="tampilan_kembalian">Kembalian</label>
                        <input type="text" class="form-control form-control-lg" name="tampilan_kembalian" id="tampilan_kembalian" placeholder="Rp. 0" readonly>
                        <input type="hidden" class="form-control" name="kembalian" id="kembalian" value="0" readonly>
                        <div class="invalid-feedback">
                            Uang Ta Kurang
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit <i class="fas fa-angle-double-right"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>