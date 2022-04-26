<?= $this->extend('layouts/layout') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form Input</h4>
            </div>
            <div class="card-body">
                <form action="<?= base_url('/matakuliah/store') ?>" method="post">
                    <div class="form-group">
                        <label form="nama_matakuliah">Nama Mata Kuliah</label>
                        <input type="text" name="nama_matakuliah" id="nama_matakuliah" class="form-control <?= ($validation->hasError('nama_matakuliah')) ? 'is-invalid' : '' ?>" placeholder="input nama mata kuliah" value="<?= old('nama_matakuliah') ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_matakuliah') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label form="jadwal_absensi">Jadwal Absensi</label>
                        <input type="time" value="17:00" name="jadwal_absensi" id="jadwal_absensi" class="form-control <?= ($validation->hasError('jadwal_absensi')) ? 'is-invalid' : '' ?>" placeholder="input jadwal absensi" value="<?= old('jadwal_absensi') ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('jadwal_absensi') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label form="hari">Hari</label>
                        <select class="form-control <?= ($validation->hasError('hari')) ? 'is-invalid' : '' ?>" name="hari" id="hari">
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jum'at</option>
                            <option value="Sabtu">Sabtu</option>
                            <option value="Minggu">Minggu</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('hari') ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm mt-2">SAVE</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>