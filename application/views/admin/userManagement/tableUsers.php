<div class="card shadow">
    <!-- <div class="card-header">
        Transaksi Pembelian
    </div> -->
    <form id="formSubmitAddObat">
        <div class="card-body">
            <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>User Name</th>
                        <th>Sebagai</th>
                        <th>Waktu Input</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($users as $val) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $val->nama; ?></td>
                            <td><?= $val->username; ?></td>
                            <td><?= $val->role; ?></td>
                            <td><?= $val->waktu_buat; ?></td>
                            <td><img src="<?= base_url(); ?>/img/<?= $val->foto; ?>" alt="..." class="img-thumbnail setImg"></td>
                            <td>
                                <button type="button" onclick="edit_user(<?= $val->id; ?>)" class="btn btn-warning">Edit</button>
                                <button type="button" onclick="delete_user(<?= $val->id; ?>)" class="btn btn-danger">Hapus</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </form>
</div>