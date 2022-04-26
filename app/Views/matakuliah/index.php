<?= $this->extend('layouts/layout') ?>
<?= $this->section('content') ?>
<div class="row mt-5">
    <div class="col">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h4 class="card-title">List Matakuliah</h4>
                <a href="/matakuliah/create" class="btn btn-primary btn-sm float-end">Create Data</a>
            </div>
            <div class="card-body">
                <table class="table table -sm table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Matakuliah</th>
                            <th>jadwal Absensi</th>
                            <th>Hari</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($matakuliah as $index => $matkul) : ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= $matkul->nama_matakuliah ?></td>
                                <td><?= $matkul->jadwal_absensi ?></td>
                                <td><?= $matkul->hari ?></td>
                                <td>
                                    <a href="<?= base_url('/matakuliah/' . $matkul->id . '/edit') ?>" class="btn btn-info btn-sm">Edit</a>
                                    <a href="<?= base_url('/matakuliah/' . $matkul->id . '/delete') ?>" class="btn btn-danger btn-sm" onclick="return confirm('matakuliah ini akan terhapus, lanjutkan?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>