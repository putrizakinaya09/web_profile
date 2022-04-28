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
            <form action="<?= base_url() ?>/articles/update" method="post">
                    <div class="form-group">
                        <label form="title">Title</label>
                        <input type="hidden" name="id" id="id" value="<?= $articles->id ?? '' ?>">
                        <input type="text" name="title" id="title" class="form-control <?= ($validation->hasError('title')) ? 'is-invalid' : '' ?>" placeholder="input title" value="<?= $articles->title ?? '' ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('title') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label form="categories">Categories</label>
                        <select multiple="multiple" style="width: 100%;" name="categories[]" id="categories" class="<?= ($validation->hasError('categories')) ? 'is-invalid' : '' ?>">
                            <?php if ($categories) : ?>
                                <?php foreach ($categories as $key => $value) : ?>
                                    <option <?= in_array($value->id, $categories_relation) ? 'selected' : '' ?> value="<?= $value->id ?>"><?= $value->name ?></option>
                                <?php endforeach ?>
                            <?php endif ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('categories') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label form="slug">Slug</label>
                        <input type="text" name="slug" id="slug" class="form-control <?= ($validation->hasError('slug')) ? 'is-invalid' : '' ?>" placeholder="input slug" value="<?= $articles->slug ?? '' ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('slug') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label form="status">Status</label>
                        <select style="width: 100%;" name="status" id="status" class="<?= ($validation->hasError('status')) ? 'is-invalid' : '' ?>">
                            <option <?= $articles->status == '0' ? 'selected' : '' ?> value="0">Draft</option>
                            <option <?= $articles->status == '1' ? 'selected' : '' ?> value="1">Publish</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('status') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label form="content">Content</label>
                        <textarea class="form-control <?= ($validation->hasError('content')) ? 'is-invalid' : '' ?>" name="content" id="content" placeholder="input content"><?= $articles->content ?? '' ?></textarea>
                        <div class="invalid-feedback">
                            <?= $validation->getError('content') ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm mt-2">UPDATE</button>
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
    $('#status').select2({
        theme: 'bootstrap-5'
    });
    $('#categories').select2({
        theme: 'bootstrap-5',
        placeholder: 'Select Category'
    });
</script>

<?= $this->endSection() ?>