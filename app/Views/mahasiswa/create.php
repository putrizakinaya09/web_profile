<?= $this->extend('layouts/layout') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form Input</h4>
            </div>
            <div class="card-body">
                <form action="<?= base_url('/mahasiswa/store') ?>" method="post">
                    <div class="form-group">
                        <label form="nim">Nim</label>
                        <input type="text" name="nim" id="nim" class="form-control <?= ($validation->hasError('nim')) ? 'is-invalid' : '' ?>" placeholder="input nim" value="<?= old('nim') ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nim') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label form="nama_mahasiswa">Nama Mahasiswa</label>
                        <input type="text" name="nama_mahasiswa" id="nama_mahasiswa" class="form-control <?= ($validation->hasError('nama_mahasiswa')) ? 'is-invalid' : '' ?>" placeholder="input nama mahasiswa" value="<?= old('nama_mahasiswai') ?>">
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