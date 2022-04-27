<?= $this->extend('layouts/layout') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1><?= $page->title ?? '' ?></h1>
        </div>
        <div class="col-md-6">
            <?= $page->content ?? ''?>
        </div>
    </div>
</div>
</div>
<?= $this->endSection() ?>