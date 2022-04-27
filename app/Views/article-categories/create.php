<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= $title ?? '' ?></h1>
</div>
<div class="row mt-5">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form Input</h4>
            </div>
            <div class="card-body">
                <form action="<?= base_url() ?>/article-categories/store" method="post">
                    <div class="form-group">
                        <label form="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control <?= ($validation->hasError('name')) ? 'is-invalid' : '' ?>" placeholder="input name" value="<?= old('name') ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('name') ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm mt-2">SAVE</button>
                </form>
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