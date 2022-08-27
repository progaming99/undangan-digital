<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <hr class="sidebar-divider">

    <h3><?= $title5; ?></h3>
    <div class="row">

        <div class="card-body">
            <div class="table-responsive table-hover">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <?= $this->session->flashdata('pesan'); ?>
                    <?= $this->session->flashdata('flash'); ?>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Image</th>
                            <th>Aktif</th>
                            <th>Member Sejak</th>
                            <th>Aksi</th>
                        </tr>
                    <tbody>
                        <div hidden>
                            <?= $i = 1; ?>
                        </div>
                        <?php foreach ($nama as $u) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $u['nama']; ?></td>
                                <td><?= $u['email']; ?></td>
                                <td><?= $u['image']; ?></td>
                                <td><?= $u['is_active']; ?></td>
                                <td><?= date('d F Y', $u['created_at']); ?></td>
                                <td>
                                    <a href="<?= base_url(); ?>admin/edit_user/<?= $u['id']; ?>" class="btn btn-info btn-circle">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                    <a href="<?= base_url(); ?>admin/hapus_user/<?= $u['id']; ?>" class="btn btn-danger btn-circle" onclick="return confirm('Apa anda yakin?');">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>