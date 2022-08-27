<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    </div>


    <div class="row">

        <!-- Form Column -->
        <div class="container">

            <div class="card o-hidden border-0 shadow-lg col-lg-7 my-5 mx-auto">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <?= $this->session->flashdata('pesan'); ?>
                                    <h1 class="h4 text-gray-900 mb-4"><?= $title; ?></h1>
                                </div>
                                <form class="user row col-sm ml-5" method="POST" action="<?= base_url('pernikahan/edit_mempelai/') . $mempelai['id']; ?>" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?= $mempelai['id']; ?>">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="np_pria" placeholder="Nama Panggilan Pria" name="np_pria" value="<?= $mempelai['np_pria']; ?>">
                                        <?= form_error('np_pria', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group ml-1">
                                        <input type="text" class="form-control form-control-user" id="np_wanita" placeholder="Nama Panggilan Wanita" name="np_wanita" value="<?= $mempelai['np_wanita']; ?>">
                                        <?= form_error('np_wanita', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="nl_pria" placeholder="Nama Lengkap pria" name="nl_pria" value="<?= $mempelai['nl_pria']; ?>">
                                        <?= form_error('nl_pria', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="nl_wanita" placeholder="Nama Lengkap wanita" name="nl_wanita" value="<?= $mempelai['nl_wanita']; ?>">
                                        <?= form_error('nl_wanita', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="na_pria" placeholder="Nama Ayah Pria" name="na_pria" value="<?= $mempelai['na_pria']; ?>">
                                        <?= form_error('na_pria', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>

                                    <div class="form-group ml-1">
                                        <input type="text" class="form-control form-control-user" id="na_wanita" placeholder="Nama Ayah Wanita" name="na_wanita" value="<?= $mempelai['na_wanita']; ?>">
                                        <?= form_error('na_wanita', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="ni_pria" placeholder="Nama Mempelai pria" name="ni_pria" value="<?= $mempelai['ni_pria']; ?>">
                                        <?= form_error('ni_pria', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>

                                    <div class="form-group ml-1">
                                        <input type="text" class="form-control form-control-user" id="ni_wanita" placeholder="Nama Mempelai Wanita" name="ni_wanita" value="<?= $mempelai['ni_wanita']; ?>">
                                        <?= form_error('ni_wanita', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-10">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <img src="<?= base_url('/wedding-2/images/wedding/wedding-1/mempelai/') . $mempelai['image']; ?>" class="img-thumbnail">
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="image" name="image">
                                                        <label class="custom-file-label" for="image">Pilih Gambar</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="">
                                            <a class="mt-3 btn btn-warning btn-user btn-block" href="<?= base_url('pernikahan') ?>"> Kembali</a>
                                        </div>
                                        <div class="col-sm">
                                            <button type="submit" class="mt-3 btn btn-info btn-user btn-block">
                                                Simpan
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>