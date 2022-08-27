<div class="row">
    <div class="col-lg-10">
        <div class="p-5">
            <div class="text-left">
                <h1 class="h4 text-gray-900 mb-4"><?= $title; ?></h1>
            </div>
            <form method="POST" action="<?= base_url('user/edit_music/') . $music['id']; ?>" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $music['id']; ?>">
                <div class="form-group">
                    <label for="nama">Nama Music</label>
                    <input type="text" class="form-control form-control-user" id="nama" name="nama" value="<?= $music['nama']; ?>">
                    <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="id_music">ID Music</label>
                    <textarea class="form-control" name="id_music" id="id_music" cols="10" rows="10"><?= $music['id_music']; ?></textarea>
                    <?= form_error('id_music', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <p class="text-right">More Music ? <a href="https://soundcloud.com/discover" target="_blank">SoundCloud Music</a></p>

                <p class="text-right text-danger mb-2">Contoh</p>
                <p class="text-right mb-2">[Ashes Remain]<a href="#" target="_blank"> 183235744 </a></p>
                <p class="text-right mb-2"> [Christina Perry New]<a href="#" target="_blank"> 66810925</a></p>

                <a class="btn btn-sm btn-info text-decoration-none" href="<?= base_url('user/music') ?>"> Kembali</a>
                <button type="submit" class="btn btn-sm btn-success my-3">
                    Save
                </button>
            </form>
        </div>
    </div>
</div>