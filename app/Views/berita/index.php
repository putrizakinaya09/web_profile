<?= $this->extend('layouts/layout') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <h1 class="text-center">Berita</h1>
    <div class="row my-5">
        <?php if (isset($articles)) : ?>
            <?php foreach ($articles as $value) : ?>
                <div class="col-md-6">
                    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-static">
                            <strong class="d-inline-block mb-2 text-primary">World</strong>
                            <h3 class="mb-0"><?= $value['title'] ?? '' ?></h3>
                            <div class="mb-1 text-muted"><?= $value['date_ago'] ?? '' ?></div>
                            <p class="card-text mb-auto"><?= $value['short_content'] ?? '' ?></p>
                            <a href="<?= base_url()?>/berita/<?= $value['slug'] ?? '' ?>" class="stretched-link">Continue reading</a>
                        </div>
                        <div class="col-auto d-none d-lg-block">
                            <?= !empty($value['images']) ? '<img style="max-width:350px" class="img-thumbnail" src="/assets/images/'.$value["images"].'">' : '' ?>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        <?php endif ?>
    </div>

</div>
<?= $this->endSection() ?>