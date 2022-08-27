<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Pilih Jenis Undangan</h1>
    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('pesan'); ?>

            <h5></h5>
            <table class=" table table-hover table-dark">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Pilih</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($menu as $mu) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $mu['menu']; ?></td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" <?= check_access($role['id'], $mu['id']); ?> data-role="<?= $role['id']; ?>" data-menu="<?= $mu['id']; ?>">
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->