<a href="<?= base_url(); ?>admin/edit_lokasi_mempelai/<?= $detail['id_user']; ?>" class="btn btn-warning btn-icon-split mb-3">
    <span class="icon text-white-50">
        <i class="fas fa-exclamation-triangle"></i>
    </span>
    <span class="text">Edit Lokasi Mempelai</span>
</a>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Acara Utama</h6>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Judul Acara</th>
                    <th scope="col">Alamat Acara</th>
                    <th scope="col">Nama Lokasi</th>
                    <th scope="col">Tgl Pernikahan</th>
                    <th scope="col">Waktu Mulai</th>
                    <th scope="col">Waktu Selesai</th>
                    <th scope="col">Zona Waktu</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $detail['judul_acara']; ?></td>
                    <td><?= $detail['alamat_acara']; ?></td>
                    <td><?= $detail['nm_lokasi']; ?></td>
                    <td><?= $detail['tgl_pernikahan']; ?></td>
                    <td><?= $detail['w_mulai']; ?></td>
                    <td><?= $detail['w_selesai']; ?></td>
                    <td><?= $detail['z_waktu']; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Acara Opsional</h6>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Judul Acara</th>
                    <th scope="col">Alamat Acara</th>
                    <th scope="col">Nama Lokasi</th>
                    <th scope="col">Tgl Pernikahan</th>
                    <th scope="col">Waktu Mulai</th>
                    <th scope="col">Waktu Selesai</th>
                    <th scope="col">Zona Waktu</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $detail['judul_acara2']; ?></td>
                    <td><?= $detail['alamat_acara2']; ?></td>
                    <td><?= $detail['nm_lokasi2']; ?></td>
                    <td><?= $detail['tgl_pernikahan2']; ?></td>
                    <td><?= $detail['w_mulai2']; ?></td>
                    <td><?= $detail['w_selesai2']; ?></td>
                    <td><?= $detail['z_waktu2']; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>