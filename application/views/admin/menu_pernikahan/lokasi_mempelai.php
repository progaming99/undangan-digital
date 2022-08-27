<?php if ($this->session->flashdata('flash')) : ?>
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Data Lokasi Mempelai
                <strong>berhasil</strong>
                <?= $this->session->flashdata('flash'); ?>.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
<?php endif; ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Mempelai Pria</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>User ID</th>
                        <th>Nama Mempelai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($lokasi as $l) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $l['id_user']; ?></td>
                            <td><?= $l['nl_pria']; ?> & <?= $l['nl_wanita']; ?></td>
                            <td>
                                <a href="<?= base_url(); ?>admin/detail_lokasi_mempelai/<?= $l['id_user']; ?>" class="btn btn-info btn-circle">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                                <a href="<?= base_url(); ?>admin/hapus_mempelai/<?= $l['id']; ?>" class="btn btn-danger btn-circle" onclick="return confirm('Apa anda yakin?');">
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