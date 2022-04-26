<?= $this->extend('layouts/layout') ?>
<?= $this->section('content') ?>

<h1 class="text-primary">Halaman Presensi Mahasiswa</h1>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form Presensi</h4>
            </div>
            <div class="card-body">
                <form action="<?= base_url('/') ?>" method="post">
                    <div class="form-group">
                        <label form="ip_address">IP Address</label>
                        <input readonly type="text" id="ip_address" name="ip_address" class="form-control <?= ($validation->hasError('ip_address')) ? 'is-invalid' : '' ?>" />
                        <div class="invalid-feedback">
                            <?= $validation->getError('ip_address') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label form="id_matakuliah">Nama Mata Kuliah</label>
                        <select class="form-control <?= ($validation->hasError('id_matakuliah')) ? 'is-invalid' : '' ?>" name=" id_matakuliah" id="id_matakuliah">
                            <?php if (!empty($matakuliah)) : ?>
                                <?php foreach ($matakuliah as $val) : ?>
                                    <option value="<?= $val->id ?>"><?= $val->nama_matakuliah ?> (<?= $val->hari ?> | <?= $val->jadwal_absensi ?>)
                                    <?php endforeach ?>
                                <?php endif ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('id_matakuliah') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label form="nim">Nim</label>
                        <input type="text" name="nim" id="nim" class="form-control <?= ($validation->hasError('nim')) ? 'is-invalid' : '' ?>" placeholder="input nim" value="<?= old('nim') ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nim') ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm mt-2">Hadir</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row mt-5">
    <div class="col">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h4 class="card-title">List Presensi <?= $hari_ini ?>, <?= date('d-m-Y') ?></h4>
            </div>
            <div class="card-body">
                <table class="table table -sm table-hover">
                    <thead>
                        <tr>
                            <th>Mata Kuliah</th>
                            <th>Nim</th>
                            <th>Nama Mahasiswa</th>
                            <th>ip address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($presensi as $index => $presen) : ?>
                            <tr>
                                <td><?= $presen->nama_matakuliah ?></td>
                                <td><?= $presen->nim ?></td>
                                <td><?= $presen->nama_mahasiswa ?></td>
                                <td><?= $presen->ip_address ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    let apiKey = '1be9a6884abd4c3ea143b59ca317c6b2';
    fetch(`https://ipgeolocation.abstractapi.com/v1/?api_key=${apiKey}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById("ip_address").value = data.ip_address;
        });
</script>
<?= $this->endSection() ?>