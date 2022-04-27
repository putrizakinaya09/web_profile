<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= $title ?? ''?></h1>
</div>
<div class="row mt-5">
    <div class="col">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h4 class="card-title">List Categories</h4>
                <a href="/article-categories/create" class="btn btn-primary btn-sm float-end">Create Data</a>
            </div>
            <div class="card-body">
            <table class="table table -sm table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categories as $index => $category) : ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= $category->name ?></td>
                                <td>
                                    <a href="<?= base_url('/article-categories/' . $category->id . '/edit') ?>" class="btn btn-info btn-sm">Edit</a>
                                    <a href="<?= base_url('/article-categories/' . $category->id . '/delete') ?>" class="btn btn-danger btn-sm" onclick="return confirm('matakuliah ini akan terhapus, lanjutkan?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#content').summernote({
            tabsize: 2,
            height: 500
        });
    });
</script>

<?= $this->endSection() ?>