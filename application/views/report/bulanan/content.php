<!-- Horizontal Form -->
<div class="card card-success shadow">
    <div class="card-header">
        <h3 class="card-title">Laporan Bulanan</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form class="form-horizontal" id="form_laporan">
        <div class="card-body">
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Bulan</label>
                <div class="col-sm-10">
                    <select class="form-control" id="lap_bulan" name="lap_bulan" required>
                        <option value="01">Januari</option>
                        <option value="02">Februari</option>
                        <option value="03">Maret</option>
                        <option value="04">April</option>
                        <option value="05">Mei</option>
                        <option value="06">Juni</option>
                        <option value="07">Juli</option>
                        <option value="08">Agustus</option>
                        <option value="09">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Tahun</label>
                <div class="col-sm-10">
                    <select class="form-control" id="lap_tahun" name="lap_tahun" required>
                        <?php
                        $mulai = date('Y');
                        for ($i = $mulai; $i < $mulai + 20; $i++) {
                            $sel = $i == date('Y') ? ' selected="selected"' : '';
                            echo '<option value="' . $i . '"' . $sel . '>' . $i . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn btn-info">Sign in</button>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">Master Obat</h3>
    </div>
    <div class="card-body shadow">
        <div class="row">
            <div class="form-group col-5">
                <label>Telusuri Berdasarkan Tanggal</label>


            </div>
        </div>
        <!-- <div id="div_inquery" class="row" style="display: none;"> -->
        <div id="div_inquery" class="row">
            <table id='laporan_bulanan' class="display dataTable table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Persediaan</th>
                        <th>Saldo Awal</th>
                        <th>Penambahan</th>
                        <th>Pengurangan</th>
                        <th>Saldo Akhir</th>
                        <!-- <th>Harga</th> -->
                        <!-- <th>Keterangan</th> -->
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>