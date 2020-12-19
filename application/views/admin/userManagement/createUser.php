<div class="card shadow">
    <!-- <div class="card-header">
        Transaksi Pembelian
    </div> -->
    <form id="form_create">
        <div class="card-body">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukan Nama" required>
            </div>
            <div class="form-group">
                <label for="username">User Name</label>
                <input type="text" class="form-control" name="username" id="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>
            <div class="form-group">
                <label for="role">Sebagai</label>
                <select class="form-control" name="role" required>
                    <option value="1">Admin</option>
                    <option value="2">Karyawan</option>
                </select>
            </div>

            <button type="submit" id="" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>