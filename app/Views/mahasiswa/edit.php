<?= $this->extend('layouts/layout') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col">
        <form action="<?= base_url('/mahasiswa/update') ?>" method="post">
            <input type="hidden" name="id" value="<?= $mahasiswa->id ?>">
            <div class="form-group">
                <label form="nim">Nim</label>
                <input type="text" name="nim" id="nim" class="form-control <?= ($validation->hasError('nim')) ? 'is-invalid' : '' ?>" value="<?= $mahasiswa->nim ?>">
                <div class="invalid-feedback">r
                    <?= $validation->getError('nim') ?>
                </div>
            </div>
            <div class="form-group">
                <label form="nama_mahasiswa">Nama Mahasiswa</label>
                <input type="text" name="nama_mahasiswa" id="nama_mahasiswa" class="form-control <?= ($validation->hasError('nama_mahasiswa')) ? 'is-invalid' : '' ?>" value="<?= $mahasiswa->nama_mahasiswa ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('nama_mahasiswa') ?>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-sm mt-2">SAVE</button>
        </form>
    </div>
</div>
</div>
</div>

<?= $this->endSection() ?>