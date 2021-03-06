<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= ucfirst($uri->getSegment(3)) ?? '' ?></h1>
</div>
<div class="row mt-5">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form Input</h4>
            </div>
            <div class="card-body">
                <form action="<?= base_url() ?>/page/<?= $pageType->slug ?? '' ?>/store" method="post">
                    <div class="form-group">
                        <label form="title">Name</label>
                        <input type="text" name="title" id="title" class="form-control <?= ($validation->hasError('title')) ? 'is-invalid' : '' ?>" placeholder="input title" value="<?= $pageType->name ?? '' ?>">
                        <input type="hidden" name="page_type_id" id="page_type_id" class="form-control" value="<?= $pageType->id ?? '' ?>">
                        <input type="hidden" name="id" id="id" class="form-control" value="<?= $page->id ?? '' ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('title') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label form="content">Content</label>
                        <textarea class="form-control <?= ($validation->hasError('content')) ? 'is-invalid' : '' ?>" name="content" id="content" placeholder="input content"><?= $page->content ?? '' ?></textarea>
                        <div class="invalid-feedback">
                            <?= $validation->getError('content') ?>
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