<?= $this->extend('layouts/layout') ?>
<?= $this->section('content') ?>

<div class="row mt-5">
    <div class="col">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h4 class="card-title">List Mahasiswa</h4>
                <a href="/mahasiswa/create" class="btn btn-primary btn-sm float-end">Create Data</a>
            </div>
            <div class="card-body">
                <table class="table table -sm table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nim</th>
                            <th>Nama Mahasiswa</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($mahasiswa as $index => $mhs) : ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= $mhs->nim ?></td>
                                <td><?= $mhs->nama_mahasiswa ?></td>
                                <td>
                                    <a href="<?= base_url('/mahasiswa/' . $mhs->id . '/edit') ?>" class="btn btn-info btn-sm">Edit</a>
                                    <a href="<?= base_url('/mahasiswa/' . $mhs->id . '/delete') ?>" class="btn btn-danger btn-sm" onclick="return confirm('mahasiswa ini akan terhapus, lanjutkan?')">Delete</a>
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