<?php if ($this->session->flashdata('flash')) : ?>
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Data Tamu
                <strong>berhasil</strong>
                <?= $this->session->flashdata('flash'); ?>.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
<?php endif; ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Tamu Undangan</h6>
    </div>
    <a href="<?= base_url('Admin/tambah_tamu_syukuran'); ?>" class="btn btn-facebook btn-block col-lg-2 mt-1"><i class="fa-solid fa-person-circle-plus"></i></fa-solid> Tambah Tamu</a>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Tamu</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($list as $l) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $l['nama']; ?></td>
                            <td>
                                <a href="<?= base_url(); ?>Admin/edit_tamu_undangan/<?= $l['id']; ?>" class="btn btn-warning btn-circle">
                                    Edit
                                </a>
                                <a href="<?= base_url(); ?>Admin/hapus_tamu_syukuran/<?= $l['id']; ?>" class="btn btn-danger btn-circle" onclick="return confirm('Apa anda yakin?');">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>